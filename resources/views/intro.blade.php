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
  </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 to-blue-50 text-gray-800">

<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/30 backdrop-blur-md shadow-sm">
  <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
    <a href="#" class="text-2xl font-extrabold text-indigo-800">Moodify </a>
    <div class="space-x-6 hidden md:flex">
      <a href="#about" class="hover:text-indigo-500 font-medium">About</a>
      <a href="#features" class="hover:text-indigo-500 font-medium">Features</a>
      <a href="#users" class="hover:text-indigo-500 font-medium">Who It's For</a>
      <a href="#faq" class="hover:text-indigo-500 font-medium">FAQs</a>
      <a href="{{route('login')}}" class="bg-indigo-600 text-white px-5 py-2 rounded-full hover:bg-indigo-700 transition font-semibold">Log In</a>
    </div>
    <!-- Language Switcher -->
    <div class="ml-4">
      <select class="language-selector bg-white border border-gray-300 rounded px-2 py-1">
        <option value="en">🇬🇧 English</option>
        <option value="sw">🇹🇿 Swahili</option>
      </select>
    </div>
  </div>
</nav>

<<!-- HERO SECTION WITH BACKGROUND VIDEO -->
<section class="relative h-screen overflow-hidden flex items-center justify-center text-white">

  <!-- Background Video -->
  <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
    <source src="{{ asset('videos/hero-bg.mp4') }}" type="video/mp4" />
    Your browser does not support the video tag.
  </video>

  <!-- Overlay -->
  <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

  <!-- Content -->
  <!-- Hero Content -->
<div class="relative z-20 text-bottom max-w-3xl px-6 fade-in">
  <h1 class="text-5xl font-poppins md:text-7xl font-extrabold leading-tight mb-6">
    You Deserve Peace.  
    <br />
    Welcome to <span class="text-indigo-300">Moodify </span>
  </h1>
  <p class="text-xl md:text-2xl text-indigo-100 font-medium mb-8">
    A safe space to understand yourself, reflect, and heal at your own pace, in your own language.
  </p>
 
</div>

<a href="#about" class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-30 animate-bounce">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white opacity-80 hover:opacity-100 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
  </svg>
</a>


</section>
<!-- Welcome to Moodify Section -->
<section class="bg-gradient-to-br from-indigo-50 to-blue-50 py-24 px-6">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

    <!-- Left Column: Image -->
    <div data-aos="fade-right" class="relative">
      <div class="rounded-3xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-500">
        <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=900&q=80" alt="Calm illustration" class="w-full object-cover rounded-3xl">
      </div>
      <!-- Decorative circle -->
      <div class="absolute -top-6 -left-6 w-16 h-16 bg-indigo-200 rounded-full opacity-60 blur-lg"></div>
    </div>

    <!-- Right Column: Text -->
    <div data-aos="fade-left" class="space-y-6 text-center md:text-left">
      <h2 class="text-5xl font-extrabold text-indigo-800 leading-tight">
        Welcome to <span class="text-indigo-500">Moodify</span>
      </h2>
      <p class="text-lg text-gray-700 leading-relaxed">
        A guided, private, and caring platform created to help Tanzanians gain clarity, find calm, and build emotional resilience one step at a time.
      </p>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
        <div class="flex items-start space-x-3">
          <span class="text-indigo-600 text-xl">🌿</span>
          <span>Self-guided mental health assessments</span>
        </div>
        <div class="flex items-start space-x-3">
          <span class="text-indigo-600 text-xl">🗣️</span>
          <span>Anonymous community support spaces</span>
        </div>
        <div class="flex items-start space-x-3">
          <span class="text-indigo-600 text-xl">📞</span>
          <span>Talk to trusted Tanzanian therapists</span>
        </div>
        <div class="flex items-start space-x-3">
          <span class="text-indigo-600 text-xl">🌍</span>
          <span>Available in English & Swahili</span>
        </div>
      </div>
      <div class="pt-4">
        <a href="{{ url('/assessment') }}"
           class="inline-block bg-indigo-600 text-white text-base px-6 py-3 rounded-full font-semibold shadow hover:bg-indigo-700 transition">
          Get Started with a Self-Check-in
        </a>
      </div>
    </div>

  </div>
