<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrUpdateContactRequest;
use App\Models\Contact;
use App\Models\Icon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the form for creating a new contact
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.contacts.create', [
            'icons' => Icon::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created cantact in database
     *
     * @param \App\Http\Requests\CreateOrUpdateContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateOrUpdateContactRequest $request): RedirectResponse
    {
        cache()->forget('nav_contacts');

        Contact::create([
            'icon_id' => $request->icon,
            'phone' => $request->phone,
        ]);

        return back()->withSuccess(
            trans('contacts.contact_added')
        );
    }

    /**
     * Show the form for editing the contact record
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\View\View
     */
    public function edit(Contact $contact): View
    {
        return view('admin.contacts.edit')->with([
            'contact' => $contact,
            'icons' => Icon::orderBy('name')->get(),
        ]);
    }

    /**
     * Update contact in db
     *
     * @param \App\Http\Requests\CreateOrUpdateContactRequest $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateOrUpdateContactRequest $request, Contact $contact): RedirectResponse
    {
        cache()->forget('nav_contacts');

        $contact->icon_id = $request->icon;
        $contact->phone = $request->phone;

        return ($contact->save())
        ? back()->withSuccess(trans('contacts.changed'))
        : back()->withError(trans('contacts.changing_fails'));
    }

    /**
     * Remove the specified resource from db
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        cache()->forget('nav_contacts');

        return ($contact->delete())
        ? redirect('/admin/contacts/create')->withSuccess(trans('contacts.deleted'))
        : redirect('/admin/contacts/create')->withError(trans('contacts.deleted_fail'));
    }
}
