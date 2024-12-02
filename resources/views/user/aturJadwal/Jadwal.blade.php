@extends('mainUser')

@section('title', 'Jadwal Obat')

@section('breadcrumbs')
    <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Berikut Jadwal Obat Kamu</h1>
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
        <div class="table-responsive">
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
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $jadwal->obat->nama_obat }}</td>
                        <td>{{$jadwal->tanggal_konsumsi}}</td>
                        <td>{{ $jadwal->waktu_pengingat }}</td>
                        <td>{{ $jadwal->caraPenggunaanObat }}</td>
                        <td>{{ $jadwal->frekuensi }} Kali Sehari</td>
                        <td class="badge text-danger border border-secondary fs-6">
                            <span class="badge bg-success text-wrap fs-6" data-bs-toggle="tooltip" title="Masih dalam jadwal">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        </td>
                        <td>
                            <!-- Button Hapus dengan konfirmasi -->
                            <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


 <!-- Modern Modal -->
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
        <img src="{{ asset('/style/assets/img/minumobat.png') }}" alt="Obat Icon" class="img-fluid shadow-lg" style="width: 100px;">
    </div>
    <h4 class="fw-bold text-primary text-gradient mb-3">Waktunya Minum Obat!</h4>
    <p id="modalMessage" class="text-muted fs-5 text-center">
        Jangan lupa konsumsi obat Anda tepat waktu untuk mendapatkan manfaat maksimal dan memastikan pemulihan yang lebih cepat. 
        Dengan mematuhi jadwal minum obat yang telah ditentukan, Anda membantu tubuh bekerja lebih efektif dalam melawan penyakit.
    </p>
    <p class="text-muted fs-6 text-center">
        Jika Anda memiliki pertanyaan terkait cara penggunaan obat atau efek samping yang mungkin timbul, segera hubungi dokter atau apoteker Anda. 
        Menjaga konsistensi dalam pengobatan adalah kunci untuk kesehatan jangka panjang!
    </p>
</div>

<!-- Modal Footer -->
<div class="modal-footer justify-content-center" style="background-color: #f8f9fa;">
    <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" data-bs-dismiss="modal">
        <i class="bi bi-check-circle me-2"></i> OK, Saya Ingat!!!
    </button>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Minta izin untuk notifikasi
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }

        // Data jadwal obat dari backend
        const jadwalPengingat = @json($jadwalPengingat);

        jadwalPengingat.forEach(jadwal => {
            const waktuPengingat = new Date(jadwal.tanggal_konsumsi + 'T' + jadwal.waktu_pengingat); // Format ISO

            // Hitung waktu sampai notifikasi
            const waktuSekarang = new Date();
            const waktuTunggu = waktuPengingat - waktuSekarang;

            if (waktuTunggu > 0) {
                setTimeout(() => {
                    // Kirim notifikasi
                    if (Notification.permission === "granted") {
                        new Notification("Pengingat Obat", {
                            body: `Waktunya konsumsi obat: ${jadwal.obat.nama_obat}. Jangan lupa, pengobatan yang teratur akan membantu Anda pulih lebih cepat!`,
                            icon: '{{ asset('/style/assets/img/logo.jpg') }}' // Ganti dengan path ikon notifikasi
                        });
                    }
                    // Tampilkan modal dengan pesan pengingat
                    const modalMessage = `Waktunya konsumsi obat: ${jadwal.obat.nama_obat}`;
                    document.getElementById('modalMessage').textContent = modalMessage;
                    // Gunakan Bootstrap modal untuk menampilkan modal
                    const myModal = new bootstrap.Modal(document.getElementById('reminderModal'));
                    myModal.show();
                }, waktuTunggu);
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll("tbody tr");
    
    rows.forEach(row => {
        const tanggal = row.querySelector("td:nth-child(3)").innerText; // Tanggal Konsumsi
        const waktu = row.querySelector("td:nth-child(4)").innerText; // Waktu Pengingat
        const statusCell = row.querySelector("td:nth-child(7)"); // Kolom Status

        const waktuPengingat = new Date(`${tanggal}T${waktu}`);
        const sekarang = new Date();

        if (waktuPengingat < sekarang) {
            statusCell.innerText = "Non Aktif"; // Ubah status secara dinamis
        }
    });
});

</script>
</main>
@endsection
