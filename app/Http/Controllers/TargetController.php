<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TargetController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['target'=>$request->target]);

        return back()->with('success','Target berhasil diupdate');
    }
}
