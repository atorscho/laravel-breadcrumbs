<div class="ui breadcrumb">
	@foreach ($crumbs as $crumb)
		@if($crumb->isActive())
			<div class="active section">
				{!! $crumb->title !!}
			</div>
		@else
			<a class="section" href="{{ $crumb->url }}">{!! $crumb->title !!}</a>
			<i class="right angle icon divider"></i>
		@endif
	@endforeach
</div>
