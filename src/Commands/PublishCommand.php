<?php

namespace Leavingstone\MessagingApi\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Leavingstone\MessagingApi\Providers\TestProvider;

class PublishCommand extends Command
{
    protected $name = 'ms-api:publish';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ms-api:publish';

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
        $this->createController();
        $this->createServiceDir();
        $this->createException();
    }

    protected function createController()
    {
        $files = new Filesystem();
        $content = $files->get(__DIR__ . '/../console/controller.stub');

        $className = 'MessagingApiController';
        $path = app_path() . '/Http/Controllers/Messaging';
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
    protected function createException()
    {
        $files = new Filesystem();
        $content = $files->get(__DIR__ . '/../console/apiException.stub');

        $className = 'ApiException';
        $path = app_path() . '/Exceptions';
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
    protected function createServiceDir()
    {
        $files = new Filesystem();
        $content = $files->get(__DIR__ . '/../console/methodEnum.stub');

        $className = 'MethodsEnum';
        $path = app_path() . '/MessagingApi';
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
}
