<?php

namespace App\Service\Builder\Function;

trait SetProtectedValTrait {
  protected array $setLang = [];
  protected string $uploadDirectory = 'builder';
  protected bool $setDataRequired = true;
  protected bool $setAddBlockPhoto = false;

  public function __construct() {
    $this->setLang = config('app.web_add_lang');
  }

  public function setDataRequired(bool $setDataRequired): static {
    $this->setDataRequired = $setDataRequired;
    return $this;
  }

  public function setAddBlockPhoto(bool $setAddBlockPhoto): static {
    $this->setAddBlockPhoto = $setAddBlockPhoto;
    return $this;
  }

}
