<?php

namespace Innerent\Contacts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Innerent\Contact\Http\Requests\ContactRequest;
use Innerent\Contact\Services\ContactService;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index($contactableType, $contactableId)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        return response()->json($contactable->contacts()->with('emails', 'phones', 'addresses')->get()->toArray(), 200);
    }

    public function store(ContactRequest $request, $contactableType, $contactableId)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $contact = $this->contactService->make($contactable, $request->all());

        return response()->json($contact->toArray(), 201);
    }

    public function show($contactableType, $contactableId, $id)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $contact = $this->contactService->get($contactable, $id);

        return response()->json($contact->toArray(), 200);
    }

    public function update(Request $request, $contactableType, $contactableId, $id)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $contact = $this->contactService->update($contactable, $id, $request->all());

        return response()->json($contact->toArray(), 200);
    }

    public function destroy($contactableType, $contactableId, $id)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $this->contactService->delete($contactable, $id);

        return response()->json('', 204);
    }
}
