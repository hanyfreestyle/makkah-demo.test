{{--<div class="grid grid-cols-2 gap-4">--}}
{{--  @foreach ($templates as $template)--}}
{{--    <label class="border p-2 rounded cursor-pointer flex gap-2 items-center @if($template_id == $template->id) border-blue-500 bg-blue-100 @endif">--}}
{{--      <input type="radio"--}}
{{--             name="template_id"--}}
{{--             value="{{ $template->id }}"--}}
{{--             wire:model.defer="template_id"--}}
{{--             class="text" />--}}
{{--      <img src="{{ Storage::disk('root_folder')->url($template->photo) }}" class="w-20 h-20 object-cover rounded" />--}}
{{--      if (!empty($file) && Storage::disk('root_folder')->exists($file)) {--}}
{{--      return Storage::disk('root_folder')->url($file);--}}
{{--      }--}}
{{--      --}}
{{--      <span class="font-bold">{{ $template->name['ar']}}</span>--}}
{{--    </label>--}}
{{--  @endforeach--}}
{{--</div>--}}

{{--@if ($templates->isEmpty())--}}
{{--  <p class="text-sm text-gray-500">اختر نوع البلوك أولاً لعرض القوالب المتاحة.</p>--}}
{{--@endif--}}

@props(['record'])

<div class="flex items-center gap-3">
  <img
      src="{{ Storage::disk('root_folder')->url($record->photo) }}"
      class="w-10 h-10 object-cover rounded"
      alt="{{ $record->name['ar'] }}"
  >
  <span>{{ $record->name['ar'] }}</span>
</div>