<?php

namespace App\Filament\Admin\Resources\Builder;

use App\Enums\Builder\EnumsBlockTemplate;
use App\Enums\Builder\EnumsBlockType;
use App\FilamentCustom\Form\Inputs\SoftTranslatableInput;
use App\Models\Builder\BuilderBlockTemplate;
use App\Service\Builder\BlockFormFactory;
use Astrotomic\Translatable\Translatable;
use App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;
use Filament\Forms\Get;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\Helper\SmartResourceTrait;
use App\Models\Builder\BuilderBlock;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Forms;


class BuilderBlocksResource extends Resource {
  use Translatable;
  use SmartResourceTrait;

  protected static ?string $model = BuilderBlock::class;
  protected static ?string $navigationIcon = 'fas-puzzle-piece';
  protected static ?string $uploadDirectory = 'BuilderBlocksResource';

//  public static bool $showCategoryActions = true;
//  public static string $relatedResourceClass = BlogCategoryResource::class;
//  public static string $modelPolicy = BuilderPage::class;
//
//  public static function canViewAny(): bool {
//    return Gate::forUser(auth()->user())->allows('viewAnyCategory', BuilderPage::class) ;
//  }
//
//  public static function shouldRegisterNavigation(): bool {
//    return false;
//  }

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
  public static function table(Table $table): Table {
    $thisLang = app()->getLocale();

    return $table
      ->modifyQueryUsing(fn ($query) => $query->with('template'))
      ->columns([
//        ImageColumnDef::make('template.photo')->width(80)->height(40),
        Tables\Columns\TextColumn::make('id')
          ->label("#")
          ->sortable()
          ->searchable(),

        ImageColumn::make('template.photo')
          ->label('')
          ->disk('root_folder'),

        Tables\Columns\TextColumn::make('name.' . $thisLang)
          ->label(__('default/lang.columns.name'))
          ->sortable()
          ->searchable(),


        Tables\Columns\TextColumn::make('template.template')
          ->label(__('builder/builder-block-template.columns.template'))
          ->formatStateUsing(fn ($state) => EnumsBlockTemplate::tryFrom($state)?->label())
          ->sortable()
          ->searchable(),


        Tables\Columns\TextColumn::make('template.type')
          ->label(__('builder/builder-block-template.columns.type'))
          ->formatStateUsing(fn ($state) => EnumsBlockType::tryFrom($state)?->label())
          ->sortable()
          ->searchable(),


        Tables\Columns\IconColumn::make('is_active')
          ->label(__('default/lang.columns.is_active'))
          ->boolean()
          ->sortable(),

      ])->filters([
//        ...FilterWithArchive::make()->getColumns(),
      ])
      ->persistFiltersInSession()
      ->persistSearchInSession()
      ->persistSortInSession()
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([

      ])
      ->recordUrl(fn ($record) => static::getTableRecordUrl($record))
      ->defaultSort('id', 'desc');
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function form(Form $form): Form {
    return $form->schema([

      Forms\Components\Group::make()->schema([
        Forms\Components\Section::make()->schema([
          ...SoftTranslatableInput::make()->setUniqueTable("builder_block")->getColumns(),
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


      Forms\Components\Section::make()
        ->schema(function (Get $get) {
          $slug = \App\Models\Builder\BuilderBlockTemplate::find($get('template_id'))?->slug;
          $type = \App\Models\Builder\BuilderBlockTemplate::find($get('template_id'))?->type;
          return BlockFormFactory::make($type, $slug);
        })
        ->columnSpanFull()
        ->columns(4)
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
      keepKeys: ['cat', 'sort', 'publish'],
    );
  }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function getRecordTitle(?Model $record): Htmlable|string|null {
    return getTranslatedValue($record->name) ?? null;
  }


}
