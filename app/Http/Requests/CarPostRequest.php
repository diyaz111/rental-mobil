<?php

namespace App\Http\Requests;

use Auth;
use App\Models\Buku;
use App\Models\Mobil;
use Illuminate\Foundation\Http\FormRequest;

class CarPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if (Auth::check() && Auth::user()->role == 'admin') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }


        $datas = Mobil::get();
        return view('mobil.index', compact('datas'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'merk' => 'required|string|max:255',
            'name' => 'required|string',
            'license_number'  => 'required|string',
            'color'  => 'nullable|string',
            'year' => 'nullable|string',
            'status' => 'nullable|string',
            'price' => 'nullable|string',
            'penalty'  => 'nullable|string',
        ];
    }
}
