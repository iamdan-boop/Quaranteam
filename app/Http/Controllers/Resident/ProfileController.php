<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = User::find(auth()->user()->id);
        if (!$request->password) {
            $user->update($request->except('password'));
        } else {
            $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'password' => Hash::make($request->password),
                'email' => $request->email
            ]);
        }
        return redirect()->back();
    }


    public function updateProfile(Request $request)
    {
        if ($request->has('photo')) {
            $temporaryFile = TemporaryFile::where('folder', $request->photo)->first();
            $storage_path = storage_path('app/public/images/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename);
            if ($temporaryFile) {
                $user = auth()->user();
                $user->media()->delete();
                $user->addMedia($storage_path)
                    ->toMediaCollection('avatars');
                rmdir(storage_path('app/public/images/tmp/' . $temporaryFile->folder));
            }
        }
        return redirect()->back();
    }
}
