<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Sheet;

class PresentationController extends Controller
{
    public $presentation;
    public function __construct()
    {
        $lists  = Presentation::orderBy('order', 'asc')->get();

        $hasAdvanceList = collect($lists)->filter(function ($key) {
            return $key->sheet->content_type == 'advance';
        })->map(function ($key) {
            return $key->id;
        })->all();

        if (count($hasAdvanceList) > 0) {
            Presentation::whereIn('id', $hasAdvanceList)->delete();
            $lists = collect($lists)->filter(function ($key) use ($hasAdvanceList) {
                return !in_array($key->id, $hasAdvanceList);
            });
        }

        $this->presentation = $lists;
    }
    public function index()
    {

        $lists = $this->presentation;

        return view('presentation.index', compact('lists'));
    }

    public function create()
    {
        $itemAndSheets = Item::with(['sheets' => function ($query) {
            $query->with('presentation')->where('content_type', '!=', 'advance')->latest();
        }])->latest()->get();

        $noUrut = [];
        $presentation = Presentation::all();
        if ($presentation->count() > 0) {
            $noUrut = $presentation->map(function ($key) {
                return [
                    'sheet_id' => $key->sheet_id,
                    'order' => $key->order,
                ];
                // return $key->order;
            });
        }

        $noUrut = json_encode($noUrut);
        // dd($noUrut);
        // dd($noUrut);
        return view('presentation.create', compact('itemAndSheets', 'noUrut'));
    }

    public function store(Request $request)
    {
        $data = json_decode($request->data);
        $index = 0;
        $insert = [];
        foreach ($data as  $item) {
            $insert[$index]['sheet_id'] = (int)$item->sheet_id;
            $insert[$index]['order'] = $item->order;
            $insert[$index]['created_at'] = Carbon::now();
            $insert[$index]['updated_at'] = Carbon::now();
            $index++;
        }
        DB::table('presentations')->truncate();
        DB::table('presentations')->insert($insert);

        return redirect()->route('presentation.index')->with('success', 'Data urutan presentasi berhasil disimpan');
    }

    public function play_content()
    {
        $presentation = $this->presentation;
        // dd($presentation);
        return view('presentation.play', compact('presentation'));
    }
    public function show($slug)
    {
        $item = Sheet::whereSlug($slug)->firstOrFail();
        // dd($presentation);
        return view('presentation.item-play', compact('item'));
    }
}
