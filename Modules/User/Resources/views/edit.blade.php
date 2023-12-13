@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 
                  

                        <form class="card" role="form" method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">

                            <input type="hidden" name="_method" value="PUT">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Edit User</h4>
                            </div>
        
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control" value="{{ $user->name }}" name="name" autofocus>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" name="email">                         
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label for="role_id">{{ __('Role') }}</label>
                                        <select id="role_id" name="role_id" class="form-control" required="required">
                                            <option value="">Select a Role</option>
                                            @foreach($roles as $role)
                                                @if($user->role_id==$role->id)
                                                    <option value="{{ $role->id }}" selected="selected">{{ $role->name }}</option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>                                                       
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="password" class="d-block">{{ __('Password') }}</label>
                                        <input id="password" type="password"class="form-control" name="password">
                                    </div>
                                </div>


                                <div class="form-group col-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
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
