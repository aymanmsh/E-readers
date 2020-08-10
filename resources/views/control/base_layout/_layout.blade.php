<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'en' ? 'ltr' : 'rtl'}}">
	<head>
		@includeif('control.base_layout.components.header.header_meta')
		<style type="text/css">
			#kt_wrapper {
				padding-top: 65px !important; 
			}
			#kt_header {
				background-color: #1E1E2D;
			}
		</style>
		@yield('style')
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable" cz-shortcut-listen="true">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		@includeif('control.base_layout.components.header.header_mobile')
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Aside-->
				@includeif('control.base_layout.components.global.aside')
				<!--end::Aside-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					@includeif('control.base_layout.components.header.header')
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container">
							@if(session()->has('success'))								
								<div class="alert alert-custom alert-primary fade show" role="alert">
								    <div class="alert-icon"><i class="fa fa-check"></i></div>
								    <div class="alert-text">{{session()->get('success')}}</div>
								    <div class="alert-close">
								        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								            <span aria-hidden="true"><i class="ki ki-close"></i></span>
								        </button>
								    </div>
								</div>
							@elseif(session()->has('error'))
								<div class="alert alert-danger">{{session()->get('error')}}</div>
							@endif
						</div>

						@yield('content')
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					@includeif('control.base_layout.components.footer.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<!--begin::Sticky Toolbar-->
		{{-- @includeif('control.base_layout.components.global.sticky_toolbar') --}}
		@includeif('control.base_layout.components.global.chat_panel')
		@includeif('control.base_layout.components.global.quick_panel')
		@includeif('control.base_layout.components.global.quick_cart')
		@includeif('control.base_layout.components.global.scroll_top')
		@includeif('control.base_layout.components.global.user_panel')
		{{-- @includeif('control.base_layout.components.global.demo_panel') --}}
		@includeif('control.base_layout.components.global.drop_down')
		<!--end::Sticky Toolbar-->
		@includeif('control.base_layout.components.footer.footer_meta')

		@yield('script')
	</body>
</html>
