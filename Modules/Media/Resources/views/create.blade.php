@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 

                        <form class="card" role="form" method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Media Manager: Upload a new Media asset</h4>
                            </div>
                                  
                                <div class="card-body">
                                    <div class="col-lg-8">
                                        <div class="mb-6">
                                            <div class="form-group col-10">
                                                <label class="form-label" for="name">{{ __('File') }}</label>
                                                <input type="file" name="file_upload" id="file_upload" class="form-control" onchange="preview_image(this);">
                                            </div>
                                        </div>

                                        <div class="mb-6">
                                            <div class="form-group col-10">
                                                <label class="form-label" for="email">{{ __('Title') }}</label>
                                                <input type="text" id='title' name="title" class="form-control">              
                                            </div>
                                        </div>

                                        <div class="mb-6">
                                            <div class="form-group col-10">
                                                <label for="role_id">{{ __('Type') }}</label>
                                                <select id="type" name="type" class="form-control" required="required">
                                                    <option value="">Select</option>
                                                    <option value="0">Image</option>
                                                    <option value="1">Video</option>
                                                </select>                                              
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <div class="form-group col-10">
                                                <label class="form-label" for="password" class="d-block">{{ __('Description') }}</label>
                                                <textarea class="summernote" id='summernote' name="description"></textarea>
                                            </div>
                                        </div>

                                    
                                    <div class="form-group col-10">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Upload') }}
                                        </button>
                                    </div>
                                </div>
                               
                           

                            
                            <div class="col-lg-4">
                               <img class="img-thumbnail" name="upload_preview" id="upload_preview" src="{{ asset("img/logo.png") }}">
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {         
            $('#summernote').summernote();
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
@endsection 
