<?php

namespace SoapVersion\Jobs\Server;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use SoapVersion\Models\Server\Endpoint;

class ProcessEndpoint implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Endpoint */
    protected $endpoint;

    /**
     * Create a new job instance.
     *
     * @param Endpoint $endpoint
     */
    public function __construct(Endpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Artisan::call('create:diff:endpoint', [
            'endpoint' => $this->endpoint->getAttribute('id')
        ]);
    }
}
