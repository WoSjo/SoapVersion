<?php

namespace SoapVersion\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use SoapVersion\Helpers\Diff\Checker;
use SoapVersion\Jobs\Server\ProcessEndpoint;
use SoapVersion\Models\Server\Endpoint;
use SoapVersion\Models\Version\Version;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Endpoint $endpoint
     * @return \Illuminate\View\View
     */
    public function index(Endpoint $endpoint)
    {
        $versions = Version::byEndpoint($endpoint)
            ->with(['endpoint.server', 'compareAbleVersion'])
            ->orderByDesc('created_at')
            ->get();

        return view('versions.index', compact('versions', 'endpoint'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Endpoint $endpoint
     * @return \Illuminate\View\View
     */
    public function create(Endpoint $endpoint)
    {
        $endpoints = $endpoint->get(['id', 'function'])->pluck('function', 'id');
        return view('versions.create', compact('endpoint', 'endpoints'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Endpoint $endpoint
     * @return RedirectResponse
     */
    public function store(Request $request, Endpoint $endpoint)
    {
        $endpoint = $endpoint->find($request->input('endpoint_id'));

        ProcessEndpoint::dispatch($endpoint);

        $version = Version::orderByDesc('created_at')->first();

        return redirect()->route('endpoints.versions.index', $endpoint)
            ->with('success', __('utility.created', [
                'type' => trans_choice('version.choice', 1),
                'identifier' => 'id',
                'value' => $version->getAttribute('id'),
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Endpoint $endpoint
     * @param  Version $version
     * @return \Illuminate\View\View
     */
    public function show(Endpoint $endpoint, Version $version)
    {
        $diff = New Checker(
            $version->previousVersion->endpoint_result,
            $version->endpoint_result,
            Checker::HTML_INLINE_RENDERER,
            Checker::DEFAULT_RENDER_OPTIONS
        );

        $diffRenderer = $diff->render();
        $hasDifferences = $diff->hasDifferences();

        return view('versions.show', compact('endpoint', 'version', 'diffRenderer', 'hasDifferences'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Endpoint $endpoint
     * @param  Version $version
     * @return \Illuminate\View\View
     */
    public function edit(Endpoint $endpoint, Version $version)
    {
        return view('versions.edit', compact('endpoint', 'version'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Endpoint $endpoint
     * @param Version $version
     * @return RedirectResponse
     */
    public function update(Request $request, Endpoint $endpoint, Version $version)
    {
        $version->update($request->all());

        return redirect()->route('endpoints.versions.index', $endpoint)
            ->with('success', __('utility.updated', [
                'type' => trans_choice('version.choice', 1),
                'identifier' => 'id',
                'value' => $version->getAttribute('id'),
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Version $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        //
    }
}
