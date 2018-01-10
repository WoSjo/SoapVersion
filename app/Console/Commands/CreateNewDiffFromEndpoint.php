<?php

namespace SoapVersion\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SoapClient;
use SoapVersion\Helpers\Diff\Checker;
use SoapVersion\Mail\EndpointDifferenceFound;
use SoapVersion\Models\Server\Endpoint;
use SoapVersion\Models\User\User;
use SoapVersion\Models\Version\Version;

class CreateNewDiffFromEndpoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:diff:endpoint 
        {endpoint : The id of the endpoint} 
        {user? : The id of the user which should recieve this mail}';

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

        if ($endpoint->server->type->getAttribute('name') !== 'soap') {
            $this->warn('Can only run a soap endpoint at the moment');
        }

        try {
            $options = array(
                'uri' => 'http://schemas.xmlsoap.org/soap/envelope/',
                'style' => SOAP_RPC,
                'use' => SOAP_ENCODED,
                'soap_version' => SOAP_1_1,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'connection_timeout' => 15,
                'trace' => true,
                'encoding' => 'UTF-8',
                'exceptions' => true,
            );

            $functionName = $endpoint->getAttribute('function');
            $functionData = $endpoint->getAttribute('data');

            list($key, $value) = explode(':', $functionData);

            $dataArray = [];
            $dataArray[$key] = $value;

            $soapClient = new SoapClient($endpoint->server->host, $options);
            $result = $soapClient->__soapCall($functionName, [
                $functionName => $dataArray
            ], null);

            $lastVersion = Version::byEndpoint($endpoint)
                ->latest('id')
                ->first();

            if (null === $lastVersion) {
                $lastVersion = $endpoint->versions()->firstOrCreate([
                    'compare' => false,
                    'endpoint_result' => ''
                ]);
            }

            $version = $endpoint->versions()->create([
                'compare' => $lastVersion !== null ? true : false,
                'endpoint_result' => var_export($result, true),
            ]);
            $version->previousVersion()->associate($lastVersion)->save();

            $diff = new Checker(
                $lastVersion->endpoint_result,
                $version->endpoint_result,
                Checker::HTML_INLINE_RENDERER,
                Checker::DEFAULT_RENDER_OPTIONS
            );

            $hasDifferences = $diff->hasDifferences();

            $user = Auth::user();

            if ($this->argument('user')) {
                $user = User::findOrFail($this->argument('user'));
            }

            Mail::to($user->email)
                ->send(
                    new EndpointDifferenceFound(
                        $endpoint,
                        $version,
                        $diff->render(),
                        $hasDifferences
                    )
                );

            $this->info('Mail has been sent to : ' . $user->email);

        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }

        $this->info('Finished creating diff.');
    }
}
