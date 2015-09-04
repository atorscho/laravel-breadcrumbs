<ul class="breadcrumbs">
	@foreach ($crumbs as $crumb)
		<li class="{{ $crumb->active(false, 'current') }} {{ $crumb->disabled('unavailable') }}">
			<a href="{{ $crumb->url }}">
				{!! $crumb->title !!}
			</a>
		</li>
	@endforeach
</ul>
