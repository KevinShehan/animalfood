<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bills & Invoices</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">View and manage all customer bills and invoices.</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="exportBills()" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export
                </button>
                <a href="{{ route('admin.billing.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New Bill
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Bills</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search by customer name, bill number..." 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                </div>
            </div>
            
            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select id="statusFilter" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Status</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="overdue">Overdue</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            
            <!-- Date Range -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date Range</label>
                <select id="dateRange" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6" id="summaryCards">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Bills</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="totalBills">0</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Amount</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="totalAmount">Rs. 0.00</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Paid</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="totalPaid">Rs. 0.00</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Due</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="totalDue">Rs. 0.00</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bills Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Bills List</h3>
                <div class="flex items-center space-x-2">
                    <button onclick="refreshBills()" class="inline-flex items-center px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh
                    </button>
                    <span class="text-sm text-gray-500 dark:text-gray-400" id="lastUpdated">
                        Last updated: <span id="lastUpdatedTime">Never</span>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Loading State -->
        <div id="loadingState" class="hidden p-8 text-center">
            <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-gray-600 dark:text-gray-400">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading bills...
            </div>
        </div>

        <!-- Error State -->
        <div id="errorState" class="hidden p-8 text-center">
            <div class="text-red-600 dark:text-red-400">
                <svg class="mx-auto h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-lg font-medium mb-2">Error loading bills</p>
                <p class="text-sm" id="errorMessage">An error occurred while fetching the bills.</p>
                <button onclick="refreshBills()" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Try Again
                </button>
            </div>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="hidden p-8 text-center">
            <div class="text-gray-500 dark:text-gray-400">
                <svg class="mx-auto h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-lg font-medium mb-2">No bills found</p>
                <p class="text-sm">No bills match your current search criteria.</p>
            </div>
        </div>
        
        <div class="overflow-x-auto" id="tableContainer">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Bill #</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="billsTableBody">
                    <!-- Data will be loaded here dynamically -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6" id="paginationContainer">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button onclick="changePage('prev')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                        Previous
                    </button>
                    <button onclick="changePage('next')" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300" id="paginationInfo">
                            Showing <span class="font-medium">0</span> to <span class="font-medium">0</span> of <span class="font-medium">0</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" id="paginationNav">
                            <!-- Pagination links will be generated here -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        let currentPage = 1;
        let lastPage = 1;
        let searchTerm = '';
        let statusFilter = '';
        let dateRange = '';
        let refreshInterval;

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            loadBills();
            setupEventListeners();
            startAutoRefresh();
        });

        function setupEventListeners() {
            // Search input with debouncing
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    searchTerm = this.value;
                    currentPage = 1;
                    loadBills();
                }, 500);
            });

            // Status filter
            document.getElementById('statusFilter').addEventListener('change', function() {
                statusFilter = this.value;
                currentPage = 1;
                loadBills();
            });

            // Date range filter
            document.getElementById('dateRange').addEventListener('change', function() {
                dateRange = this.value;
                currentPage = 1;
                loadBills();
            });
        }

        function startAutoRefresh() {
            // Refresh every 30 seconds
            refreshInterval = setInterval(() => {
                loadBills(false); // Don't show loading state for auto-refresh
            }, 30000);
        }

        function stopAutoRefresh() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
        }

        function loadBills(showLoading = true) {
            if (showLoading) {
                showLoadingState();
            }

            const params = new URLSearchParams({
                page: currentPage,
                search: searchTerm,
                status: statusFilter,
                dateRange: dateRange
            });

            fetch(`{{ route('admin.billing.api.bills') }}?${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayBills(data);
                        updateSummary(data.summary);
                        updatePagination(data.pagination);
                        updateLastUpdated();
                        hideLoadingState();
                    } else {
                        showError(data.error || 'Failed to load bills');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('Network error occurred while loading bills');
                });
        }

        function displayBills(data) {
            const tbody = document.getElementById('billsTableBody');
            
            if (data.data.length === 0) {
                showEmptyState();
                return;
            }

            hideEmptyState();
            
            tbody.innerHTML = data.data.map(bill => `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">${bill.bill_number}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">${bill.order_number}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">${bill.customer.name}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">${bill.customer.email}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        ${bill.date}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        ${bill.due_date}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Rs. ${bill.amount}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Due: Rs. ${bill.due_amount}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${bill.status_class}">
                            ${bill.status}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <button onclick="viewBill('${bill.bill_number}')" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400 p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="printBill('${bill.bill_number}')" class="text-green-600 hover:text-green-900 dark:hover:text-green-400 p-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteBill('${bill.bill_number}')" class="text-red-600 hover:text-red-900 dark:hover:text-red-400 p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function updateSummary(summary) {
            document.getElementById('totalBills').textContent = summary.total_bills;
            document.getElementById('totalAmount').textContent = `Rs. ${summary.total_amount}`;
            document.getElementById('totalPaid').textContent = `Rs. ${summary.total_paid}`;
            document.getElementById('totalDue').textContent = `Rs. ${summary.total_due}`;
        }

        function updatePagination(pagination) {
            currentPage = pagination.current_page;
            lastPage = pagination.last_page;
            
            document.getElementById('paginationInfo').innerHTML = `
                Showing <span class="font-medium">${pagination.from || 0}</span> to <span class="font-medium">${pagination.to || 0}</span> of <span class="font-medium">${pagination.total}</span> results
            `;

            const nav = document.getElementById('paginationNav');
            nav.innerHTML = '';

            // Previous button
            if (pagination.current_page > 1) {
                nav.innerHTML += `
                    <button onclick="changePage(${pagination.current_page - 1})" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                `;
            }

            // Page numbers
            const start = Math.max(1, pagination.current_page - 2);
            const end = Math.min(pagination.last_page, pagination.current_page + 2);

            for (let i = start; i <= end; i++) {
                nav.innerHTML += `
                    <button onclick="changePage(${i})" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ${i === pagination.current_page ? 'z-10 bg-green-50 border-green-500 text-green-600 dark:bg-green-900 dark:border-green-400 dark:text-green-300' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700'}">
                        ${i}
                    </button>
                `;
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                nav.innerHTML += `
                    <button onclick="changePage(${pagination.current_page + 1})" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                `;
            }
        }

        function changePage(page) {
            currentPage = page;
            loadBills();
        }

        function updateLastUpdated() {
            const now = new Date();
            document.getElementById('lastUpdatedTime').textContent = now.toLocaleTimeString();
        }

        function showLoadingState() {
            document.getElementById('loadingState').classList.remove('hidden');
            document.getElementById('tableContainer').classList.add('hidden');
            document.getElementById('errorState').classList.add('hidden');
            document.getElementById('emptyState').classList.add('hidden');
        }

        function hideLoadingState() {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('tableContainer').classList.remove('hidden');
        }

        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorState').classList.remove('hidden');
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('tableContainer').classList.add('hidden');
            document.getElementById('emptyState').classList.add('hidden');
        }

        function showEmptyState() {
            document.getElementById('emptyState').classList.remove('hidden');
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('tableContainer').classList.add('hidden');
            document.getElementById('errorState').classList.add('hidden');
        }

        function hideEmptyState() {
            document.getElementById('emptyState').classList.add('hidden');
        }

        function refreshBills() {
            loadBills();
        }

        function viewBill(billNumber) {
            Swal.fire({
                title: `Bill ${billNumber}`,
                text: 'Bill details will be displayed here.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }

        function printBill(billNumber) {
            Swal.fire({
                title: `Print Bill ${billNumber}`,
                text: 'Print functionality will be implemented.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }

        function deleteBill(billNumber) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You want to delete bill ${billNumber}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Deleted!', 'Bill has been deleted.', 'success');
                }
            });
        }

        function exportBills() {
            // Get current filters
            const currentFilters = {
                search: searchTerm,
                status: statusFilter,
                dateRange: dateRange
            };

            // Show export options modal
            Swal.fire({
                title: 'Export Bills Report',
                html: `
                    <div class="text-left space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Report Title</label>
                            <input type="text" id="reportTitle" value="Bills Summary Report" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Export Options</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" id="includeSummary" checked class="mr-2">
                                    <span class="text-sm">Include Executive Summary</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="includeDetails" checked class="mr-2">
                                    <span class="text-sm">Include Detailed Bills List</span>
                                </label>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Export Format</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="exportType" value="preview" checked class="mr-2">
                                    <span class="text-sm">Print Preview (New Tab)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="exportType" value="pdf" class="mr-2">
                                    <span class="text-sm">Download PDF</span>
                                </label>
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Export',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                width: '500px',
                preConfirm: () => {
                    const reportTitle = document.getElementById('reportTitle').value;
                    const includeSummary = document.getElementById('includeSummary').checked;
                    const includeDetails = document.getElementById('includeDetails').checked;
                    const exportType = document.querySelector('input[name="exportType"]:checked').value;
                    
                    if (!reportTitle.trim()) {
                        Swal.showValidationMessage('Report title is required');
                        return false;
                    }
                    
                    if (!includeSummary && !includeDetails) {
                        Swal.showValidationMessage('Please select at least one section to include');
                        return false;
                    }
                    
                    return {
                        reportTitle,
                        includeSummary,
                        includeDetails,
                        exportType
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { reportTitle, includeSummary, includeDetails, exportType } = result.value;
                    
                    // Build export URL with parameters
                    const params = new URLSearchParams({
                        ...currentFilters,
                        title: reportTitle,
                        include_summary: includeSummary,
                        include_details: includeDetails,
                        type: exportType
                    });
                    
                    const exportUrl = `{{ route('admin.billing.export') }}?${params}`;
                    
                    if (exportType === 'preview') {
                        // Open print preview in new tab
                        window.open(exportUrl, '_blank');
                        Swal.fire({
                            title: 'Print Preview Opened',
                            text: 'The print preview has been opened in a new tab.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Download PDF
                        Swal.fire({
                            title: 'Generating PDF',
                            text: 'Please wait while we generate your PDF report...',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Create a temporary link to trigger download
                        const link = document.createElement('a');
                        link.href = exportUrl;
                        link.download = `bills_report_${new Date().toISOString().slice(0, 10)}.pdf`;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        
                        setTimeout(() => {
                            Swal.fire({
                                title: 'PDF Generated',
                                text: 'Your PDF report has been downloaded successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        }, 2000);
                    }
                }
            });
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', function() {
            stopAutoRefresh();
        });
    </script>
</x-admin-layout>
