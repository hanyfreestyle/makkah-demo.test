@foreach ($blocks as $block)
    @php
        $template  = $block->template?->template; // مثل: 'makkah'
        $type      = $block->template?->type;     // مثل: 'counter'
        $slug      = $block->template?->slug;     // مثل: 'counter-1'
        $photo     = $block->photo ?? null;
         if (!empty($photo) && Storage::disk('root_folder')->exists($photo)) {
            $blockPhoto =  Storage::disk('root_folder')->url($photo);
         }else{
            $blockPhoto = null ;
         }
        $viewPath  = "builder-block.$template.$type.$slug";
    @endphp

    @if(View::exists($viewPath))
        @include($viewPath, [
            'block' => $block,
            'schema' => $block->schema,
            'config' => $block->config,
        ])

        {{--      {{dd($block->schema)}}--}}
    @else
        <div class="bg-red-100 text-red-600 p-4 my-2">
            العرض غير متاح لهذا البلوك ({{ $viewPath }})
        </div>
    @endif

@endforeach