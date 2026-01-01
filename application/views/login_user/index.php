<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login_user.css') ?>">
</head>
<body>

    <div class="login-card">
        <div class="logo-box">
            <i class="fa-solid fa-shield-alt"></i> 
        </div>
        
        <h2>SINTA</h2>
        <p class="subtitle">Sistem Informasi Terpadu</p>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('loginuser/proses') ?>" method="POST" id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-user"></i>
                    <input type="email" id="email" name="email" placeholder="Masukkan email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock-open"></i> 
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Login ke Akun</button>
        </form>
        
        <div class="login-footer" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
            <p style="font-size: 13px; color: #6b7280; margin-bottom: 8px;">
                Login sebagai <a href="<?= base_url('login') ?>" style="color: #131b2e; text-decoration: none; font-weight: 500;">Administrator</a>
            </p>
        </div>
    </div>

    <div class="footer-text">
        &copy; 2025 SINTA. All rights reserved.
    </div>

    <script>
        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            });
        }, 5000);

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                // Create error alert
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-error';
                alertDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> Email dan password harus diisi';
                
                const form = document.getElementById('loginForm');
                form.parentNode.insertBefore(alertDiv, form);
                
                // Auto hide after 3 seconds
                setTimeout(function() {
                    alertDiv.style.opacity = '0';
                    setTimeout(function() {
                        alertDiv.remove();
                    }, 300);
                }, 3000);
            }
        });
    </script>

</body>
</html>
