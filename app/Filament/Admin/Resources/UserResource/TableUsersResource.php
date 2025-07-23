<?php

namespace App\Filament\Admin\Resources\UserResource;


use App\FilamentCustom\Table\CreatedDates;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use FreestyleRepo\FilamentPhoneInput\PhoneInputNumberType;
use FreestyleRepo\FilamentPhoneInput\Tables\PhoneColumn;
use Illuminate\Support\Str;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Illuminate\Database\Eloquent\Builder;

trait TableUsersResource {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public static function table(Table $table): Table {
        return $table->columns([

            Tables\Columns\TextColumn::make('id')
                ->label("#")
                ->weight(FontWeight::Bold)
                ->sortable()
                ->searchable(),

            Tables\Columns\ImageColumn::make('avatar_url')
                ->disk('root_folder')
                ->label('')
                ->searchable()
                ->circular()
                ->grow(false)
                ->getStateUsing(fn($record) => $record->avatar_url
                    ? $record->avatar_url
                    : "https://ui-avatars.com/api/?name=" . urlencode($record->name)),

            Tables\Columns\TextColumn::make('name')
                ->label(__('default/users.columns.name'))
                ->weight(FontWeight::Bold)
                ->searchable(),


            PhoneColumn::make('phone')
                ->label(__('default/users.columns.phone'))
                ->weight(FontWeight::Bold)
                ->displayFormat(PhoneInputNumberType::NATIONAL)
                ->countryColumn('phone_country')
                ->showFlag(true)
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->label(__('default/users.columns.email'))
                ->icon('heroicon-m-envelope')
                ->weight(FontWeight::Bold)
                ->searchable(),

            Tables\Columns\TextColumn::make('roles.name')
                ->label(__('default/users.columns.roles'))
                ->formatStateUsing(fn($state): string => Str::headline($state))
                ->icon('heroicon-o-shield-check'),

            Tables\Columns\IconColumn::make('is_active')
                ->label(__('default/users.columns.is_active'))
                ->boolean(),

            Tables\Columns\TextColumn::make('email_verified_at')
                ->label(__('default/lang.columns.email_verified_at'))
                ->date()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            ...CreatedDates::make()->toggleable(true)->getColumns(),

        ])->filters([
            Tables\Filters\TrashedFilter::make(),
            DateRangeFilter::make('created_at')->label(__('default/lang.columns.created_at')),
            Tables\Filters\TernaryFilter::make('team_leader')
                ->label(__('default/users.ternary_team.label'))
                ->nullable()
                ->searchable()
                ->placeholder(__('default/users.ternary_team.label_all'))
                ->trueLabel(__('default/users.ternary_team.label_true'))
                ->falseLabel(__('default/users.ternary_team.label_false'))
                ->queries(
                    true: fn(Builder $query) => $query->where('team_leader', true),
                    false: fn(Builder $query) => $query->where('team_leader', false),
                    blank: fn(Builder $query) => $query, // In this example, we do not want to filter the query when it is blank.
                ),

            Tables\Filters\SelectFilter::make('roles')
                ->label(__('default/users.columns.roles'))
                ->relationship('roles', 'name')
                ->multiple()
                ->preload(),
        ])
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->persistSortInSession()
            ->actions([
                Tables\Actions\EditAction::make()->iconButton()
                    ->hidden(fn($record) => auth()->user()->id != 1 && $record->id === 1 or $record->trashed()),
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->visible(fn($record) => $record->id !== 1),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),

            ])
            ->headerActions([

            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
}

