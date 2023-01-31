<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Services\ImageService;
use App\Models\Game;
use App\Models\Notifications;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        return view('account.home', ["user" => Auth::user()]);
    }

    /**
     * Settings page
     *
     * @return Renderable
     */
    public function settings(): Renderable
    {
        return view('account.settings', ["user" => Auth::user()]);
    }

    /**
     * User settings update
     *
     * @param UserEditRequest $request
     * @return RedirectResponse
     */
    public function updateSettings(UserEditRequest $request): RedirectResponse
    {
        return redirect()->back()->with("status", User::updateUser($request));
    }

    /**
     * Get payment history of user
     *
     * @return Renderable
     */
    public function getPaymentHistory(): Renderable
    {
        $payments = PaymentHistory::with("server")
            ->whereHas("server", function ($q){ $q->where("owner_id", Auth::id()); })
            ->whereNotNull("server_id")
            ->get();

        return view("account.paymenthistory", compact("payments"));
    }

    /**
     * Get notifications of user
     *
     * @return Renderable
     */
    public function getNotifications(): Renderable
    {
        return view("account.notifications", ["notifications" => Notifications::where("user_id", Auth::id())->get()]);
    }

    /**
     * Open notification by ID
     *
     * @param $id
     * @return Renderable
     */
    public function goToNotification($id): Renderable
    {
        $notification = Notifications::where("id", $id)->where("user_id", Auth::id())->firstOrFail();

        if(!$notification->is_viewed) {
            $notification->is_viewed = 1;
            $notification->save();
        }

        return view("account.notification", compact("notification"));
    }
}
