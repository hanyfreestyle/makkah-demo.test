<?php

namespace App\FilamentCustom\Form\Inputs;

use App\Traits\Admin\Helper\SmartSetFunctionTrait;
use Filament\Forms\Components\Textarea;


class SoftTranslatableTextArea {
    use SmartSetFunctionTrait;

    protected string|null $setLabel = null;
    protected string $setInputName = 'des';
    protected array $setLang = [];
    protected bool $setTransMode = false;


    public function __construct() {
        $this->setLabel = __('default/lang.construct.description');
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

    public function setTransMode(?bool $setTransMode): static {
        $this->setTransMode = $setTransMode ?? false;
        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getColumns(): array {
        $columns = [];
        foreach ($this->setLang as $lang) {
            if ($this->setTransMode) {
                $printName = $lang . "." . $this->setInputName;
            } else {
                $printName = $this->setInputName . "." . $lang;
            }

            $printLang = "(" . ucfirst($lang) . ")";
            $columns[] = Textarea::make($printName)
                ->label($this->setLabel . " " . $printLang)
                ->extraAttributes(fn() => rtlIfArabic($lang))
                ->rows($this->setTextAreaRow)
                ->required($this->setDataRequired);
        }
        return $columns;
    }
}

