@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Karyawan</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Tambah Karyawan Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->age }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
