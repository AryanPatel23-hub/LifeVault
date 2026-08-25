<?php
// index.php - LifeVault Emergency Medical Profile

// Simple PHP Form Handler for Roll Number Lookup
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roll_number'])) {
    $rollNumber = trim($_POST['roll_number']);
    if (!empty($rollNumber)) {
        // Redirect to profile page (e.g., profile.php?id=...)
        header("Location: profile.php?roll_number=" . urlencode($rollNumber));
        exit;
    } else {
        $error = "Please enter a valid Roll Number.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeVault - Emergency Medical Profile</title>
    
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
<body class="font-sans text-slate-800 bg-slate-50 antialiased selection:bg-rose-500 selection:text-white">

    <!-- Header / Navbar -->
    <header class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Logo -->
            <a href="index.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-rose-600 rounded-xl flex items-center justify-center text-white text-xl shadow-md shadow-rose-200 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <div class="text-xl font-bold tracking-tight text-slate-900 leading-tight">
                        Life<span class="text-rose-600">Vault</span>
                    </div>
                    <div class="text-[10px] font-semibold text-slate-400 tracking-wider uppercase">
                        Emergency Medical Profile
                    </div>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="#home" class="text-rose-600 relative pb-1 border-b-2 border-rose-600">Home</a>
                <a href="#about" class="text-slate-600 hover:text-rose-600 transition">About</a>
                <a href="#how-it-works" class="text-slate-600 hover:text-rose-600 transition">How It Works</a>
                <a href="#features" class="text-slate-600 hover:text-rose-600 transition">Features</a>
                <a href="#contact" class="text-slate-600 hover:text-rose-600 transition">Contact</a>
            </nav>

            <!-- Auth Actions -->
            <div class="flex items-center gap-3">
                <a href="login.php" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition flex items-center gap-2">
                    <i class="fa-regular fa-user"></i>
                    <span>Login</span>
                </a>
                <a href="register.php" class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-md shadow-rose-200 transition flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Create Profile</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-brand-dark min-h-[580px] flex items-center overflow-hidden">
        <!-- Background Ambulance Image & Overlay -->
        <div class="absolute inset-0 z-0">
            <img 
                src="https://images.unsplash.com/photo-1587745416684-47953f16f02f?q=80&w=1920&auto=format&fit=crop" 
                alt="Emergency Ambulance Background" 
                class="w-full h-full object-cover object-right opacity-40 mix-blend-luminosity lg:opacity-75 lg:mix-blend-normal"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-brand-dark via-brand-dark/90 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10 w-full">
            <div class="max-w-2xl text-white">
                
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-medium text-rose-300 mb-6">
                    <i class="fa-solid fa-shield-heart text-rose-400"></i>
                    <span>Your Health. Your Safety. Our Priority.</span>
                </div>

                <!-- Hero Title -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.15] mb-6">
                    Emergency Information When <span class="text-rose-500">Every Second Counts</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-slate-300 text-base sm:text-lg mb-8 leading-relaxed font-normal">
                    LifeVault stores your critical medical information securely and makes it instantly accessible during emergencies.
                </p>

                <!-- Search / Roll Number Input Form -->
                <form action="index.php" method="POST" class="max-w-xl mb-4">
                    <div class="bg-white p-2 rounded-2xl shadow-2xl flex flex-col sm:flex-row items-center gap-2">
                        <div class="flex items-center gap-3 px-4 w-full py-2">
                            <i class="fa-regular fa-user text-slate-400 text-lg"></i>
                            <input 
                                type="text" 
                                name="roll_number" 
                                required
                                placeholder="Enter Roll Number" 
                                class="w-full bg-transparent text-slate-800 placeholder-slate-400 focus:outline-none text-sm font-medium"
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-7 py-3.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2 whitespace-nowrap transition-all shadow-md shadow-rose-300 active:scale-95"
                        >
                            <span>View Profile</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </div>
                    <?php if (!empty($error)): ?>
                        <p class="text-rose-400 text-xs mt-2 font-medium"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>
                </form>

                <!-- Trust Badges -->
                <div class="flex items-center gap-2 text-xs text-slate-300 font-medium pt-2">
                    <i class="fa-solid fa-shield-halved text-rose-400"></i>
                    <span>Secure • Private • Always Accessible</span>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section (Floating Card) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                
                <!-- Stat 1 -->
                <div class="flex items-center gap-4 px-2 pt-4 md:pt-0">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900 tracking-tight">10,000+</div>
                        <div class="text-xs font-semibold text-slate-400">Profiles Created</div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="flex items-center gap-4 px-2 pt-4 md:pt-0">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900 tracking-tight">99.9%</div>
                        <div class="text-xs font-semibold text-slate-400">Data Security</div>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="flex items-center gap-4 px-2 pt-4 md:pt-0">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900 tracking-tight">2 Sec</div>
                        <div class="text-xs font-semibold text-slate-400">Instant Access</div>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="flex items-center gap-4 px-2 pt-4 md:pt-0">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900 tracking-tight">24/7</div>
                        <div class="text-xs font-semibold text-slate-400">Always Available</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Why Choose LifeVault Section -->
    <section id="features" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-14">
                <h2 class="text-3xl font-extrabold text-slate-900">
                    Why Choose <span class="text-rose-600">LifeVault</span>?
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Feature 1 -->
                <div class="bg-white p-7 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2.5">Instant QR Access</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        First responders can scan your QR code to get instant access to your medical information.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-7 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2.5">Strict Privacy Control</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        You control what information is shared. Keep your data private and secure at all times.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-7 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2.5">One-Tap Calling</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Emergency contacts can be called instantly with a single tap in critical situations.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-7 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-kit-medical"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2.5">Complete Medical Profile</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Store allergies, medications, blood group, conditions, and more in one secure place.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#f0f7ff] rounded-3xl border border-blue-100 p-8 sm:p-12">
                
                <h2 class="text-2xl font-bold text-slate-900 text-center mb-12">
                    How It Works?
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center relative">
                    
                    <!-- Step 1 -->
                    <div class="flex items-start gap-4">
                        <div class="relative shrink-0">
                            <div class="w-14 h-14 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-xl">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-rose-600 text-white text-[11px] font-bold rounded-full flex items-center justify-center border-2 border-white">
                                1
                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 mb-1">Create Your Profile</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Sign up and create your secure medical profile with important details.
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start gap-4 relative">
                        <div class="relative shrink-0">
                            <div class="w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-emerald-600 text-white text-[11px] font-bold rounded-full flex items-center justify-center border-2 border-white">
                                2
                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 mb-1">Secure Your Data</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Your information is encrypted and stored securely in our protected system.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start gap-4">
                        <div class="relative shrink-0">
                            <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl">
                                <i class="fa-solid fa-qrcode"></i>
                            </div>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-blue-600 text-white text-[11px] font-bold rounded-full flex items-center justify-center border-2 border-white">
                                3
                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 mb-1">Instant Access</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Share your QR code and get instant access during emergency situations.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0b1120] text-slate-400 text-xs py-10 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <!-- Footer Brand -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-rose-600 rounded-lg flex items-center justify-center text-white text-base">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div>
                        <div class="text-base font-bold text-white tracking-tight">
                            Life<span class="text-rose-500">Vault</span>
                        </div>
                        <div class="text-[9px] text-slate-500 uppercase tracking-wider">Emergency Medical Profile</div>
                    </div>
                </div>

                <!-- Copyright / Center Text -->
                <div class="text-center md:text-left">
                    <p class="text-slate-300 font-medium mb-1">Your health information. Secure. Private. Accessible.</p>
                    <p class="text-slate-500">© <?php echo date('Y'); ?> LifeVault Emergency System. All rights reserved.</p>
                </div>

                <!-- Legal Links -->
                <div class="flex items-center gap-6 font-medium">
                    <a href="privacy.php" class="hover:text-white transition">Privacy Policy</a>
                    <a href="terms.php" class="hover:text-white transition">Terms of Service</a>
                    <a href="contact.php" class="hover:text-white transition">Contact Us</a>
                </div>

            </div>
        </div>
    </footer>

</body>
</html>