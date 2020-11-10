<?php

namespace App\Http\Controllers;

use App\Models\Quene;
use App\Models\Role;
use Carbon\Carbon;
use App\Models\User;
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
            $role_date = Auth::user()->role_date;
            $current_date = now();

            if ($current_date->gt($role_date)){

                $user = Auth::user();
                $user->roles()->sync((array)Role::select('id')->where('name','Basic')->first()->id);
                $user->save();
            }

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
