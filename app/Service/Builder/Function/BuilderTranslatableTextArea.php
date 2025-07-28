<?php

namespace App\Service\Builder\Function;

use App\Traits\Admin\Helper\SmartSetFunctionTrait;
use Filament\Forms\Components\Textarea;


class BuilderTranslatableTextArea {
  use SmartSetFunctionTrait;
  protected string|null $setLabel = null;
  protected string $setInputName = 'name';
  protected int $setRows = 6;
  protected array $setLang = [];
  protected ?string $setUniqueTable = null; // ✅ جديد


  public function __construct() {
    $this->setLabel = __('builder/_default.description');
    $this->setLang = config('app.web_add_lang');
  }


  public static function make(): static {
    return new static();
  }

  public function setLabel(?string $label = null): static {
    $this->setLabel = $label ?? __('default/lang.columns.name');
    return $this;
  }

  public function setInputName(?string $name): static {
    $this->setInputName = $name ?? 'name';
    return $this;
  }

  public function setRows(?int $setRows): static {
    $this->setRows = $setRows ?? 6;
    return $this;
  }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns(): array {
    $columns = [];
    foreach ($this->setLang as $lang) {
      $printName = $this->setInputName . "." . $lang;
      $printLang = "(" . ucfirst($lang) . ")";

      $input = TextArea::make($printName)
        ->label($this->setLabel . " " . $printLang)
        ->extraAttributes(fn () => rtlIfArabic($lang))
        ->rows( $this->setRows)
        ->required($this->setDataRequired);

      $columns[] = $input;
    }
    return $columns;
  }
}

