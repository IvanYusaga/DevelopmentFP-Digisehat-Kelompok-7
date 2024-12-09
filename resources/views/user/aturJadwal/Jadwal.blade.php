@extends('mainUser')

@section('title', 'Jadwal Obat')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Berikut Jadwal Obat Kamu</h1>
        <a href="{{ route('jadwalPengingat.form') }}">
            <button type="button" class="btn btn-info rounded-pill text-white">Tambah</button>
        </a>
    </div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow-sm border-0 rounded-3">
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

<script>
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
</main>
@endsection
