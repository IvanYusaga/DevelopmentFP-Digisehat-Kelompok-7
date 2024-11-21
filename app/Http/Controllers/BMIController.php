<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        ], [
            'beratBadan.required' => 'Berat badan wajib diisi.',
            'tinggiBadan.required' => 'Tinggi badan wajib diisi.',
            'jenisKelamin.required' => 'Pilih jenis kelamin.',
        ]);

        //debug data input
        Log::info('Data valid:', $request->all());

        // Ambil data input
        $beratBadan = $request->input('beratBadan');
        $tinggiBadan = $request->input('tinggiBadan');
        $jenisKelamin = $request->input('jenisKelamin');

        // Hitung BMI
        $bmi = $beratBadan / pow($tinggiBadan / 100, 2);
        Log::info("BMI: $bmi");
        $kategori = $this->getKategoriBMI($bmi);
        Log::info("Kategori BMI: $kategori");

        // Tentukan pesan dan gambar
        $message = $this->getMessage($kategori, $bmi);
        $advice = $this->getAdvice($kategori);
        $image = $this->getImage($kategori);

        // Kirim data ke view
        return view('user/hasilBMI', compact('kategori', 'message', 'image', 'advice'));
    }

    private function getKategoriBMI($bmi)
    {
        if ($bmi < 18.5) {
            return 'Kurus';
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            return 'Normal';
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            return 'Gemuk';
        } elseif ($bmi >= 30 && $bmi <= 34.9) {
            return 'Obesitas 1';
        } elseif ($bmi >= 35 && $bmi <= 39.9) {
            return 'Obesitas 2';
        } else {
            return 'Obesitas 3';
        }
    }

    private function getMessage($kategori, $bmi)
    {
        $bmi = number_format($bmi, 1);
        switch ($kategori) {
            case 'Kurus':
                return "Berat badan kamu di bawah normal. BMI kamu adalah $bmi . Disarankan untuk meningkatkan asupan gizi.";
            case 'Normal':
                return "Berat badan kamu sudah ideal, yaitu di kisaran 18.5 - 24.9. Keren!";
            case 'Gemuk':
                return "Berat badan kamu di atas normal. BMI kamu adalah $bmi . Disarankan untuk menjaga pola makan.";
            case 'Obesitas 1':
                return "BMI kamu adalah $bmi , termasuk kategori Obesitas 1. Disarankan mulai memperhatikan gaya hidup.";
            case 'Obesitas 2':
                return "BMI kamu adalah $bmi , termasuk kategori Obesitas 2. Perhatikan pola makan dan aktivitas fisik.";
            case 'Obesitas 3':
                return "BMI kamu adalah $bmi , termasuk kategori Obesitas 3. Penting untuk konsultasi dengan tenaga medis.";
        }
    }

    private function getAdvice($kategori)
    {
        switch ($kategori) {
            case 'Kurus':
                return "Hasilnya menunjukkan bahwa berat badanmu sedikit dibawah rata rata. Periksa lebih lanjut untuk memastikan adanya gangguan makan atau kondisi medis lain, serta rencana untuk meningkatkan asupan kalori, protein, dan nutrisi.";
            case 'Normal':
                return "Keren! Berat badan kamu pas banget! Disarankan untuk menjaga pola makan sehat, tetap aktif, dan melakukan pemeriksaan kesehatan rutin (seperti cek gula darah dan tekanan darah) untuk memelihara kesehatan jangka panjang.";
            case 'Gemuk':
                return "Hasilnya menunjukkan bahwa kamu berada dalam kategori berat badan lebih, tetapi belum mencapai level obesitas. Disarankan untuk mengatur pola makan dengan lebih baik (pengurangan kalori yang sehat), meningkatkan aktivitas fisik, dan pemantauan rutin untuk tanda-tanda awal penyakit metabolik (seperti tes gula darah dan kolesterol).";
            case 'Obesitas 1':
                return "berat badanmu sedikit di atas rata-rata nih. Rencanakan penurunan berat badan melalui diet seimbang, olahraga rutin, dan mungkin pengaturan perilaku terkait kebiasaan makan. Pemeriksaan untuk gula darah dan kolesterol juga disarankan.";
            case 'Obesitas 2':
                return "Oke, kamu di kategori obesitas tingkat 2. Demi kesehatan yang lebih baik, Rencanakan untuk mengatur pola makan dengan bantuan ahli gizi, program penurunan berat badan yang diawasi secara medis, pemeriksaan lebih lanjut untuk kondisi terkait obesitas, serta pengaturan untuk meningkatkan aktivitas fisik dan kesehatan mental.";
            case 'Obesitas 3':
                return "Obesitas tingkat 3 memerlukan perhatian serius. Diperlukan untuk segera melakukan Intervensi medis, termasuk perubahan gaya hidup yang signifikan, kemungkinan pengobatan untuk menurunkan berat badan, dan pemeriksaan lanjutan untuk kondisi kesehatan terkait (misalnya, pemeriksaan jantung, tes gula darah, dan kolesterol). Dalam beberapa kasus, prosedur medis seperti bariatric surgery mungkin perlu dipertimbangkan.";
        }
    }

    private function getImage($kategori)
    {
        switch ($kategori) {
            case 'Kurus':
                return asset('style/assets/img/kurus.png');
            case 'Normal':
                return asset('style/assets/img/normal.png');
            case 'Gemuk':
                return asset('style/assets/img/gemuk.png');
            case 'Obesitas 1':
                return asset('style/assets/img/obesitas_1.png');
            case 'Obesitas 2':
                return asset('style/assets/img/obesitas_2.png');
            case 'Obesitas 3':
                return asset('style/assets/img/obesitas_3.png');
        }
    }
}
