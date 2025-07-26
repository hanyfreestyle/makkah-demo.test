<?php

namespace App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;

use App\Filament\Admin\Resources\Builder\BuilderBlocksResource;
use Filament\Resources\Pages\EditRecord;
use App\Traits\Admin\FormAction\WithNextAndPreviousActions;
use App\Traits\Admin\FormAction\WithSaveAndClose;
use Filament\Actions;
use App\Traits\Admin\UploadPhoto\WithGallerySaving;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Illuminate\Contracts\Support\Htmlable;

class EditBuilderBlocks extends EditRecord {
  use EditTranslatable;
  use WithSaveAndClose;
  use WithNextAndPreviousActions;

  protected static string $resource = BuilderBlocksResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getRecordTitle(): Htmlable|string {
    return getTranslatedValue($this->record->name) ?? "";
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  protected function getHeaderActions(): array {
    return [
      ...$this->getNextAndPreviousActions(),
      Actions\DeleteAction::make(),
    ];
  }

}



