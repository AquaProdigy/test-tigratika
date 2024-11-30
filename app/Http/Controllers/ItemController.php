<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{

    public function index()
    {
        return Inertia::render('List', ['items' => Item::with('child_items')->orderBy('position')->get()->toArray()]);
    }

}
