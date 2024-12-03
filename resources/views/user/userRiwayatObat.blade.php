@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="container">
        <div class="progress-grid" id="progressGrid"></div>

        <div class="list-container">
            <div class="filter-buttons">
                <button class="filter-button active">Semua</button>
                <button class="filter-button">Selesai</button>
                <button class="filter-button">Belum</button>
            </div>
            <div id="medList"></div>
        </div>
    </div>
@endsection

@section('content')
<script>
    // Data obat
    const medications = [
        {
            id: 1,
            name: 'Vitamin A',
            dosage: '1 Tablet',
            frequency: 2,
            duration: 10,
            takenDoses: 9,
            schedule: ['08:00', '12:00', '20:00']
        },
        {
            id: 2,
            name: 'Paracetamol',
            dosage: '1 Tablet',
            frequency: 2,
            duration: 10,
            takenDoses: 15,
            schedule: ['08:00', '20:00']
        },
        {
            id: 3,
            name: 'Amoxicillin',
            dosage: '1 Tablet',
            frequency: 2,
            duration: 10,
            takenDoses: 20,
            schedule: ['08:00', '20:00']
        },
        {
            id: 4,
            name: 'Ibuprofen',
            dosage: '1 Tablet',
            frequency: 2,
            duration: 10,
            takenDoses: 4,
            schedule: ['08:00', '12:00', '16:00', '20:00']
        }
    ];

    // Membuat daftar obat dengan dropdown jadwal
    function createMedicationList() {
        const medList = document.getElementById('medList');
        medList.innerHTML = ''; // Reset daftar obat

        medications.forEach(med => {
            const totalDoses = med.frequency * med.duration;

            const listItem = document.createElement('div');
            listItem.className = 'med-list-item';

            // Bagian detail obat
            const medDetails = document.createElement('div');
            medDetails.className = 'med-details';
            medDetails.innerHTML = `
                <p><strong>${med.name}</strong></p>
                <p>${med.dosage}</p>
            `;

            // Dropdown jadwal
            const dropdown = document.createElement('div');
            dropdown.className = 'dropdown';

            dropdown.innerHTML = `
            <div class="dropdown">
                <button type="button" class="btn btn-info dropdown-btn">
                    <i class="bi bi-info-circle"></i> Cek Jadwal
                </button>
                <ul class="dropdown-content">
                    ${med.schedule
                        .map(
                            (time, index) =>
                                `<li>
                                    <span>${time}</span>
                                    <a class="btn btn-sm btn-outline-primary mark-done-btn" data-med-id="${med.id}" data-time-index="${index}">
                                        <i class="bi bi-check-circle"></i> Selesai
                                    </a>
                                </li>`
                        )
                        .join('')}
                </ul>
            </div>
            `;

            // Bagian status obat (9/20 Obat)
            const status = document.createElement('span');
            status.className = 'status';
            status.innerText = `${med.takenDoses}/${totalDoses} Obat`;

            // Gabungkan elemen-elemen ke dalam list item
            listItem.appendChild(medDetails);
            listItem.appendChild(status);
            listItem.appendChild(dropdown);

            // Tambahkan list item ke daftar utama
            medList.appendChild(listItem);
        });

        // Event listener untuk tombol selesai (Edit)
        document.querySelectorAll('.mark-done-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const medId = event.target.dataset.medId;
                const timeIndex = event.target.dataset.timeIndex;

                alert(`Obat ID: ${medId}, Jadwal index: ${timeIndex} selesai.`);
                // Logika backend atau update UI bisa ditambahkan di sini
            });
        });

        // Event listener untuk tombol dropdown
        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const dropdownContent = event.target.nextElementSibling;
                dropdownContent.classList.toggle('show');
            });
        });
    }

    // Inisialisasi saat DOM sudah siap
    document.addEventListener('DOMContentLoaded', () => {
        createMedicationList();
    });
</script>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .list-container {
        background: #f9fafb;
        border-radius: 8px;
        padding: 20px;
    }

    .filter-buttons {
        margin-bottom: 20px;
    }

    .filter-button {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        margin-right: 10px;
        cursor: pointer;
        font-weight: 500;
    }

    .filter-button.active {
        background: #dbeafe;
        color: #1a56db;
    }

    .filter-button:not(.active) {
        background: transparent;
        color: #666;
    }

    .med-list-item {
        background: white;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .med-details {
        flex: 1;
    }

    .status {
        color: #1a56db;
        font-weight: bold;
        margin-left: 10px;
    }

    .dropdown {
        margin-top: 10px;
        width: 100%;
    }

    .dropdown-content {
        display: none;
        background-color: #f9f9f9;
        margin-top: 10px;
        padding: 10px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dropdown-content.show {
        display: block;
    }

    .dropdown-content li {
        list-style: none;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dropdown-content li span {
        font-size: 14px;
    }

    .dropdown-content li a {
        margin-left: auto;
    }

</style>
</main>
@endsection
