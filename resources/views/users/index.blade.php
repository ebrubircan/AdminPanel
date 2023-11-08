@extends('layouts.app')

@section('title', 'Data user')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data user</h6>
        </div>
        <div class="card-body">
            @if(auth()->user() && auth()->user()->is_admin === 1)
                <a href="{{ route('users.add') }}" class="btn btn-primary mb-3">Add User</a>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        @if(auth()->user() && auth()->user()->is_admin === 1)
                        <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @php($no = 1)
                    @foreach ($data as $row)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                                <td>
                                    @if(auth()->user() && auth()->user()->is_admin === 1)
                                    <a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('users.delete', $row->id) }}" class="btn btn-danger">Delete</a>
                                    @endif
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
