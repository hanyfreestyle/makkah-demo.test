<?php

namespace App\Filament\Admin\Resources\Builder;

use App\Enums\Builder\EnumsBlockType;
use App\Filament\Admin\Resources\Builder\BuilderBlocksResource\BuilderBlockTable;
use App\FilamentCustom\Form\Inputs\SoftTranslatableInput;
use App\Models\Builder\BuilderBlockTemplate;
use App\Service\Builder\BlockFormFactory;
use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Get;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\Builder\BuilderBlock;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms;

class BuilderBlocksResource extends Resource implements HasShieldPermissions {
  use Translatable;
  use SmartResourceTrait;
  use BuilderBlockTable;

  protected static ?string $model = BuilderBlock::class;
  protected static ?string $navigationIcon = 'fas-puzzle-piece';
  protected static ?string $uploadDirectory = 'BuilderBlocksResource';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPages(): array {
    return [
      'index' => Pages\ListBuilderBlocks::route('/'),
      'create' => Pages\CreateBuilderBlocks::route('/create'),
      'edit' => Pages\EditBuilderBlocks::route('/{record}/edit'),
    ];
  }

  public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder {
    return parent::getEloquentQuery()->with('template');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function form(Form $form): Form {
    return $form->schema([

      Forms\Components\Group::make()->schema([
        Forms\Components\Section::make()->schema([
          ...SoftTranslatableInput::make()
            ->setUniqueTable("builder_block")
            ->getColumns(),
        ])->columns(2),

      ])->columnSpan(6)->columns(2),


      Forms\Components\Group::make()->schema([
        Forms\Components\View::make('builder/admin/template-photo')
          ->label(false)
          ->visible(fn ($get, $livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
      ])->columnSpan(2)->columns(1),


      Forms\Components\Section::make()->schema([
        Forms\Components\Select::make('type')
          ->label(__('builder/builder-blocks.columns.block_type'))
          ->searchable()
          ->preload()
          ->options(
            collect(EnumsBlockType::cases())
              ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
              ->sort()
              ->toArray()
          )
          ->reactive()
          ->required(),

        RadioButtonImage::make('template_id')
          ->label(__('builder/builder-blocks.columns.block_template'))
          ->options(function (callable $get) {
            if (!$get('type')) {
              return [];
            }

            return BuilderBlockTemplate::query()
              ->when($get('type'), fn ($q, $type) => $q->where('type', $type))
              ->get()
              ->mapWithKeys(fn ($template) => [
                $template->id => ['name' => $template->name['ar'], 'photo' => $template->photo ?? 'builder-template/noPhoto.webp'],
              ])
              ->toArray();
          })->required()

      ])
        ->columnSpanFull()
        ->visible(fn (Get $get, $livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),


      Forms\Components\Group::make()
        ->schema(function (Get $get) {
          $slug = \App\Models\Builder\BuilderBlockTemplate::find($get('template_id'))?->slug;
          $type = \App\Models\Builder\BuilderBlockTemplate::find($get('template_id'))?->type;
          return BlockFormFactory::make($type, $slug);
        })
        ->columns(8)
        ->columnSpanFull()
        ->visible(fn ($get, $livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
    ])->columns(8);
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRelations(): array {
    return [];
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getNavigationGroup(): ?string {
    return __('builder/builder-block-template.navigation_group');
  }

  public static function getNavigationLabel(): string {
    return __('builder/builder-blocks.navigation_label');
  }


  public static function getModelLabel(): string {
    return __('builder/builder-blocks.model_label');
  }


  public static function getPluralModelLabel(): string {
    return __('builder/builder-blocks.plural_model_label');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getPermissionPrefixes(): array {
    return static::filterPermissions(
      skipKeys: ['view'],
      keepKeys: ['sort', 'replicate'],
    );
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRecordTitle(?Model $record): Htmlable|string|null {
    return getTranslatedValue($record->name) ?? null;
  }


}
