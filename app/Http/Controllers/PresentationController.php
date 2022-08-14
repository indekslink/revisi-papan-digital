<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index()
    {
        $lists  = Presentation::orderBy('order', 'asc')->get();
        return view('presentation.index', compact('lists'));
    }

    public function create()
    {
        $itemAndSheets = Item::with('sheets.presentation')->latest()->get();
        return view('presentation.create', compact('itemAndSheets'));
    }
}
