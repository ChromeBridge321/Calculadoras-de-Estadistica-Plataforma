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
    <title>StatSolver - Inicio</title>
    <link rel="icon" type="images/png" href="https://calculadoras-de-estadistica-plataforma.onrender.com/images/logo.png">
    <style>
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .font-dmsans { font-family: 'DM Sans', sans-serif; }
        .hero-glow {
            position: absolute;
            top: -30%; right: -20%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(222, 17, 65, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #DE1141, #FF2D55);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .feature-card:hover::before { opacity: 1; }
    </style>
</head>

<body class="font-dmsans bg-white text-gray-900 overflow-x-hidden">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/85 backdrop-blur-xl border-b border-black/8 transition-all duration-300 py-3" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <a href="/" class="flex items-center gap-3 no-underline">
                    <img src="{{ asset('images/logo.png') }}" alt="StatSolver" class="rounded-lg" style="width: 44px; height: 44px; object-fit: cover;">
                    <span class="font-outfit font-bold text-xl text-gray-900">StatSolver</span>
                </a>

                <div class="flex items-center" id="navMenu">
                    <a href="{{ url('/list') }}" class="bg-red-600 hover:bg-red-700 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-red-600/15 transition-all duration-300 px-4 py-2 text-white no-underline rounded-lg font-semibold">Empezar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="min-h-screen flex items-center relative pt-20 overflow-hidden">
        <div class="hero-glow"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center max-lg:flex-col max-lg:text-center">
                <div class="w-1/2 max-lg:w-full">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 bg-gray-50 border border-black/8 px-4 py-2 rounded-full text-xs text-gray-600">
                            <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                            Plataforma de Estadisticas
                        </div>
                    </div>

                    <h1 class="font-outfit font-extrabold text-5xl lg:text-7xl leading-tight tracking-tight mb-6">
                        Resuelve problemas de<br>
                        <span class="text-red-600">probabilidad y estadistica</span>
                    </h1>

                    <p class="text-gray-600 text-lg leading-relaxed max-w-lg mb-8">
                        Aprende y resuelve los conceptos mas comunes en probabilidad y estadistica
                        con nuestras calculadoras interactivas.
                    </p>

                    <div class="flex gap-4 flex-wrap mb-10">
                        <a href="{{ url('/list') }}" class="bg-red-600 hover:bg-red-700 hover:-translate-y-1 hover:shadow-xl hover:shadow-red-600/15 transition-all duration-300 px-6 py-3.5 text-white no-underline rounded-lg font-semibold inline-flex items-center gap-2">
                            Ver calculadoras
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <div class="bg-gray-50 border border-black/8 p-4 rounded-2xl">
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <div class="font-outfit font-bold text-2xl text-red-600">12+</div>
                                <div class="text-xs text-gray-500 mt-1 uppercase tracking-wider">Calculadoras</div>
                            </div>
                            <div class="border-x border-black/8">
                                <div class="font-outfit font-bold text-2xl text-red-600">100%</div>
                                <div class="text-xs text-gray-500 mt-1 uppercase tracking-wider">Gratis</div>
                            </div>
                            <div>
                                <div class="font-outfit font-bold text-2xl text-red-600">24/7</div>
                                <div class="text-xs text-gray-500 mt-1 uppercase tracking-wider">Disponible</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-1/2 max-lg:w-full text-center max-lg:mt-10 relative">
                    <img src="{{ asset('images/studing.png') }}" alt="Estudiante" class="max-h-[450px] w-auto inline-block">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <div class="text-red-600 text-xs font-semibold uppercase tracking-[0.15em] mb-2">Funcionalidades</div>
                <h2 class="text-4xl font-bold tracking-tight mb-4">Todo lo que necesitas para aprender</h2>
                <p class="text-gray-600 max-w-md mx-auto">Herramientas diseñadas para simplificar los conceptos estadisticos mas complejos.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <div class="bg-white border border-black/8 rounded-2xl p-6 h-full relative overflow-hidden transition-all duration-400 hover:-translate-y-1.5 hover:border-red-600/30 hover:shadow-2xl hover:shadow-black/8 feature-card">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4 bg-red-600/10 text-red-600">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Medidas de Tendencia Central</h3>
                        <p class="text-gray-600 leading-relaxed">Calcula media, mediana y moda de forma rapida. Aprende el paso a paso de cada operacion.</p>
                    </div>
                </div>

                <div>
                    <div class="bg-white border border-black/8 rounded-2xl p-6 h-full relative overflow-hidden transition-all duration-400 hover:-translate-y-1.5 hover:border-violet-500/30 hover:shadow-2xl hover:shadow-black/8 feature-card">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4 bg-violet-500/10 text-violet-500">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Tablas de Frecuencia</h3>
                        <p class="text-gray-600 leading-relaxed">Genera tablas de distribucion de frecuencias agrupadas y no agrupadas.</p>
                    </div>
                </div>

                <div>
                    <div class="bg-white border border-black/8 rounded-2xl p-6 h-full relative overflow-hidden transition-all duration-400 hover:-translate-y-1.5 hover:border-emerald-500/30 hover:shadow-2xl hover:shadow-black/8 feature-card">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4 bg-emerald-500/10 text-emerald-500">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 8l-4 4-4-4"/><path d="M16 16l-4-4-4 4"/></svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Medidas de Posicion</h3>
                        <p class="text-gray-600 leading-relaxed">Obten cuartiles, deciles y percentiles con explicaciones detalladas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t border-black/8 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center max-md:flex-col max-md:gap-4">
                <div class="max-md:text-center">
                    <img src="{{ asset('images/logo2.png') }}" alt="StatSolver" class="max-w-[140px] opacity-70">
                </div>
                <div class="max-md:text-center">
                    <p class="text-gray-500 text-sm">&copy; 2026 StatSolver. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('py-2');
                navbar.classList.remove('py-3');
            } else {
                navbar.classList.add('py-3');
                navbar.classList.remove('py-2');
            }
        });
    </script>
</body>

</html>
