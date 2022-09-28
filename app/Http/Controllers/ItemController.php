<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->get();
        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => ['required', function ($attr, $val, $fail) {
                $slug  = Str::slug($val);
                $isExist = Item::whereSlug($slug)->first();
                if ($isExist) {
                    $fail('Nama item tersebut sudah ada dalam sistem');
                }
            }]
        ]);

        Item::create([
            'name' => $request->nama_item,
            'slug' => Str::slug($request->nama_item)
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $slug)
    {
        $item = Item::whereSlug($slug)->firstOrFail();
        $request->validate([
            'nama_item' => ['required', function ($attr, $val, $fail) use ($item) {
                $slug  = Str::slug($val);
                $isExist = Item::whereSlug($slug)->first();
                if ($isExist && $isExist->slug != $item->slug) {
                    $fail('Nama item tersebut sudah ada dalam sistem');
                }
            }]
        ]);

        $item->update([
            'name' => $request->nama_item,
            'slug' => Str::slug($request->nama_item)
        ]);
        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($slug)
    {
        $item = Item::whereSlug($slug)->firstOrFail();
        if ($item->sheets->count() > 0) {
            return redirect()->back()->withErrors([
                'nama_item' => 'Data tidak dapat dihapus karena telah memiliki sheet'
            ]);
        }
        $item->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function show($slug)
    {
        $item = Item::with('sheets')->whereSlug($slug)->firstOrFail();
        return view('items.show', compact('item'));
    }
}
