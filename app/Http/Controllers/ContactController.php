<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateContactRequest;
use App\Models\Contact;
use App\Models\Icon;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('contacts.create')->with([
            'contacts' => Contact::all(),
            'icons' => Icon::orderBy('name')->get(),
        ]);
    }

    // Store a newly created resource in storage
    public function store(CreateOrUpdateContactRequest $request)
    {
        Contact::create([
            'icon_id' => $request->icon,
            'phone' => $request->phone,
        ]);
        return back()->withSuccess(
            trans('contacts.contact_added')
        );
    }

    // Show the form for editing the specified resource
    public function edit(Contact $contact)
    {
        return view('contacts.edit')->with([
            'contact' => $contact,
            'icons' => Icon::orderBy('name')->get(),
        ]);
    }

    // Update the specified resource in storage
    public function update(CreateOrUpdateContactRequest $request, Contact $contact)
    {
        $contact->icon_id = $request->icon;
        $contact->phone = $request->phone;

        return ($contact->save())
        ? back()->withSuccess(trans('contacts.changed'))
        : back()->withError(trans('contacts.changing_fails'));
    }

    // Remove the specified resource from storage
    public function destroy(Contact $contact)
    {
        return ($contact->delete())
        ? redirect('contacts/create')->withSuccess(trans('contacts.deleted'))
        : redirect('contacts/create')->withError(trans('contacts.deleted_fail'));
    }
}
