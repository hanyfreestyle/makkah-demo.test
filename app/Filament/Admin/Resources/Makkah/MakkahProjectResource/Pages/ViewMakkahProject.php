<?php
namespace App\Filament\Admin\Resources\Makkah\MakkahProjectResource\Pages;

use App\Filament\Admin\Resources\Makkah\MakkahProjectResource;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;

class ViewMakkahProject extends ViewRecord {
    use ViewTranslatable;
    protected static string $resource = MakkahProjectResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }

}


