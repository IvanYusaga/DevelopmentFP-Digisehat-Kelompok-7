<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BMIController extends Controller
{
    public function index()
    {
        return view('user/userBMI');
    }

    public function cekBMI(Request $request)
    {
        // Validasi input
        $request->validate([
            'beratBadan' => 'required|numeric|min:1',
            'tinggiBadan' => 'required|numeric|min:1',
            'jenisKelamin' => 'required|in:Laki-Laki,Perempuan',
            'umur' => 'required|numeric|min:1',
        ], [
            'beratBadan.required' => 'Berat badan wajib diisi.',
            'tinggiBadan.required' => 'Tinggi badan wajib diisi.',
            'jenisKelamin.required' => 'Pilih jenis kelamin.',
            'umur.required' => 'Umur wajib diisi.',
        ]);

        // Ambil data input
        $beratBadan = $request->input('beratBadan');
        $tinggiBadan = $request->input('tinggiBadan');
        $jenisKelamin = $request->input('jenisKelamin');
        $umur = $request->input('umur');

        // Konversi data untuk API
        $gender = $jenisKelamin === 'Laki-Laki' ? 1 : 0;

        // Kirim request ke API
        $response = Http::withOptions(['verify' => false])->post('https://naual-bmi.hf.space/predict', [
            'gender' => $gender,
            'age' => $umur,
            'height' => (float)$tinggiBadan,
            'weight' => (float)$beratBadan,
        ]);

        if ($response->failed()) {
            return back()->withErrors(['API gagal dihubungi, coba lagi nanti.']);
        }

        $result = $response->json();

        // Data dari API
        $prediction = $result['prediction'] ?? 'Tidak diketahui';
        $recommendation = $result['recommendation'] ?? 'Tidak ada rekomendasi.';
        $image = $this->getImage($prediction);

        // Kirim data ke view
        return view('user/hasilBMI', compact('prediction', 'recommendation', 'image'));
    }

    private function getImage($kategori)
    {
        $images = [
            'Underweight' => asset('style/assets/img/kurus.png'),
            'Normal weight' => asset('style/assets/img/normal.png'),
            'Overweight' => asset('style/assets/img/gemuk.png'),
            'Obesity I' => asset('style/assets/img/obesitas_1.png'),
            'Obesity II' => asset('style/assets/img/obesitas_2.png'),
            'Obesity III' => asset('style/assets/img/obesitas_3.png'),
        ];

        return $images[$kategori] ?? asset('style/assets/img/default.png');
    }
}
