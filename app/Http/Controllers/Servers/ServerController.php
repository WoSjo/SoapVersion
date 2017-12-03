<?php

namespace SoapVersion\Http\Controllers\Servers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use SoapVersion\Http\Controllers\Controller;
use SoapVersion\Http\Requests\Dashboard\Soap\Server\StoreRequest;
use SoapVersion\Models\Server\Server;
use SoapVersion\Models\User\Group;

class ServerController extends Controller
{
    const TRANSLATION_CHOICE = 1;

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $servers = Server::activeUser()->get();
        $translationChoice = self::TRANSLATION_CHOICE;

        return view('servers.index', compact('servers', 'translationChoice'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $translationChoice = self::TRANSLATION_CHOICE;

        return view('servers.create', compact('translationChoice', 'formBuilder'));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $group = Group::where('id', $request->group_id)->firstOrFail();
        $server = $group->servers()->create($request->all());

        return redirect()->route('servers.index')
            ->with('success', __('utility.created', [
                'type' => trans_choice('soap_server.soap server', self::TRANSLATION_CHOICE),
                'identifier' => 'id',
                'value' => $server->id,
            ]));
    }

    /**
     * @param Server $soapServer
     * @return \Illuminate\View\View
     */
    public function show(Server $soapServer)
    {
        return view('servers.show', compact('soapServer'));
    }

    /**
     * @param Server $server
     * @return \Illuminate\View\View
     */
    public function edit(Server $server)
    {
        return view('servers.edit', compact('server'));
    }

    /**
     * @param Request $request
     * @param Server $server
     * @return RedirectResponse
     */
    public function update(Request $request, Server $server): RedirectResponse
    {
        $server->update($request->all());

        return redirect()->route('servers.index')
            ->with('success', __('utility.updated', [
                'type' => trans_choice('soap_server.soap server', self::TRANSLATION_CHOICE),
                'identifier' => 'id',
                'value' => $server->id,
            ]));
    }

    /**
     * @param Server $soapServers
     */
    public function destroy(Server $soapServers)
    {
        //
    }
}
