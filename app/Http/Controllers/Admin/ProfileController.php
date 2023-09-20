<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Showing profile page login person
     */
    public function index(Request $request)
    {
        return view('admin.pages.profile.index');
    }

    /**
     * Profile update
     */

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,webp,png,jpg,gif', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->user_id) {
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }


            if ($request->hasFile('avatar')) {

                $file = $request->file('avatar');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('storage/images/users', $fileName);
                $user->user_image = $fileName;
            }
            $user->save();
        }

        return redirect()->back();
    }
}
