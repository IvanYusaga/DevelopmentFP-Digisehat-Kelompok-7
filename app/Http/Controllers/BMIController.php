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
        $height = $result['height'] ?? 'BB Tidak diketahui';
        $weight = $result['weight'] ?? 'TB Tidak diketahui';
        $idealWeight = $result['range ideal weight'] ?? 'BB Ideal Tidak diketahui';
        $recommendation = $result['recommendation'] ?? 'Tidak ada rekomendasi.';
        $image = $this->getImage($prediction);

        $idealWeightMessage = $this->getIdealWeightMessage($prediction, $idealWeight);

        // Kirim data ke view
        return view('user/hasilBMI', compact('prediction', 'height', 'weight', 'idealWeight', 'idealWeightMessage', 'recommendation', 'image'));
    }

    private function getImage($kategori)
    {
        $images = [
            'Underweight' => asset('style/assets/img/kurus.png'),
            'Normal weight' => asset('style/assets/img/normal.png'),
            'Overweight' => asset('style/assets/img/gemuk.png'),
            'Obesity class I' => asset('style/assets/img/obesitas_1.png'),
            'Obesity class II' => asset('style/assets/img/obesitas_2.png'),
        ];

        return $images[$kategori] ?? asset('style/assets/img/default.png');
    }

    private function getIdealWeightMessage($prediction, $idealWeight)
    {
        $messages = [
            'Underweight' => "Kamu berada di bawah berat badan normal. Berat badan ideal kamu adalah $idealWeight. Ayo tingkatkan asupan kalori dan gizi agar lebih sehat!",
            'Normal weight' => "Selamat! Kamu memiliki berat badan yang ideal. Berat badan ideal kamu tetap berada di $idealWeight. Jaga pola makan dan gaya hidup sehat!",
            'Overweight' => "Kamu berada di atas berat badan normal. Berat badan ideal kamu adalah $idealWeight. Pertimbangkan untuk meningkatkan aktivitas fisik dan mengatur pola makan.",
            'Obesity I' => "Berat badanmu berada di kategori obesitas I. Berat badan ideal kamu adalah $idealWeight. Mulailah rencana untuk mencapai berat badan lebih sehat.",
            'Obesity II' => "Kamu berada di kategori obesitas II. Berat badan ideal kamu adalah $idealWeight. Diskusikan dengan ahli gizi untuk strategi penurunan berat badan.",
        ];

        return $messages[$prediction] ?? "Berat badan ideal kamu adalah $idealWeight. Tetaplah menjaga kesehatan!";
    }
}
