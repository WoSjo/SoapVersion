<?php

namespace SoapVersion\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use SoapVersion\Http\Controllers\Controller;
use SoapVersion\Models\Dashboard\SoapServer;

class SoapServersController extends Controller
{
    public function index()
    {
        $soapServers = SoapServer::byUserId();

        return view('dashboard.soap_servers.index', compact('soapServers'));
    }

    public function create()
    {
        return view('dashboard.soap_servers.create');
    }

    public function store(Request $request)
    {
        // Create new soap server
    }

    public function show(SoapServer $soapServer)
    {
        return view('dashboard.soap_servers.show', compact('soapServer'));
    }

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
