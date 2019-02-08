<?php

namespace Leavingstone\MessagingApi\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateServiceCommand extends Command
{
    protected $name = 'ms-api:make';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ms-api:make {className?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all necessary files';

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
     */
    public function handle()
    {
        $files = new Filesystem();
        $content = $files->get(__DIR__ . '/../console/method.stub');

        $toCreate = $this->argument('className');
        $components = explode('/', $toCreate);
        $className = array_pop($components);
        $components = array_map('ucwords', $components);
        $subPath = implode('/', $components);
        if (!$className) {
            $className = 'TestService';
        }
        $className = ucwords($className);
        $content = str_replace('{##CLASS##}', $className, $content);
        $content = str_replace('{##NAMESPACE##}', $this->getNamespace($components), $content);
        $path = app_path() . '/MessagingApi/Services/' . $subPath;
        if (!$files->isDirectory(($path))) {
            $files->makeDirectory(($path), 0777, true, true);
        }
        $file = $path . '/' . $className . '.php';
        if ($files->isFile($file)) {
            $this->info('File already exists ' . $className);
        } else {
            $files->put($file, $content);
            $this->info('Display this on the screen ' . $className);
        }

    }

    private function getNamespace($components)
    {
        $namespace = implode("\\", $components);
        if ($namespace) {
            return "\\$namespace";
        }
    }
}
