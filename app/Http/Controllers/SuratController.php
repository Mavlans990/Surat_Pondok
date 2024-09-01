<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat.index', [
            'surats' => Surat::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'surat_judul' => 'required',
            'surat_tgl_upload' => 'required',
            'surat_link' => 'required',
            'surat_pdf' => 'required|mimes:pdf,jpg|max:2048'
        ]);

        $auto_kode = $this->generate_surat_A();

        $validate['surat_kode'] = $auto_kode;

        // Nama file QR Code
        $qrCodePath = $auto_kode . '.png';
        $filePath = 'qrcodes/' . $qrCodePath;

        // Buat QR Code dan simpan ke file
        QrCode::format('png')->size(500)->generate($validate['surat_link'], storage_path('app/public/' . $filePath));
        $validate['surat_qr_code'] = $filePath;

        // Menangani unggahan berkas PDF
        if ($request->file('surat_pdf')) {
            $file = $request->file('surat_pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('pdf_surat', $fileName, 'public');
            $validate['surat_pdf'] = $fileName;
        }

        Surat::create($validate);
        return redirect('/surat')->with('success', 'Data berhasil ditambahkan!');
    }

    public function generate_surat_A()
    {
        $kode_faktur = DB::table('tb_surat')->max('surat_kode');

        if ($kode_faktur) {
            $nilai = substr($kode_faktur, 7);
            $kode = (int) $nilai;

            //tambahkan sebanyak + 1
            $kode = $kode + 1;
            $auto_kode = "SRT-A-" . str_pad($kode, 6, "0", STR_PAD_LEFT);
        } else {
            $auto_kode = "SRT-A-000001";
        }
        return $auto_kode;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $surat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        return view('surat.edit', [
            'surat' => $surat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
        // Validasi input
        $validate = $request->validate([
            'surat_judul' => 'required',
            'surat_tgl_upload' => 'required',
            'surat_link' => 'required',
            'surat_pdf' => 'nullable|mimes:pdf,jpg|max:2048'
        ]);

        $surat = Surat::findOrFail($surat->surat_id);
        $auto_kode = $surat->surat_kode;

        if ($request->surat_link !== $surat->surat_link) {
            // Hapus QR Code lama jika ada
            $oldQrCodePath = 'qrcodes/' . $auto_kode . '.png';
            if (file_exists(public_path($oldQrCodePath))) {
                unlink(public_path($oldQrCodePath));
            }
    
            // Buat QR Code baru berdasarkan surat_link yang baru
            $qrCodePath = $auto_kode . '.png';
            $filePath = 'qrcodes/' . $qrCodePath;

            QrCode::format('png')->size(500)->generate($request->surat_link, storage_path('app/public/' . $filePath));
        }

        // Jika ada file baru yang diupload
        if ($request->hasFile('surat_pdf')) {
            // Hapus file lama jika ada
            $oldFilePath = 'pdf_surat/' . $surat->surat_pdf;
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Unggah file baru
            $file = $request->file('surat_pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('pdf_surat', $fileName, 'public');

            // Perbarui nama file pada validasi
            $validate['surat_pdf'] = $fileName;
        } else {
            // Jika tidak ada file baru, pertahankan nama file lama
            $validate['surat_pdf'] = $surat->surat_pdf;
        }

        // Perbarui entri dengan data yang telah divalidasi
        $surat->update($validate);

        return redirect('/surat')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $surat)
    {

        // Path file yang akan dihapus
        $filePath = 'pdf_surat/' . $surat->surat_pdf;

        // Cek apakah file ada dan hapus file
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Path file barcode yang akan dihapus
        $qrCodePath = $surat->surat_qr_code;

        // Cek apakah file barcode ada dan hapus file
        if (Storage::disk('public')->exists($qrCodePath)) {
            Storage::disk('public')->delete($qrCodePath);
        }
        Surat::destroy($surat->surat_id);
        return redirect('/surat')->with('success', 'Data berhasil dihapus!');

        // $user = Surat::where('surat_kode', $surat->surat_kode)->first();
        // dd($user);
    }

}
