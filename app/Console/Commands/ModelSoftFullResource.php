<?php

namespace App\Console\Commands;


use App\Traits\Admin\Command\CommandTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class ModelSoftFullResource extends Command {
    use CommandTrait;


    protected $signature = 'app:modelSoft
        {path : The relative model path, e.g., Admin\\BlogPost}
        {--table= : The table name to use}
        {--Resource : Also generate a Filament Resource}
        {--Lang : Also generate a Lang File }';

    protected $description = 'Generate a custom model (and translation model if needed) using stubs';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function handle() {
        $inputPath = str_replace('/', '\\', $this->argument('path'));
        $className = Str::studly(class_basename($inputPath));
        $namespacePath = Str::beforeLast($inputPath, '\\');
        $this->namespace = 'App\\Models\\' . $namespacePath;
        $this->relativePath = str_replace('\\', '/', $namespacePath);
        $this->table = $this->option('table') ?? Str::snake($className);

        $columns = $this->getTableColumnsList($this->table);
        $parentRelations = $this->generateParentRelations($className, $columns);
        $fillableLine = "protected \$fillable = [" . implode(', ', array_map(fn($col) => "'$col'", $columns)) . "];";

        // === Create Main Model ===
        $modelStubPath = base_path('stubs/softData/model.stub');
        if (!File::exists($modelStubPath)) {
            $this->error("Model stub not found at {$modelStubPath}");
            return;
        }

        $modelStub = File::get($modelStubPath);
        $modelStub = str_replace(
            [
                '{{ class }}',
                '{{ namespace }}',
                '{{ table }}',
                '{{ fillableLine }}',
                '{{ parentRelations }}',
            ],
            [
                $className,
                $this->namespace,
                $this->table,
                $fillableLine,
                $parentRelations,
            ],
            $modelStub
        );

        $modelPath = app_path("Models/{$this->relativePath}/{$className}.php");
        File::ensureDirectoryExists(dirname($modelPath));
        if (!File::exists($modelPath)) {
            File::put($modelPath, $modelStub);
            $this->info("✅ Model created: {$this->relativePath}/{$className}");
        } else {
            $this->error("❌ Model {$this->relativePath}/{$className} Is Exists");
            return false;
        }


        // ===  Create Resource if --Resource flag is set ===
        if ($this->option('Resource')) {
            $this->call('app:make-data-resource', [
                'modelPath' => $inputPath,
                'tableName' => $this->table,
            ]);
        }

        // ===  Create Resource if --Resource flag is set ===
        if ($this->option('Lang')) {
            $this->call('app:make:model-lang', [
                'model' => $this->argument('path'),
            ]);
        }

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function createModelFile($modelPath, $modelStub, $className) {
        if ($this->reWrite) {
            File::put($modelPath, $modelStub);
            return $this->info("✅ Model created: {$this->relativePath}/{$className}");
        } else {
            File::ensureDirectoryExists(dirname($modelPath));
            if (!File::exists($modelPath)) {
                File::put($modelPath, $modelStub);
                $this->info("✅ Model created: {$this->relativePath}/{$className}");
            } else {
                $this->error("❌ Model {$this->relativePath}/{$className} Is Exists");
                return false;
            }
        }
    }


}
