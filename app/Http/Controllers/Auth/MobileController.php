<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MobileVerification;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MobileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // mobile verivication
    public function showOTPVerifyRequestForm()
    {
        return view('auth.passwords.mobile_reset');
    }
    public function sendOTPVerify(Request $request)
    {
        User::where('mobile', '=', $request->mobile);
        $hasToken = MobileVerification::where('mobile', '=', $request->mobile)->get()->first();
        $otp = random_int(100000, 999999);
        $send = false;
        $nexmo = app('Nexmo\Client');
        if ($hasToken == null) {
            MobileVerification::create([
                'mobile' => $request->mobile,
                'token' => Hash::make($otp),
                'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()
            ]);
            $nexmo->message()->send([
                'to' => $request->mobile,
                'from' => 'Miyago NN',
                'text' => 'Pakai kode OTP ' . $otp . ' untuk reset password. JANGAN KASIH KODE KE SIAPAPUN. Bahkan ke DOSEN MU. \n',
            ]);
        } else {
            $start = new DateTime($hasToken['created_at']);
            $end = new DateTime(Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString());
            $diff = $start->diff($end);

            $daysInSecs = $diff->format('%r%a') * 24 * 60 * 60;
            $hoursInSecs = $diff->h * 60 * 60;
            $minsInSecs = $diff->i * 60;

            $seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;


            if ($seconds / 60 > 5) {
                MobileVerification::where('mobile', '=', $request->mobile)->update([
                    'token' => Hash::make($otp),
                    'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString(),
                    'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()
                ]);
                $nexmo->message()->send([
                    'to' => $request->mobile,
                    'from' => 'Miyago NN',
                    'text' => 'Pakai kode OTP ' . $otp . ' untuk reset password. JANGAN KASIH KODE KE SIAPAPUN. Bahkan ke DOSEN MU. \n',
                ]);
            }
        }
        return redirect('mobile/verify/' . $request->mobile);
    }
    public function showOTPVerifyForm($mobile)
    {
        $hasToken = MobileVerification::where('mobile', '=', $mobile)->get()->first();
        $send = false;
        $message = "";
        if ($hasToken == null) {
            $message = "allowRequest";
        } else {
            $start = new DateTime($hasToken['created_at']);
            $end = new DateTime(Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString());
            $diff = $start->diff($end);

            $daysInSecs = $diff->format('%r%a') * 24 * 60 * 60;
            $hoursInSecs = $diff->h * 60 * 60;
            $minsInSecs = $diff->i * 60;

            $seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;


            if ($seconds / 60 <= 5) {
                $message = "notAllowRequest";
            } else {
                $message = "allowRequest";
            }
        }

        $data = [
            'message' => $message,
            'mobile' => $mobile
        ];
        return view('auth.mobile_verify', $data);
    }

    public function checkOTPVerify(Request $request)
    {
        $data = MobileVerification::where('mobile', '=', $request->mobile)->get()->first();
        if (Hash::check($request->otp, $data['token'])) {
            User::where('mobile', '=', $request->mobile)->update([
                'mobile_verified_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()
            ]);
            MobileVerification::where('mobile', '=', $request->mobile)->delete();
            return Redirect::to('admin');
        } else {
            return Redirect::back()->withErrors(['failed' => "Kode OTP Salah. Coba Lagi."]);
        }
    }
}