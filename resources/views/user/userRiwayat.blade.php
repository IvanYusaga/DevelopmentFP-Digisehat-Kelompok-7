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
        // Data obat dan perhitungan progress
        const medications = [
            {
                id: 1,
                name: 'Vitamin A',
                dosage: '1 Tablet',
                frequency: 2,
                duration: 10,
                takenDoses: 9,
                schedule: ['08:00', '20:00']
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
                schedule: ['08:00', '20:00']
            }
        ];

        // Membuat daftar obat
         function createMedicationList() {
            const medList = document.getElementById('medList');

            medications.forEach(med => {
                const totalDoses = med.frequency * med.duration;
                const listItem = document.createElement('div');
                listItem.className = 'med-list-item';
                listItem.innerHTML = `
                    <div class="med-details">
                        <p>${med.name}</p>
                        <p>${med.schedule.join(' & ')}</p>
                        <p>${med.dosage}</p>
                    </div>
                    <span class="status">${med.takenDoses}/${totalDoses} Obat</span>
                `;
                medList.appendChild(listItem);
            });
        }

        // Inisialisasi
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
    </main>
@endsection
