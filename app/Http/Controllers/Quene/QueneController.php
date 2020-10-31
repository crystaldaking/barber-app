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
        $quene = Quene::all();
        return view('quene.index')->with('quene',$quene);
    }
}
