<div class="d-flex flex-column justify-content-center align-items-center mt-4 text-center">

    <a class="fw-bold text-decoration-none lh-0" href="#" style="color:#0280f5;">
        <span class="fs-3">DPWH</span>
    </a>

    <span class="text-light small">
        Information Technology Division
    </span>

</div>


<div class="text-white p-2 min-vh-100 mt-4">

    <ul class="nav flex-column">

        <li class="nav-item mb-2">
            <a href="../dashboard.php" class="nav-link text-light">
                <i class="bi bi-speedometer2 me-2"></i>
                Inventory
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="../assets/asset.php" class="nav-link text-light">
                <i class="bi bi-box-seam me-2"></i>
                Assets
            </a>
        </li>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>

        <li class="nav-item mb-2">
            <a href="../user/user_permissions.php" class="nav-link text-white">
                <i class="bi bi-shield-lock me-2"></i>
                User Permissions
            </a>
        </li>
        <?php } ?>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-danger">
                <i class="bi bi-people me-2"></i>
                System Logs
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="../../backend/logout.php" class="nav-link text-white">
                <i class="bi bi-people me-2"></i>
                Logout
            </a>
        </li>
    </ul>

</div>