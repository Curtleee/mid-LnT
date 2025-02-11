<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Menampilkan daftar karyawan
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    // Menampilkan form untuk menambah karyawan
    public function create()
    {
        return view('employees.create');
    }

    // Menyimpan data karyawan baru
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'name' => 'required|min:5|max:20',
            'age' => 'required|numeric|min:21',
            'address' => 'required|min:10|max:40',
            'phone' => 'required|regex:/^08\d{7,10}$/',
        ]);

        // Menyimpan data ke database
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->age = $request->input('age');
        $employee->address = $request->input('address');
        $employee->phone = $request->input('phone');
        $employee->save(); 

        // Redirect ke halaman daftar karyawan
        return redirect()->route('employees.index');
    }

    // Menampilkan form untuk mengedit karyawan
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Memperbarui data karyawan
    public function update(Request $request, Employee $employee)
    {
        // Validasi inputan
        $request->validate([
            'name' => 'required|min:5|max:20',
            'age' => 'required|numeric|min:21',
            'address' => 'required|min:10|max:40',
            'phone' => 'required|regex:/^08\d{7,10}$/',
        ]);

        // Memperbarui data karyawan
        $employee->update($request->all());

        // Redirect ke halaman daftar karyawan
        return redirect()->route('employees.index');
    }

    // Menghapus data karyawan
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
