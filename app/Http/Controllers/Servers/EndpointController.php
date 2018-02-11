<?php

namespace SoapVersion\Http\Controllers\Servers;

use Illuminate\Http\Request;
use SoapVersion\Http\Controllers\Controller;
use SoapVersion\Http\Requests\Server\Endpoint\BaseRequest;
use SoapVersion\Models\Server\Endpoint;
use SoapVersion\Models\Server\Server;

class EndpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Server $server
     * @return \Illuminate\View\View
     */
    public function index(Server $server)
    {
        $endpoints = Endpoint::byServer($server)->get();

        return view('servers.endpoints.index', compact('endpoints', 'server'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Server $server
     * @return \Illuminate\View\View
     */
    public function create(Server $server)
    {
        return view('servers.endpoints.create', compact('server'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BaseRequest $request
     * @param Server $server
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BaseRequest $request, Server $server)
    {
        $endpoint = $server->endpoints()->create($request->all());

        return redirect()->route('servers.endpoints.index', $server)
            ->with('success', __('utility.created', [
                'type' => trans_choice('endpoint.choice', 1),
                'identifier' => 'id',
                'value' => $endpoint->getAttribute('id'),
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Server $server
     * @param Endpoint $endpoint
     * @return \Illuminate\View\View
     */
    public function show(Server $server, Endpoint $endpoint)
    {
        return view('servers.endpoints.show', compact('server', 'endpoint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Server $server
     * @param Endpoint $endpoint
     * @return \Illuminate\View\View
     */
    public function edit(Server $server, Endpoint $endpoint)
    {
        return view('servers.endpoints.edit', compact('server', 'endpoint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Server $server
     * @param Endpoint $endpoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server, Endpoint $endpoint)
    {
        $endpoint->update($request->all());

        return redirect()->route('servers.endpoints.index', $server)
            ->with('success', __('utility.updated', [
                'type' => trans_choice('endpoint.choice', 1),
                'identifier' => 'id',
                'value' => $endpoint->getAttribute('id'),
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Endpoint $endpoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Endpoint $endpoint)
    {
        //
    }
}