</section>
<!-- Moodify Features Elegant Section -->
<section id="features" class="py-24 bg-gradient-to-b from-white via-indigo-50 to-blue-100">
  <div class="max-w-6xl mx-auto px-6 space-y-24">

    <!-- Header -->
    <div class="text-center">
      <h2 class="text-4xl font-extrabold text-indigo-800 mb-4">Moodify Features Built Just for You</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Moodify is more than an app it's your gentle mental wellness companion, created with the Tanzanian spirit in mind.
      </p>
    </div>

    <!-- Feature 1 -->
    <div class="flex flex-col-reverse md:flex-row items-center gap-12">
      <div class="md:w-1/2">
        <h3 class="text-2xl font-bold text-indigo-700 mb-4">📊 Daily Mood Tracking</h3>
        <p class="text-gray-700 text-lg leading-relaxed">
          Record your feelings in seconds and reflect on patterns. Moodify helps you identify what lifts or lowers your emotional state through elegant, simple tracking.
        </p>
      </div>
      <div class="md:w-1/2">
        <img 
          src="https://cdn-icons-png.flaticon.com/512/4576/4576787.png" 
          class="w-40 h-40 md:w-48 md:h-48 mx-auto transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"
          alt="Mood Tracking">
      </div>
    </div>

    <!-- Feature 2 -->
    <div class="flex flex-col md:flex-row items-center gap-12">
      <div class="md:w-1/2">
        <img 
          src="https://cdn-icons-png.flaticon.com/512/3251/3251866.png" 
          class="w-40 h-40 md:w-48 md:h-48 mx-auto transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"
          alt="Assessment">
      </div>
      <div class="md:w-1/2">
        <h3 class="text-2xl font-bold text-indigo-700 mb-4">🧠 Adaptive Self-Assessments</h3>
        <p class="text-gray-700 text-lg leading-relaxed">
          Engage in personalized wellness check-ins that adapt to your mood. With each answer, the journey evolves helping you grow stronger without judgment.
        </p>
      </div>
    </div>

    <!-- Feature 3 -->
    <div class="flex flex-col-reverse md:flex-row items-center gap-12">
      <div class="md:w-1/2">
        <h3 class="text-2xl font-bold text-indigo-700 mb-4">🗣️ Anonymous Peer Support</h3>
        <p class="text-gray-700 text-lg leading-relaxed">
          Find comfort in a safe space. Chat anonymously, share stories, and heal together your voice matters, and your identity is always respected.
        </p>
      </div>
      <div class="md:w-1/2">
        <img 
          src="https://cdn-icons-png.flaticon.com/512/4140/4140047.png" 
          class="w-40 h-40 md:w-48 md:h-48 mx-auto transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"
          alt="Anonymous Support">
      </div>
    </div>

    <!-- Feature 4 -->
    <div class="flex flex-col md:flex-row items-center gap-12">
      <div class="md:w-1/2">
        <img 
          src="https://cdn-icons-png.flaticon.com/512/3313/3313888.png" 
          class="w-40 h-40 md:w-48 md:h-48 mx-auto transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"
          alt="Tanzania Localized">
      </div>
      <div class="md:w-1/2">
        <h3 class="text-2xl font-bold text-indigo-700 mb-4">🌍 Tanzanian-Centered Guidance</h3>
        <p class="text-gray-700 text-lg leading-relaxed">
          Designed for Tanzanians with Kiswahili language options, cultural awareness, spiritual sensitivity, and guidance from local therapists.
        </p>
      </div>
    </div>

  </div>
</section>



