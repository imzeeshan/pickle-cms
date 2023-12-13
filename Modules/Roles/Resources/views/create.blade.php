@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 

                        <form class="card" role="form" method="POST" action="{{ route('roles.store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Create Role</h4>
                            </div>
        
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control" value="" name="name" required>
                                    </div>
                                </div>

                                <div class="form-group col-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
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
