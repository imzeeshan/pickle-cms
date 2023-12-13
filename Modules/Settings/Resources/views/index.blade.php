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
                        <h4>List of all Settings in the system.     <a href="{{ route('settings.create') }}" class="btn btn-sm btn-success">Add a new Setting</a> </h4>  
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter" id="sortable-table">
                                <thead class="sticky-top">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">@sortablelink('name','Key')</th>
                                        <th scope="col">@sortablelink('value','Value')</th>
                                        <th scope="col">Actions</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($settings as $setting)
                                    <tr>
                                        <th scope="row">{{ $setting->id }}</th>
                                        <td>{{ $setting->key }}</td>
                                        <td>{{ $setting->value }}</td>                                                            
                                        <td>
                                            <a href="{{route('settings.edit',$setting->id)}}">Edit</a> &nbsp; | &nbsp;
                                            <a href="{{route('settings.delete',$setting->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $settings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
