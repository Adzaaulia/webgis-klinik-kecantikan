<?php
// start session
session_start();
require('../../databases/connection.php');
// cek session apakah ada atau tidak

if (isset($_SESSION['id'])) {
    header("Location: /tugas-sig/src/dashboard/index.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // hash password

    $stmt = $conn->prepare("SELECT * FROM tb_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        header("Location: /tugas-sig/src/dashboard/index.php");
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
        <div class="mt-7 bg-white border border-gray-300 rounded-xl shadow-sm">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800">Sign in</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Don't have an account yet?
                        <a class="text-blue-600 decoration-2 hover:underline font-medium" href="../examples/html/signup.html">
                            Sign up here
                        </a>
                    </p>
                </div>

                <div class="mt-5">
                    <!-- Form -->
                    <form class="space-y-4" action="" method="post">
                        <input type="hidden" name="login" value="login">
                        <div class="grid gap-y-4">
                            <!-- Form Group -->
                            <div>
                                <label for="email" class="block text-sm mb-2">Username</label>
                                <div class="relative">
                                    <input type="text" id="email" name="username" class="py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="email-error">
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
                                <div class="flex justify-between items-center">
                                    <label for="password" class="block text-sm mb-2">Password</label>
                                    <a class="text-sm text-blue-600 decoration-2 hover:underline font-medium" href="../examples/html/recover-account.html">Forgot password?</a>
                                </div>
                                <div class="relative">
                                    <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="password-error">
                                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                        <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign
                                in</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>