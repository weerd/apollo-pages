<?php

namespace Weerd\ApolloPages\Console;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;

class ScaffoldCommand extends Command
{
    use AppNamespaceDetectorTrait;

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
     * List of directories to scaffold.
     *
     * @var array
     */
    protected $directories = [
        'app/Http/Controllers/Admin',
        'app/Http/Controllers/Client',
        'resources/views/pages/admin',
        'resources/views/pages/client',
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
        // Make the specified directories.
        foreach ($this->directories as $directory) {
            $this->makeDirectory($directory);
        }

    	// Add controller scaffold files.
    	foreach ($this->controllers as $stub => $controller) {
    		file_put_contents(
            	app_path($controller),
            	$this->compileControllerStub($stub)
        	);
    	}

        $this->info('Page controllers added successfully.');

    	// Append to routes file.
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/stubs/make/routes/web.stub'),
            FILE_APPEND
        );

        $this->info('Pages routes appended successfully.');
    }

	/**
	 * Compile the controller stub with the proper namespace.
	 *
	 * @return string
	 */
    protected function compileControllerStub($path)
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.$path)
        );
    }

    /**
     * Make the directory for the specified path.
     *
     * @param  string $path [description]
     * @return void
     */
    protected function makeDirectory($path)
    {
        if (! is_dir(base_path($path))) {
            mkdir(base_path($path), 0644, true);
        }
    }
}
