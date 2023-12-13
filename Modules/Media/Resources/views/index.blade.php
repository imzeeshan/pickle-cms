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
                        <h4>List of all Media in the system.     <a href="{{ route('media.create') }}" class="btn btn-sm btn-success">Add a new Media Asset</a> </h4>  
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter" id="sortable-table">
                                <thead class="sticky-top">
                                    <tr>
                                        <th scope="col">Preview</th>
                                        <th scope="col">@sortablelink('name','Name')</th>
                                        <th scope="col">@sortablelink('title','Title')</th>                                   
                                        <th col">@sortablelink('type','Type')</th>
                                        <th scope="col">@sortablelink('created_at','Created At')</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Actions</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_media as $media)
                                    <tr>
                                        <td scope="row">
                                            <a href="{{ $media->url }}" target="_blank">
                                                @if($media->type==0)
                                                    <img src="{{ $media->url }}" class="media" width="50px;" height="50px;"/>
                                                @else
                                                    <video width="50px;" class="media" height="50px;" controls>
                                                        <source src="{{ $media->url }}" type="video/mp4">
                                                        Your browser does not support HTML video.
                                                    </video>
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{ $media->name }}</td>
                                        <td>{{ $media->title }}</td>
                                        <td>@if($media->type==0)
                                            Image
                                            @else
                                            Video
                                            @endif
                                        </td>
                                         <td>{{ $media->created_at }}</td>                        
                                        <td>{{ $media->author->name }}</td>
                                        <td>
                                            <a href="{{route('media.edit',$media->id)}}">Edit</a> &nbsp; | &nbsp;
                                            <a href="{{route('media.delete',$media->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $all_media->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
