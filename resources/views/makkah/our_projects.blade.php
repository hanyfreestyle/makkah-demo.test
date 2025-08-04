@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('our_projects') !!}

  <x-makkah.def.page-heading :meta="$meta"/>

  @foreach($ourProjects as  $project)
    <section class="project-section project-1">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-12 order-lg-{{ $loop->iteration % 2 == 0 ? '2' : '1' }} order-sm-2">
            <div class="project-image mask-hexagon slide-in-rightXXX">
              <a href="{{ route('web.project_view', $project->slug) }}">
                <x-web.def.img :row="$project" def-photo="news_thumbnail" def-photo-row="photo" class="" />
              </a>

            </div>
          </div>
          <div class="col-lg-6 col-md-12 order-lg-{{ $loop->iteration % 2 == 0 ? '1' : '2' }}  order-sm-1">
            <div class="project-content slide-in-leftCCC">
              <h2 class="project-title updateFont">{{ $project->name }}</h2>
              {!! $project->des !!}
            </div>
            <div class="btn-wrapper animated {{ textDir() }}">
              <a href="{{ route('web.project_view', $project->slug) }}" class="theme-btn-1 btn btn-effect-1 updateFont">
                {{ __('web/def.read_more') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>


{{--    <div class="ltn__about-us-area our_project_list pt-120--- pb-20 mt-30">--}}
{{--      <div class="container">--}}
{{--        <div class="row d-flex flex-wrap flex-column flex-lg-row align-items-center">--}}

{{--          <div class="col-lg-12">--}}
{{--            <h2 class="project_name updateFont">{{ $project->name }}</h2>--}}
{{--          </div>--}}

{{--          <div class="col-lg-6 order-lg-{{ $loop->iteration % 2 == 0 ? '2' : '1' }}">--}}
{{--            <div class="project_photo mt-10">--}}
{{--              <x-web.def.img :row="$project" def-photo="news_thumbnail" def-photo-row="photo" class="" />--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-6 order-lg-{{ $loop->iteration % 2 == 0 ? '1' : '2' }}">--}}
{{--            <div class="project_infoWrap">--}}
{{--              <div class="newsDesPrint mt-10">--}}
{{--                {!! $project->des !!}--}}
{{--              </div>--}}

{{--              <div class="btn-wrapper animated {{ textDir() }}">--}}
{{--                <a href="{{ route('web.project_view', $project->slug) }}" class="theme-btn-1 btn btn-effect-1 updateFont">--}}
{{--                  {{ __('web/def.read_more') }}--}}
{{--                </a>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}

    <hr>
  @endforeach

@endsection

@push('stackStyle')
{{--  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/blog.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/our_project.css',$cssMinifyType,$cssReBuild) !!}--}}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/our_project_2.css',$cssMinifyType,$cssReBuild) !!}
@endpush

@push('stackScript')

  <script>
      // قائمة الأقنعة الهندسية العشوائية
      const masks = [
          'mask-wave',
      ];

      // تأثيرات الحركة عند التمرير
      document.addEventListener('DOMContentLoaded', function () {
          // تطبيق أقنعة عشوائية على الصور
          const images = document.querySelectorAll('.project-image');
          images.forEach((image, index) => {
              // إزالة القناع الموجود
              masks.forEach(mask => image.classList.remove(mask));
              // إضافة قناع عشوائي
              const randomMask = masks[Math.floor(Math.random() * masks.length)];
              image.classList.add(randomMask);
          });

          const observerOptions = {
              threshold: 0.2,
              rootMargin: '0px 0px -50px 0px'
          };

          const observer = new IntersectionObserver(function (entries) {
              entries.forEach(entry => {
                  if (entry.isIntersecting) {
                      entry.target.classList.add('visible');
                  }
              });
          }, observerOptions);

          // مراقبة جميع العناصر المتحركة
          const animatedElements = document.querySelectorAll('.fade-in, .slide-in-right, .slide-in-left');
          animatedElements.forEach(element => {
              observer.observe(element);
          });
      });
  </script>
@endpush


