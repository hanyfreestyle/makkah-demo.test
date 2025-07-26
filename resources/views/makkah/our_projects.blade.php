@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('our_projects') !!}

  <x-makkah.def.page-heading :meta="$meta"/>

  @foreach($ourProjects as  $project)
    <div class="ltn__about-us-area our_project_list pt-120--- pb-20 mt-30">
      <div class="container">
        <div class="row d-flex flex-wrap flex-column flex-lg-row align-items-center">

          <div class="col-lg-12">
            <h2 class="project_name updateFont">{{ $project->name }}</h2>
          </div>

          <div class="col-lg-6 order-lg-{{ $loop->iteration % 2 == 0 ? '2' : '1' }}">
            <div class="project_photo mt-10">
              <x-web.def.img :row="$project" def-photo="news_thumbnail" def-photo-row="photo" class="" />
            </div>
          </div>

          <div class="col-lg-6 order-lg-{{ $loop->iteration % 2 == 0 ? '1' : '2' }}">
            <div class="project_infoWrap">
              <div class="newsDesPrint mt-10">
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
      </div>
    </div>

    <hr>
  @endforeach

@endsection

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/blog.css',$cssMinifyType,$cssReBuild) !!}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/our_project.css',$cssMinifyType,$cssReBuild) !!}
@endpush

