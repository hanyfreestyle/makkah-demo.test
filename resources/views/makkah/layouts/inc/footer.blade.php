<footer class="footer">
    <div class="footer-content">
        <div class="footer-column">
            <a href="{{route('web.index')}}" class="footer-logo">
                @if(thisCurrentLocale() == 'ar')
                    <img src="{{defImagesDir('light_logo_ar','photo')}}" width="296" height="100" alt="RealEstate.eg Logo" class="img-fluid">
                @else
                    <img src="{{defImagesDir('light_logo','photo')}}" width="345" height="110" alt="RealEstate.eg Logo" class="img-fluid">
                @endif
            </a>
            <p class="footer-about">{{ $webConfig->footer_text ?? ''}}</p>
            <div class="footer-social">
                <a href="{{ $webConfig->social['facebook'] ?? '#' }}" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ $webConfig->social['twitter'] ?? '#' }}" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="{{ $webConfig->social['instagram'] ?? '#' }}" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="{{ $webConfig->social['linkedin'] ?? '#' }}" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="{{ $webConfig->social['youtube'] ?? '#' }}" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="footer-column">
            <h3 class="footer-title">{{__('webLang/footer.h3_quick_links')}}</h3>
            <div class="footer-links">
                <a href="{{route('page_AboutUs')}}">{{__('webLang/footer.menu_about_us')}}</a>
                <a href="{{route('web.index')}}">{{__('webLang/footer.menu_our_services')}}</a>
                <a href="{{route('web.index')}}">{{__('webLang/footer.menu_property_listings')}}</a>
                <a href="{{route('web.index')}}">{{__('webLang/footer.menu_new_projects')}}</a>
                <a href="{{route('web.index')}}">{{__('webLang/footer.menu_terms_conditions')}}</a>
                <a href="{{route('page_ContactUs')}}">{{__('webLang/footer.menu_contact_us')}}</a>
            </div>
        </div>
        <div class="footer-column">
            <h3 class="footer-title">{{__('webLang/footer.h3_popular_areas')}}</h3>
            <div class="footer-links">
                @foreach($locationsMenu->take(6) as $location)
                    <a href="{{ setLocalizationRoute(route('page_locationView',$location->slug)) }}">{{$location->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="footer-column">
            <h3 class="footer-title">{{__('webLang/footer.h3_contact_us')}}</h3>
            <div class="footer-contact">
                <i class="fas fa-map-marker-alt"></i>
                <div>{{ $webConfig->schema_address ?? ''}}</div>
            </div>
            <div class="footer-contact">
                <i class="fas fa-phone-alt"></i>
                <div>{{ $webConfig->phone_num ?? ''}}</div>
            </div>
            <div class="footer-contact">
                <i class="fas fa-envelope"></i>
                <div>{{ $webConfig->email ?? ''}}</div>
            </div>
            <div class="footer-contact">
                <i class="fa-solid fa-globe"></i>
                <div>{{ $webConfig->web_url ?? ''}}</div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>{!! getCopyRight('2008',$webConfig->name ) !!}</p>
    </div>
</footer>

<x-real-estate-eg.def.call-to-action view-type="FooterView" :config="$webConfig" :unit="null"/>
