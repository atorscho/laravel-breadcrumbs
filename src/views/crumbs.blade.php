<?php // todo - translate ?>

<ol class="breadcrumb">
	@if(URL::current() == route('admin.index'))
        <li class="active">{{ getSetting('crumbsHome') ?: @trans('crumbs::crumbs.home') }}</li>
    @else
        <li><a href="{{{ route('admin.index') }}}">{{ getSetting('crumbsHome') ?: @trans('crumbs::crumbs.home') }}</a></li>
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
