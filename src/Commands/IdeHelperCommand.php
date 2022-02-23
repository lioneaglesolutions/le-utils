<?php

namespace Lioneagle\LeUtils\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class IdeHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'le:ide {--M|models} {--I|interactive} {--F|facades}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate IDE helper files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->hasNoOptions()) {
            $this->generateModelDocs();
            $this->generateFacadeDocs();

            return 0;
        }

        if ($this->option('models')) {
            $this->generateModelDocs();
        }

        if ($this->option('facades')) {
            $this->generateFacadeDocs();
        }

        return 0;
    }

    protected function models()
    {
        return $this->option('models');
    }

    protected function interactive()
    {
        return $this->option('interactive');
    }

    protected function facades()
    {
        return $this->option('facades');
    }

    protected function hasNoOptions()
    {
        return !$this->models() && !$this->interactive() && !$this->facades();
    }


    protected function generateFacadeDocs()
    {
        $this->call('ide-helper:generate');
    }

    protected function generateModelDocs()
    {
        if ($this->option('interactive')) {
            return $this->generateModelDocsInteractively();
        }

        $this->call('ide-helper:models', [
            '--write' => true
        ]);
    }

    protected function generateModelDocsInteractively()
    {
        $models = $this->getModels();
        $modelNames = $models->pluck('model_name')->all();

        $choice = $this->choice('Select Models to generate docs for', $modelNames, null, null, true);

        $selectedModels = $models->whereIn('model_name', $choice)->pluck('model')->all();

        $this->call('ide-helper:models', [
            'model' => $selectedModels,
            '--write' => true
        ]);
    }

    protected function getModels()
    {
        $modelPath = base_path('app/Models');

        $namespace = App::getNamespace();

        $files = (new Finder())->in($modelPath)->files()->depth(0);

        return collect($files)
            ->map(function ($file, $fileName) use ($namespace) {
                $class =
                    $namespace .
                    str_replace(
                        ['/', '.php'],
                        ['\\', ''],
                        Str::after(
                            $file->getRealPath(),
                            realpath(app_path()) . DIRECTORY_SEPARATOR
                        )
                    );

                return [
                    'model' => $class,
                    'file' => $fileName,
                    'model_name' => str_replace('App\\Models\\', '', $class),
                ];
            })
            ->values();
    }
}
