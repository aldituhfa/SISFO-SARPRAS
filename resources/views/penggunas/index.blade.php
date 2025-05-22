@extends('layouts.dashboard-layout')
@section('content')

<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar User</h1>
        <a href="{{ route('penggunas.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
           + Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Nama</th>
                    <th class="py-3 px-6">Email</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach ($penggunas as $pengguna)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $pengguna->no }}</td>
                    <td class="py-3 px-6">{{ $pengguna->name }}</td>
                    <td class="py-3 px-6">{{ $pengguna->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection