<div class="container {{getPaddingSize($config) }}   {{getMarginSize($config) }}">
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-8">
      <div class="ltn__form-box contact-form-box box-shadow white-bg">
        <h4 class="title-2 updateFont"> {{getLangData($schema, 'h1')}}</h4>

        <form id="contact-form" action="#" method="post">
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
          </div>

          <div class="btn-wrapper mt-0 {{ textDir() }}">
            <button class="btn theme-btn-1 btn-effect-1 font-bold updateFont" type="submit">
              {{getLangData($schema, 'btn')}}
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
