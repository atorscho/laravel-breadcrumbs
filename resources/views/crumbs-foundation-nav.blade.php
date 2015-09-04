<nav class="breadcrumbs">
	@foreach ($crumbs as $crumb)
		<a class="{{ $crumb->active(false, 'current') }} {{ $crumb->disabled('unavailable') }}" href="{{ $crumb->url }}">
			{!! $crumb->title !!}
		</a>
	@endforeach
</nav>
