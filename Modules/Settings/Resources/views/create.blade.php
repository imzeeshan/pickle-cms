@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 

                        <form class="card" role="form" method="POST" action="{{ route('settings.store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Setings : Add a new Setting</h4>
                            </div>
        
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="key">{{ __('Setting Name') }}</label>
                                        <input id="key" type="text" class="form-control" value="" name="key" required>
                                    </div>
                                </div>     
                                
                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="value">{{ __('Setting Value') }}</label>
                                        <input id="value" type="text" class="form-control" value="" name="value" required>
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
