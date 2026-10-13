<?php


session_start();

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Admin_email = $_POST['email'];
    $Admin_password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM admin_login 
         WHERE email = '$Admin_email' 
         AND PASSWORD = '$Admin_password'"
    );

    if (mysqli_num_rows($result) > 0) {

        // Create session
        $_SESSION['Admin_email'] = $Admin_email;

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit;

    } else {

        echo "<script>
                alert('Enter Valid Information');
                window.location.href = 'login.php';
              </script>";
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Granite State Misfits</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/login.css" rel="stylesheet">
</head>


<body>

    <div class="container-xxl position-relative d-flex p-0 login-wrapper">

        <!-- Sign In Start -->
        <div class="container-fluid">

            <div class="row h-100 align-items-center justify-content-center"
                style="min-height: 100vh;">

                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">

                    <div class="login-card p-4 p-sm-5 my-4 mx-3">

                        <!-- Logo / Brand -->
                        <div class="text-center mb-4">

                            <div class="brand-icon">
                                <i class="fa-solid fa-motorcycle"></i>
                            </div>

                            <h2 class="brand-name">
                                Granite State Misfits
                            </h2>

                            <p class="brand-subtitle">
                                Motorcycle Riding Club
                            </p>

                            <div class="admin-heading">
                                <h5>Admin Panel</h5>
                                <span>Sign in to manage your rides</span>
                            </div>

                        </div>


                        <!-- Login Form -->
                        <form action="" method="post">

                            <!-- Email -->
                            <div class="form-floating mb-3">

                                <input
                                    type="email"
                                    class="form-control"
                                    id="floatingInput"
                                    placeholder="name@example.com"
                                    name="email"
                                    required>

                                <label for="floatingInput">
                                    Email address
                                </label>

                            </div>


                            <!-- Password -->
                            <div class="form-floating mb-4">

                                <input
                                    type="password"
                                    class="form-control"
                                    id="floatingPassword"
                                    placeholder="Password"
                                    name="password"
                                    required>

                                <label for="floatingPassword">
                                    Password
                                </label>

                            </div>


                            <!-- Sign In -->
                            <button
                                type="submit"
                                class="btn login-btn py-3 w-100">

                                <i class="fa-solid fa-right-to-bracket me-2"></i>
                                Sign In

                            </button>

                        </form>


                        <!-- Footer -->
                        <div class="login-footer">

                            <span>
                                Granite State Misfits
                            </span>

                            <small>
                                Admin Dashboard © 2026
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- Sign In End -->

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
</html>