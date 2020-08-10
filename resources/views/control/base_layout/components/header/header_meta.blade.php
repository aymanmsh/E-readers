		<meta charset="utf-8">
		<title>Metronic | Dashboard</title>
		<meta name="description" content="Updates and statistics">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
		<!--end::Fonts-->
		@if(app()->getLocale() == 'en')
			<!--begin::Global Theme Styles(used by all pages)-->
			<link href="{{asset('control/style/assets/plugins/global/plugins.bundle.css?v=7.0.8')}}" rel="stylesheet" type="text/css">
			<link href="{{asset('control/style/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.8')}}" rel="stylesheet" type="text/css">
			<link href="{{asset('control/style/assets/css/style.bundle.css?v=7.0.8')}}" rel="stylesheet" type="text/css">
			<!--end::Global Theme Styles-->
			<!--begin::Layout Themes(used by all pages)-->
			<link href="{{asset('control/style/assets/css/themes/layout/header/base/light.css?v=7.0.8')}}" rel="stylesheet" type="text/css">
			<link href="{{asset('control/style/assets/css/themes/layout/header/menu/light.css?v=7.0.8')}}" rel="stylesheet" type="text/css">
			<link href="{{asset('control/style/assets/css/themes/layout/brand/dark.css?v=7.0.8')}}" rel="stylesheet" type="text/css">
			<link href="{{asset('control/style/assets/css/themes/layout/aside/dark.css?v=7.0.8')}}" rel="stylesheet" type="text/css">
			<!--end::Layout Themes-->
		@elseif(app()->getLocale() == 'ar')
			<!--begin::Global Theme Styles(used by all pages)-->
			<link href="{{asset('control/style/assets/plugins/global/plugins.bundle.rtl.css?v=7.0.8')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('control/style/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css?v=7.0.8')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('control/style/assets/css/style.bundle.rtl.css?v=7.0.8')}}" rel="stylesheet" type="text/css" />
			<!--end::Global Theme Styles-->
			<!--begin::Layout Themes(used by all pages)-->
			<link href="{{asset('control/style/assets/css/themes/layout/header/base/light.rtl.css?v=7.0.8')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('control/style/assets/css/themes/layout/header/menu/light.rtl.css?v=7.0.8')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('control/style/assets/css/themes/layout/brand/dark.rtl.css?v=7.0.8')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('control/style/assets/css/themes/layout/aside/dark.rtl.css?v=7.0.8')}}" rel="stylesheet" type="text/css" />
			<!--end::Layout Themes-->
		@endif
		<link rel="shortcut icon" href="{{asset('control/style/assets/media/logos/favicon.ico')}}">