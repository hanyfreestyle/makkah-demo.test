<?php
namespace App\Filament\Admin\Resources\Builder\BuilderBlocksResource\Pages;

use App\Filament\Admin\Resources\Builder\BuilderBlocksResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListBuilderBlocks extends ListRecords {
    protected static string $resource = BuilderBlocksResource::class;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make()
                ->label(__('builder/builder-blocks.add_but_label')),
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function getTabs(): array {
//        $tabs = [
//            'Active' => [
//                'label' => __('default/lang.tab_list.active'),
//                'icon' => 'heroicon-o-paper-clip',
//                'conditions' => fn(Builder $query) => $query->where('is_active', 1),
//                'badgeColor' => 'success',
//            ],
//            'Pending' => [
//                'label' => __('default/lang.tab_list.pending'),
//                'icon' => 'heroicon-o-lock-closed',
//                'conditions' => fn(Builder $query) => $query->where('is_active', 0),
//                'badgeColor' => 'warning',
//            ],
//            'All' => [
//                'label' => __('default/lang.tab_list.all'),
//                'badge' => static::getModel()::query()->count(),
//                'conditions' => fn(Builder $query) => $query->where('id', '>', 0),
//            ],
//        ];
//
//        return array_map(fn($key, $tab) => Tab::make()
//            ->label($tab['label'])
//            ->icon($tab['icon'] ?? null)
//            ->modifyQueryUsing($tab['conditions'] ?? fn($q) => $q)
//            ->badge($tab['badge'] ?? static::getModel()::query()->where(fn($q) => ($tab['conditions'] ?? fn($q) => $q)($q))->count())
//            ->badgeColor($tab['badgeColor'] ?? null), array_keys($tabs), $tabs);
//    }


}


