<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /tugas-sig/src/auth/login.php");
}
require('../../databases/connection.php');
// get all data from table
$query = "SELECT * FROM `markers`";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    delete($id);
    header("Location: /tugas-sig/src/dashboard/index.php");
}
// create function delete with given id
function delete($id)
{
    global $conn;
    $query = "DELETE FROM `markers` WHERE id = $id";
    $result = $conn->query($query);
    return $result;
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body class="font-inter">
    <!-- ========== HEADER ========== -->
    <header
        class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 sm:py-4 lg:ps-64">
        <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6" aria-label="Global">
            <div class="me-5 lg:me-0 lg:hidden">
                <!-- Logo -->
                <a class="flex-none rounded-xl text-xl inline-block font-bold focus:outline-none focus:opacity-80"
                    href="../templates/admin/index.html" aria-label="Preline">
                    Adza
                </a>
                <!-- End Logo -->
            </div>

            <div class="w-full flex items-center justify-end ms-auto sm:justify-between sm:gap-x-3 sm:order-3">
                <div class="sm:hidden">
                    <button type="button"
                        class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </button>
                </div>

                <div class="hidden sm:block">
                    <label for="icon" class="sr-only">Search</label>
                    <div class="relative min-w-72 md:min-w-80">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                            <svg class="flex-shrink-0 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </div>
                        <input type="text" id="icon" name="icon"
                            class="py-2 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Search">
                    </div>
                </div>
                <div class="flex flex-row items-center justify-end gap-2">
                    <button type="button"
                        class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                        </svg>
                    </button>
                    <button type="button"
                        class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-offcanvas="#hs-offcanvas-right">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                        </svg>
                    </button>

                    <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                        <button id="hs-dropdown-with-header" type="button"
                            class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
                            <img class="inline-block size-[38px] rounded-full ring-2 ring-white"
                                src="/tugas-sig/src/assets/images/profile.JPG" alt="Image Description">
                        </button>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2"
                            aria-labelledby="hs-dropdown-with-header">
                            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
                                <p class="text-sm text-gray-500">Signed in as</p>
                                <p class="text-sm font-medium text-gray-800">james@site.com</p>
                            </div>
                            <div class="mt-2 py-2 first:pt-0 last:pb-0">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                                    href="#">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                                    </svg>
                                    Newsletter
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                                    href="#">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                        <path d="M3 6h18" />
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                    Purchases
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                                    href="#">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242" />
                                        <path d="M12 12v9" />
                                        <path d="m8 17 4 4 4-4" />
                                    </svg>
                                    Downloads
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                                    href="#">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                    Team Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <!-- Breadcrumb -->
    <div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden">
        <div class="flex justify-between items-center py-2">
            <!-- Breadcrumb -->
            <ol class="ms-3 flex items-center whitespace-nowrap">
                <li class="flex items-center text-sm text-gray-800">
                    Application Layout
                    <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16"
                        viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </li>
                <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
                    <a href="/tugas-sig/src/dashboard/index.php">
                        Dashboard
                    </a>
                </li>
                <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
                    <a href="/tugas-sig/src/auth/logout.php">
                        Logout
                    </a>
                </li>
            </ol>
            <!-- End Breadcrumb -->

            <!-- Sidebar -->
            <button type="button"
                class="py-2 px-3 flex justify-center items-center gap-x-1.5 text-xs rounded-lg border border-gray-200 text-gray-500 hover:text-gray-600"
                data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Sidebar">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M17 8L21 12L17 16M3 12H13M3 6H13M3 18H13" />
                </svg>
                <span class="sr-only">Sidebar</span>
            </button>
            <!-- End Sidebar -->
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Sidebar -->
    <div id="application-sidebar"
        class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-[260px] hidden fixed inset-y-0 start-0 z-[60] bg-white border-e border-gray-200 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0">
        <div class="px-8 pt-4">
            <!-- Logo -->
            <a class="flex-none rounded-xl text-xl inline-block font-bold focus:outline-none focus:opacity-80"
                href="../templates/admin/index.html" aria-label="Preline">
                Adza
            </a>
            <!-- End Logo -->
        </div>

        <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
            <ul class="space-y-1.5">
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 bg-gray-100 text-sm text-neutral-700 rounded-lg hover:bg-gray-100"
                        href="/tugas-sig/src/dashboard/index.php">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
                    <a href="/tugas-sig/src/auth/logout.php">
                        Logout
                    </a>
                </li>

            </ul>
        </nav>
    </div>
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
                <p class="text-sm text-gray-500">Welcome, <b>Adza</b>!</p>
            </div>
            <div>
                <!-- Table Section -->
                <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    <!-- Card -->
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                                    <!-- Header -->
                                    <div
                                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                                        <div>
                                            <h2 class="text-xl font-semibold text-gray-800">
                                                Webgis
                                            </h2>
                                            <p class="text-sm text-gray-600">
                                                Create new data.
                                            </p>
                                        </div>
                                        <div>
                                            <a href="/tugas-sig/src/dashboard/add.php"
                                                class="w-full px-6 py-3 bg-purple-600 rounded-xl text-white">
                                                Tambah Data
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Header -->

                                    <!-- Table -->
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <a class="group inline-flex items-center gap-x-2" href="#">
                                                        <span
                                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                            #
                                                        </span>

                                                    </a>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <a class="group inline-flex items-center gap-x-2" href="#">
                                                        <span
                                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                            Nama
                                                        </span>

                                                    </a>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <span
                                                        class="block w-full whitespace-nowrap text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                        Koordinat (lat, lng)
                                                    </span>

                                                </th>


                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <a class="group inline-flex items-center gap-x-2" href="#">
                                                        <span
                                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                            Deskripsi
                                                        </span>
                                                    </a>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <a class="group inline-flex items-center gap-x-2" href="#">
                                                        <span
                                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                            Gambar
                                                        </span>
                                                    </a>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-end"></th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200">
                                            <!-- looping from mysql assoc -->
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) { ?>
                                            <tr class="bg-white hover:bg-gray-50">
                                                <td class="size-px whitespace-nowrap">
                                                    <div class="px-6 py-2">
                                                        <div
                                                            class="block text-sm text-blue-600 decoration-2 hover:underline">
                                                            <?= $row['id'] ?>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="size-px whitespace-nowrap">
                                                    <div class="px-6 py-2">
                                                        <span
                                                            class="inline-flex gap-1.5 py-1 px-2 rounded-lg text-xs font-medium bg-gray-100 text-gray-800">
                                                            <?= $row['name'] ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="size-px whitespace-nowrap">
                                                    <div class="px-6 py-2">
                                                        <span
                                                            class="inline-flex gap-1.5 py-1 px-2 rounded-lg text-xs font-medium bg-gray-100 text-gray-800">
                                                            <?= $row['latitude'] ?>, <?= $row['longitude'] ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="h-px w-72 min-w-72">
                                                    <div class="px-6 py-2">
                                                        <p class="text-sm text-gray-500">
                                                            <?= $row['description'] ?>
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="size-px whitespace-nowrap">
                                                    <img class="inline-block size-16 rounded-full ring-2 ring-white object-cover"
                                                        src="/tugas-sig/src/assets/images/<?= $row['image'] ?>"
                                                        alt="<?= $row['name'] ?>">
                                                </td>
                                                <td class="size-px whitespace-nowrap flex gap-x-2">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <button type="submit">Delete</button>
                                                    </form>
                                                    <a
                                                        href="/tugas-sig/src/dashboard/edit.php?id=<?= $row['id'] ?>">Edit</a>
                                                </td>
                                            </tr>

                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                    <!-- End Table -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Table Section -->
            </div>
        </div>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
    <script src="/tugas-sig/node_modules/preline/dist/preline.js"></script>
</body>

</html>