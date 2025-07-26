@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('contact_us') !!}

  <div class="ltn__contact-address-area mb-90">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
            <div class="ltn__contact-address-icon">
              <img src="img/icons/10.png" alt="Icon Image">
            </div>
            <h3>Email Address</h3>
            <p>info@webmail.com <br>
              jobs@webexample.com</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
            <div class="ltn__contact-address-icon">
              <img src="img/icons/11.png" alt="Icon Image">
            </div>
            <h3>Phone Number</h3>
            <p>+0123-456789 <br> +987-6543210</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
            <div class="ltn__contact-address-icon">
              <img src="img/icons/12.png" alt="Icon Image">
            </div>
            <h3>Office Address</h3>
            <p>18/A, New Born Town Hall <br>
              New York, US</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CONTACT ADDRESS AREA END -->

  <!-- CONTACT MESSAGE AREA START -->
  <div class="ltn__contact-message-area mb-120 mb--100">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ltn__form-box contact-form-box box-shadow white-bg">
            <h4 class="title-2">Get A Quote</h4>
            <form id="contact-form" action="https://tunatheme.com/tf/html/quarter-preview/quarter/mail.php" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-item input-item-name ltn__custom-icon">
                    <input type="text" name="name" placeholder="Enter your name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-item input-item-email ltn__custom-icon">
                    <input type="email" name="email" placeholder="Enter email address">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-item">
                    <select class="nice-select">
                      <option>Select Service Type</option>
                      <option>Property Management</option>
                      <option>Mortgage Service</option>
                      <option>Consulting Service</option>
                      <option>Home Buying</option>
                      <option>Home Selling</option>
                      <option>Escrow Services</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-item input-item-phone ltn__custom-icon">
                    <input type="text" name="phone" placeholder="Enter phone number">
                  </div>
                </div>
              </div>
              <div class="input-item input-item-textarea ltn__custom-icon">
                <textarea name="message" placeholder="Enter message"></textarea>
              </div>
              <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Save my name, email, and website in this browser for the next time I comment.</label></p>
              <div class="btn-wrapper mt-0">
                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">get a free service</button>
              </div>
              <p class="form-messege mb-0 mt-20"></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CONTACT MESSAGE AREA END -->

  <!-- GOOGLE MAP AREA START -->
  <div class="google-map">

    <iframe src="{{$webConfig->google_map_embed}}"  width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
@endsection


