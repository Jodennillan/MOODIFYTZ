<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Feedback | MindWell</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'emerald': {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        .animate-pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .action-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .breathing-circle {
            animation: breathe 8s infinite ease-in-out;
            transform-origin: center;
        }
        @keyframes breathe {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .expandable {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }
        .expanded {
            max-height: 500px;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.25rem;
        }
    </style>
</head>
<body class="bg-emerald-50 font-poppins min-h-screen">
    <x-app-layout>
        <div class="pt-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header with animated celebration -->
                <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 p-6 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center pointer-events-none">
                        <div class="w-64 h-64 rounded-full bg-emerald-300 opacity-20 animate-pulse-slow"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-emerald-500 text-5xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-white">Mood Recorded Successfully!</h2>
                        <p class="text-emerald-100 mt-2">Thank you for checking in with yourself today</p>
                    </div>
                </div>
                
                <!-- Motivational quote -->
                <div class="p-6 bg-emerald-50 border-b border-emerald-100">
                    <div class="text-center">
                        <i class="fas fa-quote-left text-emerald-300 text-xl"></i>
                        <p class="text-emerald-700 italic px-4">"Self-awareness is the first step toward self-improvement."</p>
                        <p class="text-emerald-500 mt-1">- Anonymous</p>
                    </div>
                </div>
                
                <!-- Actions section -->
                <div class="p-6 sm:p-8">
                    <h3 class="text-xl font-semibold text-emerald-800 text-center mb-6">What would you like to do next?</h3>
                    
                    <div class="card-grid">
                        <!-- Talk to Therapist -->
                        <a href="{{ route('therapist.chat') }}" class="action-card bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-5 flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                                <i class="fas fa-comments text-indigo-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-indigo-800 text-lg">Talk to a Therapist</h4>
                            <p class="text-indigo-600 text-sm mt-1">Connect with a professional</p>
                            <div class="mt-4 w-full">
                                <div class="h-1 bg-indigo-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-500 w-3/4"></div>
                                </div>
                                <p class="text-xs text-indigo-500 mt-1">3 therapists available now</p>
                            </div>
                        </a>
                        
                        <!-- Journal History -->
                        <a href="{{ route('journal.history') }}" class="action-card bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl p-5 flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-full bg-amber-100 flex items-center justify-center mb-4">
                                <i class="fas fa-book text-amber-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-amber-800 text-lg">View Journal History</h4>
                            <p class="text-amber-600 text-sm mt-1">Read your past reflections</p>
                            <div class="mt-4">
                                <div class="h-8 w-8 mx-auto rounded-full bg-amber-200 flex items-center justify-center">
                                    <span class="text-amber-700 font-bold text-sm">7</span>
                                </div>
                                <p class="text-xs text-amber-500 mt-1">Recent entries</p>
                            </div>
                        </a>
                        
                        <!-- Mood History -->
                        <a href="{{ route('mood.history') }}" class="action-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-blue-800 text-lg">View Mood History</h4>
                            <p class="text-blue-600 text-sm mt-1">Track your emotional patterns</p>
                            <div class="mt-4 flex items-center justify-center">
                                <div class="flex">
                                    <div class="w-3 h-3 bg-blue-400 rounded-full mr-1"></div>
                                    <div class="w-3 h-3 bg-blue-300 rounded-full mr-1"></div>
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-1"></div>
                                    <div class="w-3 h-3 bg-blue-400 rounded-full mr-1"></div>
                                    <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                </div>
                                <span class="text-xs text-blue-500 ml-2">5 entries this week</span>
                            </div>
                        </a>
                        
                        <!-- Breathing Exercise -->
                        <a href="/breathing-exercise" class="action-card bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl p-5 flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-full bg-teal-100 flex items-center justify-center mb-4 breathing-circle">
                                <i class="fas fa-wind text-teal-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-teal-800 text-lg">Breathing Exercise</h4>
                            <p class="text-teal-600 text-sm mt-1">Calm your mind in minutes</p>
                            <div class="mt-4">
                                <span class="inline-flex items-center text-teal-600">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span class="text-xs">4 min guided session</span>
                                </span>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Journal Section -->
                    <div class="mt-10 bg-white rounded-xl p-5 border border-emerald-200 shadow-sm" x-data="{ expanded: false }">
                        <div class="flex items-center justify-between cursor-pointer" @click="expanded = !expanded">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center">
                                    <i class="fas fa-book text-amber-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-amber-800">Journal About Your Mood</h4>
                                    <p class="text-amber-600 text-sm">Reflect on what you're feeling</p>
                                </div>
                            </div>
                            <div class="text-amber-600 transform transition-transform" :class="{ 'rotate-180': expanded }">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        
                        <!-- Journal Form (Collapsible) -->
                        <div class="expandable mt-4" :class="{ 'expanded': expanded }" x-cloak>
                            <form id="journalForm" class="space-y-4 fade-in">
                                @csrf
                                <input type="hidden" name="entry_date" value="{{ now()->toDateString() }}">
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Journal Title</label>
                                    <input type="text" name="title" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-amber-500 focus:border-amber-500" placeholder="Title your reflection">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Your Reflection</label>
                                    <textarea name="content" rows="4" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-amber-500 focus:border-amber-500" placeholder="What are you thinking and feeling right now?"></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Privacy Setting</label>
                                    <div class="flex space-x-4">
                                        <label class="flex items-center">
                                            <input type="radio" name="privacy" value="private" class="text-amber-600 focus:ring-amber-500" checked>
                                            <span class="ml-2 text-sm">Private</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="privacy" value="shared" class="text-amber-600 focus:ring-amber-500">
                                            <span class="ml-2 text-sm">Share with therapist</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="pt-2">
                                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                                        <i class="fas fa-save mr-2"></i> Save Journal Entry
                                    </button>
                                </div>
                            </form>
                            
                            <!-- Success Message (Hidden by default) -->
                            <div id="journalSuccess" class="mt-4 p-4 bg-emerald-100 border border-emerald-300 rounded-lg text-center hidden">
                                <div class="flex items-center justify-center text-emerald-700">
                                    <i class="fas fa-check-circle text-xl mr-2"></i>
                                    <span class="font-medium">Journal entry saved successfully!</span>
                                </div>
                                <p class="text-emerald-600 mt-1">Your reflection has been recorded</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Daily Challenge -->
                    <div class="mt-6 bg-emerald-50 rounded-xl p-5 border border-emerald-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-medal text-emerald-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-emerald-800">Today's Wellness Challenge</h4>
                                <p class="text-emerald-600 text-sm">Take a 10-minute walk outside</p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <div class="w-full bg-emerald-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full w-1/4"></div>
                            </div>
                            <span class="text-xs text-emerald-600 ml-3">25% complete</span>
                        </div>
                        <button class="mt-4 w-full py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition duration-300">
                            Mark as Complete
                        </button>
                    </div>
                    
                    <!-- Continue button -->
                    <div class="mt-8 text-center">
                        <a href="/dashboard" class="inline-block px-8 py-3 bg-white border border-emerald-500 text-emerald-600 hover:bg-emerald-50 rounded-full font-medium transition duration-300">
                            <i class="fas fa-home mr-2"></i>Return to Dashboard
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Celebration animation -->
            <div class="fixed top-0 left-0 w-full h-full pointer-events-none z-50" id="celebration"></div>
        </div>
        
        <script>
            // Create celebration effect
            document.addEventListener('DOMContentLoaded', function() {
                const celebration = document.getElementById('celebration');
                const emojis = ['🎉', '✨', '💚', '😊', '🌟', '👍'];
                
                for (let i = 0; i < 30; i++) {
                    const emoji = document.createElement('div');
                    emoji.classList.add('absolute', 'text-2xl', 'opacity-0', 'pointer-events-none');
                    emoji.style.left = `${Math.random() * 100}%`;
                    emoji.style.top = `${Math.random() * 100}%`;
                    emoji.textContent = emojis[Math.floor(Math.random() * emojis.length)];
                    celebration.appendChild(emoji);
                    
                    // Animate emojis
                    setTimeout(() => {
                        emoji.style.transition = 'all 1s ease-out';
                        emoji.style.opacity = '1';
                        emoji.style.transform = 'translateY(-20px)';
                        
                        setTimeout(() => {
                            emoji.style.opacity = '0';
                            emoji.style.transform = 'translateY(-50px)';
                        }, 500);
                    }, i * 100);
                }
                
                // Journal form submission
                const journalForm = document.getElementById('journalForm');
                const journalSuccess = document.getElementById('journalSuccess');
                
                if (journalForm) {
                    journalForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        // Simulate form submission (in a real app, this would be an AJAX call)
                        setTimeout(() => {
                            // Hide form and show success message
                            journalForm.classList.add('hidden');
                            journalSuccess.classList.remove('hidden');
                            
                            // Reset form after success
                            setTimeout(() => {
                                journalForm.reset();
                                journalForm.classList.remove('hidden');
                                journalSuccess.classList.add('hidden');
                            }, 3000);
                        }, 800);
                    });
                }
            });
        </script>
    </x-app-layout>
</body>
</html>