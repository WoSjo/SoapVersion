<?php

namespace SoapVersion\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SoapVersion\Models\Server\Endpoint;
use SoapVersion\Models\Version\Version;

class EndpointDifferenceFound extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Version
     */
    private $version;
    /**
     * @var Endpoint
     */
    private $endpoint;
    /**
     * @var null
     */
    private $difference;

    /**
     * Create a new message instance.
     *
     * @param Endpoint $endpoint
     * @param Version $version
     * @param null $difference
     */
    public function __construct(Endpoint $endpoint, Version $version, $difference = null)
    {
        $this->version = $version;
        $this->endpoint = $endpoint;

        if (null !== $difference) {
            $this->difference = $difference;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd($this->difference);
        return $this->markdown('emails.versions.difference_found')
            ->with([
                'endpoint' => $this->endpoint,
                'version' => $this->version,
                'difference' => $this->difference
            ]);
    }
}
