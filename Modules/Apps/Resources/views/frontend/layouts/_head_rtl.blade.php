<head>
	<meta charset="utf-8" />
	<title>@yield('title', '--') || {{ setting('app_name',locale()) }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link href="/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="/admin/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
	<link href="/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
	

	<link rel="shortcut icon" href="{{ setting('favicon') ? url(setting('favicon')) : '' }}" />

	<style>
		body {
			font-family: 'Cairo', sans-serif !important;
		}

		.portlet.box>.portlet-body {
			padding: 27px 12px 80px;
		}

		.dropdown-menu {
			font-family: 'Cairo', sans-serif !important;
		}
	</style>

	@yield('css')

</head>
