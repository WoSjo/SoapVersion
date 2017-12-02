<?php

namespace SoapVersion\Observers\Soap;

use SoapVersion\Models\Dashboard\Soap\Server;

class ServerObserver
{
    /**
     * @param Server $server
     * @return void
     */
    public function saving(Server $server): void
    {
        if (null === $server->getAttribute('slug')) {
            $server->setAttribute('slug', str_slug($server->getAttribute('name')));
        }

        if (null === $server->getAttribute('port')) {
            $server->setAttribute('port', 80);
        }
    }
}