<header class="header">
    <div class="logo-container">
        @if(thisCurrentLocale() == 'ar')
            <a href="{{route('page_index')}}" aria-label="home"><img data-src="https://realestate.eg/rtl-logo.svg" class="lazy" width="200" height="85" alt="Logo"></a>
        @else
            <a href="{{route('page_index')}}" aria-label="home"><img data-src="https://realestate.eg/new-logo.svg"  class="lazy" width="200" height="85" alt="Logo"></a>
        @endif
    </div>

    <a class="back-button" aria-label="back" href="{{$pageGoBack ?? route('page_index')}}">
        @if(thisCurrentLocale() == 'ar')
            <i class="fas fa-arrow-right"></i>
        @else
            <i class="fas fa-arrow-left"></i>
        @endif
    </a>

    <div class="search-bar">
        <form action="{{route('Search')}}" method="get">
            <input type="text" name="project_name" value="{{old('project_name',issetArr($_GET,"project_name"))}}" placeholder="{{__('web/layout.header_search')}}">
            <button type="submit" class="search-icon" aria-label="search"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="hamburger-menu" onclick="toggleMenu()" >
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>
<div class="full-screen-menu" id="fullScreenMenu">
    <div class="menu-content">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
        <div class="menu-section">
            <h2>{!! __('web/menu.main_compounds')!!}</h2>
            <a href="{{ LaravelLocalization::localizeUrl(route('page_compounds')) }}">{!! __('web/menu.main_compounds_view')!!}</a>
            <div class="submenu">
                @foreach($locationsMenu as $location)
                    <a href="{{ LaravelLocalization::localizeUrl(route('page_locationView',$location->slug)) }}">{{$location->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="menu-section">
            <h2>{{__('web/menu.main_for_sale')}}</h2>
            <a href="{{ LaravelLocalization::localizeUrl(route('page_for_sale')) }}">{{__('web/menu.main_for_sale_view')}}</a>
            <div class="submenu">
                @foreach($pagesLinkMenu as $pageLink)
                    <a href="{{\App\Http\Controllers\admin\PageAdminController::createPagesLink(thisCurrentLocale(),$pageLink)}}">{{$pageLink->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="menu-section">
            <h2>{{__('web/menu.main_developer')}}</h2>
            <a href="{{ LaravelLocalization::localizeUrl(route('page_developers')) }}">{{__('web/menu.main_developer_view')}}</a>
            <div class="submenu">
                @foreach($developersMenu as $developer )
                    <a href="{{ LaravelLocalization::localizeUrl(route('page_developer_view',$developer->slug)) }}">{{$developer->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="menu-section">
            <h2>{{__('web/menu.main_blog')}}</h2>
            <a href="{{ LaravelLocalization::localizeUrl(route('page_blog')) }}">{{__('web/menu.main_blog_view')}}</a>
        </div>
        <div class="menu-section">
            <h2>{{__('web/menu.main_contatc_us')}}</h2>
            <a href="{{ LaravelLocalization::localizeUrl(route('page_ContactUs')) }}">{{__('web/menu.main_contatc_us_view')}}</a>
        </div>
        <div class="menu-section">
            <h2>{{__('web/menu.main_lang')}}</h2>
            <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}">{{__('web/menu.main_lang_view')}}</a>
        </div>
    </div>
</div>
@if($unit->listing_type == 'Project')
    <div class="horizontal-tabs-container">
        <nav class="horizontal-tabs">
            <a href="#project-units" class="tab">{{__('web/layout.menu_project_units')}}</a>
            <a href="#project-description" class="tab">{{__('web/layout.menu_project_description')}}</a>
            <a href="#amenities" class="tab">{{__('web/layout.menu_amenities')}}</a>
            <a href="#project-video" class="tab">{{__('web/layout.menu_project_video')}}</a>
            <a href="#project-location" class="tab">{{__('web/layout.menu_project_location')}}</a>
            <a href="#faq" class="tab">{{__('web/layout.menu_faq')}}</a>
            <a href="#similar-projects" class="tab">{{__('web/layout.menu_similar_projects')}}</a>
        </nav>
        <div class="more-tabs-indicator"></div>
    </div>
@elseif($unit->listing_type == 'Unit')
    <div class="horizontal-tabs-container">
        <nav class="horizontal-tabs">
            <a href="#unit-description" class="tab">{{__('web/layout.menu_unit_description')}}</a>
            <a href="#more-units" class="tab">{{__('web/layout.menu_more_units')}}</a>
            <a href="#amenities" class="tab">{{__('web/layout.menu_amenities')}}</a>
            <a href="#project-video" class="tab">{{__('web/layout.menu_project_video')}}</a>
            <a href="#project-location" class="tab">{{__('web/layout.menu_project_location')}}</a>
        </nav>
        <div class="more-tabs-indicator"></div>
    </div>
@endif


@push('ScriptCode')

        <script>
            const horizontalTabs = document.querySelector('.horizontal-tabs');
            const tabs = document.querySelectorAll('.horizontal-tabs .tab');
            const sections = document.querySelectorAll('.content__project section');
            const moreTabsIndicator = document.querySelector('.more-tabs-indicator');


            // Function to highlight active tab based on scroll position
            function highlightActiveTab() {
                let currentSectionId = '';
                const headerOffset = header.offsetHeight + horizontalTabs.offsetHeight;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop - headerOffset;
                    const sectionBottom = sectionTop + section.offsetHeight;
                    if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionBottom) {
                        currentSectionId = section.id;
                    }
                });

                tabs.forEach(tab => {
                    const href = tab.getAttribute('href').substring(1);
                    tab.classList.toggle('active', href === currentSectionId);
                });
            }

            // Function to smooth scroll to section when clicking on a tab
            function scrollToSection(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                const headerOffset = header.offsetHeight + horizontalTabs.offsetHeight;
                const targetPosition = targetSection.offsetTop - headerOffset;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }



            // Function to update more tabs indicator visibility
            function updateMoreTabsIndicator() {
                const isScrollable = horizontalTabs.scrollWidth > horizontalTabs.clientWidth;
                moreTabsIndicator.style.display = isScrollable ? 'flex' : 'none';
            }

            // Function to handle tab scrolling
            function handleTabScroll() {
                const maxScroll = horizontalTabs.scrollWidth - horizontalTabs.clientWidth;
                moreTabsIndicator.style.opacity = horizontalTabs.scrollLeft >= maxScroll - 10 ? '0' : '1';
            }

            // Event Listeners
            window.addEventListener('scroll', () => {
                highlightActiveTab();
            });
            window.addEventListener('resize', updateMoreTabsIndicator);
            tabs.forEach(tab => tab.addEventListener('click', scrollToSection));
            horizontalTabs.addEventListener('scroll', handleTabScroll);

            // Initial calls
            highlightActiveTab();
            updateMoreTabsIndicator();

            // Intersection Observer for more accurate section tracking
            const observerOptions = {
                root: null,
                rootMargin: `-${header.offsetHeight + horizontalTabs.offsetHeight}px 0px 0px 0px`,
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.id;
                        tabs.forEach(tab => {
                            const href = tab.getAttribute('href').substring(1);
                            tab.classList.toggle('active', href === id);
                        });
                    }
                });
            }, observerOptions);

            sections.forEach(section => observer.observe(section));

        </script>

@endpush
