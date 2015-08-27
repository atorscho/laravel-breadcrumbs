<div class="ui breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
	@foreach ($crumbs as $i => $crumb)
		@if($crumb->isActive())
			<div class="{!! $crumb->active(false) !!} section" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="name">{{ $crumb->title }}</span>
				<meta itemprop="position" content="{{ $i + 1 }}" />
			</div>
		@else
			<a class="section" href="{{ $crumb->url }}" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="name">{{ $crumb->title }}</span>
				<meta itemprop="position" content="{{ $i + 1 }}" />
			</a>
			<div class="divider"> /</div>
		@endif
	@endforeach
</div>