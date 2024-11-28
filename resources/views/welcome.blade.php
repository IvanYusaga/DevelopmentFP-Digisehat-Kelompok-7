<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Landing Page Pengingat Obat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('/style/assets/img/logo.jpg') }}" type="image/png">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('style/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Link to Bootstrap 5 CSS -->
    <link href="{{asset('style/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #cfdde6, #fff, #cfdde6);
            color: #333;
        }

        .container-fluid {
            overflow: hidden;
            animation: fadeIn 2s ease-in-out;
        }

        .img-fluid {
            transform: scale(0.9);
            transition: transform 0.5s ease-in-out;
        }

        .typewriter {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(45deg, #1e90ff, #00d4ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Animations */
        @keyframes bounce {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeInText {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        p {
            font-size: 1.1rem;
            line-height: 1.8;
            opacity: 0.9;
            animation: fadeInText 1.5s ease-in;
        }

        .btn-primary {
            padding: 14px 35px;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            transition: all 0.4s ease;
        }

           .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(179, 201, 219, 0.5);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .typewriter {
                font-size: 2rem;
            }

            p {
                font-size: 0.95rem;
            }

            .btn-primary {
                padding: 12px 25px;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Landing Page Section -->
    <div class="container container-fluid d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 align-items-center text-center">
            <!-- Column for Image -->
            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                <img src="{{ asset('/style/assets/img/logo-nobg.png') }}" alt="Pengingat Obat" class="img-fluid rounded-3 animated-image">
            </div>
            <!-- Column for Content -->
            <div class="col-lg-7 text-center">
                <!-- Typing Effect -->
                <h1 class="typewriter">
                    <span id="typewriter-text"></span>
                    <i class="bi bi-pen fs-2" id="pen-icon"></i>
                </h1>
                <p class="lead mt-4 fw-semibold">Solusi kesehatan digital yang memastikan Anda tidak melewatkan satu dosis pun. Medipulse membantu mengelola jadwal konsumsi obat dengan mudah dan teratur, dari pengingat harian hingga catatan kesehatan Anda.</p>
                <p class="fst-italic text-highlight mb-5 text-primary">Bantu jaga kesehatan Anda, kapan saja, di mana saja, dengan cara yang aman dan praktis!</p>
                <a href="{{ route('login.view') }}" class="btn btn-primary btn-lg">Masuk</a>
            </div>
        </div>
    </div>

    <script>
        // JavaScript Typing Effect
        const textElement = document.getElementById('typewriter-text');
        const penIcon = document.getElementById('pen-icon');
        const textToType = "Selamat datang di Medipulse!";
        let index = 0;

        function typeEffect() {
            if (index < textToType.length) {
                textElement.innerHTML += textToType.charAt(index);
                index++;
                setTimeout(typeEffect, 100); // Adjust speed here
            } else {
                // Hilangkan ikon setelah penulisan selesai
                setTimeout(() => {
                    penIcon.style.opacity = '0'; // Fade out
                }, 100); // Delay sedikit untuk lebih halus
            }
        }

        // Mulai efek penulisan saat halaman dimuat
        window.onload = typeEffect;
    </script>

    <!-- Link to Bootstrap 5 JS Bundle -->
    <script src="{{ asset('style/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
