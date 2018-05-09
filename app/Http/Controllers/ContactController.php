<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    // Show the form for creating a new resource
    public function create()
    {
        return view('contacts.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        //
    }

    // Show the form for editing the specified resource
    public function edit(Contact $contact)
    {
        //
    }

    // Update the specified resource in storage
    public function update(Request $request, Contact $contact)
    {
        //
    }

    // Remove the specified resource from storage
    public function destroy(Contact $contact)
    {
        //
    }
}
