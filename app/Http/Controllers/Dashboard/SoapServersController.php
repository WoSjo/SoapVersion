<?php

namespace SoapVersion\Http\Controllers\Dashboard;

use Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapVersion\Http\Controllers\Controller;
use SoapVersion\Http\Requests\Dashboard\Soap\Server\StoreRequest;
use SoapVersion\Models\Dashboard\Soap\Server;

class SoapServersController extends Controller
{
    const TRANSLATION_CHOICE = 1;

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $servers = Server::byUserId();
        $translationChoice = self::TRANSLATION_CHOICE;

        return view('dashboard.servers.index', compact('servers', 'translationChoice'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $translationChoice = self::TRANSLATION_CHOICE;

        return view('dashboard.soap.servers.create', compact('translationChoice', 'formBuilder'));
    }

    public function store(StoreRequest $request)
    {
        $server = Auth::user()->soapServers()->create($request->all());

        return redirect()->route('soap.servers.index')
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
        return view('dashboard.soap.servers.show', compact('soapServer'));
    }

    /**
     * @param Server $server
     * @return \Illuminate\View\View
     */
    public function edit(Server $server)
    {
        return view('dashboard.soap.servers.edit', compact('server'));
    }

    /**
     * @param Request $request
     * @param Server $server
     * @return RedirectResponse
     */
    public function update(Request $request, Server $server): RedirectResponse
    {
        $server->update($request->all());

        return redirect()->route('soap.servers.index')
            ->with('success', __('utility.updated', [
                'type' => trans_choice('soap_server.soap server', self::TRANSLATION_CHOICE),
                'identifier' => 'id',
                'value' => $server->id,
            ]));
    }

    public function destroy(Server $soapServers)
    {
        //
    }
}
