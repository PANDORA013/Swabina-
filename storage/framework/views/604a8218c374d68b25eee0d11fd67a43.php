<?php $__env->startSection('content'); ?>
<div class="login-container">
    <div class="login-wrapper">
        <!-- Logo Section -->
        <div class="login-logo-section">
            <div class="logo-container">
                <img src="<?php echo e(asset('assets/gambar_landingpage/logo_swabina.png')); ?>" alt="SWABINA GATRA" class="login-logo">
            </div>
            <h1 class="company-name">SWABINA GATRA</h1>
            <p class="company-tagline">Facility Management & Services</p>
        </div>

        <!-- Login Form Section -->
        <div class="login-form-section">
            <div class="form-header">
                <h2>Admin Panel</h2>
                <p>Masuk ke dashboard administrator</p>
            </div>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="login-form">
                <?php echo csrf_field(); ?>

                <!-- Email Input -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i> Email Address
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        name="email" 
                        value="<?php echo e(old('email', $email)); ?>" 
                        placeholder="admin@swabina.com"
                        required 
                        autofocus>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i> Password
                    </label>
                    <div class="password-input-group">
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            name="password" 
                            value="<?php echo e(old('password', $password)); ?>" 
                            placeholder="••••••••"
                            required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>

                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="form-group remember-me">
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            <?php echo e(old('remember') ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="remember">
                            Ingat saya di perangkat ini
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <span>Masuk ke Dashboard</span>
                    <i class="bi bi-arrow-right"></i>
                </button>

                <!-- Additional Info -->
                <div class="login-footer">
                    <p class="text-muted">
                        <i class="bi bi-shield-check"></i> 
                        Akses terbatas untuk administrator
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        max-width: 1000px;
        width: 100%;
        align-items: center;
    }

    /* Logo Section */
    .login-logo-section {
        text-align: center;
        color: white;
        animation: slideInLeft 0.6s ease-out;
    }

    .logo-container {
        margin-bottom: 30px;
    }

    .login-logo {
        width: 120px;
        height: 120px;
        object-fit: contain;
        filter: drop-shadow(0 4px 15px rgba(0, 0, 0, 0.3));
        animation: float 3s ease-in-out infinite;
    }

    .company-name {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 20px 0 10px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        letter-spacing: 2px;
    }

    .company-tagline {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
    }

    /* Form Section */
    .login-form-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideInRight 0.6s ease-out;
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header h2 {
        font-size: 1.8rem;
        color: #0454a3;
        margin: 0 0 10px;
        font-weight: 700;
    }

    .form-header p {
        color: #666;
        margin: 0;
        font-size: 0.95rem;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .form-label i {
        margin-right: 6px;
        color: #0454a3;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        outline: none;
        border-color: #0454a3;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(4, 84, 163, 0.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    /* Password Input Group */
    .password-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-input-group .form-control {
        padding-right: 45px;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        background: none;
        border: none;
        cursor: pointer;
        color: #0454a3;
        font-size: 1.1rem;
        padding: 5px;
        transition: all 0.3s ease;
    }

    .password-toggle:hover {
        color: #00a8e8;
        transform: scale(1.1);
    }

    /* Invalid Feedback */
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
    }

    .invalid-feedback i {
        margin-right: 5px;
    }

    /* Remember Me */
    .remember-me {
        margin-bottom: 25px;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-top: 3px;
        cursor: pointer;
        accent-color: #0454a3;
    }

    .form-check-label {
        margin-left: 8px;
        cursor: pointer;
        color: #555;
        font-size: 0.95rem;
    }

    /* Login Button */
    .btn-login {
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #0454a3 0%, #00a8e8 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(4, 84, 163, 0.3);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(4, 84, 163, 0.4);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .btn-login i {
        transition: transform 0.3s ease;
    }

    .btn-login:hover i {
        transform: translateX(3px);
    }

    /* Login Footer */
    .login-footer {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .login-footer p {
        margin: 0;
        color: #666;
        font-size: 0.85rem;
    }

    .login-footer i {
        color: #0454a3;
        margin-right: 5px;
    }

    /* Animations */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-wrapper {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .login-logo-section {
            display: none;
        }

        .login-form-section {
            padding: 30px 20px;
        }

        .company-name {
            font-size: 1.8rem;
        }

        .form-header h2 {
            font-size: 1.5rem;
        }

        .login-logo {
            width: 80px;
            height: 80px;
        }
    }

    @media (max-width: 480px) {
        .login-form-section {
            padding: 20px 15px;
        }

        .form-header h2 {
            font-size: 1.3rem;
        }

        .form-control {
            padding: 10px 12px;
            font-size: 0.9rem;
        }

        .btn-login {
            padding: 10px 15px;
            font-size: 0.95rem;
        }
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            toggleBtn.innerHTML = '<i class="bi bi-eye"></i>';
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/auth/login.blade.php ENDPATH**/ ?>