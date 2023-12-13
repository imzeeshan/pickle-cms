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
                        <h4>List of all Permissions in the system.     
                            <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-success">Add a new Permission</a> 
                        </h4>  
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter" id="sortable-table">
                                <thead class="sticky-top">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">@sortablelink('permissions','Permissions')</th>     
                                        <th scope="col">@sortablelink('entity','Entity')</th>    
                                        <th scope="col">@sortablelink('entity_type','Entity Type')</th>  
                                        <th scope="col">@sortablelink('role','Role')</th>                                          
                                        <th scope="col">Actions</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <th scope="row">{{ $permission->id }}</th>
                                        <td>{{ $permission->permissions }}</td>      
                                        <td>{{ $permission->entity }}</td>                                     
                                        <td>{{ $permission->entity_type }}</td>     
                                        <td>{{ $permission->role->name }}</td>                                                                     
                                        <td>
                                            <a href="{{route('permissions.edit',$permission->id)}}">Edit</a> &nbsp; | &nbsp;
                                            <a href="{{route('permissions.delete',$permission->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
