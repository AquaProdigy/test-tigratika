<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    public function updatePosition(Request $request)
    {
        $item = Item::find($request->id);

        if ($request->direction === "up") {
            $item_change_position = Item::where('position', '<', $item->position)->orderBy('position', 'desc')->first();

        }else {
            $item_change_position = Item::where('position', '>', $item->position)->orderBy('position', 'asc')->first();
        }

        $position_self = $item->position;
        $position_change = $item_change_position->position;

        $item_change_position->update([
            'position' => $position_self,
        ]);
        $item->update([
            'position' => $position_change,
        ]);


        return response()->json(['success_update_position' => true]);
    }



    public function delete(Request $request)
    {

        Item::findOrFail($request->id)->delete();
        return response()->json(['success_delete' => true]);
    }
}
