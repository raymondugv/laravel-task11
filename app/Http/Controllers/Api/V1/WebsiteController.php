<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteRequest;
use App\Http\Resources\WebsiteResource;

class WebsiteController extends Controller
{
    protected $website;

    public function __construct(Website $website)
    {
        $this->website = $website;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $websites = $this->website->all();

        return WebsiteResource::collection($websites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WebsiteRequest $request)
    {
        $website = $this->website->create($request->validated());

        return new WebsiteResource($website);
    }

    /**
     * Display the specified resource.
     */
    public function show(Website $id)
    {
        return new WebsiteResource($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Website $id, WebsiteRequest $request)
    {
        $id->update($request->validated());

        return new WebsiteResource($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Website $id)
    {
        $id->delete();

        return response()->noContent();
    }
}
