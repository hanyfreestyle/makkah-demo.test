<?php

namespace App\FilamentCustom\Form\Select;

use App\Models\Builder\BuilderPage;
use Filament\Forms\Components\Select;

class SelectBuilderPage extends Select {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

  protected function setUp(): void {
    parent::setUp();
    $this
      ->label(__('default/lang.columns.builder_page_id'))
      ->searchable()
      ->preload()
      ->options(fn () => BuilderPage::query()->get()->pluck("name." . thisCurrentLocale(), 'id'))
      ->nullable();

  }


}
