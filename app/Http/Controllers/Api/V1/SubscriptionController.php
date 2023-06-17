<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;

class SubscriptionController extends Controller
{
    protected $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = $this->subscription->all();

        return SubscriptionResource::collection($subscriptions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        $subscription = $this->subscription->create($request->validated());

        return new SubscriptionResource($subscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        return new SubscriptionResource($subscription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return response()->noContent();
    }
}
