@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.teachers.update.title'))
@section('css')
    <style>
        .display-none{
            display: none !important;
        }
    </style>
@endsection
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
                    <a href="{{ url(route('dashboard.teachers.index')) }}">
                        {{__('user::dashboard.teachers.index.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('user::dashboard.teachers.update.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" user="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.teachers.update',$user->id)}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="user">
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
                                                    {{ __('user::dashboard.teachers.create.form.general') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#teacher" data-toggle="tab">
                                                    {{ __('user::dashboard.teachers.create.form.teacher') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#working" data-toggle="tab">
                                                    {{ __('user::dashboard.teachers.create.form.working') }}
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
                                <h3 class="page-title">{{__('user::dashboard.teachers.create.form.general')}}</h3>
                                <div class="col-md-10">

                                    
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.name')}}
                                        </label>
                                        <div class="col-md-9">
                                             <input type="text" name="name" value="{{$user->name}}" class="form-control" data-name="name">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                 


                                 
                                  
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.email')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" value="{{$user->email}}" class="form-control" data-name="email">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    

                                  

                                   
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.mobile')}}
                                        </label>
                                        <div class="col-md-3">
                                            <select name="phone_code" class="form-control select2" data-name="phone_code" required>
                                                <option value=""></option>
                                                @foreach ($phoneCodes as $phoneCode)
                                                @if (!empty($phoneCode['calling_code'][0]))
                                                <option value="{{ $phoneCode['calling_code'][0] }}"  @if($user->phone_code == $phoneCode['calling_code'][0] ) selected @endif>
                                                    {{ $phoneCode['flag'] .' '.$phoneCode['code'] . ' +' . $phoneCode['calling_code'][0] }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control" data-name="mobile">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.description')}}
                                        </label>
                                        <div class="col-md-9">
                                            <textarea name="description" class="form-control" data-name="description">{{$user->description}}</textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.location')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="lat" value="{{$user->lat}}" placeholder="{{__('user::dashboard.teachers.create.form.lat')}}" class="form-control" data-name="lat">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="lng" value="{{$user->lng}}"  placeholder="{{__('user::dashboard.teachers.create.form.lng')}}"  class="form-control" data-name="lng">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="location" value="{{$user->location}}"  placeholder="{{__('user::dashboard.teachers.create.form.location')}}" class="form-control" data-name="lng">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.update.form.password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" name="password" class="form-control" data-name="password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.confirm_password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="confirm_password" class="form-control" data-name="confirm_password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.image')}}
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
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-danger delete">
                                                        <i class="glyphicon glyphicon-remove"></i>
                                                    </a>
                                                </span>
                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                                <img src="{{url($user->image)}}" style="height: 15rem;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    

                                    
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.gender')}}
                                        </label>
                                        <div class="col-md-9" data-name="gender" >
                                            <div class="row">
                                                <div class="col-md-6" >
                                                       <input type="radio" id="male" name="gender" @if($user->gender == "male") checked @endif value="male">
                                                        <label for="male">{{__('user::dashboard.teachers.create.form.male')}}</label><br>
                                                        <input type="radio" id="female" name="gender" @if($user->gender == "female") checked @endif value="female">
                                                        <label for="female">{{__('user::dashboard.teachers.create.form.female')}}</label><br>
                                                </div>
                                              
                                            </div>
                                            <div class="help-block"></div>
                                          
                                           
                                        </div>
                                    </div>

                                   

                                    <div class="form-group">
                                        <label class="col-md-2">

                                            {{__('user::dashboard.teachers.create.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" @if($user->is_active) checked @endif   id="test" data-size="small" name="is_active">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.datatable.verifed')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" @if($user->is_verified) checked @endif   id="test" data-size="small" name="is_verified">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                  
                                    @if ($user->trashed())
                                      <div class="form-group">
                                          <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.restore')}}
                                          </label>
                                          <div class="col-md-9">
                                              <input type="checkbox" class="make-switch" id="test" data-size="small" name="restore">
                                              <div class="help-block"></div>
                                          </div>
                                      </div>
                                    @endif




                                </div>
                            </div>


                            {{-- == --}}

                            <div class="tab-pane fade in" id="teacher">
                                <h3 class="page-title">
                                    {{__('user::dashboard.teachers.create.form.teacher')}}
                                </h3>
                                <div class="col-md-10">

                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('user::dashboard.teachers.create.form.sections')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="sections[]" id="single" data-name="sections" class="form-control select2-allow-clear" multiple>
                                              
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section['id'] }}" {{ $user->sections->contains($section->id) ? 'selected=""' : ''}}>
                                                        {{ $section->translateOrDefault(locale())->title }}
                                                    </option>
                                                @endforeach
                                            </select>
        
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('user::dashboard.teachers.create.form.subjects')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="subjects[]" id="single" data-name="subjects" class="form-control select2-allow-clear" multiple>
                                              
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject['id'] }}"  {{ $user->subjects->contains($subject->id) ? 'selected=""' : ''}}>
                                                        {{ $subject->translateOrDefault(locale())->title }}
                                                    </option>
                                                @endforeach
                                            </select>
        
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.description')}}
                                        </label>
                                        <div class="col-md-9">
                                            <textarea name="description" class="form-control" data-name="description">{{optional($user->profile)->description}}</textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.lesson_type')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="lesson_type" data-name="lesson_type">
                                                @foreach (["all", "online", "house"] as $item)
                                                    <option value="{{$item}}" @if(optional($user->profile)->lesson_type == $item) selected @endif>{{__('user::dashboard.teachers.datatable.'.$item)}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <label class="col-md-5">
                                                    {{__('user::dashboard.teachers.create.form.online_price')}}
                                                </label>
                                                <div class="col-md-7">
                                                    <input type="number" class="form-control" value="{{optional($user->profile)->online_price}}" min="0" value="0" name="online_price" data-nam="online_price" />
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="col-md-5">
                                                    {{__('user::dashboard.teachers.create.form.house_price')}}
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="number" class="form-control" min="0" value="{{optional($user->profile)->house_price}}" name="house_price" data-nam="house_price" />
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>

                                </div>
                            </div>

                            {{-- === --}}
                            <div class="tab-pane fade in" id="working">
                                <h3 class="page-title">
                                    {{__('user::dashboard.teachers.create.form.working')}}
                                </h3>
                                <div class="col-md-10">

                                   

                                    
                                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                <input type="checkbox" class="schedule-day" @if(isset($user->profile->working[$day])) checked @endif value="{{$day}}" name="working[{{$day}}][day]" /> {{ __("user::dashboard.teachers.datatable.weak.".$day)}}
                                            </label>
                                            <div class="col-md-9 {{$day}} @if(!isset($user->profile->working[$day])) display-none @endif">
                                                @foreach (range(0,23) as $item)
                                                    <div class="col-md-2">
                                                        <input type="checkbox"
                                                          @if(
                                                          isset($user->profile->working[$day])              && 
                                                          is_array($user->profile->working[$day]["times"]) &&
                                                          isset($user->profile->working[$day]["times"][$item])
                                                           )    
                                                           checked   
                                                          @endif  
                                                         value="{{handleTime($item)}}" name="working[{{$day}}][times][]" /> {{handleTime($item, 1)}}
                                                    </div> 
                                                @endforeach
                                                
                                            
                                            </div>
                                        </div>
                                    @endforeach

                                   

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
                                    {{__('apps::dashboard.buttons.edit')}}
                                </button>
                                <a href="{{url(route('dashboard.teachers.index')) }}" class="btn btn-lg red">
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
       $("body").on("change", ".schedule-day", function(){
           var _elm = $(this)
          
           var time = $(`.${_elm.val()}`)
           
           if(_elm.is(":checked")){
            //    alert("hi"+ _elm.val())
               time.removeClass("display-none") 
               time.show();
               
           }
           else{
            time.hide();
            time.addClass("display-none") 
            time.find('input:checkbox').removeAttr('checked');
           }
       })
    });
</script>







@stop