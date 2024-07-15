<?php
require('../databases/connection.php');
$query = "SELECT * FROM `markers`";
$result = $conn->query($query);
$markers = array();

if ($result->num_rows > 0) {
    // Fetch all data
    while ($row = $result->fetch_assoc()) {
        $markers[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/tugas-sig/src/assets/css/output.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body class="font-inter">
    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full py-7">
        <nav class="relative max-w-7xl w-full flex flex-wrap md:grid md:grid-cols-12 basis-full items-center px-4 md:px-6 md:px-8 mx-auto" aria-label="Global">
            <div class="md:col-span-3">
                <!-- Logo -->
                <a class="font-bold flex-none rounded-xl text-xl inline-block focus:outline-none focus:opacity-80" href="/tugas-sig/src/index.php" aria-label="Preline">
                    Adza
                </a>
                <!-- End Logo -->
            </div>

            <!-- Button Group -->
            <div class="flex items-center gap-x-2 ms-auto py-1 md:ps-6 md:order-3 md:col-span-3">
                <a href="/tugas-sig/src/auth/login.php" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-transparent bg-lime-400 text-black hover:bg-lime-500 transition disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-lime-500">
                    Login </a>
                <div class="md:hidden">
                    <button type="button" class="hs-collapse-toggle size-[38px] flex justify-center items-center text-sm font-semibold rounded-xl border border-gray-200 text-black hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- End Button Group -->

            <!-- Collapse -->
            <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block md:w-auto md:basis-auto md:order-2 md:col-span-6">
                <div class="flex flex-col gap-y-4 gap-x-0 mt-5 md:flex-row md:justify-center md:items-center md:gap-y-0 md:gap-x-7 md:mt-0">
                    <div>
                        <a class="relative inline-block text-black before:absolute before:bottom-0.5 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400" href="#" aria-current="page">Beranda</a>
                    </div>
                    <div>
                        <a class="inline-block text-black hover:text-gray-600" href="/tugas-sig/src/peta.php">Peta
                            Klinik</a>
                    </div>

                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    <div class="relative flex w-full">
        <div id="sidebar" data-state="close" class="left-2 -translate-x-96 top-28 fixed z-[99999999999] h-[80vh] w-96 bg-gray-100 border-2 border-gray-300 rounded-xl p-4 shadow-xl transition-all duration-300 overflow-auto">
        </div>

        <!-- ========== END HEADER ========== -->
        <!-- Hero -->
        <div id="map-id" class="h-screen w-full p-4"></div>
    </div>
    <!-- End Hero -->
    <script src="../node_modules/preline/dist/preline.js"></script>
    <script>
        // @-3.9848743,122.4546424
        var map = L.map('map-id').setView([-3.9848743, 122.4546424], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function createCustomIcon() {
            return L.icon({
                iconUrl: '/tugas-sig/src/assets/images/icon.png', // Ganti dengan jalur ke file PNG Anda
                iconSize: [40, 40], // Ukuran ikon
                iconAnchor: [20, 40], // Titik jangkar ikon, sesuai dengan titik di peta
                popupAnchor: [0, -40] // Titik jangkar popup, relatif terhadap ikon
            });
        }
        const data = <?= json_encode($markers); ?>;

        const sidebar = document.getElementById('sidebar');
        document.addEventListener('click', function(e) {
            if (e.target.id == 'close') {
                sidebar.classList.toggle('translate-x-0');
                sidebar.setAttribute('data-state', 'close');
            }
        })
        // Menambahkan marker ke peta
        data.forEach(function(item) {
            L.marker([item.latitude, item.longitude])
                .setIcon(createCustomIcon())
                .bindPopup(item.name)
                .on('click', function() {
                    const state = sidebar.getAttribute('data-state');
                    if (state == 'close') {
                        sidebar.classList.toggle('translate-x-0');
                        sidebar.setAttribute('data-state', 'open');
                    }
                    sidebar.innerHTML = `
                <div class="flex flex-col justify-center">
                <button id="close" class="sticky top-0 right-0">close</button>
                <img src="/tugas-sig/src/assets/images/${item.image}" alt="${item.name}" class="w-full object-cover">
                <h1 class="text-3xl font-bold">${item.name}</h1>
                <p class="text-sm text-justify mt-4">${item.description}</p>
                </div>
                
                `
                })
                .addTo(map);
        });
    </script>
</body>

</html>