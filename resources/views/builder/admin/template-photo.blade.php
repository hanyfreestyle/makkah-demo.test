@php
  /** @var \App\Models\BuilderBlock $record */
  $record = $getRecord();
  $photo = $record->template->photo ?? 'builder-template/noPhoto.webp' ;

//  $imageUrl = $record?->getFirstMediaUrl('thumbnail');
@endphp


<div class="printPhoto">
  <img src="{{ Storage::disk('root_folder')->url($photo) }}" class="printPhoto roundedC">
</div>


<style>
    .printPhoto {
        display: block;
        width: 100% !important;
        background: yellow!important;


    }
</style>