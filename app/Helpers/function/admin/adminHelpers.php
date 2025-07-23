<?php

use Filament\Forms\Get;
use Illuminate\Support\Facades\Storage;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('isLocalSuperAdmin')) {
    function isLocalSuperAdmin(): bool {
        $user = auth()->user();
        return config('app.env') === 'local' && $user->hasRole('super_admin');
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getImageDirForPdf')) {
    function getImageDirForPdf($row): string {
        if (config('app.env') === 'local' and $row) {
            $img = public_path('images/' . $row);
        } else {
            $img = Storage::disk('root_folder')->url($row);
        }
        return $img;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('cashDay')) {
    function cashDay($days = 2) {
        $lifeTime = $days * (86400);
        return $lifeTime;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('calcRatio')) {
    function calcRatio($width, $height): string {
        $gcd = gcd($width, $height);
        $widthRatio = $width / $gcd;
        $heightRatio = $height / $gcd;
        return $widthRatio . ':' . $heightRatio;
    }
}
if (!function_exists('gcd')) {
    function gcd(int $a, int $b) {
        return ($b === 0)
            ? $a
            : gcd($b, $a % $b);
    }
}
if (!function_exists('getNewIdByOldId')) {
    function getNewIdByOldId($map, $oldId): ?int {
        return $map[$oldId] ?? null;
    }
}

if (!function_exists('renameToSlug')) {
    function renameToSlug(string $field = 'slug'): Closure {
        return fn(Get $get) => $get($field);
    }
}





