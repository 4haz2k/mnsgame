<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Services\ImageService;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     * @return Renderable
     */
    public function index(): Renderable
    {
        $user = Auth::user();
        return view('account.home', compact("user"));
    }

    public function settings(){
        $user = Auth::user();
        return view('account.settings', compact("user"));
    }

    public function updateSettings(UserEditRequest $request): RedirectResponse
    {
        $user = User::where("id", Auth::id())->first();

        if($request->has("name"))
            $user->name = $request->name;

        if($request->has("surname"))
            $user->surname = $request->surname;

        if($request->has("login"))
            $user->login = $request->login;

        if($request->has("password"))
            $user->password = Hash::make($request->password);

        $user->email = $request->email;

        $image = new ImageService();
        $user->profile_image = $image->handleProfileUploadedImage($request);

        $user->save();

        return redirect()->back()->with("status", true);
    }
}
