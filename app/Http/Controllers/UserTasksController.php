<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\UserTasks;

use Illuminate\Http\Request;

class UserTasksController extends Controller
{
    public function utasks(Request $request){
        //$name = $request->query('name');
        $name = $request->input('name');
        $query=DB::select('select dbo.user_feladat(?) as db',array($name));
        //$query=DB::select('select dbo.valami2(?)',array($name));
        //$query=UserTasks::select($name);
        //$querys=DB::select('select dbo.valami2()')->where(fn($query) => $query->where('name', '=', $name))->get();
        return $query;
    }
}
