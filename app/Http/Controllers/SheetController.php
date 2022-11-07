<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SheetController extends Controller
{
    public function index(Request $request)
    {

        $sheets = Sheet::with('item')->when($request->get('item') != '', function ($query) use ($request) {
            $query->whereHas('item', function ($query) use ($request) {
                $query->whereName($request->get('item'));
            });
        })->latest()->get();
        // dd($sheets);
        $items = Item::all();
        return view('sheets.index', compact('sheets', 'items'));
    }

    public function create()
    {

        $items = Item::latest()->get();
        return view('sheets.create', compact('items'));
    }

    public function store(Request $request)
    {
        $data = json_decode($request->data);
        $content_type = $data->content_type;

        $sheet = new Sheet();
        $sheet->title = $data->title;
        $sheet->subtitle = $data->subtitle;
        $sheet->item_id = $data->item_id;
        $sheet->content_type = $data->content_type;
        $sheet->slug = Str::slug($data->title);
        $sheet->order = Sheet::count() + 1;


        if ($content_type == 'gallery') {
            $images = $request->content_image;
            $filesName = [];
            foreach ($images as $file) {
                $extension =  $file->getClientOriginalExtension();
                $name = time() . rand() . '.' . $extension;
                $file->move('img/', $name);
                array_push($filesName, $name);
            }
            $sheet->content = json_encode($filesName);
        } else {
            $sheet->content = $data->content;
        }


        $sheet->save();
        return redirect()->route('sheets.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($slug)
    {
        $sheet = Sheet::whereSlug($slug)->firstOrFail();
        return view('sheets.show', compact('sheet'));
    }

    public function edit($slug)
    {
        $sheet = Sheet::whereSlug($slug)->firstOrFail();
        $items = Item::latest()->get();

        // dd($sheet);
        return view('sheets.edit', compact('items', 'sheet'));
    }

    public function update(Request $request, $slug)
    {
        $sheet = Sheet::whereSlug($slug)->firstOrFail();
    }
}
