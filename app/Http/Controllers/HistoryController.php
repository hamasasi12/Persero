<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the history.
     */
    public function index()
    {
        $histories = History::latest()->get();
        return view('pages.history', compact('histories'));
    }
}
