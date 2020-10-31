<?php

namespace App\Http\Controllers\Quene;

use App\Http\Controllers\Controller;
use App\Models\Quene;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueneController extends Controller
{
    public function index()
    {
        /** @var Collection $quene */
        $quene = Quene::where('complete',0)->get();

        $sorted = $quene->sortBy(function ($item) {
            return $item->user->getRank();
        });

        return view('quene.index')->with('quene',$sorted);
    }

    /**
     * Set quene as completed
     * @param Quene $quene
     */

    public function edit(Request $request,Quene $quene)
    {
        $quene->complete = true;
        $quene->save();

        $request->session()->flash('success','Client removed from quene');
        return redirect()->route('quene.quene.index');
    }
}
