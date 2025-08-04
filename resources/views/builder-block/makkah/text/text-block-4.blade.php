<div class="container-fluid textblock4 pt-50">
  <div class="main-title">
    <h2 class="updateFont">معرض الصور</h2>
    <p>اكتشف مجموعة مختارة من أروع الصور</p>
  </div>

  <div class="row">
    <!-- الصورة الأولى -->
    <div class="col-lg-6 col-md-6 col-sm-12">
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="منظر طبيعي">
        <div class="photo-overlay">
          <h2>جمال الطبيعة</h2>
          <p>استمتع بروعة المناظر الطبيعية الخلابة والمناظر الجبلية الساحرة التي تأخذ الأنفاس</p>
        </div>
      </div>
    </div>

    <!-- الصورة الثانية -->
    <div class="col-lg-6 col-md-6 col-sm-12">
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="مدينة حديثة">
        <div class="photo-overlay">
          <h2>المدينة العصرية</h2>
          <p>اكتشف جمال العمارة الحديثة والأضواء المتلألئة في قلب المدينة النابضة بالحياة</p>
        </div>
      </div>
    </div>

    <!-- الصورة الثالثة -->
    <div class="col-lg-6 col-md-6 col-sm-12">
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="شاطئ البحر">
        <div class="photo-overlay">
          <h2>سحر الشاطئ</h2>
          <p>انغمس في هدوء الأمواج وجمال الشواطئ الذهبية تحت أشعة الشمس الدافئة</p>
        </div>
      </div>
    </div>

    <!-- الصورة الرابعة -->
    <div class="col-lg-6 col-md-6 col-sm-12">
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="غابة خضراء">
        <div class="photo-overlay">
          <h2>عمق الغابة</h2>
          <p>تجول في أعماق الغابات الخضراء واستنشق عبق الطبيعة البكر والهواء النقي</p>
        </div>
      </div>
    </div>
  </div>
</div>



@push('stackStyle')
  <style>

      .textblock4 {

      }

      .gallery-item {
          position: relative;
          overflow: hidden;
          border-radius: 0;
          box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
          margin-bottom: 30px;
          height: 420px;
          cursor: pointer;
          transition: all 0.3s ease;
          padding: 0;
      }

      .gallery-item:hover {
          /*transform: translateY(-5px);*/
          /*box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);*/
      }

      .gallery-item img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.5s ease;
      }

      .gallery-item:hover img {
          transform: scale(1.2);
      }

      .photo-overlay {
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
          color: white;
          padding: 30px 20px 20px;
          transform: translateY(20px);
          transition: all 0.3s ease;
      }

      .gallery-item:hover .photo-overlay {
          transform: translateY(0);
          background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
      }

      .photo-overlay h2 {
          font-size: 1.5rem;
          font-weight: 700;
          margin-bottom: 10px;
          text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
          color: rgba(255, 255, 255, .9);
      }

      .photo-overlay p {
          font-size: 1rem;
          margin-bottom: 30px;
          opacity: 0.9;
          line-height: 1.5;
          color: rgba(255, 255, 255, .8);
      }

      /* تأثير إضافي للمحتوى */
      .photo-overlay::before {
          content: '';
          position: absolute;
          top: 0;
          left: 20px;
          right: 20px;
          height: 0;
          /*background: var(--def-color);*/
          opacity: 0;
          transition: opacity 0.3s ease;
      }

      .gallery-item:hover .photo-overlay::before {
          opacity: 1;
      }

      /* للشاشات الصغيرة */
      @media (max-width: 768px) {
          .gallery-item {
              height: 280px;
              margin-bottom: 20px;
          }

          .photo-overlay h2 {
              font-size: 1.3rem;
          }

          .photo-overlay p {
              font-size: 0.9rem;
          }

          .photo-overlay {
              padding: 20px 15px 15px;
          }
      }

      .main-title {
          text-align: center;
          margin-bottom: 40px;
          color: #2c3e50;
      }

      .main-title h1 {
          font-size: 2.5rem;
          font-weight: 800;
          margin-bottom: 10px;
      }

      .main-title p {
          font-size: 1.1rem;
          color: #6c757d;
      }

      /* تأثير الظهور التدريجي */
      @keyframes fadeInUp {
          from {
              opacity: 0;
              transform: translateY(30px);
          }
          to {
              opacity: 1;
              transform: translateY(0);
          }
      }

      .gallery-item {
          animation: fadeInUp 0.6s ease-out;
      }

      .gallery-item:nth-child(1) {
          animation-delay: 0.1s;
      }

      .gallery-item:nth-child(2) {
          animation-delay: 0.2s;
      }

      .gallery-item:nth-child(3) {
          animation-delay: 0.3s;
      }

      .gallery-item:nth-child(4) {
          animation-delay: 0.4s;
      }


      .textblock4 .row {
          padding: 0 !important;
      }

      .textblock4 .col-lg-6 {
          padding: 0 !important;
      }

      .textblock4 .gallery-item {
          margin-bottom: 0;
      }


  </style>
@endpush