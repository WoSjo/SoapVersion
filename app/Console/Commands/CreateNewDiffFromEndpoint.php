<?php

namespace SoapVersion\Console\Commands;

use Illuminate\Console\Command;
use SoapVersion\Models\Server\Endpoint;

class CreateNewDiffFromEndpoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:diff:endpoint {endpoint : The id of the endpoint}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the endpoint and create a diff.';

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
        $endpointId = $this->argument('endpoint');
        $endpoint = Endpoint::with('server.type')->find($endpointId);

        $this->info(sprintf('Running for diff for endpoint with id `%s`', $endpointId));

        dump($endpoint->server->type->getAttribute('name'));

        $this->info('Finished creating diff.');
    }
}
