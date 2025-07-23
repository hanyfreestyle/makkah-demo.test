<?php

namespace App\Exports\Default;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class TextValueBinder {
    public function bindValue(Cell $cell, $value) {
        // نحول كل شيء لنص صريح
        $cell->setValueExplicit((string)$value, DataType::TYPE_STRING);
        return true;
    }

}
