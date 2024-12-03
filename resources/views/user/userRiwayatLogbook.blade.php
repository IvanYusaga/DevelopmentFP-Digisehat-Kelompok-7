@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Riwayat Logbook Kamu...</h1>
            <br>
        </div>

        <div style="display: flex; align-items: center;">
            <div>
                <img src="{{asset('style/assets/img/Logbook_logo.png')}}" alt="Doctor Illustration" width="350">
            </div>
            <div style="margin-left: 20px;">
                <h5 class="text-primary text-center">Jalani pengobatan dengan disiplin. Lihat perubahan positif
                    pada kesehatan Anda melalui lembar progres minum obat.</h4>
            </div>
        </div>

@endsection

@section('content')
    <div class="container">
        <div class="progress-grid" id="progressGrid"></div>

        <div class="list-container">
            <div id="medList"></div>
        </div>
    </div>
<script>
    // Data obat dan perhitungan progress
    const medications = [
        {
            id: 5,
            name: 'Vitamin B',
            dosage: '1 Tablet',
            frequency: 3,
            duration: 5,
            takenDoses: 10,
        },
        {
            id: 2,
            name: 'Paracetamol',
            dosage: '1 Tablet',
            frequency: 2,
            duration: 10,
            takenDoses: 15,
        },
        {
            id: 3,
            name: 'Amoxicillin',
            dosage: '1 Tablet',
            frequency: 2,
            duration: 10,
            takenDoses: 20,
        },
        {
            id: 4,
            name: 'Ibuprofen',
            dosage: '1 Tablet',
            frequency: 2,
            duration: 10,
            takenDoses: 4,
        }
    ];

    // Fungsi untuk menghitung persentase progress
    function calculateProgress(medication) {
                const totalDoses = medication.frequency * medication.duration;
                return Math.round((medication.takenDoses / totalDoses) * 100);
    }

    // Membuat doughnut chart untuk setiap obat
    function createMedicationCards() {
            const progressGrid = document.getElementById('progressGrid');

            medications.forEach(med => {
                const progress = calculateProgress(med);
                const totalDoses = med.frequency * med.duration;

                const card = document.createElement('div');
                card.className = 'progress-card';

                const chartContainer = document.createElement('div');
                chartContainer.className = 'progress-chart';
                const canvas = document.createElement('canvas');
                chartContainer.appendChild(canvas);

                card.innerHTML += `
                    <div class="med-info">
                        <p>Nama Obat</p>
                        <p>${med.name}</p>
                    </div>
                    <div class="med-info">
                        <p>Dosis</p>
                        <p>${med.dosage} (${med.takenDoses}/${totalDoses} Obat)</p>
                    </div>
                `;

                card.insertBefore(chartContainer, card.firstChild);
                progressGrid.appendChild(card);

                // Membuat chart menggunakan Chart.js
                new Chart(canvas, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [progress, 100 - progress],
                            backgroundColor: ['#1a56db', '#e5e7eb'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        cutout: '75%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // Menambahkan teks persentase di tengah
                const percentText = document.createElement('div');
                percentText.style.position = 'absolute';
                percentText.style.top = '50%';
                percentText.style.left = '50%';
                percentText.style.transform = 'translate(-50%, -50%)';
                percentText.style.fontSize = '24px';
                percentText.style.fontWeight = 'bold';
                percentText.textContent = `${progress}%`;
                chartContainer.appendChild(percentText);
            });
        }

    // Inisialisasi
        document.addEventListener('DOMContentLoaded', () => {
            createMedicationCards();
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

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .header p {
            color: #1a56db;
            font-weight: 500;
        }

        .progress-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .progress-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .progress-chart {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            position: relative;
        }

        .med-info {
            background: #f3f4f6;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
        }

        .med-info p:first-child {
            color: #666;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .med-info p:last-child {
            font-weight: 600;
            color: #333;
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
            align-items: center;
        }

        .med-list-item .med-details p:first-child {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .med-list-item .med-details p:not(:first-child) {
            color: #666;
            font-size: 14px;
        }

        .status {
            color: #1a56db;
        }
    </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</main>
@endsection
