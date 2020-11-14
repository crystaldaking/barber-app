<?php

namespace App\Http\Controllers\Quene;

use App\Http\Controllers\Controller;
use App\Models\Quene;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Valuestore\Valuestore;

class QueneController extends Controller
{
    public function index()
    {
        /** @var Collection $quene */
        $quene = Quene::where('status','not like',"%Exited%")->get();
        $settings = Valuestore::make(storage_path('app/settings.json'));

        $sorted = $quene->sortBy(function ($item) {
            return $item->user->getRank();
        });

        $data = ['quene' => $sorted,'settings' => $settings];

        return view('quene.index')->with($data);
    }

    /**
     * Set quene as served or completed
     * @param Quene $quene
     */

    public function status(Request $request,$id,$completed)
    {
        $quene = Quene::find($id);

        if ($completed == '1'){
            $quene->status = 'Served';
            $request->session()->flash('success', 'Client served');
        }
        if ($completed == '0'){
            $quene->status = 'Exited';
            $request->session()->flash('success', 'Client exited');
        }

        $quene->save();
        return redirect()->route('quene.quene.index');
    }

}
