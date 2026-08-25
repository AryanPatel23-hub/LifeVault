<?php
// login.php - LifeVault User Authentication with Hero Background
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
$identifier = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['identifier'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (empty($identifier) || empty($password)) {
        $error = "Please enter both your Roll Number / Email and password.";
    } else {
        // Demo authentication fallback
        if (($identifier === 'demo@lifevault.com' || $identifier === 'LV-10024') && $password === 'password123') {
            $_SESSION['user_id'] = 1;
            $_SESSION['user_name'] = 'Alex Morgan';
            $_SESSION['roll_number'] = 'LV-10024';

            if ($remember) {
                setcookie('lifevault_remember', $identifier, time() + (86400 * 30), "/");
            }

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid credentials. (Demo: demo@lifevault.com / password123)";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — LifeVault Emergency Medical Profile</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            red: '#e11d48',
                            redDark: '#be123c',
                            dark: '#080d1a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased min-h-full flex flex-col justify-between relative selection:bg-rose-500 selection:text-white bg-brand-dark">

    <!-- Background Image & Overlay -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <img 
            src="https://images.unsplash.com/photo-1587745416684-47953f16f02f?q=80&w=1920&auto=format&fit=crop" 
            alt="Emergency Ambulance Background" 
            class="w-full h-full object-cover object-center opacity-30 mix-blend-luminosity lg:opacity-40"
        >
        <div class="absolute inset-0 bg-gradient-to-b from-brand-dark/90 via-brand-dark/80 to-brand-dark/95 backdrop-blur-[2px]"></div>
    </div>

    <!-- Header Navigation -->
    <header class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between">
        <a href="index.php" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 bg-rose-600 rounded-xl flex items-center justify-center text-white text-lg shadow-lg shadow-rose-600/30 group-hover:scale-105 transition-transform">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div>
                <span class="text-xl font-bold tracking-tight text-white">Life<span class="text-rose-500">Vault</span></span>
            </div>
        </a>

        <a href="index.php" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-semibold text-slate-200 backdrop-blur-md border border-white/10 transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Back to Home</span>
        </a>
    </header>

    <!-- Main Content Container -->
    <main class="relative z-10 flex-1 flex items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">

            <!-- Login Card -->
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/50 border border-white/20 p-8 sm:p-10 relative overflow-hidden">
                
                <!-- Decorative Top Ambient Accent -->
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-rose-500/15 rounded-full blur-2xl pointer-events-none"></div>

                <!-- Form Header -->
                <div class="text-center mb-8">
                    <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl shadow-inner">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Welcome Back</h1>
                    <p class="text-xs text-slate-500 mt-1.5 font-medium">Access and manage your emergency medical profile</p>
                </div>

                <!-- Alert Message -->
                <?php if (!empty($error)): ?>
                    <div class="mb-6 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-exclamation text-rose-500 text-sm mt-0.5 shrink-0"></i>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form action="login.php" method="POST" class="space-y-4">
                    
                    <!-- User Name / Email Field -->
                    <div>
                        <label for="identifier" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            User Name or Email Address
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-regular fa-id-card text-sm"></i>
                            </span>
                            <input 
                                type="text" 
                                name="identifier" 
                                id="identifier" 
                                value="<?php echo htmlspecialchars($identifier); ?>"
                                required
                                placeholder="e.g., JohnDoe or john.doe@domain.com"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-50 transition"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-semibold text-slate-700">
                                Password
                            </label>
                            <a href="forgot-password.php" class="text-xs font-semibold text-rose-600 hover:text-rose-700 hover:underline">
                                Forgot?
                            </a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </span>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required
                                placeholder="••••••••"
                                class="w-full pl-10 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-50 transition"
                            >
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility()" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                            >
                                <i id="toggleEye" class="fa-regular fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-4 h-4 rounded border-slate-300 text-rose-600 focus:ring-rose-500 focus:ring-offset-0"
                            >
                            <span class="text-xs text-slate-600 font-medium">Keep me signed in</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-rose-600/30 active:scale-[0.99] flex items-center justify-center gap-2"
                    >
                        <span>Sign In to Vault</span>
                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                    </button>

                </form>

                <!-- Divider -->
                <div class="relative my-6 text-center">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200/70"></div>
                    </div>
                    <span class="relative bg-white px-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                        New to LifeVault?
                    </span>
                </div>

                <!-- Registration Route -->
                <a 
                    href="register.php" 
                    class="w-full py-3 bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2"
                >
                    <i class="fa-solid fa-user-plus text-rose-500"></i>
                    <span>Create Emergency Profile</span>
                </a>

                <!-- Emergency First Responder Notice -->
                <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                    <p class="text-[11px] text-slate-500 font-medium">
                        First Responder or Paramedic? 
                        <a href="index.php" class="text-rose-600 font-semibold hover:underline">Lookup profile by ID</a>
                    </p>
                </div>

            </div>

            <!-- Security Footnote -->
            <div class="flex items-center justify-center gap-2 text-slate-400 text-xs mt-6 font-medium">
                <i class="fa-solid fa-lock text-[11px] text-rose-400"></i>
                <span>256-Bit Encrypted Medical Vault Session</span>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 w-full py-5 text-center text-xs text-slate-400 font-medium">
        © <?php echo date('Y'); ?> LifeVault Emergency System. All rights reserved.
    </footer>

    <!-- Password Visibility Toggle Script -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleEye = document.getElementById('toggleEye');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleEye.classList.remove('fa-eye');
                toggleEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleEye.classList.remove('fa-eye-slash');
                toggleEye.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>