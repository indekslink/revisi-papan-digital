<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SheetController extends Controller
{
    public function index()
    {
        $sheets = Sheet::latest()->get();
        return view('sheets.index', compact('sheets'));
    }

    public function create()
    {

        $items = Item::latest()->get();
        return view('sheets.create', compact('items'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'item_id' => ['required', function ($attr, $val, $fail) {
                $isAvailable = Item::find($val);
                if (!$isAvailable) {
                    $fail('Mohon Periksa ketersediaan data yang Anda pilih');
                }
            }]
        ]);


        Sheet::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'subtitle' => $request->subtitle,
            'item_id' => $request->item_id,
            'content' => $request->content_value,
            'order' => Sheet::count() + 1,
            'content_type' => $request->content
        ]);

        return redirect()->route('sheets.index')->with('success', 'Data berhasil ditambahkan');
    }
}
