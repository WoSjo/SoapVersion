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

    /** @var Version */
    private $version;

    /** @var Endpoint */
    private $endpoint;

    /** @var null */
    private $difference;

    /** @var string */
    private $differenceFound;

    /** @var boolean */
    private $viewButton = false;

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

        $this->differenceFound = ucfirst(__('version.no differences found'));
        $this->difference = ucfirst(__('version.no differences found')) .
            ' ' . __('version.for endpoint') . '.';

        if (!empty($difference)) {
            $this->differenceFound = ucfirst(__('version.difference found')) .
                ' ' . __('version.for endpoint');
            $this->difference = $difference;
            $this->viewButton = true;

        }

        $this->subject($this->differenceFound);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.versions.difference_found')
            ->with([
                'endpoint' => $this->endpoint,
                'version' => $this->version,
                'headerText' => $this->differenceFound,
                'difference' => $this->difference,
                'viewButton' => $this->viewButton,
            ]);
    }
}
