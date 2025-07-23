<header class="header">
    <div class="logo-container">
        <a href="{{route('web.index')}}" class="">
            <img src="https://realestate.eg/new-logo.svg" alt="RealEstate.eg Logo">
        </a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="{{__('webLang/header.input_search')}}" aria-label="Search">
        <i class="fas fa-search search-icon"></i>
    </div>
    <div class="hamburger-menu" onclick="toggleMenu()" aria-label="Toggle Menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

@if($listing_unit != null)
    @if($listing_unit->listing_type == "Project")
        <x-real-estate-eg.horizontal-tabs.project :unit="$listing_unit" :similar-projects="$similarProjects"/>
    @elseif($listing_unit->listing_type == "Unit")
        <x-real-estate-eg.horizontal-tabs.unit :unit="$listing_unit" :similar-units="$similarUnits"/>
    @elseif($listing_unit->listing_type == "ForSale")
        <x-real-estate-eg.horizontal-tabs.for-sale :unit="$listing_unit"/>
    @endif
@endif

<div class="full-screen-menu" id="fullScreenMenu">
    <div class="menu-content">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
        <div class="menu-section">
            <h2><i class="fas fa-building"></i>{!! __('webLang/header.menu_compounds')!!}</h2>
            <a href="{{ setLocalizationRoute(route('page_compounds')) }}">
                <i class="fas fa-th-list"></i>{!! __('webLang/header.menu_all_compounds')!!}
            </a>
            <div class="submenu active">
                @foreach($locationsMenu as $location)
                    <a href="{{ setLocalizationRoute(route('page_locationView',$location->slug)) }}">
                        <i class="fas fa-map-pin"></i>
                        {{$location->name}}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="menu-section">
            <h2><i class="fas fa-home"></i>{!! __('webLang/header.menu_for_sale')!!}</h2>
            <a href="{{ setLocalizationRoute(route('page_for_sale')) }}"><i class="fas fa-th-list"></i>{!! __('webLang/header.menu_all_properties_for_sale')!!}</a>
            <div class="submenu active">
                @foreach($listingPageMenu as $pageLink)
                    <a href="{{createPagesLink(thisCurrentLocale(),$pageLink)}}"><i class="fas fa-building"></i>{{$pageLink->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="menu-section">
            <h2><i class="fas fa-briefcase"></i>{!! __('webLang/header.menu_developers')!!}</h2>
            <a href="{{ setLocalizationRoute(route('page_developers')) }}">
                <i class="fas fa-th-list"></i>{!! __('webLang/header.menu_all_developers')!!}
            </a>
            <div class="submenu active">
                @foreach($developersMenu->take(8) as $developer )
                    <a href="{{ setLocalizationRoute(route('page_developer_view',$developer['slug'])) }}">
                        <i class="fas fa-building"></i> {{$developer['name']}}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="menu-section">
            <h2><i class="fas fa-blog"></i>{{ __('webLang/header.menu_blog') }}</h2>
            <a href="{{ setLocalizationRoute(route('page_blog')) }}">
                <i class="fas fa-newspaper"></i>{{ __('webLang/header.menu_visit_our_blog') }}
            </a>
        </div>

        <div class="menu-section">
            <h2><i class="fas fa-envelope"></i>{{ __('webLang/header.menu_contact_us') }}</h2>
            <a href="{{ setLocalizationRoute(route('page_ContactUs')) }}"><i class="fas fa-phone"></i>{{ __('webLang/header.menu_get_in_touch') }}</a>
        </div>

        <div class="menu-section">
            <h2><i class="fas fa-users"></i>{{ __('webLang/header.menu_about_us') }}</h2>
            <a href="{{ setLocalizationRoute(route('page_AboutUs')) }}"><i class="fas fa-landmark"></i>{{ __('webLang/header.menu_about_us_text') }}</a>
        </div>

        <div class="menu-section">
            <h2><i class="fa-solid fa-language"></i>{{ __('webLang/header.menu_language') }}</h2>
            <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}">{{__('webLang/header.menu_language_view')}}</a>
        </div>

    </div>
</div>
