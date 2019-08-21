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
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(): View
    {
        return view('admin.contacts.index');
    }

    public function create(): View
    {
        return view('admin.contacts.create', [
            'icons' => Icon::orderBy('name')->get(),
        ]);
    }

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

    public function edit(Contact $contact): View
    {
        return view('admin.contacts.edit')->with([
            'contact' => $contact,
            'icons' => Icon::orderBy('name')->get(),
        ]);
    }

    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        cache()->forget('nav_contacts');

        $contact->icon_id = $request->icon;
        $contact->phone = $request->phone;

        return ($contact->save())
        ? redirect('admin/contacts')->withSuccess(trans('contacts.changed'))
        : redirect('admin/contacts')->withError(trans('contacts.changing_fails'));
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        cache()->forget('nav_contacts');

        return ($contact->delete())
        ? redirect('/admin/contacts')->withSuccess(trans('contacts.deleted'))
        : redirect('/admin/contacts')->withError(trans('contacts.deleted_fail'));
    }
}
