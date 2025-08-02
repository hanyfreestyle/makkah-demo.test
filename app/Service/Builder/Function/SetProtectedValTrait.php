<?php

namespace App\Service\Builder\Function;

trait SetProtectedValTrait {
  protected array $setLang = [];
  protected string $uploadDirectory = 'builder';
  protected bool $setDataRequired = true;
  protected int $photoFilter = 4;
  protected int $photoFilterThumbnail = 4;
  protected bool $generateThumbnail = true;
  protected int $quality = 90;
  protected int $photoWidth = 300;
  protected int $photoHeight = 300;

  protected int $photoThumbnailWidth = 300;
  protected int $photoThumbnailHeight = 300;

   protected string $photoCanvas = "#ffffff";
//  protected string|null $aspectRatio = null;


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

  public function setThumbnail(bool $value = true): static {
    $this->generateThumbnail = $value;
    return $this;
  }
  public function setPhotoFilter(int $value = 4): static {
    $this->photoFilter = $value;
    return $this;
  }

  public function setPhotoFilterThumbnail(int $value = 4): static {
    $this->photoFilterThumbnail = $value;
    return $this;
  }

  public function setPhotoSize(int $width, int $height, int $quality = 90): static {
    $this->photoWidth = $width;
    $this->photoHeight = $height;
    $this->quality = $quality;
    return $this;
  }

  public function setPhotoThumbnailSize(int $width, int $height, int $quality = 90): static {
    $this->photoThumbnailWidth = $width;
    $this->photoThumbnailHeight = $height;
    $this->quality = $quality;
    return $this;
  }

  public function setPhotoCanvas(string|null $value = null): static {
    $this->photoCanvas = $value;
    return $this;
  }

}
