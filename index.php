<?php
$form = $_GET['form'] ?? 'login';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPWH IT — Portal Login</title>

    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/bootstrap-icon/bootstrap-icons.css">

    <style>
        :root {
            --dpwh-blue: #0038a8;
            --dpwh-red: #ce1126;
        }

        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at center, #1e293b, #0f172a);
        }

        .login-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 56, 168, 0.15) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 56, 168, 0.15) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-top: 6px solid var(--dpwh-blue);
            box-shadow: 0 25px 50px rgba(0, 0, 0, .4);
            border-radius: 18px;
        }

        .btn-main {
            background: var(--dpwh-blue);
            color: white;
            font-weight: 700;
            text-transform: uppercase;
        }

        .btn-main:hover {
            background: white;
            border: 1px solid var(--dpwh-blue);
        }
    </style>

</head>

<body>

    <div class="login-grid"></div>

    <div class="container-fluid">
        <div class="row min-vh-100 justify-content-center align-items-center px-3">
            <div class="col-lg-4">

                <div class="glass-card p-4">

                    <?php
                    if ($form === "register") {
                        include "register-form.php";
                    } else {
                        include "login-form.php";
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>

<script>
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        el.classList.remove('show');
        setTimeout(() => el.remove(), 500);
    });
}, 2000);
</script>

</body>

</html>