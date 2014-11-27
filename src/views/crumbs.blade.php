<ol class="breadcrumb">
	@if(URL::current() == route('admin.index'))
        <li class="active">{{{ getSetting('crumbsHome') ?: Config::get('crumbs::config.home') }}}</li>
    @else
        <li><a href="{{{ route('admin.index') }}}">{{{ getSetting('crumbsHome') ?: Config::get('crumbs::config.home') }}}</a></li>
    @endif

	@if($crumbs)
		@foreach($crumbs as $crumb)
			@if(URL::current() == $crumb->uri)
	            <li class="active">{{{ $crumb->title }}}</li>
	        @else
	            <li><a href="{{{ $crumb->uri }}}">{{{ $crumb->title }}}</a></li>
	        @endif
		@endforeach
	@endif
</ol>
