<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mobil;
use App\Models\TransaksiCar;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        if (Auth::user()->role == 'anggota') {
            $datas = TransaksiCar::where('user_id', Auth::user()->user->id)
                ->get();
        } else {
            $datas = TransaksiCar::get();
        }
        return view('transaksi.car.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $getRow = TransaksiCar::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "TR00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "TR0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "TR000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "TR00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "TR0" . '' . ($lastId->id + 1);
            } else {
                $kode = "TR" . '' . ($lastId->id + 1);
            }
        }

        $mobil = Mobil::where('status', 'ready')->get();
        $users = User::get();
        return view('transaksi.car.create', compact('mobil', 'kode', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'mobil_id' => 'required|string|',
            'user_id' => 'required|string|',

        ]);

        $transaksi = TransaksiCar::create([
            'kode_transaksi' => $request->get('kode_transaksi'),
            'tgl_pinjam' => $request->get('tgl_pinjam'),
            'tgl_kembali' => $request->get('tgl_kembali'),
            'mobil_id' => $request->get('mobil_id'),
            'user_id' => $request->get('user_id'),
            'ket' => $request->get('ket'),
            'status' => 'sewa'
        ]);

        $transaksi->mobil->where('id', $transaksi->mobil_id)
            ->update([
                'status' => 'disewa',
            ]);
        $user = User::get();
        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->route('sewa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = TransaksiCar::findOrFail($id);


        if ((Auth::user()->role == 'user') && (Auth::user()->user->id != $data->user_id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }


        return view('transaksi.car.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TransaksiCar::findOrFail($id);

        if ((Auth::user()->role == 'user') && (Auth::user()->user->id != $data->user_id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('transaksi.car.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = TransaksiCar::find($id);

        $transaksi->update([
            'status' => 'kembali'
        ]);

        $transaksi->mobil->where('id', $transaksi->mobil->id)
            ->update([
                'status' => 'ready',
            ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('sewa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransaksiCar::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('sewa.index');
    }
}
