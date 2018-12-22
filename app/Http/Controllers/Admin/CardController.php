<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Card;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;

class CardController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display all cards
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('cards.index', [
            'cards' => Card::get(),
        ]);
    }

    /**
     * Display create card page with form
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('cards.create', [
            'types' => Type::orderBy('name')->get(),
        ]);
    }

    /**
     * Store new card in database
     *
     * @param \App\Http\Requests\StoreCardRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCardRequest $request): RedirectResponse
    {
        if (Card::count() >= 3) {
            return back()->withError(trans('cards.already_3_cards'));
        }

        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $filename = getFileName($request->type, $ext);

        $this->uploadCardImage($image, $filename);

        Card::create([
            'image' => $filename,
            'type_id' => $request->type,
            'category' => $request->category,
        ]);

        cache()->forget('home_cards');

        return redirect('cards')->withSuccess(
            trans('cards.card_added')
        );
    }

    /**
     * Display edit card page with form
     *
     * @param \App\Models\Card $card
     * @return \Illuminate\View\View
     */
    public function edit(Card $card): View
    {
        $types = Type::orderBy('name')->get();

        return view('cards.edit')->with(
            compact('card', 'types')
        );
    }

    /**
     * Update card in database
     *
     * @param \App\Http\Requests\UpdateCardRequest $request
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCardRequest $request, Card $card): RedirectResponse
    {
        if ($request->hasFile('image')) {
            if ($card->image != 'default.jpg') {
                Storage::delete('public/img/cards/' . $card->image);
            }
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = getFileName($request->type, $ext);

            $this->uploadCardImage($image, $filename);

            $card->update(['image' => $filename]);
        }

        $card->update([
            'type_id' => $request->type,
            'category' => $request->category,
        ]);

        cache()->forget('home_cards');

        return redirect('cards')->withSuccess(
            trans('cards.card_changed')
        );
    }

    /**
     * Remove the specified resource from storage,
     * App\Observers\CardObserver will delete image
     * file while database record is being deleted
     *
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Card $card): RedirectResponse
    {
        cache()->forget('home_cards');

        return ($card->delete())
        ? redirect('cards')->withSuccess(trans('cards.card_deleted'))
        : redirect('cards')->withError(trans('cards.deleted_fail'));
    }

    /**
     * Method helper upload image in storage
     *
     * @param \Illuminate\Http\UploadedFile $image_inst
     * @param string $filename
     * @return void
     */
    public function uploadCardImage(UploadedFile $image_inst, string $filename): void
    {
        (new ImageManager)
            ->make($image_inst)
            ->fit(451, 676, function ($constraint) {
                $constraint->upsize();
            }, 'top')
            ->save(storage_path("app/public/img/cards/{$filename}"));
    }
}
