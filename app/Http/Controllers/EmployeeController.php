<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index', [
            'employees' => Employee::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create', [
            'employees' => Employee::all()
        ]);
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
            'employee_name' => 'required',
            'employee_password' => 'required',
            'employee_role' => 'required',
            'employee_role_2' => 'required'
        ]);

        // $validate['password'] = bcrypt($validate['password']);
        $validate['employee_password'] = Hash::make($validate['employee_password']);

        $auto_kode = $this->generate_user();

        $validate['employee_kode'] = $auto_kode;

        Employee::create($validate);
        return redirect('/employee')->with('success', 'Data berhasil ditambahkan!');
    }

    public function generate_user()
    {
        $kode_faktur = DB::table('tb_employee')->max('employee_kode');

        if ($kode_faktur) {
            $nilai = substr($kode_faktur[0], 5);
            $kode = (int) $nilai;
    
            //tambahkan sebanyak + 1
            $kode = $kode + 1;
            $auto_kode = "USR" . str_pad($kode, 6, "0",  STR_PAD_LEFT);
        } else {
            $auto_kode = "USR000001";
        }
        return $auto_kode;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit', [
            'employee' => $employee
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validate = $request->validate([
            'employee_name' => 'required',
            'employee_password' => 'nullable',
            'employee_role' => 'required',
            'employee_role_2' => 'required'
        ]);

        $validate['employee_password'] = Hash::make($validate['employee_password']);

        $employee->update($validate);
        return redirect('/employee')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->employee_id);
        return redirect('/employee')->with('success', 'Data berhasil dihapus!');
    }
}
