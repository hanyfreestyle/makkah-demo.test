<?php

namespace App\Filament\Admin\Resources\LatestNews\LatestNewsResource;

use App\FilamentCustom\Table\CreatedDates;
use App\FilamentCustom\Table\ImageColumnDef;
use App\FilamentCustom\Table\TranslationTextColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

trait TableLatestNews {
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
  public static function table(Table $table): Table {
    return $table
      ->columns([
        TextColumn::make('id')->label('ID')->sortable()->searchable(),
        ImageColumnDef::make('photo')->width(60)->height(40),
        TranslationTextColumn::make('name'),
        IconColumn::make('is_active')->label(__('default/lang.columns.is_active'))->boolean(),
        ...CreatedDates::make()->toggleable(true)->getColumns(),
      ])->filters([
        TrashedFilter::make()->searchable(),
      ])
      ->persistFiltersInSession()
      ->persistSearchInSession()
      ->persistSortInSession()
      ->actions([
        EditAction::make()->hidden(fn ($record) => $record->trashed())->iconButton(),
        DeleteAction::make()->iconButton(),
        ForceDeleteAction::make(),
        RestoreAction::make(),
      ])
      ->bulkActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ])
      ->recordUrl(fn ($record) => static::getTableRecordUrl($record))
      ->defaultSort('id', 'desc');
  }
}

