<?php

namespace App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;

use App\Filament\Admin\Resources\Builder\BuilderBlocksResource;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use App\Models\Builder\BuilderBlockTemplate;
use App\Traits\Admin\FormAction\WithSaveAndCreateAnother;
use App\Traits\Admin\UploadPhoto\WithGallerySaving;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateBuilderBlocks extends CreateRecord {
  use CreateTranslatable;
  use WithSaveAndCreateAnother;

//    use WithGallerySaving;

  protected static string $resource = BuilderBlocksResource::class;
  protected static bool $canCreateAnother = false;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function afterCreate() {
//        $this->setRelation('photos')->afterCreateGallery();
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  protected function mutateFormDataBeforeCreate(array $data): array {


    // 1. تأكد أن template_id موجود
    if (empty($data['template_id'])) {
      throw ValidationException::withMessages([
        'data.template_id' => __('builder/builder-blocks.columns.block_template_error'), // أو رسالة مباشرة
      ]);
    }

    // 2. اجلب القالب من قاعدة البيانات
    $template = BuilderBlockTemplate::find($data['template_id']);

    if (!$template) {
      throw ValidationException::withMessages([
        'data.template_id' => __('builder/builder-blocks.columns.block_template_error'),
      ]);
    }

    // 3. تحقق من النوع
    if ($template->type !== $data['type']) {
      throw ValidationException::withMessages([
        'data.template_id' => __('builder/builder-blocks.columns.block_template_error'),
      ]);
    }

    // 4. رجّع البيانات بعد التحقق
    return $data;

  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getRedirectUrl(): string {
    return $this->getResource()::getUrl('index');
  }

}


