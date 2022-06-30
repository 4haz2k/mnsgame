<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Services\ImageService;
use App\Models\Game;
use App\Models\PaymentHistory;
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

        if($request->has("name") and $request->filled('name'))
            if($request->name != $user->name)
                $user->name = $request->name;

        if($request->has("surname") and $request->filled('surname'))
            if($request->surname != $user->surname)
                $user->surname = $request->surname;

        if($request->has("login") and $request->filled('login'))
            if($request->login != $user->login)
                $user->login = $request->login;

        if($request->has("password") and $request->filled('password'))
            $user->password = Hash::make($request->password);

        if($request->has("email") and $request->filled('email'))
            if($request->email != $user->email)
                $user->email = $request->email;

        if($request->hasFile("profile_image") and $request->filled('profile_image')){
            $image = new ImageService();
            $user->profile_image = $image->handleProfileUploadedImage($request);
        }

        $user->save();

        return redirect()->back()->with("status", true);
    }

    public function getPaymentHistory(){
        $payments = PaymentHistory::with("server")
            ->whereHas("server", function ($q){ $q->where("owner_id", Auth::id()); })
            ->whereNotNull("server_id")
            ->get();

        return view("account.paymenthistory", compact("payments"));
    }
}
