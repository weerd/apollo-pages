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
	 * List of controller files to scaffold.
	 *
	 * @var array
	 */
	protected $controllers = [
    	'/stubs/make/controllers/admin/pagecontroller.stub' => 'Http/Controllers/Admin/PageController.php',
    	'/stubs/make/controllers/client/pagecontroller.stub' => 'Http/Controllers/Client/PageController.php',
    ];

    /**
     * List of view files to scaffold.
     *
     * @var array
     */
    protected $views = [
        '/stubs/make/views/admin/master.stub' => 'resources/views/layouts/admin/master.blade.php',
        '/stubs/make/views/client/master.stub' => 'resources/views/layouts/client/master.blade.php',

        '/stubs/make/views/admin/index.stub' => 'resources/views/pages/admin/index.blade.php',
        '/stubs/make/views/admin/create.stub' => 'resources/views/pages/admin/create.blade.php',
        '/stubs/make/views/admin/edit.stub' => 'resources/views/pages/admin/edit.blade.php',

        '/stubs/make/views/client/show.stub' => 'resources/views/pages/client/show.blade.php',
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
        $this->addControllers();

        $this->addViews();

        $this->appendRoutes();
    }

    /**
     * Add the specified controllers.
     *
     * @return void
     */
    protected function addControllers()
    {
        $directories = [
            'Http/Controllers/Admin',
            'Http/Controllers/Client',
        ];

        // Make the controller directories.
        foreach ($directories as $directory) {
            if (! is_dir(app_path($directory))) {
                mkdir(app_path($directory), 0644, true);
            }
        }

        // Add controller scaffold files.
        foreach ($this->controllers as $stub => $controller) {
            file_put_contents(app_path($controller), $this->compileNamespaceToStub($stub));
        }

        $this->info('ApolloPages controllers added successfully.');
    }

    /**
     * Add the specified views.
     *
     * @return void
     */
    protected function addViews()
    {
        $directories = [
            'resources/views/pages/admin',
            'resources/views/pages/client',
            'resources/views/layouts/admin',
            'resources/views/layouts/client',
        ];

        // Make the view directories.
        foreach ($directories as $directory) {
            if (! is_dir(base_path($directory))) {
                mkdir(base_path($directory), 0644, true);
            }
        }

        // Add view scaffold files.
        foreach ($this->views as $stub => $view) {
            file_put_contents(base_path($view), file_get_contents(__DIR__.$stub));
        }

        $this->info('ApolloPages views added successfully.');
    }

    /**
     * Append the specified routes to the project routes.
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
	 * @return string
	 */
    protected function compileNamespaceToStub($path)
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.$path)
        );
    }
}
