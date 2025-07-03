<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
    public function profile($id){
        $user=User::findOrFail($id);
        return view('profiles.profile',compact('user'));
    }

}
