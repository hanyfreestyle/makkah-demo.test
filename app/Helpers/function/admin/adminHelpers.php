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
    return fn (Get $get) => $get($field);
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('updateEnvValue')) {
  function updateEnvValue($key, $value) {
    $path = base_path('.env');

    if (!file_exists($path)) {
      throw new \Exception(".env file not found at path: $path");
    }

    $env = file_get_contents($path);
    $keyExists = preg_match("/^{$key}=.*/m", $env);

    if ($keyExists) {
      // استبدال القيمة القديمة
      $env = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $env);
    } else {
      // إضافة السطر في نهاية الملف
      $env .= "\n{$key}={$value}";
    }

    file_put_contents($path, $env);
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('updateLocale')) {
  function updateLocale($newLocale) {
//    $newLocale = $request->input('locale'); // مثلًا 'ar'

    $path = config_path('app.php');

    if (!file_exists($path)) {
      return response()->json(['error' => 'Config file not found.'], 404);
    }

    $content = file_get_contents($path);

    $content = preg_replace(
      "/('locale'\s*=>\s*)'(.*?)'/",
      "'locale' => '{$newLocale}'",
      $content
    );

    file_put_contents($path, $content);

    return response()->json(['success' => true, 'locale' => $newLocale]);
  }

}





