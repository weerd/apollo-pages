<?php

namespace Weerd\ApolloPages\Console;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class ScaffoldCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apollo:scaffold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold the necessary files to enable pages';

    /**
     * The directories that need to be created.
     *
     * @var array
     */
    protected $directories = [
        'Http/Controllers/Admin' => 'controller',
        'Http/Controllers/Client' => 'controller',
        'views/pages/admin' => 'view',
        'views/pages/client' => 'view',
        'views/layouts/admin' => 'view',
        'views/layouts/client' => 'view',
    ];

	/**
	 * The controllers that need to be exported.
	 *
	 * @var array
	 */
	protected $controllers = [
    	'controllers/admin/pagecontroller.stub' => 'Http/Controllers/Admin/PageController.php',
    	'controllers/client/pagecontroller.stub' => 'Http/Controllers/Client/PageController.php',
    ];

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'views/admin/master.stub' => 'views/layouts/admin/master.blade.php',
        'views/client/master.stub' => 'views/layouts/client/master.blade.php',

        'views/admin/index.stub' => 'views/pages/admin/index.blade.php',
        'views/admin/create.stub' => 'views/pages/admin/create.blade.php',
        'views/admin/edit.stub' => 'views/pages/admin/edit.blade.php',

        'views/client/show.stub' => 'views/pages/client/show.blade.php',
    ];

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
     * @return mixed
     */
    public function handle()
    {
        $this->createDirectories();

        $this->exportControllers();

        $this->exportViews();

        $this->appendRoutes();
    }

    /**
     * Append the page routes to the project web routes.
     *
     * @return void
     */
    protected function appendRoutes()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/stubs/make/routes/web.stub'),
            FILE_APPEND
        );

        $this->info('ApolloPages routes appended successfully.');
    }

    /**
     * Compile the stub with the proper namespace.
     *
     * @param  string $path
     * @return string
     */
    protected function compileNamespaceToStub($path)
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.'/stubs/make/'.$path)
        );
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     *
     * @todo enable using $type to allow only creating specific directory types (e.g., just views).
     */
    protected function createDirectories()
    {
        foreach ($this->directories as $directory => $type) {
            $path = $this->getDirectoryPathByType($type, $directory);

            if (! is_dir($path)) {
                mkdir($path, 0755, true);
            }
        }

        $this->info('ApolloPages directories created.');
    }

    /**
     * Export the page controllers.
     *
     * @return void
     */
    protected function exportControllers()
    {
        foreach ($this->controllers as $stub => $file) {
            file_put_contents(
                $this->getDirectoryPathByType('controller', $file),
                $this->compileNamespaceToStub($stub)
            );
        }

        $this->info('ApolloPages controllers exported successfully.');
    }

    /**
     * Export the page views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $stub => $file) {
            $path = $this->getDirectoryPathByType('view', $file);

            if (file_exists($path)) {
                if (! $this->confirm("The [{$file}] view already exists. Do you want to replace it?")) {
                    continue;
                }

                $this->warn("Replacing [{$file}] with ApolloPages version.");
            }

            copy(
                __DIR__.'/stubs/make/'.$stub,
                $path
            );
        }

        $this->info('ApolloPages views exported successfully.');
    }

    /**
     * Get the directory path for a specified directory by type.
     *
     * @param  string $type
     * @param  string $directory
     * @return string
     */
    protected function getDirectoryPathByType($type, $directory)
    {
        switch($type) {
            case 'controller':
                return app_path($directory);

            case 'view':
                return resource_path($directory);

            default:
                return base_path($directory);
        }
    }
}
