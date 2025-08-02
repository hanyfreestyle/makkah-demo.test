<?php


return [


  "project" => [
    \App\Filament\Admin\Resources\LatestNews\LatestNewsResource::class,
    \App\Filament\Admin\Resources\Makkah\MakkahProjectResource::class,

  ],

  "builder" => [
    \App\Filament\Admin\Resources\Builder\BuilderBlockTemplateResource::class,
    \App\Filament\Admin\Resources\Builder\BuilderBlocksResource::class,
    \App\Filament\Admin\Resources\Builder\BuilderPageResource::class,

  ],


  "webSettings" => [
    \App\Filament\Admin\Pages\WebSetting\SiteSettings::class,
    \App\Filament\Admin\Pages\WebSetting\ModelsSettings::class,
    \App\Filament\Admin\Resources\WebSetting\DefPhotoResource::class,
    \App\Filament\Admin\Resources\WebSetting\MetaTagResource::class,
    \App\Filament\Admin\Resources\WebSetting\UploadFilterResource::class,
    \App\Filament\Admin\Resources\WebSetting\WebPrivacyResource::class,
  ],

  "roles" => [
    \App\Filament\Admin\Resources\UserResource::class,
  ],

  "adminTools" => [
    \App\Filament\Admin\Resources\DevelopersTools\FilesListResource::class,
    \App\Filament\Admin\Resources\DevelopersTools\FilesListGroupResource::class,
    \App\Filament\Admin\Pages\DevelopersTools\BackUpFile::class,
    \App\Filament\Admin\Pages\DevelopersTools\ExportDatabase::class,
    \App\Filament\Admin\Pages\DevelopersTools\ListDatabaseTables::class,
  ],

];
