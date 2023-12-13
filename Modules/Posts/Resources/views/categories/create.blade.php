@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 

                        <form class="card" role="form" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Categories Manager: Add a new Category</h4>
                            </div>
                                  
                                <div class="card-body">
                                    <div class="col-lg-8">                                  

                                        <div class="mb-6">
                                            <div class="form-group col-10">
                                                <label class="form-label" for="email">{{ __('Name') }}</label>
                                                <input type="text" id='name' name="name" class="form-control">              
                                            </div>
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

