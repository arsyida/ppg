<div class="login-wrapper">
        <div class="card login-card shadow-lg" style="max-width: 450px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold mt-3">Admin Panel Login</h1>
                    <p class="text-muted">PPG FKIP Universitas Lampung</p>
                </div>
                <form method="POST" action="auth.php">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>