<!-- Moodify Features - Elegant, Minimalist Layout -->
<section id="features" class="py-28 bg-gradient-to-b from-white via-indigo-50 to-blue-100">
  <div class="max-w-7xl mx-auto px-6 space-y-20">

    <!-- Section Heading -->
    <div class="text-center">
      <h2 class="text-4xl font-extrabold text-indigo-800 mb-4">How Moodify Supports You Daily</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        More than just a tool Moodify is your companion for emotional resilience, mental clarity, and meaningful connection.
      </p>
    </div>

    <!-- Feature Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

      <!-- Feature Item -->
      <div class="flex items-start space-x-5 group transition-all">
        <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 p-3 rounded-full shadow-md transition-transform duration-300 group-hover:scale-110">
          <img src="https://cdn-icons-png.flaticon.com/512/4576/4576787.png" class="w-8 h-8" alt="Mood Tracking">
        </div>
        <div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-1">Daily Mood Tracking</h3>
          <p class="text-gray-600 text-base leading-relaxed">
            Capture how you feel with just one tap. Get visual trends that help you understand your emotional rhythms.
          </p>
        </div>
      </div>

      <!-- Feature Item -->
      <div class="flex items-start space-x-5 group transition-all">
        <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 p-3 rounded-full shadow-md transition-transform duration-300 group-hover:scale-110">
          <img src="https://cdn-icons-png.flaticon.com/512/3251/3251866.png" class="w-8 h-8" alt="Assessment">
        </div>
        <div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-1">Adaptive Self-Assessments</h3>
          <p class="text-gray-600 text-base leading-relaxed">
            Answer simple, adaptive questions that respond to your mood and give you helpful feedback and reflection prompts.
          </p>
        </div>
      </div>

      <!-- Feature Item -->
      <div class="flex items-start space-x-5 group transition-all">
        <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 p-3 rounded-full shadow-md transition-transform duration-300 group-hover:scale-110">
          <img src="https://cdn-icons-png.flaticon.com/512/4021/4021728.png" class="w-8 h-8" alt="Forums">
        </div>
        <div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-1">Anonymous Peer Forums</h3>
          <p class="text-gray-600 text-base leading-relaxed">
            Share thoughts, vent safely, or listen to others anonymously in moderated spaces designed for Tanzanians.
          </p>
        </div>
      </div>

      <!-- Feature Item -->
      <div class="flex items-start space-x-5 group transition-all">
        <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 p-3 rounded-full shadow-md transition-transform duration-300 group-hover:scale-110">
          <img src="https://cdn-icons-png.flaticon.com/512/3636/3636362.png" class="w-8 h-8" alt="Therapist">
        </div>
        <div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-1">Talk to Therapists</h3>
          <p class="text-gray-600 text-base leading-relaxed">
            Need more support? Get matched with licensed Tanzanian counselors confidential and at your own pace.
          </p>
        </div>
      </div>

      <!-- Feature Item -->
      <div class="flex items-start space-x-5 group transition-all">
        <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 p-3 rounded-full shadow-md transition-transform duration-300 group-hover:scale-110">
          <img src="https://cdn-icons-png.flaticon.com/512/2917/2917993.png" class="w-8 h-8" alt="Meditation">
        </div>
        <div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-1">Mindfulness & Journaling</h3>
          <p class="text-gray-600 text-base leading-relaxed">
            Access calming practices, short meditations, and reflective journaling to improve your day-to-day balance.
          </p>
        </div>
      </div>

      <!-- Feature Item -->
      <div class="flex items-start space-x-5 group transition-all">
        <div class="flex-shrink-0 bg-indigo-100 text-indigo-600 p-3 rounded-full shadow-md transition-transform duration-300 group-hover:scale-110">
          <img src="https://cdn-icons-png.flaticon.com/512/197/197560.png" class="w-8 h-8" alt="Swahili">
        </div>
        <div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-1">Swahili & Cultural Fit</h3>
          <p class="text-gray-600 text-base leading-relaxed">
            Everything in Moodify feels local language, approach, and spiritual inclusion — made for you, by you.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Explore Moodify Spaces -->
