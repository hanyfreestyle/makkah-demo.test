@extends('real-estate.layouts.app')

@section('content')
    {!! Breadcrumbs::render('contact_us') !!}

    <main class="content" id="main-content">

        <section class="contact-hero">
            <h1>{{ __('webLang/contact-us.hero_title') }}</h1>
            <p>{{ __('webLang/contact-us.hero_subtitle') }}</p>
        </section>


        <div class="contact-content">
            <div class="contact-form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-paper-plane"></i>
                        {{ __('webLang/contact-us.form_title') }}
                    </h2>
                    <p class="section-subtitle">{{ __('webLang/contact-us.form_subtitle') }}</p>
                </div>

                <form class="contact-form" id="contactForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="firstName">{{ __('webLang/contact-us.label_first_name') }}</label>
                            <input type="text" class="form-input" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="lastName">{{ __('webLang/contact-us.label_last_name') }}</label>
                            <input type="text" class="form-input" id="lastName" name="lastName" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="email">{{ __('webLang/contact-us.label_email') }}</label>
                            <input type="email" class="form-input" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">{{ __('webLang/contact-us.label_phone') }}</label>
                            <input type="tel" class="form-input" id="phone" name="phone" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="subject">{{ __('webLang/contact-us.label_subject') }}</label>
                        <select class="form-select" id="subject" name="subject" required>
                            <option value="">{{ __('webLang/contact-us.subject_select') }}</option>
                            <option value="general">{{ __('webLang/contact-us.subject_general') }}</option>
                            <option value="property">{{ __('webLang/contact-us.subject_property') }}</option>
                            <option value="sell">{{ __('webLang/contact-us.subject_sell') }}</option>
                            <option value="buy">{{ __('webLang/contact-us.subject_buy') }}</option>
                            <option value="rent">{{ __('webLang/contact-us.subject_rent') }}</option>
                            <option value="complaint">{{ __('webLang/contact-us.subject_complaint') }}</option>
                            <option value="feedback">{{ __('webLang/contact-us.subject_feedback') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">{{ __('webLang/contact-us.label_message') }}</label>
                        <textarea class="form-textarea" id="message" name="message" placeholder="{{ __('webLang/contact-us.message_placeholder') }}" required></textarea>
                    </div>

                    <button type="submit" class="form-submit">
                        <i class="fas fa-paper-plane"></i>
                        {{ __('webLang/contact-us.btn_send') }}
                    </button>
                </form>
            </div>

            <div class="contact-info-section">
                <div class="contact-methods">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-headset"></i>
                            {{ __('webLang/contact-us.need_help_title') }}
                        </h3>
                        <p class="section-subtitle">{{ __('webLang/contact-us.need_help_subtitle') }}</p>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h4>{{ __('webLang/contact-us.contact_call') }}</h4>
                            <a href="tel:+{{$webConfig->phone_call}}">{{$webConfig->phone_num}}</a>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="contact-details">
                            <h4>{{ __('webLang/contact-us.contact_whatsapp') }}</h4>
                            <a href="https://wa.me/{{$webConfig->whatsapp_send}}">{{$webConfig->whatsapp_num}}</a>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>{{ __('webLang/contact-us.contact_email') }}</h4>
                            <a href="mailto:{{$webConfig->email}}">{{$webConfig->email}}</a>
                        </div>
                    </div>
                </div>

                <div class="quick-actions">
                    <h3 class="section-title">{{ __('webLang/contact-us.quick_actions_title') }}</h3>

                    <a href="https://wa.me/{{$webConfig->whatsapp_send}}" class="quick-action-btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i>
                        {{ __('webLang/contact-us.quick_action_whatsapp') }}
                    </a>

                    <button class="quick-action-btn btn-zoom" onclick="scheduleZoom()">
                        <i class="fas fa-video"></i>
                        {{ __('webLang/contact-us.quick_action_zoom') }}
                    </button>
                </div>


                <div class="office-hours">
                    <h3 class="section-title">
                        <i class="fas fa-clock"></i>
                        {{ __('webLang/contact-us.office_hours_title') }}
                    </h3>
                    <ul class="hours-list">
                        <li class="hours-item">
                            <span class="hours-day">{{ __('webLang/contact-us.office_sun_thu') }}</span>
                            <span class="hours-time">{{ __('webLang/contact-us.hours_9_6') }}</span>
                        </li>
                        <li class="hours-item">
                            <span class="hours-day">{{ __('webLang/contact-us.office_friday') }}</span>
                            <span class="hours-time">{{ __('webLang/contact-us.hours_10_2') }}</span>
                        </li>
                        <li class="hours-item">
                            <span class="hours-day">{{ __('webLang/contact-us.office_saturday') }}</span>
                            <span class="hours-time closed">{{ __('webLang/contact-us.closed') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <section class="map-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-map-marked-alt"></i>
                    {{ __('webLang/contact-us.map_title') }}
                </h2>
                <p class="section-subtitle">{{$webConfig->schema_address}}</p>
            </div>

            <div class="map-container">
                <div class="map-placeholder">
{{--                    <i class="fas fa-map-marked-alt"></i> {{ __('webLang/contact-us.map_placeholder') }}--}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27641.277176315063!2d31.38730770599792!3d30.003571977167375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583cc75436d909%3A0x7f921d4528ec3e03!2sThe%205th%20Settlement%2C%20Industrial%20Area%2C%20New%20Cairo%201%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1748404449211!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

    </main>
@endsection

@push('stackStyle')
    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/pages/contact-us.css',$cssMinifyType,$cssReBuild) !!}
@endpush


@push('stackScript')
    <script>
        // Contact form submission
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Here you would normally send the form data to your server
            // For now, we'll just show a success message
            alert('Thank you for your message! We will get back to you within 24 hours.');
            this.reset();
        });

        // Schedule Zoom meeting
        function scheduleZoom() {
            // In a real implementation, this would open a calendar or scheduling interface
            alert('Zoom meeting scheduling will be available soon! Please call us at 0100-9808-986');
        }

    </script>
@endpush

