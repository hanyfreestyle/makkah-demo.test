<?php

namespace App\Service\Builder\Function;


use Filament\Forms;
use App\Traits\Admin\Helper\SmartSetFunctionTrait;
use Filament\Forms\Components\TextInput;


class ConfigInputs {
  use SetProtectedValTrait;


//  protected string|null $setLabel = null;
//  protected string $setInputName = 'name';
//  protected array $setLang = [];
//  protected bool $setTransMode = false;
//  protected ?string $setUniqueTable = null; // ✅ جديد

//
//  public function __construct() {
//    $this->setLabel = __('builder/_default.label');
//    $this->setLang = config('app.web_add_lang');
//  }
//
//
  public static function make(): static {
    return new static();
  }
//
//  public function setLabel(?string $label = null): static {
//    $this->setLabel = $label ?? __('default/lang.columns.name');
//    return $this;
//  }
//
//  public function setInputName(?string $name): static {
//    $this->setInputName = $name ?? 'name';
//    return $this;
//  }
//
//  public function setTransMode(?bool $setTransMode): static {
//    $this->setTransMode = $setTransMode ?? false;
//    return $this;
//  }
//
//  public function setUniqueTable(?string $table): static {
//    $this->setUniqueTable = $table;
//    return $this;
//  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns() {
    $keys = self::getFinalConfigKeys();
//     dd($keys);
    $components = [];


    $components[] = Forms\Components\TextInput::make('config.pt')
      ->label(__('config.pt'))
      ->default(null);

    $components[] = Forms\Components\TextInput::make('config.pb')
      ->label(__('config.pt'))
      ->default(null);


    return $components;
  }

}

