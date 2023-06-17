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
    public function show(Website $website)
    {
        return new WebsiteResource($website);
    }

    public function update(WebsiteRequest $request, Website $website)
    {
        $website->update($request->validated());

        return new WebsiteResource($website);
    }

    public function destroy(Website $website)
    {
        $website->delete();

        return response()->json(['message' => 'Website deleted successfully.']);
    }
}
