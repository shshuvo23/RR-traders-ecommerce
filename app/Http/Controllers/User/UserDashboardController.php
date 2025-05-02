<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $title = 'Dashboard';
        $userId = Auth::id();
        $totalOrders = Order::where('user_id', $userId)->count();
        $latestOrder = Order::where('user_id', $userId)->latest()->first();
        $latestOrders = Order::where('user_id', Auth::id())
                                ->orderBy('id', 'desc')
                                ->limit(5)
                                ->get();

        return view('user.dashboard', compact('user', 'title', 'totalOrders', 'latestOrder', 'latestOrders'));
    }

    public function profile()
    {
        $title = __('messages.common.profile');
        $user = Auth::user();
        return view('user.profile', compact('user','title'));
    }
    public function setting()
    {
        $title = __('messages.common.settings');
        $user = Auth::user();
        return view('user.setting', compact('user', 'title'));
    }

    public function profileUpdate(Request $request)
    {

        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        $this->validate($request, [
            'name'  => 'required',
            'email'   => 'required|unique:users,email,' . $user->id . ',id',
            'phone'  => 'required',
            'address' => 'required',
        ]);

        try {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if ($request->hasFile('image')) {

                // Delete the existing image file if it exists
                if (File::exists(public_path($user->image))) {
                    File::delete(public_path($user->image));
                }

                // Upload and save the new image
                $image = $request->file('image');
                $base_name  = preg_replace('/\..+$/', '', $image->getClientOriginalName());
                $base_name  = explode(' ', $base_name);
                $base_name  = implode('-', $base_name);
                $base_name  = Str::lower($base_name);
                $image_name = $base_name . "-" . uniqid() . "." . $image->getClientOriginalExtension();
                $extension  = $image->getClientOriginalExtension();
                $file_path  = 'uploads/UserInfo';
                $image->move(public_path($file_path), $image_name);
                $user->image  = $file_path . '/' . $image_name;

            }

            $user->save();
        } catch (\Exception $e) {
            Toastr::error(__('messages.toastr.user_profile_update_error'), __('messages.common.error'), ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        Toastr::success(__('messages.toastr.user_profile_update_success'), __('messages.common.success'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('user.profile');
    }
    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [

            'newpassword'          => 'required|min:6',
            'confirm_password'  => 'required|same:newpassword',
        ]);

        try {

                $user  = User::find(Auth::user()->id);
                $user->password = Hash::make($request->input('newpassword'));
                $user->update();

        } catch (\Exception $e) {
            Toastr::error(__('messages.toastr.user_password_change_error'), __('messages.common.error'), ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        Toastr::success(__('messages.toastr.user_password_change_success'), __('messages.common.success'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function upgradePlan()
    {
        $title = __('messages.user_dashboard.upgrade_plan');
        $userPlan = Auth::user()->current_pan_id;
        $plans = Plan::with('features')->where('is_default', '!=', 1)->where('status', 1)->orderBy('order_number', 'asc')->get();
        // dd($plans->toArray());
        return view('user.plan_upgrade', compact('title', 'plans', 'userPlan'));
    }

    public function orderList()
    {
        $data['title'] = 'Order List';
        $userId = Auth::id();
        $data['user'] = Auth::user();
        $data['orders'] = Order::where('user_id', $userId)->orderBy('id', 'desc')->paginate(7);
        return view('user.order',$data);
    }

    public function orderDetails($orderNumber)
    {
        $data['title'] = 'Order Details';
        $userId = Auth::id();
        $data['user'] = Auth::user();
        $data['company_data'] = getSetting();
        $data['order'] = Order::with('orderDetails.product')->where('order_number', $orderNumber)->first();
        return view('user.order_details',$data);
    }
}
