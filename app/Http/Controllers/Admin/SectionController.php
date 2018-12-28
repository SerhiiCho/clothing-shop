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
        cache()->forget('home_sections');

        $section->update([
            'title' => request('title'),
            'content' => request('content'),
            'name' => $section->name,
        ]);

        $anchors = ['home_up', 'home_down'];

        if (in_array($section->name, $anchors)) {
            return redirect("/#{$section->name}");
        }

        return back();
    }
}
