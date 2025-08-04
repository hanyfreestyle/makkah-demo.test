@php
  $blockPhoto = $blockPhoto ?? asset('makkah/img/video-bg.jpg') ;

@endphp


<div class="map-wrapper">
  @if(getLangData($schema,'btn'))
    <div class="map-overlay" id="mapOverlay">
      <div class="overlay-content">
        @if(getLangData($schema,'h1'))
          <h2 class="updateFont">{{getLangData($schema,'h1')}}</h2>
        @endif

        @if(getLangData($schema,'des'))
          <ul>
            @foreach (explode("\n", getLangData($schema, 'des')) as $line)
              @if(trim($line) !== '')
                <li><i class="fa-solid fa-thumbtack"> </i> {{ $line }}</li>
              @endif
            @endforeach
          </ul>
        @endif

        <button class="map-button updateFont" onclick="hideOverlay()">{{getLangData($schema,'btn')}}</button>
      </div>
    </div>
  @endif


  <iframe src="{{getData($schema,'map_url')}}&hl=en" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>

@push('stackStyle')
  <style>
      .map-wrapper {
          position: relative;
          width: 100%;
          height: 75vh;
          overflow: hidden;
          box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      }

      .map-wrapper iframe {
          width: 100%;
          height: 100%;
          border: 0;
          z-index: 1;
      }

      .map-overlay {
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 10;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          text-align: center;
          color: white;
          transition: opacity 0.3s ease, visibility 0.3s ease;
      }

      .map-overlay.hidden {
          opacity: 0;
          visibility: hidden;
      }

      .overlay-content {
          background: rgba(255, 255, 255, .8);
          backdrop-filter: blur(10px);
          border-radius: 16px;
          padding: 40px;
          max-width: 600px;
          border: 1px solid rgba(255, 255, 255, 0.2);
      }

      .map-overlay h2 {
          font-size: 1.2rem;
          margin-bottom: 30px;
          font-weight: 700;
          color: var(--def-color);
      }

      .map-overlay ul {
          list-style: none;
          margin-bottom: 30px;
      }

      .map-overlay li {
          /*background: rgba(255, 255, 255, .8);*/
          margin: 5px;
          padding: 5px 10px;
          /*border-radius: 8px;*/
          /*border: 1px solid rgba(255, 255, 255, 0.2);*/
          font-size: 1rem;
          position: relative;
          transition: all 0.3s ease;
          color: #000;
          text-align: left;
      }

      html[lang="ar"] .map-overlay li {
          text-align: right;
      }

      .map-overlay li i {
          color: var(--def-color);
          font-size: 14px;
      }


      .map-overlay li:hover {
          background: rgba(255, 255, 255, 0.2);
          transform: translateY(-2px);
      }


      .map-button {
          background: var(--def-color);
          color: white;
          border: none;
          padding: 10px 20px;
          font-size: 1.2rem;
          font-weight: 600;
          border-radius: 10px;
          cursor: pointer;
          transition: all 0.3s ease;
          text-decoration: none;
          display: inline-block;
          box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
      }

      /* تأثير الرسوم المتحركة عند الدخول */
      @keyframes slideInUp {
          from {
              opacity: 0;
              transform: translateY(30px);
          }
          to {
              opacity: 1;
              transform: translateY(0);
          }
      }

      .overlay-content {
          animation: slideInUp 0.6s ease-out;
      }

      /* للشاشات الصغيرة */
      @media (max-width: 768px) {
          .overlay-content {
              padding: 30px 15px;
              margin: 20px;

          }

          .map-overlay h2 {
              font-size: 1.3rem;
              margin-bottom: 20px;
          }

          .map-overlay li {
              font-size: 1rem;
              padding: 10px;
          }

          .map-button {
              padding: 12px 25px;
              font-size: 1.1rem;
          }
      }
  </style>
@endpush


@push('stackScript')
  <script>
      function hideOverlay() {
          const overlay = document.getElementById('mapOverlay');
          overlay.classList.add('hidden');

          // إزالة الـ overlay نهائياً من DOM بعد انتهاء الأنيميشن
          setTimeout(() => {
              overlay.style.display = 'none';
          }, 300);
      }

      // اختياري: إظهار الـ overlay مرة أخرى عند تحديث الصفحة
      function showOverlay() {
          const overlay = document.getElementById('mapOverlay');
          overlay.style.display = 'flex';
          overlay.classList.remove('hidden');
      }
  </script>

@endpush






