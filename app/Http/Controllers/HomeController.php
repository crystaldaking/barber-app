<?php

namespace App\Http\Controllers;

use App\Models\Quene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')) {
            return redirect()->route('admin.users.index');
        } else {
            $matchFields = ['user_id' => Auth::user()->id, 'complete' => 'false'];
            if (Quene::where($matchFields)->get()->isEmpty()) {
                $quene = new Quene();
                $quene->user_id = Auth::user()->id;
                $quene->updated_at = now();
                $quene->save();
            } else {
                $request->session()->flash('danger','You are already in the queue!');
            }
            return view('home');
        }
    }
}
