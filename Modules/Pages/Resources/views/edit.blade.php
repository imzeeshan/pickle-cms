@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 

                        <form class="card" role="form" method="POST" action="{{ route('pages.update',$page->id) }}" enctype="multipart/form-data">

                            <input type="hidden" name="_method" value="PUT">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Edit Page</h4>
                            </div>
        
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="title">{{ __('Title') }}</label>
                                        <input id="title" type="text" class="form-control" value="{{$page->title}}" name="title" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group col-8">
                                        <label class="form-label" for="description">{{ __('Description') }}</label>
                                        <textarea class="form-control summernote" id='summernote' name="description" rows="20">{{$page->description}}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group col-8">
                                        <label class="form-label">{{ __('Status') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status" value="1">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Published
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status" value="0">
                                                <label class="form-check-label" for="gridRadios2">
                                                    UnPublished
                                                </label>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="mb-3">
                                        <div class="form-group col-4">
                                            <label class="form-label">{{ __('Author') }}</label>
                                    
                                            <select class="form-control">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>                                   
                                </div>

                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {         
            $('#summernote').summernote();
        });
    </script>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection 



