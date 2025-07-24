<?php
namespace App\Filament\Admin\Resources\LatestNews\LatestNewsResource\Pages;

use App\Filament\Admin\Resources\LatestNews\LatestNewsResource;
use App\Helpers\FilamentAstrotomic\Resources\Pages\Record\ViewTranslatable;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;

class ViewLatestNews extends ViewRecord {
    use ViewTranslatable;
    protected static string $resource = LatestNewsResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getHeaderActions(): array{
        return [
            Actions\EditAction::make(),
        ];
    }

}


