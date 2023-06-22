<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    public function index(): Response
    {
        return response(Subscriber::paginate(100));
    }

    public function store(SubscriberRequest $request): Response
    {
        $validated = $request->validated();
        $subscriber = Subscriber::create($validated);

        return response(Subscriber::find($subscriber->id));
    }

    public function show(Subscriber $subscriber): Response
    {
        return response($subscriber);
    }

    public function update(SubscriberRequest $request, Subscriber $subscriber): Response
    {
        $validated = $request->validated();
        $subscriber->update($validated);

        return response($subscriber);
    }

    public function destroy(Subscriber $subscriber): Response
    {
        $subscriber->delete();

        return response()->noContent();
    }
}
