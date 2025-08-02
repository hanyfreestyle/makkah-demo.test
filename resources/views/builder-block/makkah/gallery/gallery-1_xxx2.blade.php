<div class="container">
  <h1>معرض الصور - Masonry Layout</h1>

  <div class="gallery">

    @foreach($block->photos as $photo)
      <div class="gallery-item small ">
        <img src="{{ Storage::disk('root_folder')->url($photo->photo)}}" alt="صورة 1">
        <div class="overlay">
          <div class="title">منظر طبيعي جميل</div>
          <div class="zoom-icon">
            <i class="fas fa-search-plus"></i>
          </div>
        </div>
      </div>

{{--      <div class="col-lg-12">--}}
{{--        <div class="ltn__img-slide-item-4">--}}
{{--          <a href="{{ Storage::disk('root_folder')->url($photo->photo)}}" data-rel="lightcase:myCollection">--}}
{{--            <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="Image">--}}
{{--          </a>--}}
{{--        </div>--}}
{{--      </div>--}}
    @endforeach



  </div>
</div>



@push('stackStyle')
  <style>
      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
      }

      body {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          min-height: 100vh;
          padding: 20px;
      }

      .container {
          max-width: 1200px;
          margin: 0 auto;
      }

      h1 {
          text-align: center;
          color: white;
          margin-bottom: 30px;
          font-size: 2.5rem;
          text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
      }

      .gallery {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
          grid-gap: 20px;
          grid-auto-rows: 10px;
      }

      .gallery-item {
          position: relative;
          border-radius: 15px;
          overflow: hidden;
          box-shadow: 0 10px 30px rgba(0,0,0,0.2);
          transition: all 0.3s ease;
          cursor: pointer;
      }

      .gallery-item:hover {
          transform: translateY(-5px);
          box-shadow: 0 15px 35px rgba(0,0,0,0.3);
      }

      .gallery-item img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
          transition: transform 0.3s ease;
      }

      .gallery-item:hover img {
          transform: scale(1.1);
      }

      /* Overlay للعنوان */
      .gallery-item .overlay {
          position: absolute;
          top: 0;
          right: 0;
          left: 0;
          bottom: 0;
          background: linear-gradient(180deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.8) 100%);
          opacity: 0;
          transition: opacity 0.3s ease;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          padding: 20px;
      }

      .gallery-item:hover .overlay {
          opacity: 1;
      }

      .gallery-item .title {
          color: white;
          font-size: 1.1rem;
          font-weight: bold;
          text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
          align-self: flex-start;
      }

      .gallery-item .zoom-icon {
          color: white;
          font-size: 1.5rem;
          align-self: flex-end;
          opacity: 0.8;
          transition: opacity 0.3s ease;
      }

      .gallery-item:hover .zoom-icon {
          opacity: 1;
      }

      /* تحديد ارتفاع العناصر للـ Masonry Effect */
      .gallery-item.small {
          grid-row-end: span 20;
      }

      .gallery-item.medium {
          grid-row-end: span 25;
      }

      .gallery-item.large {
          grid-row-end: span 30;
      }

      .gallery-item.extra-large {
          grid-row-end: span 35;
      }

      /* تأثيرات إضافية */
      .gallery-item::after {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
          opacity: 0;
          transition: opacity 0.3s ease;
          border-radius: 15px;
      }

      .gallery-item:hover::after {
          opacity: 1;
      }

      /* للشاشات الصغيرة */
      @media (max-width: 768px) {
          .gallery {
              grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
              grid-gap: 15px;
          }

          h1 {
              font-size: 2rem;
          }
      }

      @media (max-width: 480px) {
          .gallery {
              grid-template-columns: 1fr;
              grid-gap: 15px;
          }

          .container {
              padding: 0 10px;
          }
      }

      /* تأثير التحميل */
      .gallery-item {
          animation: fadeInUp 0.6s ease forwards;
          opacity: 0;
          transform: translateY(30px);
      }

      .gallery-item:nth-child(1) { animation-delay: 0.1s; }
      .gallery-item:nth-child(2) { animation-delay: 0.2s; }
      .gallery-item:nth-child(3) { animation-delay: 0.3s; }
      .gallery-item:nth-child(4) { animation-delay: 0.4s; }
      .gallery-item:nth-child(5) { animation-delay: 0.5s; }
      .gallery-item:nth-child(6) { animation-delay: 0.6s; }
      .gallery-item:nth-child(7) { animation-delay: 0.7s; }
      .gallery-item:nth-child(8) { animation-delay: 0.8s; }

      @keyframes fadeInUp {
          to {
              opacity: 1;
              transform: translateY(0);
          }
      }
  </style>
@endpush


@push('stackScript')
  <script>
      // تأثيرات إضافية للتفاعل
      document.querySelectorAll('.gallery-item').forEach(item => {
          item.addEventListener('click', function() {
              this.style.transform = 'scale(0.95)';
              setTimeout(() => {
                  this.style.transform = '';
              }, 150);
          });
      });

      // تحسين التحميل التدريجي
      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.style.animationPlayState = 'running';
              }
          });
      });

      document.querySelectorAll('.gallery-item').forEach(item => {
          observer.observe(item);
      });
  </script>
@endpush
