<?php

namespace Weerd\ApolloPages\Console;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;

class ApolloPagesCommand extends Command
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
    protected $description = 'Scaffold the necessary files to construct pages';
	
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
    	// Add controller scaffold files.
    	foreach ($this->controllers as $stub => $controller) {
    		file_put_contents(
            	app_path($controller),
            	$this->compileControllerStub($stub)
        	);
    	}
    	
    	// Append to routes file.
    	$this->info('Page controllers added successfully.');

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
}
