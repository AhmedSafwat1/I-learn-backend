@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.users.create.title'))
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('dashboard.users.index')) }}">
                        {{__('user::dashboard.users.index.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('user::dashboard.users.create.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.users.store')}}">
                @csrf
                
                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                </div>
                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('user::dashboard.users.create.form.general') }}
                                                </a>
                                            </li>
                                           
                                           

                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- CREATE FORM --}}
                            <div class="tab-pane active fade in" id="global_setting">
                                <h3 class="page-title">{{__('user::dashboard.users.create.form.general')}}</h3>
                                <div class="col-md-10">

                                    
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.name')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control" data-name="name">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                  
                                  
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.email')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control" data-name="email">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                 

                                    
{{-- 
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.country')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="country_id" class="form-control" data-name="country_id">
                                                @foreach ($countries as $country)
                                                     <option value="{{$country->id}}" > {{ $country->translateOrDefault(locale())->title}} </option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.mobile')}}
                                        </label>
                                        <div class="col-md-3">
                                            <select name="phone_code" class="form-control select2" data-name="phone_code" >
                                                <option value=""></option>
                                                @foreach ($phoneCodes as $phoneCode)
                                                @if (!empty($phoneCode['calling_code'][0]))
                                                <option value="{{ $phoneCode['calling_code'][0] }}" @if( $phoneCode['calling_code'][0] == "965" ) selected @endif>
                                                    {{ $phoneCode['flag'] .' '.$phoneCode['code'] . ' +' . $phoneCode['calling_code'][0] }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="mobile" class="form-control" data-name="mobile">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    {{-- <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.description')}}
                                        </label>
                                        <div class="col-md-9">
                                            <textarea name="description" class="form-control" data-name="description"></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.location')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="lat" placeholder="{{__('user::dashboard.users.create.form.lat')}}" class="form-control" data-name="lat">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="lng" placeholder="{{__('user::dashboard.users.create.form.lng')}}"  class="form-control" data-name="lng">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="location" placeholder="{{__('user::dashboard.users.create.form.location')}}" class="form-control" data-name="lng">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" class="form-control" data-name="password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.confirm_password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="confirm_password" class="form-control" data-name="confirm_password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.image')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                                        <i class="fa fa-picture-o"></i>
                                                        {{__('apps::dashboard.buttons.upload')}}
                                                    </a>
                                                </span>
                                                <input name="image" class="form-control image" type="file" >
                                               
                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.gender')}}
                                        </label>
                                        <div class="col-md-9" data-name="gender" >
                                            <div class="row">
                                                <div class="col-md-6" >
                                                       <input type="radio" id="male" name="gender" checked value="male">
                                                        <label for="male">{{__('user::dashboard.users.create.form.male')}}</label><br>
                                                        <input type="radio" id="female" name="gender" value="female">
                                                        <label for="female">{{__('user::dashboard.users.create.form.female')}}</label><br>
                                                </div>
                                              
                                            </div>
                                            <div class="help-block"></div>
                                          
                                           
                                        </div>
                                    </div>


                                    

                                   
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" checked id="test" data-size="small" name="is_active">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.datatable.verifed')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"   id="test" data-size="small" name="is_verified">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    


                                </div>
                            </div>


                            <div class="tab-pane fade in" id="categories">
                                <h3 class="page-title">
                                    {{__('user::dashboard.users.create.form.categories')}}
                                </h3>
                                <div id="jstree">
                                    @include('user::dashboard.tree.users.view',
                                    ['mainCategories' => $mainCategories]
                                    )
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="categories"  id="root_category" value="" data-name="categories">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                          
                            


                            
                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.users.index')) }}" class="btn btn-lg red">
                                    {{__('apps::dashboard.buttons.back')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')

<script>
    $(function() {
        $('#jstree').jstree();
        $('#jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
        });
    });


</script>







@stop
