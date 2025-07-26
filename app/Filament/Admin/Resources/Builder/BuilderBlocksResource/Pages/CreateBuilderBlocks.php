<?php
namespace App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;

use App\Filament\Admin\Resources\Builder\BuilderBlocksResource;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use App\Traits\Admin\FormAction\WithSaveAndCreateAnother;
use App\Traits\Admin\UploadPhoto\WithGallerySaving;
use Filament\Resources\Pages\CreateRecord;

class CreateBuilderBlocks extends CreateRecord{
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
    public function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

}