<section class="py-24 bg-white" id="spaces">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-extrabold text-indigo-800 mb-4">Explore Moodify Spaces</h2>
    <p class="text-gray-600 text-lg mb-12 max-w-2xl mx-auto">
      Dive into personalized tools and safe spaces designed to help you reflect, connect, and grow.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

      <!-- Mood Tracker -->
      <div class="group transform transition duration-300 hover:scale-105 bg-gradient-to-br from-indigo-50 to-indigo-100 shadow-lg rounded-3xl p-8">
        <div class="w-16 h-16 mx-auto mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/4205/4205120.png" alt="Mood Tracker" class="w-full h-full object-contain transition group-hover:scale-110">
        </div>
        <h3 class="text-xl font-bold text-indigo-700 mb-2">Mood Tracker</h3>
        <p class="text-gray-700 text-sm">Check in with your emotions and follow your patterns day by day.</p>
      </div>

      <!-- Self Assessment -->
      <div class="group transform transition duration-300 hover:scale-105 bg-gradient-to-br from-indigo-50 to-blue-100 shadow-lg rounded-3xl p-8">
        <div class="w-16 h-16 mx-auto mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/4344/4344828.png" alt="Assessment" class="w-full h-full object-contain transition group-hover:scale-110">
        </div>
        <h3 class="text-xl font-bold text-indigo-700 mb-2">Self Assessment</h3>
        <p class="text-gray-700 text-sm">Answer guided questions to get insights and wellness tips.</p>
      </div>

      <!-- Peer Support -->
      <div class="group transform transition duration-300 hover:scale-105 bg-gradient-to-br from-indigo-50 to-blue-200 shadow-lg rounded-3xl p-8">
        <div class="w-16 h-16 mx-auto mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/3771/3771492.png" alt="Peer Support" class="w-full h-full object-contain transition group-hover:scale-110">
        </div>
        <h3 class="text-xl font-bold text-indigo-700 mb-2">Peer Support</h3>
        <p class="text-gray-700 text-sm">Join safe and anonymous chatrooms to share and support others.</p>
      </div>

      <!-- Therapist Access -->
      <div class="group transform transition duration-300 hover:scale-105 bg-gradient-to-br from-indigo-50 to-blue-200 shadow-lg rounded-3xl p-8">
        <div class="w-16 h-16 mx-auto mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/3004/3004613.png" alt="Therapist" class="w-full h-full object-contain transition group-hover:scale-110">
        </div>
        <h3 class="text-xl font-bold text-indigo-700 mb-2">Talk to a Therapist</h3>
        <p class="text-gray-700 text-sm">Get professional mental health help privately and confidentially.</p>
      </div>

      <!-- Wellness Library -->
      <div class="group transform transition duration-300 hover:scale-105 bg-gradient-to-br from-indigo-50 to-blue-100 shadow-lg rounded-3xl p-8">
        <div class="w-16 h-16 mx-auto mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/3351/3351990.png" alt="Library" class="w-full h-full object-contain transition group-hover:scale-110">
        </div>
        <h3 class="text-xl font-bold text-indigo-700 mb-2">Wellness Library</h3>
        <p class="text-gray-700 text-sm">Read articles and listen to audio tools tailored to your growth.</p>
      </div>

      <!-- Progress Tracker -->
      <div class="group transform transition duration-300 hover:scale-105 bg-gradient-to-br from-indigo-50 to-blue-100 shadow-lg rounded-3xl p-8">
        <div class="w-16 h-16 mx-auto mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/1484/1484845.png" alt="Progress" class="w-full h-full object-contain transition group-hover:scale-110">
        </div>
        <h3 class="text-xl font-bold text-indigo-700 mb-2">Your Progress</h3>
        <p class="text-gray-700 text-sm">View a personal dashboard that tracks your healing journey over time.</p>
      </div>

    </div>
  </div>
</section>





