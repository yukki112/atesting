<?php
// customer_dashboard.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pastel-pink: #ffd6e7;
            --pastel-blue: #d6f0ff;
            --pastel-purple: #e6d6ff;
            --white: #ffffff;
            --text-dark: #4a4a4a;
            --text-light: #888888;
            --success: #a8e6cf;
            --warning: #ffd3b6;
            --danger: #ffaaa5;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --radius: 16px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--pastel-pink) 0%, var(--pastel-blue) 100%);
            min-height: 100vh;
            padding: 20px;
            color: var(--text-dark);
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Styles */
        .dashboard-header {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideDown 0.6s ease;
        }

        .header-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b9d, #6b8cff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .header-content p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .header-stats {
            display: flex;
            gap: 20px;
        }

        .stat-badge {
            background: var(--pastel-purple);
            padding: 15px 25px;
            border-radius: var(--radius);
            text-align: center;
            min-width: 120px;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #6b8cff;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-top: 5px;
        }

        /* Controls Section */
        .controls-section {
            background: var(--white);
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            animation: slideUp 0.6s ease 0.2s both;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .filter-input {
            padding: 12px 15px;
            border: 2px solid var(--pastel-pink);
            border-radius: 10px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--white);
        }

        .filter-input:focus {
            outline: none;
            border-color: #ff6b9d;
            box-shadow: 0 0 0 3px rgba(255, 107, 157, 0.1);
        }

        .control-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff6b9d, #ff8eb4);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 157, 0.3);
        }

        .btn-secondary {
            background: var(--pastel-blue);
            color: #6b8cff;
        }

        .btn-secondary:hover {
            background: #c2e4ff;
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
        }

        /* Customers Table */
        .customers-section {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            animation: slideUp 0.6s ease 0.4s both;
        }

        .section-header {
            padding: 25px;
            border-bottom: 2px solid var(--pastel-pink);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .table-container {
            overflow-x: auto;
        }

        .customers-table {
            width: 100%;
            border-collapse: collapse;
        }

        .customers-table th {
            background: var(--pastel-blue);
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: #6b8cff;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .customers-table td {
            padding: 18px 20px;
            border-bottom: 1px solid var(--pastel-pink);
            transition: var(--transition);
        }

        .customers-table tbody tr:hover {
            background: var(--pastel-pink);
            transform: scale(1.01);
        }

        .customer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b9d, #6b8cff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .customer-details h4 {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .customer-details p {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .amount {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .transaction-date {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .user-type {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .type-individual {
            background: var(--success);
            color: #2d7a5c;
        }

        .type-business {
            background: var(--pastel-blue);
            color: #6b8cff;
        }

        .type-collector {
            background: var(--pastel-purple);
            color: #8a6bff;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .stats-card {
            background: var(--white);
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            animation: slideUp 0.6s ease 0.6s both;
        }

        .stats-card h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-3px);
        }

        .stat-item:nth-child(1) { background: var(--pastel-pink); }
        .stat-item:nth-child(2) { background: var(--pastel-blue); }
        .stat-item:nth-child(3) { background: var(--success); }
        .stat-item:nth-child(4) { background: var(--pastel-purple); }

        .stat-item .number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-item .label {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .recent-activity {
            background: var(--white);
            padding: 25px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            animation: slideUp 0.6s ease 0.8s both;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: var(--pastel-pink);
            border-radius: 10px;
            transition: var(--transition);
        }

        .activity-item:hover {
            transform: translateX(5px);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--pastel-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b8cff;
        }

        .activity-content h5 {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .activity-content p {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        /* Loading State */
        .loading {
            text-align: center;
            padding: 50px;
            color: var(--text-light);
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--pastel-pink);
            border-top: 4px solid #ff6b9d;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--pastel-pink);
            margin-bottom: 20px;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                display: grid;
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .header-stats {
                justify-content: center;
            }
            
            .filters-grid {
                grid-template-columns: 1fr;
            }
            
            .control-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .header-stats {
                flex-direction: column;
                align-items: center;
            }
            
            .stat-badge {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-content">
                <h1><i class="fas fa-users"></i> Customer Dashboard</h1>
                <p>Manage and monitor your customer relationships</p>
            </div>
            <div class="header-stats">
                <div class="stat-badge">
                    <div class="stat-number" id="totalCustomers">0</div>
                    <div class="stat-label">Total Customers</div>
                </div>
                <div class="stat-badge">
                    <div class="stat-number" id="totalRevenue">₱0</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>
        </header>

        <!-- Controls -->
        <section class="controls-section">
            <div class="filters-grid">
                <div class="filter-group">
                    <label for="search"><i class="fas fa-search"></i> Search Customers</label>
                    <input type="text" id="search" class="filter-input" placeholder="Search by name, email, or phone...">
                </div>
                <div class="filter-group">
                    <label for="userType"><i class="fas fa-filter"></i> Customer Type</label>
                    <select id="userType" class="filter-input">
                        <option value="">All Types</option>
                        <option value="individual">Individual</option>
                        <option value="business">Business</option>
                        <option value="collector">Collector</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="dateFrom"><i class="fas fa-calendar"></i> Date From</label>
                    <input type="date" id="dateFrom" class="filter-input">
                </div>
                <div class="filter-group">
                    <label for="dateTo"><i class="fas fa-calendar"></i> Date To</label>
                    <input type="date" id="dateTo" class="filter-input">
                </div>
            </div>
            <div class="control-buttons">
                <button class="btn btn-secondary" onclick="resetFilters()">
                    <i class="fas fa-redo"></i> Reset Filters
                </button>
                <button class="btn btn-primary" onclick="loadCustomers()">
                    <i class="fas fa-sync"></i> Refresh Data
                </button>
            </div>
        </section>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Customers Table -->
            <section class="customers-section">
                <div class="section-header">
                    <h2><i class="fas fa-list"></i> Customer List</h2>
                    <div class="table-info" id="tableInfo">Showing 0 customers</div>
                </div>
                <div class="table-container">
                    <table class="customers-table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Type</th>
                                <th>Total Spent</th>
                                <th>Last Transaction</th>
                            </tr>
                        </thead>
                        <tbody id="customersTableBody">
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
                <div id="loadingState" class="loading">
                    <div class="loading-spinner"></div>
                    <p>Loading customer data...</p>
                </div>
                <div id="emptyState" class="empty-state" style="display: none;">
                    <i class="fas fa-users"></i>
                    <h3>No customers found</h3>
                    <p>Try adjusting your filters or refresh the data</p>
                </div>
            </section>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Statistics Card -->
                <div class="stats-card">
                    <h3><i class="fas fa-chart-pie"></i> Quick Stats</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="number" id="individualCount">0</div>
                            <div class="label">Individual</div>
                        </div>
                        <div class="stat-item">
                            <div class="number" id="businessCount">0</div>
                            <div class="label">Business</div>
                        </div>
                        <div class="stat-item">
                            <div class="number" id="collectorCount">0</div>
                            <div class="label">Collectors</div>
                        </div>
                        <div class="stat-item">
                            <div class="number" id="newCustomers">0</div>
                            <div class="label">New (30d)</div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="recent-activity">
                    <h3><i class="fas fa-bell"></i> Recent Activity</h3>
                    <div class="activity-list" id="activityList">
                        <!-- Activity items will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // API Configuration
        const API_URL = 'https://frsm.qcprotektado.com/Employee/api/api_customers_simple.php'; // Change this to your API endpoint

        // Global variables
        let customersData = [];
        let filteredData = [];

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            loadCustomers();
            setupEventListeners();
        });

        // Set up event listeners for filters
        function setupEventListeners() {
            const searchInput = document.getElementById('search');
            const userTypeSelect = document.getElementById('userType');
            const dateFromInput = document.getElementById('dateFrom');
            const dateToInput = document.getElementById('dateTo');

            // Add debounced search
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });

            // Other filters
            userTypeSelect.addEventListener('change', applyFilters);
            dateFromInput.addEventListener('change', applyFilters);
            dateToInput.addEventListener('change', applyFilters);
        }

        // Load customers from API
        async function loadCustomers() {
            showLoading(true);
            
            try {
                const response = await fetch(API_URL);
                const data = await response.json();
                
                if (data.success) {
                    customersData = data.data;
                    applyFilters();
                    updateDashboardStats();
                    updateRecentActivity();
                } else {
                    throw new Error('Failed to load data');
                }
            } catch (error) {
                console.error('Error loading customers:', error);
                showError('Failed to load customer data. Please try again.');
            } finally {
                showLoading(false);
            }
        }

        // Apply filters to the data
        function applyFilters() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const userType = document.getElementById('userType').value;
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            filteredData = customersData.filter(customer => {
                // Search filter
                const matchesSearch = !searchTerm || 
                    customer.customer_name.toLowerCase().includes(searchTerm) ||
                    customer.email.toLowerCase().includes(searchTerm) ||
                    customer.phone.includes(searchTerm);

                // User type filter
                const matchesType = !userType || customer.user_type === userType;

                // Date filters (you might need to adjust based on your data structure)
                const customerDate = new Date(customer.created_at);
                const fromDate = dateFrom ? new Date(dateFrom) : null;
                const toDate = dateTo ? new Date(dateTo + 'T23:59:59') : null;

                const matchesFromDate = !fromDate || customerDate >= fromDate;
                const matchesToDate = !toDate || customerDate <= toDate;

                return matchesSearch && matchesType && matchesFromDate && matchesToDate;
            });

            renderCustomersTable();
            updateTableInfo();
        }

        // Render customers table
        function renderCustomersTable() {
            const tbody = document.getElementById('customersTableBody');
            
            if (filteredData.length === 0) {
                document.getElementById('emptyState').style.display = 'block';
                tbody.innerHTML = '';
                return;
            }

            document.getElementById('emptyState').style.display = 'none';

            tbody.innerHTML = filteredData.map(customer => `
                <tr>
                    <td>
                        <div class="customer-info">
                            <div class="customer-avatar">
                                ${getInitials(customer.customer_name)}
                            </div>
                            <div class="customer-details">
                                <h4>${escapeHtml(customer.customer_name)}</h4>
                                <p>@${escapeHtml(customer.username)}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="customer-details">
                            <h4>${escapeHtml(customer.email)}</h4>
                            <p>${escapeHtml(customer.phone)}</p>
                        </div>
                    </td>
                    <td>
                        <span class="user-type type-${customer.user_type}">
                            ${customer.user_type}
                        </span>
                    </td>
                    <td>
                        <div class="amount">₱${formatCurrency(customer.total_spent)}</div>
                    </td>
                    <td>
                        <div class="transaction-date">
                            ${formatDate(customer.last_transaction)}
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // Update dashboard statistics
        function updateDashboardStats() {
            const totalCustomers = customersData.length;
            const totalRevenue = customersData.reduce((sum, customer) => sum + customer.total_spent, 0);
            
            const individualCount = customersData.filter(c => c.user_type === 'individual').length;
            const businessCount = customersData.filter(c => c.user_type === 'business').length;
            const collectorCount = customersData.filter(c => c.user_type === 'collector').length;

            document.getElementById('totalCustomers').textContent = totalCustomers.toLocaleString();
            document.getElementById('totalRevenue').textContent = '₱' + formatCurrency(totalRevenue);
            document.getElementById('individualCount').textContent = individualCount;
            document.getElementById('businessCount').textContent = businessCount;
            document.getElementById('collectorCount').textContent = collectorCount;
            document.getElementById('newCustomers').textContent = Math.floor(totalCustomers * 0.15); // Example calculation
        }

        // Update table information
        function updateTableInfo() {
            const info = document.getElementById('tableInfo');
            info.textContent = `Showing ${filteredData.length} of ${customersData.length} customers`;
        }

        // Update recent activity
        function updateRecentActivity() {
            const activityList = document.getElementById('activityList');
            
            // Sample recent activity - you can replace this with real data
            const activities = [
                { icon: 'fas fa-user-plus', title: 'New Customer', description: 'John Doe registered', time: '2 hours ago' },
                { icon: 'fas fa-shopping-cart', title: 'Large Purchase', description: 'Business customer made big order', time: '5 hours ago' },
                { icon: 'fas fa-star', title: 'Loyalty Update', description: '15 customers reached gold status', time: '1 day ago' },
                { icon: 'fas fa-sync', title: 'Data Refresh', description: 'Customer data updated', time: '2 days ago' }
            ];

            activityList.innerHTML = activities.map(activity => `
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="${activity.icon}"></i>
                    </div>
                    <div class="activity-content">
                        <h5>${activity.title}</h5>
                        <p>${activity.description} • ${activity.time}</p>
                    </div>
                </div>
            `).join('');
        }

        // Utility functions
        function getInitials(name) {
            return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
        }

        function formatCurrency(amount) {
            return parseFloat(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        function formatDate(dateString) {
            if (!dateString) return 'No transactions';
            const date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        }

        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function showLoading(show) {
            document.getElementById('loadingState').style.display = show ? 'block' : 'none';
        }

        function showError(message) {
            // You can implement a toast notification system here
            console.error(message);
            alert(message); // Simple alert for now
        }

        function resetFilters() {
            document.getElementById('search').value = '';
            document.getElementById('userType').value = '';
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            applyFilters();
        }
    </script>
</body>
</html>