<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
	@foreach ($crumbs as $i => $crumb)
		<li {!! $crumb->active() !!} itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			@if($crumb->isActive())
				<span itemprop="name">{!! $crumb->title !!}</span>
			@else
				<a href="{{ $crumb->url }}" itemprop="item">
					<span itemprop="name">{!! $crumb->title !!}</span>
				</a>
			@endif
			<meta itemprop="position" content="{{ $i + 1 }}" />
		</li>
	@endforeach
</ol>
