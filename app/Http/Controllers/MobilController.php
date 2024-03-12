<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Mobil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MobilController extends Controller
{
    public function lihat()
    {
        $datas = Mobil::get();
        return view('mobil/lihat', compact('datas'));
    }
    public function index(Request $request)
    {
        if ($request->user()->hasRole('anggota')) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }


        $datas = Mobil::get();
        return view('mobil.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            Alert::success('Success Title', 'Success Message');
            return redirect()->to('/');
        }

        return view('mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarPostRequest $request)
    {
        Mobil::create([
            'merk' => $request->get('merk'),
            'name' => $request->get('name'),
            'license_number' => $request->get('license_number'),
            'color' => $request->get('color'),
            'year' => $request->get('year'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'penalty' => $request->get('penalty'),
        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');

        return redirect()->route('mobil.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $data = Mobil::findOrFail($id);

        return view('mobil.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
        $mobil = Mobil::all();
        $data = Mobil::findOrFail($id);
        return view('mobil.edit', compact('data', 'mobil'));
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
        Mobil::find($id)->update([
            'merk' => $request->get('merk'),
            'name' => $request->get('name'),
            'license_number' => $request->get('license_number'),
            'color' => $request->get('color'),
            'year' => $request->get('year'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'penalty' => $request->get('penalty'),
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('mobil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mobil::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('mobil.index');
    }
}
