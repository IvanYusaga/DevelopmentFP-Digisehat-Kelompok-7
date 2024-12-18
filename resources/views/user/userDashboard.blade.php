@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Halo, {{ auth()->user()->profil->nama_lengkap ?? auth()->user()->nama_pengguna }}</h1>
        <h1>Selamat Datang di MediPulse</h1><br>

        @if (!auth()->user()->profil)
            <p>Yuk Lengkapi Profilmu! <a href="{{ route('profile.form') }}"><strong>Klik Disini</strong></a></p>
        @endif
        <br>
    </div>
@endsection

@section('content')
<section class="section dashboard">
    <div class="row">

        <!-- Jumlah Obat -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Obat</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('style/assets/img/obat_dashboard.jpeg') }}" alt="" style="width: 40px; height: 40px;">
                        </div>
                        <div class="ps-3">
                            <h6>{{ $jumlahObat }}</h6>
                            <span class="text-primary fw-bold small pt-2 ps-1">Obat yang telah diinput</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Jadwal -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Jadwal</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('style/assets/img/jumlah_jadwal.png') }}" alt="" style="width: 40px; height: 40px;">
                        </div>
                        <div class="ps-3">
                            <h6>{{ $jumlahJadwal }}</h6>
                            <span class="text-primary fw-bold small pt-2 ps-1">Jadwal yang telah diatur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Minum Obat -->
        <div class="col-12">
            <h5 class="fw-bold text-primary mt-3">Jadwal Minum Obat</h5><br>
        </div>

        <!-- Slider -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($jadwalPengingat as $jadwal)
                <div class="swiper-slide">
                    <a href="{{ route('jadwal.view', ['id' => $jadwal->id_jadwal]) }}">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('style/assets/img/jadwal_minum_obat_dashboard.png') }}" alt="" style="width: 40px; height: 40px;">
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="mb-1" style="font-size: 1rem; font-weight: bold;">{{ $jadwal->obat->nama_obat }}</h6>
                                        <p class="mb-0 text-dark small" style="margin-top: 5px;">{{ $jadwal->tanggal_konsumsi }}</p>
                                        <p class="mb-0 text-dark small" style="margin-top: 3px;">{{ $jadwal->waktu_pengingat }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
</main>

<div class="card shadow-sm border-0 rounded-3 d-none">
    <div class="card-header text-dark text-center py-2">
        <h5 class="mb-0 fs-3">Jadwal Pengingat Obat</h5>
    </div>
    <div class="card-body p-4">
        <!-- Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered table-striped table-hover text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Tanggal Konsumsi</th>
                        <th scope="col">Waktu Pengingat</th>
                        <th scope="col">Cara Penggunaan Obat</th>
                        <th scope="col">Frekuensi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwalPengingat as $index => $jadwal)
                    <tr class="clickable-row" data-bs-toggle="collapse" data-bs-target="#dropdown-{{ $index }}" aria-expanded="false" aria-controls="dropdown-{{ $index }}">
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $jadwal->obat->nama_obat }}</td>
                        <td>{{ $jadwal->tanggal_konsumsi }}</td>
                        <td>{{ $jadwal->waktu_pengingat }}</td>
                        <td class="text-start">
                        {{ $jadwal->caraPenggunaanObat }}
                        </td>
                        <td>{{ $jadwal->frekuensi }} Kali Sehari</td>
                        <td>
                            <span class="badge {{ $jadwal->status == 'aktif' ? 'bg-success' : 'bg-secondary' }} text-wrap fs-6">
                                <i class="bi {{ $jadwal->status == 'aktif' ? 'bi-check-circle' : 'bi-check-circle-fill' }}"></i>
                                {{ ucfirst($jadwal->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <!-- Baris dropdown -->
                    <tr class="collapse" id="dropdown-{{ $index }} d-none">
                        <td colspan="8">
                            <div class="border-0 rounded-4" style="background: #f6f9ff;">
                                <form action="{{ url('schedule/addEvent.php') }}" method="POST">
                                    <input type="hidden" id="inputNamaObat" class="form-control border-2 border-secondary" value="{{ $jadwal->obat->nama_obat }}" name="inputNamaObat" readonly>
                                    <input type="hidden" id="caraPenggunaanObat" class="form-control border-2 border-secondary" name="caraPenggunaanObat" value="{{ $jadwal->caraPenggunaanObat }}" required>
                                    <input type="hidden" id="inputTime" class="form-control border-2 border-secondary" name="waktu_pengingat" value="{{ $jadwal->waktu_pengingat }}" required>
                                    <input type="hidden" id="inputDate" class="form-control border-2 border-secondary" name="tanggal_konsumsi" value="{{ $jadwal->tanggal_konsumsi }}" readonly>
                                    <input type="hidden" id="inputDateEnd" class="form-control border-2 border-secondary" name="tanggal_selesai" value="{{ $jadwal->tanggal_konsumsi }}" required>
                                    <div class="d-flex justify-content-center">
                                    <button type="submit" name="submit" class="btn btn-info w-100 text-white">
                                        <i class="bi bi-calendar2-week-fill me-3"></i> Tambahkan Jadwal Ke Google Calender
                                    </button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Mobile -->
        <div class="table-responsive d-md-none">
            @forelse($jadwalPengingat as $jadwal)
            <div class="mb-3 p-2 border rounded">
                <table class="table table-bordered table-striped" >
                    <tbody class="clickable-row" data-bs-toggle="collapse" data-bs-target="#dropdown-{{ $index }}" aria-expanded="false" aria-controls="dropdown-{{ $index }}">
                        <tr>
                            <th>Nama Obat</th>
                            <td>{{ $jadwal->obat->nama_obat }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Konsumsi</th>
                            <td>{{ $jadwal->tanggal_konsumsi }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Pengingat</th>
                            <td>{{ $jadwal->waktu_pengingat }}</td>
                        </tr>
                        <tr>
                            <th>Cara Penggunaan Obat</th>
                            <td>{{ $jadwal->caraPenggunaanObat }}</td>
                        </tr>
                        <tr>
                            <th>Frekuensi</th>
                            <td>{{ $jadwal->frekuensi }} Kali Sehari</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $jadwal->status == 'aktif' ? 'bg-success' : 'bg-secondary' }} text-wrap fs-6">
                                <i class="bi {{ $jadwal->status == 'aktif' ? 'bi-check-circle' : 'bi-check-circle-fill' }}"></i>
                                {{ ucfirst($jadwal->status) }}
                            </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Aksi</th>
                            <td>
                                <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                            </td>
                        </tr>
                        <!-- Baris dropdown -->
                        <tr class="collapse d-none" id="dropdown-{{ $index }}">
                            <td colspan="8">
                                <div class="border-0 rounded-4" style="background: #f6f9ff;">
                                    <form action="{{ url('schedule/addEvent.php') }}" method="POST">
                                        <form action="{{ url('schedule/addEvent.php') }}" method="POST">
                                        <input type="hidden" id="inputNamaObat" class="form-control border-2 border-secondary" value="{{ $jadwal->obat->nama_obat }}" name="inputNamaObat" readonly>
                                        <input type="hidden" id="caraPenggunaanObat" class="form-control border-2 border-secondary" name="caraPenggunaanObat" value="{{ $jadwal->caraPenggunaanObat }}" required>
                                        <input type="hidden" id="inputTime" class="form-control border-2 border-secondary" name="waktu_pengingat" value="{{ $jadwal->waktu_pengingat }}" required>
                                        <input type="hidden" id="inputDate" class="form-control border-2 border-secondary" name="tanggal_konsumsi" value="{{ $jadwal->tanggal_konsumsi }}" readonly>
                                        <input type="hidden" id="inputDateEnd" class="form-control border-2 border-secondary" name="tanggal_selesai" value="{{ $jadwal->tanggal_konsumsi }}" required>
                                        <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit" class="btn btn-info w-100 text-white">
                                            <i class="bi bi-calendar2-week-fill me-3"></i> Tambahkan Jadwal Ke Google Calender
                                        </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @empty
            <p class="text-center">Tidak ada jadwal</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Baru -->
<div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 overflow-hidden shadow-lg">
      <!-- Modal Header -->
      <div class="modal-header text-white" style="background:#b5d6f7;">
        <div class="w-100 text-center">
          <h5 class="modal-title fw-bold" id="reminderModalLabel">
            <i class="bi bi-alarm text-warning"></i> Pengingat Obat
          </h5>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4 d-flex flex-column align-items-center justify-content-center">
          <div class="text-center mb-4">
              <img src="{{ asset('/style/assets/img/minumobat.png') }}" alt="Obat Icon" class="img-fluid" style="width: 100px;">
          </div>
          <h4 class="fw-bold text-primary text-gradient mb-3">Waktunya Minum Obat!</h4>
          <p id="modalMessage" class="text-muted fs-5 text-center">
              Jangan lupa konsumsi obat Anda tepat waktu untuk mendapatkan manfaat maksimal dan memastikan pemulihan yang lebih cepat.
          </p>
          <p class="text-muted fs-6 text-center">
              Jika Anda memiliki pertanyaan terkait cara penggunaan obat atau efek samping yang mungkin timbul, segera hubungi dokter atau apoteker Anda.
          </p>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer justify-content-center" style="background-color: #f8f9fa;">
          <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" data-bs-dismiss="modal">
              <i class="bi bi-check-circle me-2"></i> OK, Saya Ingat!!!
          </button>
      </div>
    </div>
  </div>
</div>

<!-- Inisialisasi Swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js" 
integrity="sha384-eSR7zK1V2s4cY/aOWYdtyMXBr5qXmV7r8Wq7s39HiVKWy19PcLe1WCYP6bvdrRFu" 
crossorigin="anonymous">
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true, // Looping slider
            autoplay: {
                delay: 1500, // Mempercepat jeda antar slide (1.5 detik)
                disableOnInteraction: false, // Tetap autoplay meskipun user berinteraksi
            },
            speed: 800, // Kecepatan transisi antar slide (800ms)
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const jadwalPengingat = @json($jadwalPengingat);

        jadwalPengingat.forEach(jadwal => {
            const waktuPengingat = new Date(jadwal.tanggal_konsumsi + 'T' + jadwal.waktu_pengingat);
            const waktuSekarang = new Date();
            const waktuTunggu = waktuPengingat - waktuSekarang;

            if (waktuTunggu > 0) {
                setTimeout(() => {
                    if (Notification.permission === "granted") {
                        new Notification("Pengingat Obat", {
                            body: `Waktunya konsumsi obat: ${jadwal.obat.nama_obat}.`,
                            icon: '{{ asset('/style/assets/img/logo.jpg') }}'
                        });
                    }

                    const modalMessage = document.getElementById("modalMessage");
                    modalMessage.textContent = `Waktunya konsumsi obat: ${jadwal.obat.nama_obat}.`;
                    const reminderModal = new bootstrap.Modal(document.getElementById("reminderModal"));
                    reminderModal.show();
                }, waktuTunggu);
            }
        });
    });
</script>

@endsection

<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
    }

    .card-icon {
        background-color: #f1f1f1;
        border-radius: 50%;
        padding: 10px;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    .swiper-container {
        margin-top: 20px;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
        padding: 10px;
    }

    .swiper-slide a {
        width: 100%;
        text-decoration: none;
    }

    .swiper-slide .card {
        width: 100%;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .swiper-slide .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .swiper-slide .card-body {
        padding: 20px;
    }

    .swiper-slide .ps-3 {
        margin-left: 15px;
    }

    .swiper-slide .ps-3 h6 {
        font-size: 1rem;
        font-weight: bold;
    }

    .swiper-slide .ps-3 p {
        margin-top: 5px;
        font-size: 0.875rem;
        color: #555;
    }
</style>
