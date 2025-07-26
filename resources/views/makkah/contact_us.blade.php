@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('contact_us') !!}

  <x-makkah.def.page-heading :meta="$meta"/>


  <div class="container mb-30">
    <div class="row contactPage">
      <div class="col-lg-4">

        <div class="widget ltn__social-media-widget mb-20">
          <h4 class="ltn__widget-title ltn__widget-title-border-2 updateFont">{{__('web/def.contact.october_branch')}}</h4>
          <div class="footer-address contactAddress">
            <ul>
              <li>
                <div class="footer-address-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="footer-address-info"><p><a href="{{ctaActionMap($webConfig)}}" target="_blank">{{$webConfig->schema_address}} <br>{{$webConfig->schema_city}}</a></p></div>
              </li>

              <li>
                <div class="footer-address-icon"><i class="fa-solid fa-square-phone"></i></div>
                <div class="footer-address-info footer_number"><p><a href="{{ctaActionCall($webConfig)}}">{{$webConfig->phone_num}}</a></p></div>
              </li>

              <li>
                <div class="footer-address-icon"><i class="fa-brands fa-whatsapp"></i></div>
                <div class="footer-address-info footer_number"><p><a href="#">{{$webConfig->whatsapp_num}}</a></p></div>
              </li>
              <li>
                <div class="footer-address-icon"><i class="fa-solid fa-at"></i></div>
                <div class="footer-address-info footer_number"><p><a href="mailto:{{$webConfig->email}}">{{$webConfig->email}}</a></p></div>
              </li>
            </ul>
          </div>
        </div>

        <div class="widget ltn__social-media-widget mb-20">
          <h4 class="ltn__widget-title ltn__widget-title-border-2 updateFont">{{__('web/def.contact.zayed_branch')}}</h4>
           <p>{{__('web/def.contact.form_soon')}}</p>
        </div>


        <div class="widget ltn__social-media-widget mb-20">
          <h4 class="ltn__widget-title ltn__widget-title-border-2 updateFont">{{__('web/def.widget.follow_us')}}</h4>
          <x-makkah.def.social-media type="mobile" :web-config="$webConfig"/>
        </div>


      </div>
      <div class="col-lg-8">
        <div class="ltn__form-box contact-form-box box-shadow white-bg">
          <h4 class="title-2 updateFont">{{__('web/def.contact.form_title')}}</h4>
          <form id="contact-form" action="https://tunatheme.com/tf/html/quarter-preview/quarter/mail.php" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="input-item input-item-name ltn__custom-icon updateFont">
                  <input type="text" name="name" placeholder="{{__('web/def.contact.form_name')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-item input-item-phone ltn__custom-icon">
                  <input type="text" name="phone" placeholder="{{__('web/def.contact.form_phone')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-item input-item-email ltn__custom-icon">
                  <input type="email" name="email" placeholder="{{__('web/def.contact.form_email')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-item input-item-name ltn__custom-icon">
                  <input type="text" name="subject" placeholder="{{__('web/def.contact.form_subject')}}">
                </div>
              </div>

            </div>
            <div class="input-item input-item-textarea ltn__custom-icon">
              <textarea name="message" placeholder="{{__('web/def.contact.form_message')}}"></textarea>
            </div>
            <div class="btn-wrapper mt-0 {{ textDir() }}">
              <button class="btn theme-btn-1 btn-effect-1 font-bold updateFont" type="submit">{{__('web/def.contact.form_btn')}}</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="google-map">
    <iframe src="{{$webConfig->google_map_embed}}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
@endsection

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/contact_us.css',$cssMinifyType,$cssReBuild) !!}

@endpush
