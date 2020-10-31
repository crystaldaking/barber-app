<?php

namespace App\Http\Controllers\Quene;

use App\Http\Controllers\Controller;
use App\Models\Quene;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueneController extends Controller
{
    public function index()
    {
        $quene = Quene::where('complete',0)->get();
        return view('quene.index')->with('quene',$quene);
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
