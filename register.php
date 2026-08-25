<?php
// register.php - LifeVault Account Creation
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Basic Validation
    if (empty($fullName) || empty($email) || empty($password)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } else {
        // --- Database Insertion Placeholder ---
        // $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password_hash) VALUES (?, ?, ?, ?)");
        // $stmt->execute([$fullName, $email, $phone, password_hash($password, PASSWORD_DEFAULT)]);
        
        // Mock Success
        $success = "Profile created successfully! Redirecting to login...";
        // In a real app: header("refresh:2;url=login.php"); 
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile — LifeVault Emergency Medical Profile</title>
    
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

        <a href="login.php" class="px-5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-semibold text-white backdrop-blur-md border border-white/10 transition flex items-center gap-2">
            <i class="fa-regular fa-user"></i>
            <span>Sign In</span>
        </a>
    </header>

    <!-- Main Content Container -->
    <main class="relative z-10 flex-1 flex items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg">

            <!-- Registration Card -->
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/50 border border-white/20 p-8 sm:p-10 relative overflow-hidden">
                
                <!-- Decorative Top Ambient Accent -->
                <div class="absolute -top-16 -right-16 w-40 h-40 bg-rose-500/15 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Form Header -->
                <div class="text-center mb-8">
                    <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl shadow-inner">
                        <i class="fa-solid fa-file-medical"></i>
                    </div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Create Your Profile</h1>
                    <p class="text-xs text-slate-500 mt-1.5 font-medium">Securely store your medical information for emergencies</p>
                </div>

                <!-- Alert Messages -->
                <?php if (!empty($error)): ?>
                    <div class="mb-6 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium flex items-start gap-2.5 animate-pulse">
                        <i class="fa-solid fa-circle-exclamation text-rose-500 text-sm mt-0.5 shrink-0"></i>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="mb-6 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-medium flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-sm mt-0.5 shrink-0"></i>
                        <span><?php echo htmlspecialchars($success); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Registration Form -->
                <form action="register.php" method="POST" class="space-y-4">
                    
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-xs font-semibold text-slate-700 mb-1.5">Full Name *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-regular fa-user text-sm"></i>
                            </span>
                            <input 
                                type="text" 
                                name="full_name" 
                                id="full_name" 
                                value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>"
                                required
                                placeholder="aryan patel"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-50 transition"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Email Address *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <i class="fa-regular fa-envelope text-sm"></i>
                                </span>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                    required
                                    placeholder="you@example.com"
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-50 transition"
                                >
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1.5">Phone Number</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-phone text-sm"></i>
                                </span>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    id="phone" 
                                    value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                                    placeholder="+91  9999999999"
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-50 transition"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Password *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </span>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    required
                                    placeholder="Min. 8 characters"
                                    class="w-full pl-10 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-50 transition"
                                >
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="confirm_password" class="block text-xs font-semibold text-slate-700 mb-1.5">Confirm Password *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </span>
                                <input 
                                    type="password" 
                                    name="confirm_password" 
                                    id="confirm_password" 
                                    required
                                    placeholder="Repeat password"
                                    class="w-full pl-10 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-50 transition"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="pt-2 pb-1">
                        <label class="flex items-start gap-2 cursor-pointer group">
                            <div class="flex items-center h-5">
                                <input 
                                    type="checkbox" 
                                    required
                                    class="w-4 h-4 rounded border-slate-300 text-rose-600 focus:ring-rose-500 focus:ring-offset-0"
                                >
                            </div>
                            <span class="text-[11px] text-slate-500 font-medium leading-relaxed">
                                I agree to the <a href="#" class="text-rose-600 hover:underline">Terms of Service</a> and acknowledge the <a href="#" class="text-rose-600 hover:underline">Privacy Policy</a> regarding my medical data.
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-rose-600/30 active:scale-[0.99] flex items-center justify-center gap-2 mt-2"
                    >
                        <span>Create Account</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>

                </form>

                <!-- Footer Route -->
                <div class="mt-6 pt-6 border-t border-slate-200/70 text-center">
                    <p class="text-xs text-slate-500 font-medium">
                        Already have an account? 
                        <a href="login.php" class="text-rose-600 font-bold hover:underline ml-1">Sign In Here</a>
                    </p>
                </div>

            </div>

            <!-- Security Footnote -->
            <div class="flex items-center justify-center gap-2 text-slate-400 text-xs mt-6 font-medium">
                <i class="fa-solid fa-shield-halved text-[11px] text-emerald-400"></i>
                <span>HIPAA Compliant & 256-Bit Encrypted</span>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 w-full py-5 text-center text-xs text-slate-400 font-medium">
        © <?php echo date('Y'); ?> LifeVault Emergency System. All rights reserved.
    </footer>

</body>
</html>