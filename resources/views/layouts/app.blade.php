<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Calculadoras</title>
    <link rel="icon" type="images/png" href="https://calculadoras-de-estadistica-plataforma.onrender.com/images/logo.png">
    <style>
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .font-dmsans { font-family: 'DM Sans', sans-serif; }
        .accordion-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease;
            opacity: 0;
        }
        .accordion-body.open {
            max-height: 500px;
            opacity: 1;
        }
        .sidebar-backdrop {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .sidebar-backdrop.active {
            opacity: 1;
            visibility: visible;
        }
        .sidebar-mobile {
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-mobile.active {
            transform: translateX(0);
        }
        @media (max-width: 640px) {
            .sidebar-mobile {
                width: min(280px, 85vw);
            }
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   function validarInput(event) {
    const input = event.target;
    const valor = input.value;
    if (!/^[0-9,\.]*$/.test(valor)) {
        input.value = valor.slice(0, -1);
        return;
    }
    if (valor.includes(",,")) {
        input.value = valor.replace(",,", ",");
        return;
    }
    if (valor.includes("..")) {
        input.value = valor.replace("..", ".");
        return;
    }
    if (valor.startsWith(",")) {
        input.value = valor.slice(1);
        return;
    }
    if (valor.startsWith(".")) {
        input.value = valor.slice(1);
        return;
    }
}
function validateInput() {
    const inputField = document.getElementById('inputField');
    let value = inputField.value;
    value = value.replace(/[^a-zA-Z, ]/g, '');
    if (value.charAt(0) === ',' || value.charAt(0) === ' ') {
        value = value.slice(1);
    }
    value = value.replace(/,{2,}/g, ',');
    value = value.replace(/ {2,}/g, ' ');
    value = value.replace(/, /g, ',');
    value = value.replace(/ ,/g, ',');
    inputField.value = value;
}
</script>

<body class="font-dmsans bg-gray-50 text-gray-900">
    <!-- Navbar -->
    <nav class="bg-red-600 py-3 px-4 sm:px-6 flex items-center justify-between fixed top-0 left-0 right-0 z-40 shadow-lg shadow-red-600/10">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 sm:gap-3 no-underline shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="StatSolver" class="rounded-lg shrink-0" style="width: 40px; height: 40px; object-fit: cover;">
            <span class="font-outfit font-bold text-base sm:text-lg text-white">StatSolver</span>
        </a>
        <button onclick="toggleSidebar()" class="lg:hidden text-white p-2 -mr-2 rounded-lg hover:bg-white/10 transition-colors" aria-label="Abrir menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </nav>

    <div class="flex min-h-screen pt-[56px] sm:pt-[60px]">
        <!-- Backdrop mobile -->
        <div onclick="toggleSidebar()" class="sidebar-backdrop fixed inset-0 bg-black/50 z-40 lg:hidden" id="backdrop"></div>

        <!-- Sidebar desktop -->
        <aside class="hidden lg:block w-72 bg-white border-r border-gray-200 shrink-0 overflow-y-auto">
            <div class="p-4">
                @include('partials._sidebar-nav')
            </div>
        </aside>

        <!-- Sidebar mobile -->
        <aside class="sidebar-mobile fixed top-0 left-0 w-72 h-full bg-white border-r border-gray-200 z-50 lg:hidden overflow-y-auto" id="sidebarMobile">
            <div class="flex items-center justify-between p-4 pb-2 border-b border-gray-100">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 no-underline">
                    <img src="{{ asset('images/logo.png') }}" alt="StatSolver" class="rounded-lg" style="width: 36px; height: 36px; object-fit: cover;">
                    <span class="font-outfit font-bold text-base text-gray-900">StatSolver</span>
                </a>
                <button onclick="toggleSidebar()" class="p-2 -mr-2 rounded-lg hover:bg-gray-100 transition-colors text-gray-500" aria-label="Cerrar menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-4">
                @include('partials._sidebar-nav')
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 min-w-0 p-3 sm:p-5 lg:p-6 overflow-x-hidden">
            @yield('Content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebarMobile').classList.toggle('active');
            document.getElementById('backdrop').classList.toggle('active');
        }

        function toggleSection(button) {
            const body = button.nextElementSibling;
            const icon = button.querySelector('.accordion-icon');
            const isOpen = body.classList.contains('open');

            document.querySelectorAll('.accordion-body').forEach(el => {
                el.classList.remove('open');
            });
            document.querySelectorAll('.accordion-icon').forEach(el => {
                el.style.transform = 'rotate(0deg)';
            });

            if (!isOpen) {
                body.classList.add('open');
                icon.style.transform = 'rotate(180deg)';
            }
        }
    </script>
</body>

</html>
