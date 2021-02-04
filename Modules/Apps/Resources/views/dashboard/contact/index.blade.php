
@extends('apps::dashboard.layouts.app')
@section('title', __('apps::dashboard.contact.routes.index'))
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
                    <a href="#">{{__('apps::dashboard.contact.routes.index')}}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">

                    
                    {{-- DATATABLE FILTER --}}
                    <div class="row">
                        <div class="portlet box grey-cascade">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>
                                    {{__('apps::dashboard.datatable.search')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="filter_data_table">
                                    <div class="panel-body">
                                        <form id="formFilter" class="horizontal-form">
                                            <div class="form-body">
                                                <div class="row">

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{__('apps::dashboard.datatable.form.date_range')}}
                                                            </label>
                                                            <div id="reportrange" class="btn default form-control">
                                                                <i class="fa fa-calendar"></i> &nbsp;
                                                                <span> </span>
                                                                <b class="fa fa-angle-down"></b>
                                                                <input type="hidden" name="from">
                                                                <input type="hidden" name="to">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{__('apps::dashboard.contact.datatable.type')}}
                                                            </label>
                                                            <div class="mt-radio-list">
                                                                <label class="mt-radio">
                                                                    {{__('apps::dashboard.contact.datatable.typeOf.contact')}}
                                                                    <input type="radio" value="contact" name="type" />
                                                                    <span></span>
                                                                </label>
                                                                <label class="mt-radio">
                                                                    {{__('apps::dashboard.contact.datatable.typeOf.suggest')}}

                                                                    <input type="radio" value="suggest" name="type" />
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                   
                                                   
                                                </div>
                                            </div>
                                        </form>
                                        <div class="form-actions">
                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="search">
                                                <i class="fa fa-search"></i>
                                                {{__('apps::dashboard.datatable.search')}}
                                            </button>
                                            <button class="btn btn-sm red btn-outline filter-cancel">
                                                <i class="fa fa-times"></i>
                                                {{__('apps::dashboard.datatable.reset')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END DATATABLE FILTER --}}


                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">
                                {{__('apps::dashboard.contact.routes.index')}}
                            </span>
                        </div>
                    </div>

                    {{-- DATATABLE CONTENT --}}
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="javascript:;" onclick="CheckAll()">
                                            {{__('apps::dashboard.buttons.select_all')}}
                                        </a>
                                    </th>
                                    {{-- <th>#</th> --}}
                                    <th>{{__('apps::dashboard.contact.datatable.username')}}</th>
                                    <th>{{__('apps::dashboard.contact.datatable.email')}}</th>
                                    <th>{{__('apps::dashboard.contact.datatable.type')}}</th>
                                    <th>{{__('apps::dashboard.contact.datatable.message')}}</th>
                                    <th>{{__('apps::dashboard.contact.datatable.mobile')}}</th>
                                    <th>{{__('apps::dashboard.contact.datatable.created_at')}}</th>
                                    <th>{{__('apps::dashboard.contact.datatable.options')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="submit" id="deleteChecked" class="btn red btn-sm" onclick="deleteAllChecked('{{ url(route('dashboard.contact.deletes')) }}')">
                                {{__('apps::dashboard.datatable.delete_all_btn')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')

  <script>
   function tableGenerate(data='') {

      var dataTable =
      $('#dataTable').DataTable({
          "createdRow": function( row, data, dataIndex ) {
            
          },
          ajax : {
              url   : "{{ url(route('dashboard.contact.datatable')) }}",
              type  : "GET",
              data  : {
                  req : data,
              },
          },
          language: {
              url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
          },
          stateSave: true,
          processing: true,
          serverSide: true,
          responsive: !0,
          order     : [[ 6 , "desc" ]],
          columns: [
            {data: 'id' 		 	        , className: 'dt-center'},
      			// {data: 'id' 		 	        , className: 'dt-center'},
      			{data: 'username' 		      , className: 'dt-center'},
                  {data: 'email' 		      , className: 'dt-center'},
            {data: 'type' 	        , className: 'dt-center'},
            {data: 'message' 	        , className: 'dt-center'},
            {data: 'mobile' 	        , className: 'dt-center'},
            {data: 'created_at' 		  , className: 'dt-center'},
            {data: 'id'},
      		],
          columnDefs: [
            {
      				targets: 0,
      				width: '30px',
      				className: 'dt-center',
      				orderable: false,
      				render: function(data, type, full, meta) {
      					return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" value="`+data+`" class="group-checkable" name="ids">
                          <span></span>
                        </label>
                      `;
      				},
      			},
               
            {
              targets: -1,
              width: '13%',
              title: '{{__('apps::dashboard.contact.datatable.options')}}',
              className: 'dt-center',
              orderable: false,
              render: function(data, type, full, meta) {

                

      					// Delete
      					var deleteUrl = '{{ route("dashboard.contact.destroy", ":id") }}';
      					deleteUrl = deleteUrl.replace(':id', data);

      					return `

                @permission('delete_questions')
                @csrf
                  <a href="javascript:;" onclick="deleteRow('`+deleteUrl+`')" class="btn btn-sm red">
                    <i class="fa fa-trash"></i>
                  </a>
                @endpermission`;
              },
            },
          ],
          dom: 'Bfrtip',
          lengthMenu: [
              [ 10, 25, 50 , 100 , 500 ],
              [ '10', '25', '50', '100' , '500']
          ],
  				buttons:[
  					{
  						extend: "pageLength",
              className: "btn blue btn-outline",
              text: "{{__('apps::dashboard.datatable.pageLength')}}",
              exportOptions: {
                  stripHtml: true,
                  columns: ':visible',
                  columns: [ 1 , 2 , 3 , 4 , 5 ,6, 7 ]
              }
  					},
  					{
  						extend: "print",
              className: "btn blue btn-outline" ,
              text: "{{__('apps::dashboard.datatable.print')}}",
              exportOptions: {
                  stripHtml: true,
                  columns: ':visible',
                  columns: [ 1 , 2 , 3 , 4 , 5 ,6, 7 ]
              }
  					},
  					{
  							extend: "pdf",
                className: "btn blue btn-outline" ,
                text: "{{__('apps::dashboard.datatable.pdf')}}",
                exportOptions: {
                    stripHtml: true,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5 ,6, 7 ]
                }
  					},
  					{
  							extend: "excel",
                className: "btn blue btn-outline " ,
                text: "{{__('apps::dashboard.datatable.excel')}}",
                exportOptions: {
                    stripHtml: true,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5 ,6, 7 ]
                }
  					},
  					{
  							extend: "colvis",
                className: "btn blue btn-outline",
                text: "{{__('apps::dashboard.datatable.colvis')}}",
                exportOptions: {
                    stripHtml: true,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5 ,6, 7 ]
                }
  					}
  				]
      });
  }

  jQuery(document).ready(function() {
  	tableGenerate();
  });
  </script>

@stop
