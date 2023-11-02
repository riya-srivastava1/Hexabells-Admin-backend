@extends('layouts.app')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="table-basic-9">
            <!-- BEGIN panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">Get In Touch</h4>
                @if(Auth::user()->is_admin == '1')

                {{-- <a href="{{ route('register') }}" class="btn btn-success ms-2"><i class="fas fa-plus"></i> Add </a> --}}
                @endif
            </div>
            <!-- END panel-heading -->
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <!-- BEGIN table-responsive -->
                <div class="table-responsive">
                    <table class="table  table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Is Admin</th>
                                <th>role</th>
                                {{--  <th>Action</th>  --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form action="{{ route('user.status', $user->id) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-{{ $user->role == '1' ? 'success' : 'secondary' }}">{{ $user->role == '1' ? 'Yes' : 'No' }}</button>
                                        </form>
                                    </td>
                                    {{-- <td>
                                        @if ($user->role == '1')
                                            <a href="{{ route('user.status', $user->id) }}"
                                                onclick="return confirm('Inactive?')" class="btn btn-success">Active
                                            </a>
                                        @else
                                            <a href="{{ route('user.status', $user->id) }}"
                                                onclick="return confirm('Active?')"
                                                class="btn btn-danger">Inactive</a>
                                        @endif
                                    </td>
                                    @if ($user->role == '1')
                                        <td>
                                            Admin
                                        </td>
                                    @else
                                        <td>
                                            User
                                        </td>
                                    @endif --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END table-responsive -->
            </div>
            <!-- END panel-body -->
        </div>
        <!-- END panel -->
    </div>

    <!-- END #content -->
@endsection
