@extends('layouts.app')

@section('title', 'SIREGA | Data Pengguna')
@section('page-title', 'Data Pengguna')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-1">Daftar Pengguna</h3>
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary float-right">
                        <i class="fas fa-plus"></i> Pengguna Baru
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="usersTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th class="text-center">Level Akses</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td class="text-center">
                                        @if ($user->roles()->first()->name === 'superadmin')
                                            <span class="badge badge-secondary badge-sm text-capitalize">
                                                {{ $user->roles()->first()->name }}
                                            </span>
                                        @else
                                            <span class="badge badge-primary badge-sm text-capitalize">
                                                {{ $user->roles()->first()->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($user->is_active === 1)
                                            <span class="badge badge-success badge-xs">Aktif</span>
                                        @else
                                            <span class="badge badge-danger badge-xs">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-center">
                                        @if ($user->id !== Auth::user()->id)
                                            <a class="btn btn-info btn-xs" href="{{ route('users.edit', $user->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @else
                                            <a class="btn btn-info btn-xs" href="{{ route('profile.edit') }}">
                                                <i class="fas fa-eye"></i>
                                                Akun Saya
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th class="text-center">Level Akses</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection
