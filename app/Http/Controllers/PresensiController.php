<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensis = Presensi::join('users', 'presensis.user_id', '=', 'users.id')->select('presensis.*', 'users.firstname', 'users.lastname')->orderBy('created_at', 'ASC')->get();
        $year = Carbon::now()->timezone('Asia/Jakarta')->format('Y');
        $month = Carbon::now()->timezone('Asia/Jakarta')->format('m');
        if (Auth::user()->role == "admin") {
            $data = [
                'presensis' => $presensis,
            ];
            return view('pages.dashboard_admin_presensi', $data);
        } else {
            $today = Carbon::now()->timezone('Asia/Jakarta')->locale('en_US');
            $first = Presensi::where('user_id', Auth::user()->id)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->orderBy('tgl_presensi', 'ASC')->first(); //tanggal pertama
            $last = Presensi::where('user_id', Auth::user()->id)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->orderBy('tgl_presensi', 'DESC')->first(); ///tanggal terakhir
            $now = Presensi::where('user_id', Auth::user()->id)->whereDate('created_at', '=', Carbon::now()->timezone('Asia/Jakarta')->toDateString())->first();
            if ($first != null && $now != null) {
                $between = date_create(Carbon::now()->timezone('Asia/Jakarta')->startOfMonth()->toDateString())->diff(date_create($now['created_at']->toDateString()));
                $hari = ($between->y * 12 * 30) + ($between->m * 30) + ($between->d);
                $kerja = Presensi::where('user_id', Auth::user()->id)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->count();
                $bolos = $hari - $kerja + 1;
            } else if ($last != null) {
                $between = date_create((Carbon::now()->timezone('Asia/Jakarta')->startOfMonth()->toDateString()))->diff(date_create($last['created_at']->toDateString()));
                $hari = ($between->y * 12 * 30) + ($between->m * 30) + ($between->d);
                $kerja = Presensi::where('user_id', Auth::user()->id)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->count();
                $bolos = $hari - $kerja + 2;
            } else {
                $between = date_create((Carbon::now()->timezone('Asia/Jakarta')->startOfMonth()->toDateString()))->diff(date_create((Carbon::now()->timezone('Asia/Jakarta')->toDateString())));
                $hari = ($between->y * 12 * 30) + ($between->m * 30) + ($between->d);
                $kerja = Presensi::where('user_id', Auth::user()->id)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->count();
                $bolos = $hari - $kerja + 1;
            }
            // $bolos = $hari - $kerja == -1 ? 1 : $hari - $kerja + 1;
            $data = [
                'presensis' => $presensis,
                'now' => $now,
                'today' => $today,
                'kerja' => $kerja,
                'bolos' => $bolos
            ];
            return view('pages.dashboard_user', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/img/presensi';
        $file->move($tujuan_upload, $nama_file);

        Presensi::create([
            'user_id' => Auth::user()->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'waktu_presensi' => Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s'),
            'tgl_presensi' => Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d'),
            'bukti_presensi' => $nama_file,
            'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString(),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString(),
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presensi $presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presensi)
    {
        //
    }
}