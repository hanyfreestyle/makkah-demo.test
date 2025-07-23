@unless ($breadcrumbs->isEmpty())
    @push('stackStyle')

    @endpush

    <div class="breadcrumbs" id="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <div class="breadcrumb-slide" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{!! $breadcrumb->url !!}" aria-label="{{$breadcrumb->title}}">
                    <span itemprop="name">
                        {!! $breadcrumb->title !!}
                    </span>
                    </a>
                    <meta itemprop="position" content=" {{$loop->index+1}}"/>
                    @if (thisCurrentLocale() === 'ar')
                        <span class="separator"><i class="fas fa-chevron-left"></i></span>
                    @else
                        <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    @endif

                </div>
            @else
                <div class="breadcrumb-slide " itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                     <span itemprop="item" href="{!! $breadcrumb->url !!}" aria-label="{{$breadcrumb->title}}">
                         <span class="current" itemprop="name">{!! $breadcrumb->title !!}</span>
                     </span>
                    <meta itemprop="position" content=" {{$loop->index+1}}"/>
                </div>
            @endif
        @endforeach
    </div>
@endunless

