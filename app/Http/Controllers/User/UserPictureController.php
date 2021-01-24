<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;

class UserPictureController extends Controller
{
    protected $imageManager; 

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function index() 
    {
        return view('user.profile.picture.index');
    }

    public function store(Request $request)
    {

        $path = NULL; 

        if($request->picture != null) {
            $processedImage = $this->imageManager->make($request->file('picture')->getPathName())
                ->encode('png')
                ->save(public_path('uploads/profile/images/' . $filename = uniqid(true) . '.png'));
        
            $path = '/uploads/profile/images/'.$filename; 
        }


        $user = Auth::user();
        $user->picture = $path;
        $user->save();

        return redirect()->back()->withSuccess('Profile picture updated successfully!');
    }
}
