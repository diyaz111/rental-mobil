<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Buku;
use App\Models\Mobil;
use App\Models\TransaksiCar;
use Auth;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $transaksi = TransaksiCar::get();
        $user   = User::get();
        $buku      = Mobil::get();
        if(Auth::user()->role == 'anggota')
        {
            $datas = TransaksiCar::where('status', 'sewa')
                                ->where('user_id', Auth::user()->user->id)
                                ->get();
        } else {
            $datas = TransaksiCar::where('status', 'sewa')->get();
        }
        return view('home', compact('transaksi', 'user', 'buku', 'datas'));
    }
}
