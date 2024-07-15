<?php
// start session
require('../../databases/connection.php');
// cek session apakah ada atau tidak

if (isset($_SESSION['id'])) {
    header("Location: /tugas-sig/src/dashboard/index.php");
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // hash password

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO tb_users(username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: /tugas-sig/src/auth/login.php");
    } else {
        echo "<script>alert('Username atau Password Salah!')</script>";
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
</head>

<body>
    <div class="w-full md:w-1/3 lg:w-1/5 mx-auto h-screen items-center flex">
        <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800">Sign up</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Already have an account?
                        <a class="text-blue-600 decoration-2 hover:underline font-medium" href="../examples/html/signin.html">
                            Sign in here
                        </a>
                    </p>
                </div>

                <div class="mt-5">
                    <form class="space-y-4" action="" method="post">
                        <input type="hidden" name="register" value="register">
                        <div class="grid gap-y-4">
                            <!-- Form Group -->
                            <div>
                                <label for="username" class="block text-sm mb-2">Username</label>
                                <div class="relative">
                                    <input type="username" id="username" name="username" class="py-3 px-4 block w-full  border-2 border-gray-600 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="username-error">
                                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                        <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div>
                                <label for="password" class="block text-sm mb-2">Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-600 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="password-error">
                                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                        <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div>
                                <label for="confirm-password" class="block text-sm mb-2">Confirm Password</label>
                                <div class="relative">
                                    <input type="password" id="confirm-password" name="confirm-password" class="py-3 px-4 block w-full border border-gray-500 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="confirm-password-error">
                                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                        <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                            <!-- End Form Group -->
                            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign
                                up</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>