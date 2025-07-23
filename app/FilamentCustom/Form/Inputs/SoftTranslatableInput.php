<?php

namespace App\FilamentCustom\Form\Inputs;

use App\Traits\Admin\Helper\SmartSetFunctionTrait;
use Filament\Forms\Components\TextInput;


class SoftTranslatableInput {
    use SmartSetFunctionTrait;

    protected string|null $setLabel = null;
    protected string $setInputName = 'name';
    protected array $setLang = [];
    protected bool $setTransMode = false;
    protected ?string $setUniqueTable = null; // ✅ جديد


    public function __construct() {
        $this->setLabel = __('default/lang.construct.name');
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

    public function setUniqueTable(?string $table): static {
        $this->setUniqueTable = $table;
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

            $input = TextInput::make($printName)
                ->label($this->setLabel . " " . $printLang)
                ->extraAttributes(fn() => rtlIfArabic($lang))
                ->validationMessages([
                    'unique' => fn ($state) => __('validation.used_value_before', ['value' => $state]),
                ])
                ->required($this->setDataRequired);

            // ✅ تطبيق شرط unique فقط لو تم تمرير اسم الجدول
            if (!empty($this->setUniqueTable)) {
                $input = $input->unique(
                    table: $this->setUniqueTable,
                    column: "{$this->setInputName}->{$lang}",
                    ignorable: fn($record) => $record
                );
            }

            $columns[] = $input;
        }
        return $columns;
    }
}

