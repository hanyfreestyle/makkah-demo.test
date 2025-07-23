<?php

namespace App\ConfigApp\Default\Navigation;

use Filament\Navigation\NavigationItem;


class AdminNavigation {
    public static function getNavigationItems(): array {
        return [
//            NavigationItem::make('Inventories')
//                ->label(fn() => trans('crm-inventory/inventory.navigation_label'))
//                ->icon('fas-house-chimney-crack')
//                ->url(fn() => ListInventories::getUrl())
//                ->group(fn() => trans('default/crm.nav.pipe_line'))
//                ->visible(fn() => auth()->user()?->can('view_any_crm::inventory::inventory'))
//                ->isActiveWhen(fn() => request()->url() === ListInventories::getUrl()),

        ];
    }
}
