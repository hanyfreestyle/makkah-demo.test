<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ResourceSoftData extends Command {
    protected $signature = 'app:make-data-resource {modelPath} {tableName}';


    protected $description = 'Generate a custom Filament Resource for the given model path';

    public function handle() {
        $modelPath = str_replace('/', '\\', $this->argument('modelPath'));
        $tableName = $this->argument('tableName');
        $modelName = Str::studly(class_basename($modelPath)); // BlogPost
        $modelNamespacePath = Str::beforeLast($modelPath, '\\'); // Admin\ModelName
        $modelFullClass = 'App\\Models\\' . $modelPath;
        $resourceName = $modelName . 'Resource';


        ///getLang File Var
        $modelPathForLang = collect(explode('\\', $modelPath))
            ->map(fn($segment) => Str::kebab($segment))
            ->implode('/');

        // ✅ هنا التعديل الرئيسي
        $resourceNamespace = 'App\\Filament\\Admin\\Resources\\' . $modelNamespacePath;
        $resourceRelativePath = str_replace('\\', '/', $modelNamespacePath);
        $resourcePath = base_path("app/Filament/Admin/Resources/{$resourceRelativePath}/{$resourceName}.php");

        $modelNameSnake = Str::snake($modelName);
        $modelNamePlural = Str::pluralStudly($modelName);

        $stubPath = base_path('stubs/softData/resource.stub');
        if (!File::exists($stubPath)) {
            $this->error("❌ Stub not found at {$stubPath}");
            return;
        }

        $stub = File::get($stubPath);

        $stub = str_replace(
            [
                '{{ class }}',
                '{{ namespace }}',
                '{{ modelNamespace }}',
                '{{ resourcePath }}',
                '{{ modelName }}',
                '{{ modelNamePlural }}',
                '{{ modelNameSnake }}',
                '{{ modelPathForLang }}',
                '{{ tableName }}',

            ],
            [
                $resourceName,
                $resourceNamespace,
                $modelPath,
                $modelNamespacePath,
                $modelName,
                $modelNamePlural,
                $modelNameSnake,
                $modelPathForLang,
                $tableName,

            ],
            $stub
        );

        File::ensureDirectoryExists(dirname($resourcePath));
        File::put($resourcePath, $stub);

        $this->info("✅ Resource created : {$resourceName}");

        $this->createPages(
            $modelNamePlural,
            $modelName,
            $resourceNamespace,
            $resourceName,
            $resourceRelativePath,
            $modelPathForLang,
        );

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function createPages($modelNamePlural, $modelName, $resourceNamespace, $resourceName, $resourceRelativePath, $modelPathForLang) {
        // ========== Create Pages ==========
        $pages = [
            'List' => 'resource-page-list.stub',
            'Create' => 'resource-page-create.stub',
            'Edit' => 'resource-page-edit.stub',
        ];

        foreach ($pages as $type => $stubFile) {
            $pageClass = "{$type}{$modelNamePlural}";
            if (in_array($type, ['Create', 'Edit', 'View'])) {
                $pageClass = "{$type}{$modelName}";
            }

            $stubPath = base_path("stubs/softData/{$stubFile}");
            if (!File::exists($stubPath)) {
                $this->warn("Stub for {$type} not found.");
                continue;
            }

            $pageStub = File::get($stubPath);
            $pageStub = str_replace(
                ['{{ namespace }}', '{{ modelName }}', '{{ modelNamePlural }}', '{{ resourceClass }}', '{{ modelPathForLang }}'],
                [$resourceNamespace, $modelName, $modelNamePlural, $resourceName, $modelPathForLang],
                $pageStub
            );

            $pagePath = base_path("app/Filament/Admin/Resources/{$resourceRelativePath}/{$resourceName}/Pages/{$pageClass}.php");
            File::ensureDirectoryExists(dirname($pagePath));
            File::put($pagePath, $pageStub);

            $this->info("✅ Page created: {$pageClass}");
        }
    }




}
