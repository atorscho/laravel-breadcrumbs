<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
	@foreach ($crumbs as $i => $crumb)
		<li
			class="{{ $crumb->active(false, 'current') }} {{ $crumb->disabled('unavailable') }}"
			itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a href="{{ $crumb->url }}" itemprop="item">
				<span itemprop="name">{!! $crumb->title !!}</span>
			</a>
			<meta itemprop="position" content="{{ $i + 1 }}" />
		</li>
	@endforeach
</ul>
