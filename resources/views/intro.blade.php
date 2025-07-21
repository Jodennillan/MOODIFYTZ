<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Welcome to Moodify</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    html { scroll-behavior: smooth; }
    .language-selector { font-size: 14px; }
    .hero-button {
      background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
      box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
    }
    .hero-button:hover {
      background: linear-gradient(135deg, #16a34a 0%, #14532d 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(34, 197, 94, 0.5);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-50 text-gray-800">

<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/30 backdrop-blur-md shadow-sm">
  <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
    <a href="#" class="text-2xl font-extrabold text-green-800">Moodify</a>
    <div class="space-x-6 hidden md:flex">
      <a href="#about" class="hover:text-green-600 font-medium">About</a>
      <a href="#features" class="hover:text-green-600 font-medium">Features</a>
      <a href="#users" class="hover:text-green-600 font-medium">Who It's For</a>
      <a href="#faq" class="hover:text-green-600 font-medium">FAQs</a>
      <a href="{{ route('login') }}" class="bg-green-600 text-white px-5 py-2 rounded-full hover:bg-green-700 transition font-semibold">Login</a>
    </div>
    <!-- Language Switcher -->
    <div class="ml-4">
      <select class="language-selector bg-white border border-gray-300 rounded px-2 py-1">
        <option value="en" selected>🇬🇧 English</option>
        <option value="sw">🇹🇿 Swahili</option>
      </select>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="relative h-screen overflow-hidden flex items-center justify-center text-white">
  <div class="absolute inset-0 w-full h-full z-0">
    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=1740&q=80" 
         alt="African man meditating" 
         class="w-full h-full object-cover">
  </div>
  <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

  <div class="relative z-20 max-w-4xl px-6 text-center">
    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
      Mental Resilience Begins Here<br />
      Welcome to <span class="text-green-300">Moodify</span>
    </h1>
    <p class="text-xl md:text-2xl text-green-100 font-medium mb-8">
      A safe space to understand yourself, heal at your pace, and grow in your language.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="{{ route('register') }}" class="bg-white text-green-700 hover:bg-green-100 font-bold px-8 py-3 rounded-full text-lg transition duration-300 shadow-lg">Join Now</a>
      <a href="#support" class="bg-white/20 text-white px-8 py-4 rounded-full text-lg font-bold border border-white hover:bg-white/30 transition">Customer Support</a>
    </div>
  </div>
  <a href="#about" class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-30 animate-bounce">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white opacity-80 hover:opacity-100 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </a>
</section>

<!-- About Section -->
<section id="about" class="py-20 px-6 bg-white">
  <div class="max-w-5xl mx-auto text-center">
    <h2 class="text-3xl font-extrabold text-green-700 mb-6">What is Moodify?</h2>
    <p class="text-lg text-gray-700 leading-relaxed">
      Moodify is a mental health platform tailored for Tanzanians and Swahili speakers. 
      It allows you to track your emotions daily, connect anonymously with therapists, and receive 
      supportive content in your native language — all in one place.
    </p>
  </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 px-6 bg-green-50">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-3xl font-extrabold text-green-700 mb-12">Powerful Features for Self-Care</h2>
    <div class="grid gap-8 grid-cols-1 md:grid-cols-3">
      <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="text-4xl text-green-600 mb-4">
          💬
        </div>
        <h3 class="text-xl font-semibold mb-2">Anonymous Counseling</h3>
        <p class="text-gray-600">
          Speak freely with therapists without revealing your identity. Privacy matters.
        </p>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="text-4xl text-green-600 mb-4">
          📈
        </div>
        <h3 class="text-xl font-semibold mb-2">Mood Tracker</h3>
        <p class="text-gray-600">
          Reflect on how you feel every day and spot trends to better manage your mental health.
        </p>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="text-4xl text-green-600 mb-4">
          📚
        </div>
        <h3 class="text-xl font-semibold mb-2">Self-Help Resources</h3>
        <p class="text-gray-600">
          Get articles, videos, and affirmations in Swahili, crafted by mental health professionals.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Who It's For -->
<section id="users" class="py-20 px-6 bg-white">
  <div class="max-w-5xl mx-auto text-center">
    <h2 class="text-3xl font-extrabold text-green-700 mb-6">Who Should Use Moodify?</h2>
    <p class="text-lg text-gray-700 leading-relaxed mb-8">
      Moodify is built for everyone. Whether you’re:
    </p>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-left max-w-4xl mx-auto">
      <div class="p-4 bg-green-100 rounded-lg">
        <h4 class="font-bold text-green-800">Young Adults</h4>
        <p class="text-gray-700 text-sm">Managing academic stress or social anxiety? Moodify can help.</p>
      </div>
      <div class="p-4 bg-green-100 rounded-lg">
        <h4 class="font-bold text-green-800">Professionals</h4>
        <p class="text-gray-700 text-sm">Work-life balance, burnout, or relationship issues? You're not alone.</p>
      </div>
      <div class="p-4 bg-green-100 rounded-lg">
        <h4 class="font-bold text-green-800">Parents</h4>
        <p class="text-gray-700 text-sm">Supporting your family while staying strong mentally is possible.</p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-20 px-6 bg-green-50">
  <div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-extrabold text-green-700 mb-10 text-center">Frequently Asked Questions</h2>
    
    <div class="space-y-6">
      <div>
        <h3 class="font-semibold text-lg text-green-800">Is Moodify free?</h3>
        <p class="text-gray-700">Yes! Moodify is free to use for mood tracking and accessing basic self-help tools. Premium features may be introduced in the future.</p>
      </div>

      <div>
        <h3 class="font-semibold text-lg text-green-800">Do I need to share my real name?</h3>
        <p class="text-gray-700">No. You can chat anonymously with therapists and use a nickname if preferred.</p>
      </div>

      <div>
        <h3 class="font-semibold text-lg text-green-800">Can I use Moodify without internet?</h3>
        <p class="text-gray-700">An internet connection is required. We’re working on offline features in future versions.</p>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section id="cta" class="py-20 px-6 bg-green-600 text-white text-center">
  <div class="max-w-3xl mx-auto">
    <h2 class="text-3xl font-extrabold mb-4">Start Your Wellness Journey Today 🌿</h2>
    <p class="mb-6 text-lg">Join hundreds of Tanzanians improving their mental health with Moodify. It's simple, safe, and supportive.</p>
    <a href="/register" class="bg-white text-green-700 font-bold py-3 px-6 rounded-full shadow-md hover:bg-green-100 transition-all inline-block">
      Get Started for Free
    </a>
  </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 px-6 bg-white text-center">
  <div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-extrabold text-green-700 mb-6">Contact Us</h2>
    <p class="text-gray-700 mb-4">Have a question or feedback?</p>
    <p class="text-gray-600">
      Email us at <a href="mailto:support@moodify.co.tz" class="text-green-600 underline">support@moodify.co.tz</a> <br>
      or call us at <strong>+255 754 123 456</strong>
    </p>
  </div>
</section>

<!-- Footer -->
<footer class="bg-green-800 text-white py-8 px-6">
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
    <div>
      <h3 class="font-bold text-lg mb-3">Moodify</h3>
      <p class="text-sm text-green-100">
        Empowering mental wellness across Tanzania with accessible, culturally-tailored support.
      </p>
    </div>
    <div>
      <h4 class="font-semibold text-green-200 mb-2">Quick Links</h4>
      <ul class="space-y-1 text-sm">
        <li><a href="#about" class="hover:underline">About</a></li>
        <li><a href="#features" class="hover:underline">Features</a></li>
        <li><a href="#users" class="hover:underline">Who It’s For</a></li>
        <li><a href="#faq" class="hover:underline">FAQ</a></li>
        <li><a href="#contact" class="hover:underline">Contact</a></li>
      </ul>
    </div>
    <div>
      <h4 class="font-semibold text-green-200 mb-2">Stay Connected</h4>
      <div class="flex gap-4 text-xl">
        <a href="#" class="hover:text-green-400"><i class="fab fa-facebook"></i></a>
        <a href="#" class="hover:text-green-400"><i class="fab fa-twitter"></i></a>
        <a href="#" class="hover:text-green-400"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
  <div class="mt-6 text-center text-sm text-green-200">
    &copy; {{ date('Y') }} Moodify. All rights reserved.
  </div>
</footer>

<!-- Font Awesome (for icons) -->
<script src="https://kit.fontawesome.com/a2e7e6e6f3.js" crossorigin="anonymous"></script>