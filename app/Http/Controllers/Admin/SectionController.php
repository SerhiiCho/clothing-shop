<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Update section in database
     *
     * @param \App\Http\Requests\SectionRequest $request
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SectionRequest $request, Section $section): RedirectResponse
    {
        cache()->forget('home_section');

        $section->update([
            'title' => request('title'),
            'content' => request('content'),
            'name' => $section->name,
        ]);

        if ($section->name === 'home') {
            return redirect('/#title');
        }
        return back();
    }
}
