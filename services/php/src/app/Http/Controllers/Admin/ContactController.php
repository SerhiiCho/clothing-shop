<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
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
     * Show list of all contacts
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.contacts.index');
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
     * @param \App\Http\Requests\ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        cache()->forget('nav_contacts');

        Contact::create([
            'icon_id' => $request->icon,
            'phone' => $request->phone,
        ]);

        return redirect('admin/contacts')->withSuccess(
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
     * @param \App\Http\Requests\ContactRequest $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        cache()->forget('nav_contacts');

        $contact->icon_id = $request->icon;
        $contact->phone = $request->phone;

        return ($contact->save())
        ? redirect('admin/contacts')->withSuccess(trans('contacts.changed'))
        : redirect('admin/contacts')->withError(trans('contacts.changing_fails'));
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
        ? redirect('/admin/contacts')->withSuccess(trans('contacts.deleted'))
        : redirect('/admin/contacts')->withError(trans('contacts.deleted_fail'));
    }
}
