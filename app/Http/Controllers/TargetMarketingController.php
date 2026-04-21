<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TargetMarketing;
use App\Models\User;
use Illuminate\Http\Request;

class TargetMarketingController extends Controller
{
    public function edit($id)
    {
        $target = TargetMarketing::findOrFail($id);
        $marketing = User::where('role','marketing')->get();

        return view('manager.target_edit', compact('target','marketing'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'user_id'=>'required',
        'target_nominal'=>'required|numeric',
        'tahun'=>'required'
    ]);

    TargetMarketing::where('id',$id)->update(
        $request->except('_token','_method')
    );

    return redirect()->back()->with('success','Target berhasil diupdate');
}

    public function destroy($id)
    {
        TargetMarketing::findOrFail($id)->delete();

        return redirect()->back()->with('success','Target berhasil dihapus');
    }
}