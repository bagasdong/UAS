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

class MobileResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Mobile Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function sendOTPReset(Request $request)
    {
        // echo '62'.$request->mobile;
        $user = User::where('mobile', '=', '62' . $request->mobile)->get()->first();
        $hasToken = MobileVerification::where('mobile', '=', '62' . $request->mobile)->get()->first();
        $otp = random_int(100000, 999999);
        $send = false;
        $nexmo = app('Nexmo\Client');
        if ($user != null && $user->mobile_verified_at != null) {
            if ($hasToken == null) {
                MobileVerification::create([
                    'mobile' => '62' . $request->mobile,
                    'token' => Hash::make($otp),
                    'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()
                ]);
                $nexmo->message()->send([
                    'to' => '62' . $request->mobile,
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
                    MobileVerification::where('mobile', '=', '62' . $request->mobile)->update([
                        'token' => Hash::make($otp),
                        'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString(),
                        'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()
                    ]);
                    $nexmo->message()->send([
                        'to' => '62' . $request->mobile,
                        'from' => 'Miyago NN',
                        'text' => 'Pakai kode OTP ' . $otp . ' untuk reset password. JANGAN KASIH KODE KE SIAPAPUN. Bahkan ke DOSEN MU. \n',
                    ]);
                }
            }
        } else {
            return view('auth.passwords.mobile')->with(['msg' => 'Sorry, your mobile number is not verified or not registered in the database.']);
        }
        return redirect('mobile/password/reset/' . '62' . $request->mobile);
    }
    public function showOTPResetRequestForm()
    {
        return view('auth.passwords.mobile');
    }
    public function showOTPResetForm($mobile)
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
            'mobile' => substr($mobile, 2)
        ];
        // return view('auth.mobile_verify', $data);
        return view('auth.passwords.mobile_otp', $data);
    }
    public function checkOTPReset(Request $request)
    {
        $data = MobileVerification::where('mobile', '=', $request->mobile)->get()->first();
        if (Hash::check($request->otp, $data['token'])) {
            return view('auth.passwords.mobile_reset', compact('data'));
        } else {
            return Redirect::back()->withErrors(['failed' => 'Kode OTP Salah. Coba Lagi!']);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = MobileVerification::where('mobile', '=', $request->mobile)->get()->first();
        if ($request->token == $data['token']) {
            User::where('mobile', '=',  $request->mobile)->update([
                'password' => Hash::make($request->password)
            ]);
            MobileVerification::where('mobile', '=', $request->mobile)->delete();
            return redirect('login');
        } else {
            return redirect('/mobile/password/reset');
        }
    }
}