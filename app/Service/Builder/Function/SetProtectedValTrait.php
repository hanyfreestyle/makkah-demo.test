<?php

namespace App\Service\Builder\Function;

trait SetProtectedValTrait {
  protected array $setLang = [];

  public function __construct() {
    $this->setLang = config('app.web_add_lang');
  }

}
