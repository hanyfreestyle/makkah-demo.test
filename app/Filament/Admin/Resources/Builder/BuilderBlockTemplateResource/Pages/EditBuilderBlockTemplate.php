<?php
namespace App\Filament\Admin\Resources\Builder\BuilderBlockTemplateResource\Pages;

use App\Filament\Admin\Resources\Builder\BuilderBlockTemplateResource;
use Filament\Resources\Pages\EditRecord;
use App\Traits\Admin\FormAction\WithNextAndPreviousActions;
use App\Traits\Admin\FormAction\WithSaveAndClose;
use Filament\Actions;
use App\Traits\Admin\UploadPhoto\WithGallerySaving;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditBuilderBlockTemplate extends EditRecord {
    use EditTranslatable;
    use WithSaveAndClose;
    use WithNextAndPreviousActions;
    // use WithGallerySaving;

    protected static string $resource = BuilderBlockTemplateResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getRecordTitle(): string {
        return $this->record->translate(app()->getLocale())->name ?? "";
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function afterSave(): void {
//        $this->setRelation('photos')->afterSaveGallery();
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getHeaderActions(): array {
        return [
            ...$this->getNextAndPreviousActions(),
            Actions\DeleteAction::make(),
        ];
    }

}



