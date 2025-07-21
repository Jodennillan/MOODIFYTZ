<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Moodify</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #16a34a;
      --primary-dark: #15803d;
      --primary-light: #dcfce7;
      --secondary: #1e293b;
      --accent: #22c55e;
    }
    
    * {
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f0fdf4;
      margin: 0;
      padding: 0;
      height: 100vh;
      overflow: hidden;
    }
    
    .dashboard-container {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    
    .sidebar {
      width: 64px;
      background-color: var(--secondary);
      color: white;
      transition: all 0.3s;
      overflow-y: auto;
      padding: 1rem 0.5rem;
      flex-shrink: 0;
      z-index: 100;
    }
    
    .sidebar.expanded {
      width: 256px;
    }
    
    .sidebar-content {
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    
    .sidebar a {
      display: flex;
      align-items: center;
      padding: 0.75rem 0.5rem;
      color: #e2e8f0;
      text-decoration: none;
      transition: all 0.2s;
      border-radius: 0.375rem;
      margin-bottom: 0.25rem;
      white-space: nowrap;
      overflow: hidden;
    }
    
    .sidebar a span {
      margin-left: 12px;
      opacity: 0;
      transition: opacity 0.3s;
    }
    
    .sidebar.expanded a span {
      opacity: 1;
    }
    
    .sidebar a:hover {
      background-color: #334155;
      color: white;
      transform: translateX(3px);
    }
    
    .sidebar a.active {
      background-color: var(--primary);
      color: white;
    }
    
    .sidebar i {
      width: 24px;
      text-align: center;
      flex-shrink: 0;
    }
    
    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      padding: 1rem;
      background-color: #f8fafc;
    }
    
    .scrollable-content {
      overflow-y: auto;
      padding-right: 0.5rem;
      flex: 1;
    }
    
    .top-navbar {
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border-radius: 0.5rem;
      padding: 0.75rem 1.25rem;
      margin-bottom: 1rem;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    
    .metric-card {
      transition: transform 0.3s, box-shadow 0.3s;
      border-left: 4px solid var(--primary);
      height: 100%;
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .metric-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    .chart-container {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      height: 100%;
    }
    
    .chart-wrapper {
      height: 200px;
      position: relative;
    }
    
    .activity-item {
      border-left: 3px solid var(--primary);
      transition: all 0.2s;
      padding: 0.75rem;
      border-radius: 0.25rem;
      background: white;
      margin-bottom: 0.5rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .activity-item:hover {
      background-color: var(--primary-light);
    }
    
    .compact-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1rem;
      margin-bottom: 1rem;
    }
    
    .compact-section {
      margin-bottom: 1rem;
    }
    
    .compact-charts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1rem;
      margin-bottom: 1rem;
    }
    
    .sidebar-toggle {
      display: flex;
      justify-content: center;
      padding: 0.75rem 0;
      cursor: pointer;
      color: #e2e8f0;
      transition: all 0.3s;
    }
    
    .sidebar-toggle:hover {
      color: white;
    }
    
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }
    
    .stat-card {
      border-radius: 0.5rem;
      padding: 1rem;
      color: white;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card.system {
      background: linear-gradient(135deg, #16a34a, #0d8a3c);
    }
    
    .stat-card.performance {
      background: linear-gradient(135deg, #3b82f6, #2563eb);
    }
    
    .stat-card.sessions {
      background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }
    
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8;
    }
    
    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        height: 100%;
      }
      
      .sidebar:not(.expanded) {
        transform: translateX(-100%);
      }
      
      .sidebar.expanded {
        transform: translateX(0);
        width: 250px;
      }
      
      .sidebar a span {
        opacity: 1;
      }
      
      .compact-grid {
        grid-template-columns: 1fr 1fr;
      }
      
      .main-content {
        padding: 0.75rem;
      }
    }
    
    @media (max-width: 480px) {
      .compact-grid {
        grid-template-columns: 1fr;
      }
      
      .compact-charts {
        grid-template-columns: 1fr;
      }
      
      .main-content {
        padding: 0.5rem;
      }
      
      .top-navbar {
        padding: 0.75rem;
      }
    }
    
    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 1rem 0.5rem;
    }
    
    .chart-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #1e293b;
    }
    
    .chart-select {
      border: 1px solid #cbd5e1;
      border-radius: 0.375rem;
      padding: 0.25rem 0.5rem;
      font-size: 0.8rem;
      background: white;
    }
    
    .metric-content {
      padding: 1rem;
    }
    
    .metric-title {
      font-size: 0.9rem;
      color: #64748b;
      margin-bottom: 0.5rem;
    }
    
    .metric-value {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 0.5rem;
    }
    
    .metric-trend {
      display: flex;
      align-items: center;
      font-size: 0.8rem;
      font-weight: 500;
      color: #16a34a;
    }
    
    .metric-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-left: auto;
    }
    
    .users-icon {
      background-color: #dcfce7;
      color: #16a34a;
    }
    
    .therapists-icon {
      background-color: #dbeafe;
      color: #3b82f6;
    }
    
    .messages-icon {
      background-color: #ede9fe;
      color: #8b5cf6;
    }
    
    .moods-icon {
      background-color: #fce7f3;
      color: #ec4899;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar expanded" id="sidebar">
      <div class="sidebar-content">
        <div class="flex items-center mb-6 pl-2">
          <div class="bg-green-500 p-2 rounded-lg mr-3">
            <i class="fas fa-cogs text-white text-xl"></i>
          </div>
          <h2 class="text-xl font-bold text-white">Moodify</h2>
        </div>
        
        <nav class="flex-1">
         <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i><span>Dashboard</span>
          </a>
          <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <i class="fas fa-users"></i><span>Manage Users</span>
          </a>
          <a href="#">
            <i class="fas fa-comments"></i>
            <span>Messages</span>
          </a>
          <a href="#">
            <i class="fas fa-heartbeat"></i>
            <span>Mood Entries</span>
          </a>
          <a href="#">
            <i class="fas fa-user-md"></i>
            <span>Therapists</span>
          </a>
          <a href="#">
            <i class="fas fa-chart-bar"></i>
            <span>Analytics</span>
          </a>
          <a href="#">
            <i class="fas fa-cog"></i>
            <span>System Settings</span>
          </a>
        </nav>
        
        <div class="mt-auto pt-4 border-t border-gray-700">
           <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       🚪 Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
      @csrf
    </form>
        </div>
        
        <div class="sidebar-toggle" id="toggleSidebar">
          <i class="fas fa-chevron-left"></i>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Top Navbar -->
      <div class="top-navbar">
        <div>
          <h1 class="text-xl font-bold text-gray-800">Dashboard Overview</h1>
          <p class="text-sm text-gray-600">Monitor platform activity and system health</p>
        </div>
        <div class="flex items-center">
          <span class="bg-green-100 text-green-800 text-xs px-2.5 py-0.5 rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
            Live
          </span>
          <span class="text-sm text-gray-600 ml-3">🕒 {{ now()->format('d M Y, H:i') }}</span>
        </div>
      </div>
      
      <div class="scrollable-content">
        <!-- Dashboard Metrics -->
        <div class="compact-grid">
          <div class="metric-card">
            <div class="metric-content">
              <div class="flex">
                <div>
                  <div class="metric-title">Total Users</div>
                  <div class="metric-value">{{ number_format($userCount) }}</div>
                  <div class="metric-trend">
                    <i class="fas fa-arrow-up mr-1"></i> 12.5% this month
                  </div>
                </div>
                <div class="metric-icon users-icon">
                  <i class="fas fa-users"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="metric-card">
            <div class="metric-content">
              <div class="flex">
                <div>
                  <div class="metric-title">Therapists</div>
                  <div class="metric-value">{{ number_format($therapistCount) }}</div>
                  <div class="metric-trend">
                    <i class="fas fa-arrow-up mr-1"></i> 8.2% this month
                  </div>
                </div>
                <div class="metric-icon therapists-icon">
                  <i class="fas fa-user-md"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="metric-card">
            <div class="metric-content">
              <div class="flex">
                <div>
                  <div class="metric-title">Messages</div>
                  <div class="metric-value">{{ number_format($messagesCount) }}</div>
                  <div class="metric-trend">
                    <i class="fas fa-arrow-up mr-1"></i> 24.7% this month
                  </div>
                </div>
                <div class="metric-icon messages-icon">
                  <i class="fas fa-comments"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="metric-card">
            <div class="metric-content">
              <div class="flex">
                <div>
                  <div class="metric-title">Mood Entries</div>
                  <div class="metric-value">{{ number_format($moodsCount) }}</div>
                  <div class="metric-trend">
                    <i class="fas fa-arrow-up mr-1"></i> 18.3% this month
                  </div>
                </div>
                <div class="metric-icon moods-icon">
                  <i class="fas fa-heartbeat"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Charts and Visualization -->
        <div class="compact-charts compact-section">
          <div class="chart-container">
            <div class="chart-header">
              <h3 class="chart-title">User Registrations</h3>
              <select class="chart-select">
                <option>Last 7 days</option>
                <option selected>Last 30 days</option>
                <option>Last 90 days</option>
              </select>
            </div>
            <div class="chart-wrapper">
              <canvas id="registrationsChart"></canvas>
            </div>
          </div>
          
          <div class="chart-container">
            <div class="chart-header">
              <h3 class="chart-title">Mood Distribution</h3>
              <select class="chart-select">
                <option>Today</option>
                <option selected>This Week</option>
                <option>This Month</option>
              </select>
            </div>
            <div class="chart-wrapper">
              <canvas id="moodChart"></canvas>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="compact-section">
          <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
              <h3 class="text-lg font-semibold text-gray-800">Recent Activities</h3>
              <a href="#" class="text-green-600 text-sm hover:underline">View All</a>
            </div>
            
            <div class="p-4">
              @foreach($recentActivities as $activity)
              <div class="activity-item">
                <div class="flex justify-between">
                  <p class="font-medium text-sm">{{ $activity['title'] }}</p>
                  <span class="text-xs text-gray-500">{{ $activity['time'] }}</span>
                </div>
                <p class="text-gray-600 text-sm mt-1">{{ $activity['description'] }}</p>
              </div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid compact-section">
          <div class="stat-card system">
            <h3 class="text-base mb-3">System Health</h3>
            <div class="flex items-end justify-between">
              <p class="text-2xl font-bold">98%</p>
              <div class="text-right">
                <p class="text-sm opacity-90">Uptime</p>
                <p class="text-xs opacity-75">Last 30 days</p>
              </div>
            </div>
          </div>
          
          <div class="stat-card performance">
            <h3 class="text-base mb-3">Avg. Response Time</h3>
            <div class="flex items-end justify-between">
              <p class="text-2xl font-bold">320ms</p>
              <div class="text-right">
                <p class="text-sm opacity-90">API Requests</p>
                <p class="text-xs opacity-75">Real-time</p>
              </div>
            </div>
          </div>
          
          <div class="stat-card sessions">
            <h3 class="text-base mb-3">Active Sessions</h3>
            <div class="flex items-end justify-between">
              <p class="text-2xl font-bold">142</p>
              <div class="text-right">
                <p class="text-sm opacity-90">Currently online</p>
                <p class="text-xs opacity-75">Across platform</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // User Registrations Chart
  const regCtx = document.getElementById('registrationsChart').getContext('2d');
  new Chart(regCtx, {
    type: 'line',
    data: {
      labels: {!! json_encode($registrationLabels) !!},
      datasets: [{
        label: 'User Registrations',
        data: {!! json_encode($registrationData) !!},
        borderColor: '#16a34a',
        backgroundColor: 'rgba(22, 163, 74, 0.1)',
        tension: 0.3,
        fill: true,
        pointBackgroundColor: '#16a34a',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#16a34a'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { stepSize: 5 },
          grid: { color: 'rgba(0, 0, 0, 0.05)' }
        },
        x: {
          grid: { display: false }
        }
      }
    }
  });

  // Mood Distribution Chart
  const moodCtx = document.getElementById('moodChart').getContext('2d');
  new Chart(moodCtx, {
    type: 'doughnut',
    data: {
      labels: {!! json_encode($moodLabels) !!},
      datasets: [{
        data: {!! json_encode($moodData) !!},
        backgroundColor: [
          '#16a34a', '#22c55e', '#86efac', '#f59e0b', '#ef4444', '#6366f1', '#ec4899'
        ],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'right',
          labels: {
            boxWidth: 12,
            font: { size: 10 },
            padding: 12
          }
        }
      },
      cutout: '65%'
    }
  });

  // Sidebar toggle
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('toggleSidebar');
  const toggleIcon = toggleBtn.querySelector('i');

  toggleBtn.addEventListener('click', function() {
    sidebar.classList.toggle('expanded');
    if (sidebar.classList.contains('expanded')) {
      toggleIcon.classList.remove('fa-chevron-right');
      toggleIcon.classList.add('fa-chevron-left');
    } else {
      toggleIcon.classList.remove('fa-chevron-left');
      toggleIcon.classList.add('fa-chevron-right');
    }
  });
});
</script>
</body>
</html>