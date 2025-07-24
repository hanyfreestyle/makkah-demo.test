<?php

namespace App\Filament\Admin\Resources\LatestNews\LatestNewsResource\Pages;

use App\Filament\Admin\Resources\LatestNews\LatestNewsResource;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use App\Traits\Admin\FormAction\WithSaveAndCreateAnother;
use App\Traits\Admin\UploadPhoto\WithGallerySaving;
use Filament\Resources\Pages\CreateRecord;

class CreateLatestNews extends CreateRecord {
  use CreateTranslatable;
  use WithSaveAndCreateAnother;
  use WithGallerySaving;

  protected static string $resource = LatestNewsResource::class;
  protected static bool $canCreateAnother = false;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function afterCreate() {
    $this->setRelation('photos')->afterCreateGallery();
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getRedirectUrl(): string {
    return $this->getResource()::getUrl('index');
  }

}