<!-- How It Works Section -->
<section id="how-it-works" class="relative bg-white py-24">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl font-extrabold text-center text-indigo-800 mb-6">How Moodify Works</h2>
    <p class="text-center text-lg text-gray-600 mb-16 max-w-2xl mx-auto">
      Start your emotional wellness journey in three simple, meaningful steps created for Tanzanians, with you at heart.
    </p>

    <div class="relative">
      <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-indigo-200"></div>

      <!-- Step 1 -->
      <div class="mb-16 flex flex-col md:flex-row items-center md:items-start md:justify-between gap-10">
        <div class="w-full md:w-1/2 text-right pr-10">
          <h3 class="text-2xl font-bold text-indigo-700"> Take Your First Assessment</h3>
          <p class="text-gray-700 text-base mt-3">
            Answer simple, adaptive questions that help us understand your current emotional state all in a safe and judgment-free way.
          </p>
        </div>
        <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center shadow-lg z-10">
          1
        </div>
      </div>

      <!-- Step 2 -->
      <div class="mb-16 flex flex-col md:flex-row items-center md:items-start md:justify-between gap-10 md:flex-row-reverse">
        <div class="w-full md:w-1/2 text-left md:pl-10">
          <h3 class="text-2xl font-bold text-indigo-700"> Receive Personalized Tools</h3>
          <p class="text-gray-700 text-base mt-3">
            Get instant feedback, curated mental health tips, Swahili-friendly advice, and access to the best support resources for your situation.
          </p>
        </div>
        <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center shadow-lg z-10">
          2
        </div>
      </div>

      <!-- Step 3 -->
      <div class="mb-4 flex flex-col md:flex-row items-center md:items-start md:justify-between gap-10">
        <div class="w-full md:w-1/2 text-right pr-10">
          <h3 class="text-2xl font-bold text-indigo-700">Track & Grow Daily</h3>
          <p class="text-gray-700 text-base mt-3">
            Monitor your moods, join peer spaces, talk to therapists, or journal your healing. We’ll be there every step of the way.
          </p>
        </div>
        <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center shadow-lg z-10">
          3
        </div>
      </div>
    </div>
  </div>
</section>









<!-- Target Users -->
<section id="users" class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-center text-indigo-700 mb-10">Who Is Moodify For?</h2>
    <div class="grid md:grid-cols-3 gap-10 text-center">
      <div class="p-6 rounded-xl shadow bg-indigo-50 hover:shadow-lg transition">
        <h3 class="font-bold text-xl mb-2">🎓 Students</h3>
        <p class="text-gray-700">Struggling with academic stress, relationships, or identity? Moodify offers safe, guided support.</p>
      </div>
      <div class="p-6 rounded-xl shadow bg-indigo-50 hover:shadow-lg transition">
        <h3 class="font-bold text-xl mb-2">💼 Professionals</h3>
        <p class="text-gray-700">Burnout, anxiety, or career stress? Get quick check-ins and access to therapists who understand work-life balance.</p>
      </div>
      <div class="p-6 rounded-xl shadow bg-indigo-50 hover:shadow-lg transition">
        <h3 class="font-bold text-xl mb-2">🧘 Everyone</h3>
        <p class="text-gray-700">Whether you're exploring spirituality, emotional awareness, or mindfulness, Moodify is your guide.</p>
      </div>
    </div>
  </div>
</section>


<!-- Testimonial Section -->
<section class="py-24 bg-gradient-to-b from-blue-100 via-indigo-50 to-white" id="testimonials">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-extrabold text-indigo-800 mb-4">Real Stories. Real Transformation.</h2>
    <p class="text-gray-600 text-lg mb-12 max-w-2xl mx-auto">
      Hear from fellow Tanzanians whose journeys to mental wellness began right here.
    </p>

    <div class="space-y-16">

      <!-- Testimony 1 -->
      <div class="flex flex-col md:flex-row items-center gap-10 text-left" data-aos="fade-up">
        <img src="https://cdn-icons-png.flaticon.com/512/2922/2922561.png" alt="Asha" class="w-20 h-20 rounded-full shadow-md">
        <div>
          <p class="text-lg text-gray-700 leading-relaxed italic">“Before Moodify, I felt completely alone. Now I journal my emotions daily and even connected with a therapist who truly understands me.”</p>
          <p class="mt-3 text-sm text-indigo-700 font-semibold"></p>
        </div>
      </div>

      <!-- Testimony 2 -->
      <div class="flex flex-col md:flex-row-reverse items-center gap-10 text-left" data-aos="fade-up">
        <img src="https://cdn-icons-png.flaticon.com/512/2922/2922510.png" alt="Joseph" class="w-20 h-20 rounded-full shadow-md">
        <div>
          <p class="text-lg text-gray-700 leading-relaxed italic">“Moodify helped me understand my triggers. The assessments and gentle reminders keep me on track without pressure.”</p>
          <p class="mt-3 text-sm text-indigo-700 font-semibold"></p>
        </div>
      </div>

      <!-- Testimony 3 -->
      <div class="flex flex-col md:flex-row items-center gap-10 text-left" data-aos="fade-up">
        <img src="https://cdn-icons-png.flaticon.com/512/2922/2922656.png" alt="Neema" class="w-20 h-20 rounded-full shadow-md">
        <div>
          <p class="text-lg text-gray-700 leading-relaxed italic">“I love the Swahili-friendly interface and cultural vibe. It makes mental health feel local, not foreign.”</p>
          <p class="mt-3 text-sm text-indigo-700 font-semibold"></p>
        </div>
      </div>

    </div>
  </div>
