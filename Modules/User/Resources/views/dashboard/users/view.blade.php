@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.users.show.title'))
@section('content')
  <style type="text/css" media="print">
  	@page {
  		size  : auto;
  		margin: 0;
  	}
  	@media print {
  		a[href]:after {
  		content: none !important;
  	}
  	.contentPrint{
  			width: 100%;
  		}
  		.no-print, .no-print *{
  			display: none !important;
  		}
  	}
  </style>
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
                    <a href="#">{{__('user::dashboard.users.show.title')}}</a>
                </li>
            </ul>
        </div>
 
        <h1 class="page-title"></h1>

        <div class="row">
            <div class="col-md-12">
                <div class="no-print">
                    <div class="col-md-3">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">
                                <a data-toggle="tab" href="#general">
                                    <i class="fa fa-cog"></i> {{ __('user::dashboard.users.create.form.general') }}
                                </a>
                                <span class="after"></span>
                            </li>
                           

                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 contentPrint">
                    @include('apps::dashboard.layouts._msg')
                    <div class="tab-content">
                        {{-- start --}}
                        <div class="tab-pane active" id="general">
                            <div class="invoice-content-2 busered">
                                <div class="row invoice-head">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="row invoice-logo">
                                            <div class="col-xs-6">
                                                <img src="{{ url($user->default_image ??  setting('favicon') ) }}" class="img-responsive" style="width:40%" />
                                                <span>
                                                    {{$user->name  }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="company-address">
                                            <h6 class="uppercase">#{{ $user['id'] }}</h6>
                                            <h6 class="uppercase">{{date('Y-m-d / H:i:s' , strtotime($user->created_at))}}</h6>
                                          
                                            <span class="bold">
                                                {{__('user::dashboard.users.datatable.mobile')}} :
                                            </span>
                                            @if($user->user)
                                                @if(locale() != "ar")
                                                    {{ '+'.$user->user->phone_code.$user->user->mobile }}
                                                    @else
                                                        {{ $user->user->phone_code.$user->user->mobile."+"  }}
                                                @endif
                                            @endif
                                            <br />
                                        </div>
                                    </div>
                                    <div class="row invoice-body" >
                                        <div class="col-xs-12 table-responsive" style="margin-top: 20px">
                                            <table class="table table-bordered ">
                                               
                                                <tbody>
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('user::dashboard.users.datatable.name')}}
                                                        </td>
                                                        <td>
                                                            {{ $user->name ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('user::dashboard.users.datatable.gender')}}
                                                        </td>
                                                        <td>
                                                            {{__('user::dashboard.users.create.form.'.$user->gender)}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('user::dashboard.users.datatable.status')}}
                                                        </td>
                                                        <td>
                                                         
                                                            @if ($user->status == 1) {
                                                                 <span class="badge badge-success"> {{__('apps::dashboard.datatable.available')}} </span>
                                                                @else
                                                                <span class="badge badge-danger"> {{__('apps::dashboard.datatable.unavailable')}} </span>
                                                              @endif  
                                                           
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('user::dashboard.users.datatable.verifed')}}
                                                        </td>
                                                        <td>
                                                            @if( $user->is_verified )
                                                              <span class="badge badge-success"> {{__('user::dashboard.users.datatable.is_verifed')}} </span>
                                                            @else
                                                              <span class="badge badge-danger"> {{__('user::dashboard.users.datatable.not_verifed')}} </span>  
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if($user->type == "teacher")
                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.teachers.datatable.description')}}
                                                            </td>
                                                            <td>
                                                                {!! optional($user->profile)->description ?? '-----' !!}
                                                            </td>
                                                        </tr>
                                                    
                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.teachers.datatable.sections')}}
                                                            </td>
                                                            <td>
                                                                @forelse ($user->sections as $item)
                                                                      <span class="badge badge-success"> {{ optional($item)->translateOrDefault(locale())->title }} </span>
                                                                @empty
                                                                    
                                                                @endforelse
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.teachers.datatable.subjects')}}
                                                            </td>
                                                            <td>
                                                                @forelse ($user->subjects as $item)
                                                                      <span class="badge badge-info"> {{ optional($item)->translateOrDefault(locale())->title }} </span>
                                                                @empty
                                                                    
                                                                @endforelse
                                                            </td>
                                                        </tr>
                                                       
                                                  

                                                    @if($user->profile) 

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.teachers.datatable.lesson_type')}}
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-success"> {{__('user::dashboard.teachers.datatable.'.$user->profile->lesson_type)}} </span>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.teachers.datatable.online_price')}}
                                                            </td>
                                                            <td>
                                                                {{ $user->profile->online_price}} {{ setting('default_currency')}}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.teachers.datatable.house_price')}}
                                                            </td>
                                                            <td>
                                                                {{ $user->profile->house_price}} {{ setting('default_currency')}}
                                                            </td>
                                                        </tr>
                                                     @endif   
                                                 @endif

                                                  
                                                   

                                                  


                                                </tbody>
                                                <thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}

                      

                        
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="col-xs-4">
                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
                        {{__('apps::dashboard.buttons.print')}}
                        <i class="fa fa-print"></i>
                    </a>
                </div>
                
            </div>

         

        </div>
    </div>
</div>

@stop

@section('scripts')

  <script>
 
  </script>

@stop
