<?php

namespace App\Service\Builder\Function;


use Filament\Forms;
use App\Traits\Admin\Helper\SmartSetFunctionTrait;
use Filament\Forms\Components\TextInput;


class ConfigInputDefault {
  use SetProtectedValTrait;

  public static function make(): static {
    return new static();
  }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public function getColumns() {
    return [
      Forms\Components\Group::make()->schema([
        Forms\Components\Section::make()->schema([
          ...ConfigInputs::make()
            ->setConfigArr($this->setConfigArr)
            ->setAddToConfig($this->addToConfig)
            ->setRemoveFromConfig($this->removeFromConfig)
            ->getColumns(),
        ])->columns(6),
      ])->columnSpan(8)
    ];
  }

}