</section>




<!-- FAQ Section -->
<section id="faqs" class="py-24 bg-white relative z-10">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-extrabold text-indigo-800 mb-4">Frequently Asked Questions</h2>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">
        Curious about Moodify? We’ve answered some of the most common questions to help you feel confident and informed.
      </p>
    </div>

    <div class="space-y-6" x-data="{ selected: null }">
      
      <!-- Question 1 -->
      <div class="border-b border-gray-200 pb-4">
        <button 
          @click="selected !== 1 ? selected = 1 : selected = null"
          class="flex justify-between w-full text-left text-indigo-700 text-lg font-semibold focus:outline-none transition"
        >
          <span>Is Moodify really anonymous?</span>
          <svg :class="selected === 1 ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="selected === 1" x-transition class="text-gray-600 mt-2">
          Yes. You can share and connect without revealing your name. Your identity remains private at every stage.
        </div>
      </div>

      <!-- Question 2 -->
      <div class="border-b border-gray-200 pb-4">
        <button 
          @click="selected !== 2 ? selected = 2 : selected = null"
          class="flex justify-between w-full text-left text-indigo-700 text-lg font-semibold focus:outline-none transition"
        >
          <span>Do I need to pay to use Moodify?</span>
          <svg :class="selected === 2 ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="selected === 2" x-transition class="text-gray-600 mt-2">
          Moodify’s core features are completely free. Premium features like therapist sessions may involve a cost.
        </div>
      </div>

      <!-- Question 3 -->
      <div class="border-b border-gray-200 pb-4">
        <button 
          @click="selected !== 3 ? selected = 3 : selected = null"
          class="flex justify-between w-full text-left text-indigo-700 text-lg font-semibold focus:outline-none transition"
        >
          <span>Is Moodify only for people with mental illness?</span>
          <svg :class="selected === 3 ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="selected === 3" x-transition class="text-gray-600 mt-2">
          Not at all! Moodify is for anyone who wants to improve their mental wellness — whether you're thriving or just surviving.
        </div>
      </div>

      <!-- Question 4 -->
      <div class="border-b border-gray-200 pb-4">
        <button 
          @click="selected !== 4 ? selected = 4 : selected = null"
          class="flex justify-between w-full text-left text-indigo-700 text-lg font-semibold focus:outline-none transition"
        >
          <span>Is my data secure with Moodify?</span>
          <svg :class="selected === 4 ? 'rotate-180' : ''" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="selected === 4" x-transition class="text-gray-600 mt-2">
          Yes. We use secure servers, encryption, and best practices to protect all your information. Privacy is our priority.
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Alpine.js for toggle behavior -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


