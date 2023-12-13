@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            @if (session('message'))

            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                  <div>
                    <h4 class="alert-title">System Message</h4>
                    <div class="text-muted">{{ session('message') }}</div>
                  </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
              </div>
    
            @endif

            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h4>List of all Users in the system.     
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-success">Add a new User</a>  || 
                            <a class="btn btn-primary" href="{{ route('user.download') }}">Download</a>
                        </h4>  
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter" id="sortable-table">
                                <thead class="sticky-top">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">@sortablelink('name','Name')</th>
                                        <th scope="col">@sortablelink('email','Email')</th>
                                        <th scope="col">Role</th>      
                                        <th scope="col">Actions</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@isset($user->role->name )
                                            {{ $user->role->name }}
                                            @endisset
                                        </td>                            
                                        <td>
                                            <a href="{{route('user.edit',$user->id)}}">Edit</a> &nbsp; | &nbsp;
                                            <a href="{{route('user.delete',$user->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
