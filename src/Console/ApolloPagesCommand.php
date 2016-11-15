<?php

namespace Weerd\ApolloPages\Console;

use Illuminate\Console\Command;

class ApolloPagesCommand extends Command
{
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
        file_put_contents(
            app_path('Http/Controllers/Admin/PageController.php'),
            $this->compileControllerStub()
        );

        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/stubs/make/routes/web.stub'),
            FILE_APPEND
        );

        $this->info('Pages routes appended successfully.');
    }

    protected function compileControllerStub($path)
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.$path)
        );
    }
}