<!-- CTA Section -->
<section id="cta" class="relative bg-gradient-to-br from-indigo-700 via-indigo-800 to-purple-900 py-28 text-white overflow-hidden">
  <!-- Glowing Background SVG -->
  <div class="absolute -top-24 -left-24 w-[600px] h-[600px] rounded-full bg-purple-400 opacity-20 blur-3xl animate-pulse"></div>
  <div class="absolute -bottom-24 -right-24 w-[600px] h-[600px] rounded-full bg-indigo-400 opacity-20 blur-3xl animate-pulse"></div>

  <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
    <h2 class="text-4xl sm:text-5xl font-extrabold mb-6 leading-tight">
      Your Journey to Inner Peace Begins Here 
    </h2>
    <p class="text-lg sm:text-xl text-indigo-100 max-w-3xl mx-auto mb-10 leading-relaxed">
      Moodify isn’t just an app — it’s a safe space. A movement. A companion created just for <strong>Tanzanians like you</strong> who are ready to heal, grow, and breathe easier every day.
    </p>
    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
      <a href="{{route('register')}}" class="bg-white text-indigo-700 hover:bg-indigo-100 font-bold px-8 py-3 rounded-full text-lg transition duration-300 shadow-lg">
        Get Started Now
      </a>
      <a href="#features" class="text-white hover:underline text-lg font-medium">
        Learn More →
      </a>
    </div>
  </div>
</section>


<!-- Footer -->
<footer class="bg-indigo-950 text-indigo-100 pt-20 pb-12 px-6">
  <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">

    <!-- Logo & Mission -->
    <div>
      <h3 class="text-2xl font-extrabold text-white mb-4"> Moodify</h3>
      <p class="text-sm text-indigo-300 leading-relaxed">
        Your companion for peace, healing, and mental wellness across Tanzania.  
        Safe. Private. Empowering.
      </p>
      <div class="mt-4 flex space-x-4">
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-5 h-5 hover:scale-110 transition" alt="Facebook" /></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" class="w-5 h-5 hover:scale-110 transition" alt="Instagram" /></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733635.png" class="w-5 h-5 hover:scale-110 transition" alt="YouTube" /></a>
      </div>
    </div>

    <!-- Explore -->
    <div>
      <h4 class="text-lg font-bold mb-4 text-white">Explore</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="#get-started" class="hover:text-white transition">Start Your Journey</a></li>
        <li><a href="#features" class="hover:text-white transition">Key Features</a></li>
        <li><a href="#about" class="hover:text-white transition">Why Moodify?</a></li>
        <li><a href="#contact" class="hover:text-white transition">Contact</a></li>
      </ul>
    </div>

    <!-- Resources -->
    <div>
      <h4 class="text-lg font-bold mb-4 text-white">Resources</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-white transition">Mood Tracker</a></li>
        <li><a href="#" class="hover:text-white transition">Self Assessment</a></li>
        <li><a href="#" class="hover:text-white transition">Mental Health Tips</a></li>
        <li><a href="#" class="hover:text-white transition">Community Support</a></li>
      </ul>
    </div>

    <!-- Contact -->
    <div>
      <h4 class="text-lg font-bold mb-4 text-white">Connect With Us</h4>
      <ul class="text-sm space-y-2 text-indigo-300">
        <li>Email: <a href="mailto:support@moodify.tz" class="hover:text-white">support@moodify.tz</a></li>
        <li>Phone: <a href="tel:+255700000000" class="hover:text-white">+255 700 000 000</a></li>
        <li>Location: Dar es Salaam, TZ</li>
      </ul>
      <div class="mt-6">
        <form class="flex">
          <input type="email" placeholder="Your email" class="w-full p-2 rounded-l bg-white text-black text-sm focus:outline-none" />
          <button type="submit" class="bg-indigo-600 px-4 py-2 rounded-r hover:bg-indigo-700 text-sm font-semibold">Subscribe</button>
        </form>
      </div>
    </div>

  </div>

  <!-- Divider -->
  <div class="border-t border-indigo-800 mt-12 pt-6 text-center text-sm text-indigo-400">
    &copy; {{ date('Y') }} Moodify Tanzania. All rights reserved. Made with 💙 in TZ.
  </div>
</footer>

<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<script>
  document.getElementById('mobile-menu-toggle')?.addEventListener('click', () => {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  });
</script>
</body>
</html>
