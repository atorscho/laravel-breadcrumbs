<div class="ui breadcrumb">
	@foreach ($crumbs as $crumb)
		@if($crumb->isActive())
			<div class="{!! $crumb->active(false) !!} section">
				{{ $crumb->title }}
			</div>
		@else
			<a class="section" href="{{ $crumb->url }}">{{ $crumb->title }}</a>
			<div class="divider"> /</div>
		@endif
	@endforeach
</div>
