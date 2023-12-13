@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">                 

                        <form class="card" role="form" method="POST" action="{{ route('permissions.store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="card-header">
                                <h4 class="card-title">Create a new Permission</h4>
                            </div>
        
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group col-6">
                                        <label class="form-label" for="name">{{ __('Permissions') }}</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="read_permission" name="read_permission">
                                            <label class="form-check-label" for="read_permission">Read</label>
                                        </div>
                                          
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="write_permission" name="write_permission">
                                            <label class="form-check-label" for="write_permission">Write</label>
                                        </div>

                                        <div class="form-check">                                       
                                            <input class="form-check-input" type="checkbox" id="edit_permission" name="edit_permission">
                                            <label class="form-check-label" for="edit_permission">Edit </label>  
                                        </div>
                                        
                                    </div>
                                </div>                             
                                    
                            <div class="mb-3">
                                <div class="form-group col-3">
                                <label>Entity</label>
                                <input id="name" type="text" class="form-control" value="" name="entity" required="">
                                </div>
                            </div>
                              
                            <div class="mb-3">
                                <div class="form-group col-3">
                                    <label for="entity_type">{{ __('Entity Type') }}</label>
                                    <select id="entity_type" name="entity_type" class="form-control" required="required">
                                                                                <option value="">Select an Entity Type</option>                                                <option value="module">CMS Module </option>                                                <option value="route">Route</option>
                                    </select>
                              </div>
                            </div>
                              
                            <div class="mb-3">
                              <div class="form-group col-3">
                              <label for="role_id">{{ __('Role') }}</label>
                              <select id="role_id" name="role_id" class="form-control" required="required">
                                                                          <option value="">Select a Role</option>
                                                                          @foreach($roles as $role)
                                                                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                                          @endforeach
                              </select>
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
