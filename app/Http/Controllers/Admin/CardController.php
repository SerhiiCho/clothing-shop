<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(): View
    {
        return view('admin.cards.index', [
            'cards' => Card::getCards(),
        ]);
    }

    public function create(): View
    {
        return view('admin.cards.create', [
            'types' => Type::orderBy('name')->get(),
        ]);
    }

    public function store(CardRequest $request): RedirectResponse
    {
        if (Card::count() >= 3) {
            return back()->withError(trans('cards.already_3_cards'));
        }

        $img = $request->file('image');

        if ($img) {
            $ext = $img->getClientOriginalExtension();
            $filename = get_file_name($request->type, $ext);

            $this->uploadCardImage($img, $filename);
        }

        Card::create([
            'image' => $img ? $filename : 'default.jpg',
            'type_id' => $request->type,
            'category' => $request->category,
        ]);

        cache()->forget('home_cards');

        return redirect('/admin/cards')->withSuccess(trans('cards.card_added'));
    }

    public function edit(Card $card): View
    {
        $types = Type::orderBy('name')->get();

        $category = ($card->category === 'men')
        ? trans('items.men_items')
        : trans('items.women_items');

        return view('admin.cards.edit')->with(
            compact('card', 'types', 'category')
        );
    }

    public function update(CardRequest $request, Card $card): RedirectResponse
    {
        if ($request->hasFile('image')) {
            if ($card->image != 'default.jpg') {
                Storage::delete('public/img/big/cards/' . $card->image);
            }
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = get_file_name($request->type, $ext);

            $this->uploadCardImage($image, $filename);

            $card->update(['image' => $filename]);
        }

        $card->update([
            'type_id' => $request->type,
            'category' => $request->category,
        ]);

        cache()->forget('home_cards');

        return redirect('admin/cards')->withSuccess(
            trans('cards.card_changed')
        );
    }

    /**
     * Remove the specified cards from database
     *
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     * @see I use observer for this method \App\Observers\CardObserver
     * @throws \Exception
     */
    public function destroy(Card $card): RedirectResponse
    {
        cache()->forget('home_cards');

        return ($card->delete())
            ? redirect('admin/cards')->withSuccess(trans('cards.card_deleted'))
            : redirect('admin/cards')->withError(trans('cards.deleted_fail'));
    }

    public function uploadCardImage(UploadedFile $image_inst, string $filename): void
    {
        (new ImageManager)
            ->make($image_inst)
            ->fit(451, 676, function ($constraint) {
                $constraint->upsize();
            }, 'top')
            ->save(storage_path("app/public/img/big/cards/{$filename}"));
    }
}
