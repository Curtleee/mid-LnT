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
    public function store(Request $request){
        $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'required|integer',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
    ]);

    $employee = new Employee($request->all());
    $employee->save();

    return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    // Menampilkan form untuk mengedit karyawan
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Memperbarui data karyawan
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    // Menghapus data karyawan
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
