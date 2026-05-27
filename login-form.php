<form action="./backend/login.php" method="POST">

    <div class="py-4">

        <div class="text-center mb-4">
            <span class="fs-2">
                <i class="bi bi-shield-check text-primary"></i>
            </span>

            <h4 class="fw-bold text-uppercase">DPWH IT Portal</h4>
            <p class="text-muted small fw-bold">Secure Asset Management</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-person-fill" style="color: rgb(55, 2, 90)"></i>
            </span>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-lock-fill" style="color: rgb(218, 144, 9)"></i>
            </span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-main w-100 py-2">LOGIN</button>

        <p class="text-center mt-4 small fw-bold text-primary">
            <a href="index.php?form=register" class="text-decoration-none">
                REGISTER NEW ACCOUNT
            </a>
        </p>

    </div>

</form>