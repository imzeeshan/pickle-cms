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
                        <h4>List of all Pages in the system.     <a href="{{ route('pages.create') }}" class="btn btn-sm btn-success">Add a new Page</a> </h4>  
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter" id="sortable-table">
                                <thead class="sticky-top">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">@sortablelink('name','Title')</th>
                                        <th scope="col">@sortablelink('author','Author')</th>                                   
                                        <th scope="col">Actions</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pages as $page)
                                    <tr>
                                        <th scope="row">{{ $page->id }}</th>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->author->name }}</td>                                                                
                                        <td>
                                            <a href="{{route('pages.edit',$page->id)}}">Edit</a> &nbsp; | &nbsp;
                                            <a href="{{route('pages.delete',$page->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
