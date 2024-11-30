<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSendMessageRequest;
use App\Http\Requests\UpdateSendMessageRequest;
use App\Http\Resources\SendMessageResource;
use App\Models\SendMessage;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SendMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SendMessages/Index', [
            'sendMessages' => SendMessageResource::collection(
                QueryBuilder::for(SendMessage::class)
                    ->allowedFilters([
                        AllowedFilter::callback('search', function ($query, $value) {
                            return $query->where('sender', 'like', '%' . $value . '%')
                                ->orWhere('receiver', 'like', '%' . $value . '%')
                                ->orWhere('message', 'like', '%' . $value . '%');
                        }),
                    ])
                    ->allowedSorts(['created_at', 'delivered_at'])
                    ->defaultSort('-created_at')
                    ->paginate(request()->query('show_items', 10))
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSendMessageRequest $request)
    {
        SendMessage::create($request->validated());

        return redirect()->route('send-messages.index')->with('success', 'Message sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SendMessage $sendMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SendMessage $sendMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSendMessageRequest $request, SendMessage $sendMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SendMessage $sendMessage)
    {
        //
    }
}
