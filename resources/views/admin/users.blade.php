<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Moodify</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background-color: #f0fdf4;
  height: 100%;
  overflow-x: hidden;
  overflow-y: auto;
      color: #1e293b;
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
      transition: all 0.3s ease;
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
      gap: 1.5rem;
    }
    
    
    .scrollable-content {
  overflow-y: auto;
  max-height: calc(100vh - 160px); /* make space for header/nav */
  padding-right: 0.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}
    
    .top-navbar {
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      border-radius: 0.75rem;
      padding: 1rem 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    
    .section-card {
      background: white;
      border-radius: 0.75rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      padding: 1.5rem;
    }
    
    .section-header {
      margin-bottom: 1.5rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .section-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--primary-dark);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .section-title i {
      background: var(--primary-light);
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
    }
    
    .form-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.25rem;
    }
    
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    
    .form-group label {
      font-weight: 500;
      color: #334155;
      font-size: 0.9rem;
    }
    
    .form-control {
      padding: 0.75rem 1rem;
      border: 1px solid #cbd5e1;
      border-radius: 0.5rem;
      font-size: 0.95rem;
      transition: all 0.2s;
      background: #f8fafc;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
    }
    
    .btn-primary {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 500;
      font-size: 0.95rem;
      cursor: pointer;
      transition: background 0.2s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);
    }
    
    .btn-primary:hover {
      background: var(--primary-dark);
    }
    
    .btn-primary i {
      font-size: 1rem;
    }
    
    .table-container {
      overflow-x: auto;
      border-radius: 0.75rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .user-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      background: white;
      border-radius: 0.75rem;
      overflow: hidden;
    }
    
    .user-table thead {
      background-color: #f1f5f9;
    }
    
    .user-table th {
      padding: 1rem;
      text-align: left;
      font-weight: 600;
      color: #334155;
      font-size: 0.9rem;
      border-bottom: 1px solid #e2e8f0;
    }
    
    .user-table tbody tr {
      transition: background 0.2s;
    }
    
    .user-table tbody tr:nth-child(even) {
      background-color: #f8fafc;
    }
    
    .user-table tbody tr:hover {
      background-color: var(--primary-light);
    }
    
    .user-table td {
      padding: 1rem;
      border-bottom: 1px solid #e2e8f0;
      font-size: 0.9rem;
      color: #475569;
    }
    
    .role-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 999px;
      font-size: 0.8rem;
      font-weight: 500;
    }
    
    .role-user {
      background-color: #dbeafe;
      color: #3b82f6;
    }
    
    .role-therapist {
      background-color: #dcfce7;
      color: #16a34a;
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
    
    .alert {
      padding: 1rem;
      border-radius: 0.5rem;
      margin-bottom: 1.5rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    
    .alert-success {
      background-color: #dcfce7;
      color: #166534;
      border: 1px solid #bbf7d0;
    }
    
    .alert i {
      font-size: 1.25rem;
    }
    
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
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
      
      .main-content {
        padding: 0.75rem;
      }
    }
    
    @media (max-width: 480px) {
      .main-content {
        padding: 0.5rem;
      }
      
      .top-navbar {
        padding: 0.75rem;
      }
      
      .section-card {
        padding: 1rem;
      }
    }
    
    .action-buttons {
      display: flex;
      gap: 0.5rem;
    }
    
    .btn-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f1f5f9;
      color: #64748b;
      border: none;
      cursor: pointer;
      transition: all 0.2s;
    }
    
    .btn-icon:hover {
      background: #e2e8f0;
    }
    
    .btn-edit {
      color: #3b82f6;
    }
    
    .btn-delete {
      color: #ef4444;
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
          <a href="" class="{{ request()->routeIs('admin.messages') ? 'active' : '' }}">
            <i class="fas fa-comments"></i><span>Messages</span>
          </a>
          <a href="" class="{{ request()->routeIs('admin.moods') ? 'active' : '' }}">
            <i class="fas fa-heartbeat"></i><span>Mood Entries</span>
          </a>
          <a href="" class="{{ request()->routeIs('admin.therapists') ? 'active' : '' }}">
            <i class="fas fa-user-md"></i><span>Therapists</span>
          </a>
          <a href="" class="{{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i><span>Analytics</span>
          </a>
          <a href="" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <i class="fas fa-cog"></i><span>System Settings</span>
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
          <h1 class="text-xl font-bold text-gray-800">Therapist Management</h1>
          <p class="text-sm text-gray-600">Add and manage therapists on the platform</p>
        </div>
        <div class="flex items-center">
          <span class="bg-green-100 text-green-800 text-xs px-2.5 py-0.5 rounded-full flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
            Admin Mode
          </span>
          <span class="text-sm text-gray-600 ml-3">🕒 {{ now()->format('d M Y, H:i') }}</span>
        </div>
      </div>

      <div class="scrollable-content">
  <div class="section-card" style="min-height: 300px;">
    <!-- Add Therapist Form Here -->
     <div class="section-card">
          <div class="section-header">
            <h2 class="section-title">
              <i class="fas fa-user-plus"></i>
              Add New Therapist
            </h2>
          </div>
          
          @if(session('success'))
            <div class="alert alert-success">
              <i class="fas fa-check-circle"></i>
              {{ session('success') }}
            </div>
          @endif
          
          <form action="{{ route('admin.users.add.therapist') }}" method="POST" class="form-container">
            @csrf
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Dr. Jane Smith" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="jane.smith@example.com" required>
            </div>
            
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>
            
            
            
            
            
            <div class="md:col-span-2">
              <button type="submit" class="btn-primary">
                <i class="fas fa-user-plus"></i>
                Add Therapist
              </button>
            </div>
          </form>
        </div>
  </div>

  <div class="section-card" style="min-height: 300px;">
    <!-- User Management Table Here -->
      <div class="section-card">
          <div class="section-header">
            <h2 class="section-title">
              <i class="fas fa-users"></i>
              User Management
            </h2>
            <div class="flex gap-2">
              <div class="relative">
                <input type="text" placeholder="Search users..." class="form-control pl-10" style="padding-left: 2.5rem;">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
              </div>
              <button class="btn-icon">
                <i class="fas fa-filter"></i>
              </button>
            </div>
          </div>
          
          <div class="table-container">
            <table class="user-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Registered At</th>
                  <th>Actions</th>
                </tr>
              </thead>
             <tbody>
@foreach($users as $user)
<tr>
  <td>{{ $user->name }}</td>
  <td>{{ $user->email }}</td>
  <td>
    <span class="role-badge {{ $user->role === 'therapist' ? 'role-therapist' : 'role-user' }}">
      {{ ucfirst($user->role) }}
    </span>
  </td>
  <td>{{ $user->created_at->format('d M Y') }}</td>
  <td>
    <div class="action-buttons">
      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-icon btn-edit">
        <i class="fas fa-edit"></i>
      </a>
      <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-icon btn-delete">
          <i class="fas fa-trash"></i>
        </button>
      </form>
    </div>
  </td>
</tr>
@endforeach
</tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      
      
        

        <!-- User Management Section -->
       
  </div>

  <script>
    // Sidebar toggle functionality
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

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
      const password = document.getElementById('password');
      const confirmPassword = document.getElementById('password_confirmation');
      
      if (password.value !== confirmPassword.value) {
        e.preventDefault();
        alert('Passwords do not match!');
        confirmPassword.focus();
      }
    });
  </script>
</body>
</html>