<?php

namespace App\Service\Builder\Function;

trait SetProtectedValTrait {
  protected array $setLang = [];
  protected string $uploadDirectory = 'builder';
  protected bool $setDataRequired = true;
  protected bool $setConfig = false;
  protected array|null $setConfigArr = null;
//  protected array|null $configDefault = ['pt', 'pb', 'mt', 'mb', 'col','col-m', 'bg_color', 'font_color', 'icon_color'];
  protected array|null $configDefault = ['pt', 'pb', 'mt', 'mb'];

  protected array $addToConfig = [];
  protected array $removeFromConfig = [];

  protected bool $setAddBlockPhoto = false;
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

  public function setConfig(bool $value = true): static {
    $this->setConfig = $value;
    return $this;
  }

  public function setConfigArr(array|null $arr): static {
    if (isset($arr)) {
      $this->setConfigArr = $arr;
    } else {
      $this->setConfigArr = $this->configDefault;
    }
    return $this;
  }

  public function setAddToConfig(array $arr): static {
    $this->addToConfig = array_merge($this->addToConfig, $arr);
    return $this;
  }

  public function setRemoveFromConfig(array $arr): static {
    $this->removeFromConfig = array_merge($this->removeFromConfig, $arr);
    return $this;
  }

  public function getFinalConfigKeys(): array {
    // ✅ نبدأ بالقيم الافتراضية
    $final = $this->setConfigArr;
    // نضيف القيم الجديدة
    $final = array_merge($final, $this->addToConfig);
//    dd($this->removeFromConfig);
    // نحذف القيم المطلوبة
    $final = array_diff($final, $this->removeFromConfig);
//    dd($final);
    // نعيد النتيجة بدون تكرار وبترتيب ثابت
    return array_values(array_unique($final));
  }
}
