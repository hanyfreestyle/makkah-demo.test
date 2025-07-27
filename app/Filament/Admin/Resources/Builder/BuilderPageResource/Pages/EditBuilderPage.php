<?php

namespace App\Filament\Admin\Resources\Builder\BuilderPageResource\Pages;

use App\Filament\Admin\Resources\Builder\BuilderPageResource;
use Filament\Resources\Pages\EditRecord;
use App\Traits\Admin\FormAction\WithNextAndPreviousActions;
use App\Traits\Admin\FormAction\WithSaveAndClose;
use Filament\Actions;
use App\Traits\Admin\UploadPhoto\WithGallerySaving;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Illuminate\Contracts\Support\Htmlable;

class EditBuilderPage extends EditRecord {
  use EditTranslatable;
  use WithSaveAndClose;
  use WithNextAndPreviousActions;

  // use WithGallerySaving;

  protected static string $resource = BuilderPageResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getRecordTitle(): Htmlable|string {
    return getTranslatedValue($this->record->name) ?? "";
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function afterSave(): void {

//    $newBlockIds = collect($this->data['blocks'])->sort()->values();
//
//    $this->record->loadMissing('blocks');
//
//    $originalBlockIds = $this->record->blocks->pluck('id')->sort()->values();
//
//    if ($newBlockIds->diff($originalBlockIds)->isNotEmpty() || $originalBlockIds->diff($newBlockIds)->isNotEmpty()) {
//      redirect(request()->header('Referer') ?? request()->url());
//    }

    redirect(request()->header('Referer') ?? request()->url());
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



