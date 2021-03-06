@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.teachers.create.title'))
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
                    <a href="#">{{__('user::dashboard.teachers.create.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.teachers.store')}}">
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
                                            <input type="text" name="name" class="form-control" data-name="name">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                  
                                  
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.email')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control" data-name="email">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                 

                                    
{{-- 
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.country')}}
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
                                            {{__('user::dashboard.teachers.create.form.mobile')}}
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
                                            {{__('user::dashboard.teachers.create.form.location')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="lat" placeholder="{{__('user::dashboard.teachers.create.form.lat')}}" class="form-control" data-name="lat">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="lng" placeholder="{{__('user::dashboard.teachers.create.form.lng')}}"  class="form-control" data-name="lng">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="location" placeholder="{{__('user::dashboard.teachers.create.form.location')}}" class="form-control" data-name="lng">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.create.form.password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" class="form-control" data-name="password">
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
                                               
                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
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
                                                       <input type="radio" id="male" name="gender" checked value="male">
                                                        <label for="male">{{__('user::dashboard.teachers.create.form.male')}}</label><br>
                                                        <input type="radio" id="female" name="gender" value="female">
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
                                            <input type="checkbox" class="make-switch" checked id="test" data-size="small" name="is_active">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.teachers.datatable.verifed')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"   id="test" data-size="small" name="is_verified">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    


                                </div>
                            </div>


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
                                                    <option value="{{ $section['id'] }}">
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
                                                    <option value="{{ $subject['id'] }}">
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
                                            <textarea name="description" class="form-control" data-name="description"></textarea>
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
                                                    <option value="{{$item}}">{{__('user::dashboard.teachers.datatable.'.$item)}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label class="col-md-7">
                                                    {{__('user::dashboard.teachers.create.form.online_price')}}
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" min="0" value="0" name="online_price" data-nam="online_price" />
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label class="col-md-7">
                                                    {{__('user::dashboard.teachers.create.form.house_price')}}
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" min="0" value="0" name="house_price" data-nam="house_price" />
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label class="col-md-7">
                                                    {{__('user::dashboard.teachers.create.form.homework_price')}}
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" min="0" value="0" name="homework_price" data-nam="homework_price" />
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>

                                </div>
                            </div>

                            {{--  --}}
                            <div class="tab-pane fade in" id="working">
                                <h3 class="page-title">
                                    {{__('user::dashboard.teachers.create.form.working')}}
                                </h3>
                                <div class="col-md-10">

                                   
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs bg-slate nav-tabs-component">

                                            <li class="active">
                                                <a href="#colored-rounded-tab-general-descaption" data-toggle="tab" aria-expanded="false">
                                                    {{__('user::dashboard.teachers.create.form.working')}}
                                                </a>
                                            </li>

                                            

                                            <li class="">
                                                <a href="#colored-rounded-tab-general-off" data-toggle="tab" aria-expanded="false">
                                                    {{__('user::dashboard.teachers.create.form.off')}}
                                                </a>
                                            </li>
                                           
                                        </ul>
                                    </div>


                                    <div class="tab-content">

                                        <div class="tab-pane fade active in" id="colored-rounded-tab-general-descaption">
                                            @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                                <div class="form-group">
                                                    <label class="col-md-2">
                                                        <input type="checkbox" class="schedule-day"  value="{{$day}}" name="working[{{$day}}][day]" /> {{ __("user::dashboard.teachers.datatable.weak.".$day)}}
                                                    </label>
                                                    <div class="col-md-9 {{$day}} display-none ">
                                                        @foreach (range(0,23) as $item)
                                                            <div class="col-md-2">
                                                                <input type="checkbox"
                                                                
                                                                value="{{handleTime($item)}}" name="working[{{$day}}][times][]" /> {{handleTime($item, 1)}}
                                                            </div> 
                                                        @endforeach
                                                        
                                                    
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
{{-- ========== --}}
                                        <div class="tab-pane fade  in" id="colored-rounded-tab-general-off">
                                            <div class="have_offs">
                                                <div class="form-group">
                                                    <label class="col-md-2">
                                                        {{__('user::dashboard.teachers.create.form.have_off')}}
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" class="make-switch"  id="test" data-size="small" name="have_off">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-offs">
                                                 <div class="off-one">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="col-md-2" >
                                                                        {{__('user::dashboard.teachers.create.form.from')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <div class="input-group">
                                                                        <input type="text"  class="form-control datetimepicker" name="offs[start]"  >
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="col-md-2">
                                                                        {{__('user::dashboard.teachers.create.form.to')}}
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control datetimepicker" name="offs[end]"  >
                                                                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                          
                                                            

                                                        </div>
                                                 </div>
                                            </div>
                                        </div>

                                    </div>

                                    
                                   

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

    //    
    $('.datetimepicker').datetimepicker();
    
    });
</script>







@stop
