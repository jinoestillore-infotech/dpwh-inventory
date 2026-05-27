<form action="./backend/register.php" method="POST">

    <div class="py-4">

        <div class="text-center mb-4">
            <h4 class="fw-bold text-uppercase">Create Account</h4>
            <p class="text-muted small">Register new system user</p>
        </div>

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

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-check-circle" style="color: rgb(218, 144, 9)"></i>
            </span>
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
        </div>

        <button class="btn btn-main w-100 py-2">
            REGISTER ACCOUNT
        </button>

        <p class="text-center mt-4 small fw-bold text-secondary">
            <a href="index.php?form=login" class="text-decoration-none">
                RETURN TO LOGIN
            </a>
        </p>

    </div>

</form>