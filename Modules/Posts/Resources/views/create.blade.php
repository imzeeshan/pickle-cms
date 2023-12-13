@extends('layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 

                        <form class="card" role="form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Blog Posts Manager: Add a new Blog Post</h4>
                            </div>
                                  
                                <div class="card-body">
                                    <div class="col-lg-8">                                  

                                        <div class="mb-6">
                                            <div class="form-group col-10">
                                                <label class="form-label">{{ __('Post Title') }}</label>
                                                <input type="text" id='title' name="title" class="form-control">              
                                            </div>
                                        </div>

                                        <div class="mb-6">
                                            <div class="form-group col-10">
                                                <label class="form-label">{{ __('Category') }}</label>
                                                <select class="form-control selectric" id="category" name="category">
                                                    @foreach($categories as $category)
                                                    <option id="{{$category->id}}" value="{{$category->id}}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>          
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-group col-8">
                                                <label class="form-label">{{ __('Description') }}</label>
                                                <textarea class="form-control summernote" id='summernote' name="description"></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Tags') }}</label>                                          
                                            <input type="text" class="form-control inputtags" id="tags" name="tags">                                        
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-group col-10">
                                                <label class="form-label" for="name">{{ __('Featured Image') }}</label>
                                                <input type="file" name="file_upload" id="file_upload" class="form-control border" onchange="preview_image(this);">
                                            </div>

                                            <div class="col-2">
                                                <img class="img-thumbnail border" name="upload_preview" id="upload_preview" src="{{ asset("img/logo.png") }}">
                                             </div>

                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Status') }}</label>    
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="status" value="1" checked="checked">
                                                    <label class="form-check-label" for="published">
                                                        Published
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="status" value="0">
                                                    <label class="form-check-label" for="not_published">
                                                        UnPublished
                                                    </label>
                                                </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Author') }}</label> 
                                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>                                      
                                    
                                    <div class="form-group col-10">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>

                        </div>
                        </form>
                  
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/selectric/public/jquery.selectric.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>

        $(document).ready(function() {         
            $('#summernote').summernote();
            $("#selectric").selectric();
            $(".inputtags").tagsinput('tags');
        });

        function preview_image(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#upload_preview')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        }
    </script>
@endsection


@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectric/public/selectric.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.css">
@endsection 

