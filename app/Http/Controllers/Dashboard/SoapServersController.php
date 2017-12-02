<?php

namespace SoapVersion\Http\Controllers\Dashboard;

use Collective\Html\HtmlServiceProvider;
use Form;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapVersion\Http\Controllers\Controller;
use SoapVersion\Http\Requests\Dashboard\SoapServers\StoreRequest;
use SoapVersion\Models\Dashboard\SoapServer;

class SoapServersController extends Controller
{
    const TRANSLATION_CHOICE = 1;

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $soapServers = SoapServer::byUserId();
        $translationChoice = self::TRANSLATION_CHOICE;

        return view('dashboard.soap_servers.index', compact('soapServers', 'translationChoice'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $translationChoice = self::TRANSLATION_CHOICE;

        return view('dashboard.soap_servers.create', compact('translationChoice', 'formBuilder'));
    }

    public function store(StoreRequest $request)
    {
        $user = Auth::user();
        $soapServer = $user->soapServers()->create($request->all());

        return redirect()->route('soap-servers.index')
            ->with('success', __('utility.created', [
                'type' => trans_choice('soap_server.soap server', self::TRANSLATION_CHOICE),
                'identifier' => 'id',
                'value' => $soapServer->id,
            ]));
    }

    /**
     * @param SoapServer $soapServer
     * @return \Illuminate\View\View
     */
    public function show(SoapServer $soapServer)
    {
        return view('dashboard.soap_servers.show', compact('soapServer'));
    }

    /**
     * @param SoapServer $soapServer
     * @return \Illuminate\View\View
     */
    public function edit(SoapServer $soapServer)
    {
        return view('dashboard.soap_servers.edit', compact('soapServer'));
    }

    public function update(Request $request, SoapServer $soapServers)
    {
        //
    }

    public function destroy(SoapServer $soapServers)
    {
        //
    }
}
