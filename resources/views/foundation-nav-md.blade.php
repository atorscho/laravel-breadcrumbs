<nav class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
	@foreach ($crumbs as $i => $crumb)
		<a
			class="{{ $crumb->active(false, 'current') }} {{ $crumb->disabled('unavailable') }}" href="{{ $crumb->url }}"
			itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<span itemprop="name">{!! $crumb->title !!}</span>
			<meta itemprop="position" content="{{ $i + 1 }}" />
		</a>
	@endforeach
</nav>
