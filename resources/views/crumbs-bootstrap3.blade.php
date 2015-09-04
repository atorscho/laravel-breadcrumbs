<ol class="breadcrumb">
	@foreach ($crumbs as $crumb)
		<li {!! $crumb->active() !!}>
			@if($crumb->isActive())
				{!! $crumb->title !!}
			@else
				<a href="{{ $crumb->url }}">{!! $crumb->title !!}</a>
			@endif
		</li>
	@endforeach
</ol>
