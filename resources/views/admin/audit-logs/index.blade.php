<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Audit Logs</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Track all important changes and system activities.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Logs</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white" id="total-logs">{{ number_format($auditLogs->total()) }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Today</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white" id="today-logs">-</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">This Week</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white" id="week-logs">-</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">This Month</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white" id="month-logs">-</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" id="search" placeholder="Search logs..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <!-- Action Filter -->
                <div>
                    <label for="action" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Action</label>
                    <select id="action" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">All Actions</option>
                        @foreach($actions as $action)
                            <option value="{{ $action }}">{{ ucfirst($action) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Model Filter -->
                <div>
                    <label for="model_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Model</label>
                    <select id="model_type" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">All Models</option>
                        @foreach($modelTypes as $model)
                            <option value="{{ $model['value'] }}">{{ $model['label'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- User Filter -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">User</label>
                    <select id="user_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Activity Type Filter -->
                <div>
                    <label for="activity_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Activity Type</label>
                    <select id="activity_type" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">All Activities</option>
                        @foreach($activityTypes as $type)
                            <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date From -->
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <input type="date" id="date_from" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <!-- Date To -->
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <input type="date" id="date_to" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
            </div>

            <div class="flex justify-between items-center mt-4">
                <div class="flex space-x-2">
                    <button id="clear-filters" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Clear Filters
                    </button>
                    <button id="view-login-history" class="px-4 py-2 text-sm font-medium text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/20 border border-blue-300 dark:border-blue-600 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        User Login History
                    </button>
                    <button id="view-bill-header-history" class="px-4 py-2 text-sm font-medium text-green-700 dark:text-green-300 bg-green-50 dark:bg-green-900/20 border border-green-300 dark:border-green-600 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Bill Header Changes
                    </button>
                </div>
                <div class="flex space-x-2">
                    <button id="export-btn" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export CSV
                    </button>
                    <button id="cleanup-btn" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Cleanup Old Logs
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Audit Logs Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div id="audit-logs-container">
            @include('admin.audit-logs.table')
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-6 border w-full max-w-4xl shadow-xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Audit Log Details</h3>
                    <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-1 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="modal-content">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Cleanup Modal -->
    <div id="cleanupModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-6 border w-full max-w-md shadow-xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Cleanup Old Logs</h3>
                    <button onclick="closeCleanupModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-1 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="cleanupForm">
                    <div class="mb-4">
                        <label for="cleanup_days" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Delete logs older than (days):
                        </label>
                        <input type="number" id="cleanup_days" name="days" min="30" max="3650" value="180" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Minimum 30 days, maximum 10 years</p>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeCleanupModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Delete Logs
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let currentFilters = {};

        // Load stats on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadStats();
            
            // Set up event listeners for filters
            ['search', 'action', 'model_type', 'user_id', 'activity_type', 'date_from', 'date_to'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('change', filterLogs);
                }
            });
            
            // Debounce search input
            let searchTimeout;
            const searchElement = document.getElementById('search');
            if (searchElement) {
                searchElement.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(filterLogs, 300);
                });
            }
        });

        function loadStats() {
            fetch('/admin/audit-logs/stats')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to load stats');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error('Stats error:', data.error);
                        return;
                    }
                    
                    const todayElement = document.getElementById('today-logs');
                    const weekElement = document.getElementById('week-logs');
                    const monthElement = document.getElementById('month-logs');
                    const totalElement = document.getElementById('total-logs');
                    
                    if (todayElement) todayElement.textContent = data.today_logs || 0;
                    if (weekElement) weekElement.textContent = data.this_week_logs || 0;
                    if (monthElement) monthElement.textContent = data.this_month_logs || 0;
                    if (totalElement) totalElement.textContent = data.total_logs || 0;
                })
                .catch(error => {
                    console.error('Error loading stats:', error);
                    // Set default values if stats fail to load
                    const elements = ['today-logs', 'week-logs', 'month-logs'];
                    elements.forEach(id => {
                        const element = document.getElementById(id);
                        if (element) element.textContent = '0';
                    });
                });
        }

        function filterLogs() {
            const filters = {
                search: document.getElementById('search')?.value || '',
                action: document.getElementById('action')?.value || '',
                model_type: document.getElementById('model_type')?.value || '',
                user_id: document.getElementById('user_id')?.value || '',
                activity_type: document.getElementById('activity_type')?.value || '',
                date_from: document.getElementById('date_from')?.value || '',
                date_to: document.getElementById('date_to')?.value || ''
            };

            currentFilters = filters;

            const params = new URLSearchParams();
            Object.keys(filters).forEach(key => {
                if (filters[key]) params.append(key, filters[key]);
            });

            // Show loading state
            const container = document.getElementById('audit-logs-container');
            if (container) {
                container.innerHTML = '<div class="text-center py-8"><div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div><p class="mt-2 text-gray-600">Loading...</p></div>';
            }

            fetch(`/admin/audit-logs?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load audit logs');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                
                if (container) {
                    container.innerHTML = data.html || '<div class="text-center py-8 text-gray-600">No audit logs found</div>';
                }
                
                // Update pagination if available
                const paginationContainer = document.querySelector('.pagination-container');
                if (paginationContainer && data.pagination) {
                    paginationContainer.innerHTML = data.pagination;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (container) {
                    container.innerHTML = '<div class="text-center py-8 text-red-600">Failed to load audit logs. Please try again.</div>';
                }
                Swal.fire('Error!', 'Failed to load audit logs', 'error');
            });
        }

        function clearFilters() {
            const filterIds = ['search', 'action', 'model_type', 'user_id', 'activity_type', 'date_from', 'date_to'];
            filterIds.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.value = '';
                }
            });
            filterLogs();
        }

        function viewDetails(id) {
            fetch(`/admin/audit-logs/${id}`)
                .then(response => response.json())
                .then(data => {
                    const modalContent = `
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Basic Information</h4>
                                    <div class="space-y-2 text-sm">
                                        <div><span class="font-medium">Action:</span> ${data.formatted_action}</div>
                                        <div><span class="font-medium">Model:</span> ${data.model_name}</div>
                                        <div><span class="font-medium">Model ID:</span> ${data.model_id}</div>
                                        <div><span class="font-medium">Date:</span> ${new Date(data.created_at).toLocaleString()}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">User Information</h4>
                                    <div class="space-y-2 text-sm">
                                        <div><span class="font-medium">User:</span> ${data.user_name || 'System'}</div>
                                        <div><span class="font-medium">IP Address:</span> ${data.ip_address || 'N/A'}</div>
                                        <div><span class="font-medium">URL:</span> ${data.url || 'N/A'}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Description</h4>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">${data.description || 'No description available'}</p>
                                </div>

                                ${data.old_values ? `
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Previous Values</h4>
                                    <pre class="text-xs bg-gray-100 dark:bg-gray-800 p-2 rounded overflow-auto">${JSON.stringify(data.old_values, null, 2)}</pre>
                                </div>
                                ` : ''}

                                ${data.new_values ? `
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">New Values</h4>
                                    <pre class="text-xs bg-gray-100 dark:bg-gray-800 p-2 rounded overflow-auto">${JSON.stringify(data.new_values, null, 2)}</pre>
                                </div>
                                ` : ''}
                            </div>
                        </div>
                    `;
                    
                    document.getElementById('modal-content').innerHTML = modalContent;
                    document.getElementById('viewModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to load audit log details', 'error');
                });
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        function openCleanupModal() {
            document.getElementById('cleanupModal').classList.remove('hidden');
        }

        function closeCleanupModal() {
            document.getElementById('cleanupModal').classList.add('hidden');
        }

        function showUserLoginHistory() {
            Swal.fire({
                title: 'User Login History',
                html: `
                    <div class="text-left">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select User</label>
                        <select id="user-select" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select a user...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'View History',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    const userId = document.getElementById('user-select').value;
                    if (!userId) {
                        Swal.showValidationMessage('Please select a user');
                        return false;
                    }
                    return userId;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const userId = result.value;
                    fetch(`/admin/audit-logs/user/login-history?user_id=${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                Swal.fire('Error!', data.error, 'error');
                                return;
                            }

                            const historyHtml = data.login_history.map(log => `
                                <div class="border-b border-gray-200 py-2">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="font-medium">${log.action}</span>
                                            <span class="text-sm text-gray-500 ml-2">${new Date(log.created_at).toLocaleString()}</span>
                                        </div>
                                        <span class="text-xs px-2 py-1 rounded ${getActionBadgeClass(log.action)}">${log.action}</span>
                                    </div>
                                    <div class="text-sm text-gray-600 mt-1">${log.description}</div>
                                    <div class="text-xs text-gray-500 mt-1">IP: ${log.ip_address}</div>
                                </div>
                            `).join('');

                            Swal.fire({
                                title: `Login History - ${data.user.name}`,
                                html: `
                                    <div class="text-left max-h-96 overflow-y-auto">
                                        <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                                            <div class="grid grid-cols-2 gap-4 text-sm">
                                                <div><strong>Total Logins:</strong> ${data.summary.total_logins}</div>
                                                <div><strong>Total Logouts:</strong> ${data.summary.total_logouts}</div>
                                                <div><strong>Failed Attempts:</strong> ${data.summary.failed_attempts}</div>
                                                <div><strong>Last Login:</strong> ${data.summary.last_login ? new Date(data.summary.last_login).toLocaleString() : 'N/A'}</div>
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            ${historyHtml}
                                        </div>
                                    </div>
                                `,
                                width: '600px',
                                confirmButtonText: 'Close'
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error!', 'Failed to load login history', 'error');
                        });
                }
            });
        }

        function showBillHeaderHistory() {
            fetch('/admin/audit-logs/bill-header/history')
                .then(response => response.json())
                .then(data => {
                    const historyHtml = data.history.map(log => `
                        <div class="border-b border-gray-200 py-2">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-medium">${log.user_name}</span>
                                    <span class="text-sm text-gray-500 ml-2">${new Date(log.created_at).toLocaleString()}</span>
                                </div>
                                <span class="text-xs px-2 py-1 rounded bg-green-100 text-green-800">Bill Header Updated</span>
                            </div>
                            <div class="text-sm text-gray-600 mt-1">${log.description}</div>
                            <div class="text-xs text-gray-500 mt-1">IP: ${log.ip_address}</div>
                            ${log.changed_fields && log.changed_fields.length > 0 ? `
                                <div class="mt-2">
                                    <span class="text-xs font-medium text-gray-700">Changed Fields:</span>
                                    <span class="text-xs text-gray-600 ml-1">${log.changed_fields.join(', ')}</span>
                                </div>
                            ` : ''}
                        </div>
                    `).join('');

                    const changesByUser = Object.entries(data.summary.changes_by_user).map(([user, count]) => 
                        `<div class="flex justify-between"><span>${user}</span><span class="font-medium">${count}</span></div>`
                    ).join('');

                    Swal.fire({
                        title: 'Bill Header Change History',
                        html: `
                            <div class="text-left max-h-96 overflow-y-auto">
                                <div class="mb-4 p-3 bg-green-50 rounded-lg">
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div><strong>Total Changes:</strong> ${data.summary.total_changes}</div>
                                        <div><strong>Last Change:</strong> ${data.summary.last_change ? new Date(data.summary.last_change).toLocaleString() : 'N/A'}</div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="font-medium text-sm mb-2">Changes by User:</div>
                                        <div class="space-y-1 text-sm">
                                            ${changesByUser}
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    ${historyHtml}
                                </div>
                            </div>
                        `,
                        width: '700px',
                        confirmButtonText: 'Close'
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to load bill header history', 'error');
                });
        }

        function getActionBadgeClass(action) {
            switch (action) {
                case 'login':
                    return 'bg-green-100 text-green-800';
                case 'logout':
                    return 'bg-blue-100 text-blue-800';
                case 'login_failed':
                    return 'bg-red-100 text-red-800';
                case 'session_timeout':
                    return 'bg-yellow-100 text-yellow-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        // Event Listeners
        document.getElementById('clear-filters').addEventListener('click', clearFilters);
        document.getElementById('cleanup-btn').addEventListener('click', openCleanupModal);
        document.getElementById('view-login-history').addEventListener('click', showUserLoginHistory);
        document.getElementById('view-bill-header-history').addEventListener('click', showBillHeaderHistory);

        document.getElementById('export-btn').addEventListener('click', function() {
            const params = new URLSearchParams(currentFilters);
            window.location.href = `/admin/audit-logs/export?${params.toString()}`;
        });

        document.getElementById('cleanupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const days = document.getElementById('cleanup_days').value;
            
            if (!days || days < 30 || days > 3650) {
                Swal.fire('Error!', 'Please enter a valid number of days (30-3650)', 'error');
                return;
            }
            
            Swal.fire({
                title: 'Are you sure?',
                text: `This will permanently delete all audit logs older than ${days} days. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Yes, delete logs'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                     document.querySelector('input[name="_token"]')?.value;
                    
                    if (!csrfToken) {
                        Swal.fire('Error!', 'CSRF token not found. Please refresh the page and try again.', 'error');
                        return;
                    }
                    
                    fetch('/admin/audit-logs/cleanup', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ days: parseInt(days) })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success!', data.message, 'success');
                            closeCleanupModal();
                            filterLogs(); // Reload the logs
                            loadStats(); // Reload stats
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to cleanup logs', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Failed to cleanup logs. Please try again.', 'error');
                    });
                }
            });
        });
    </script>
</x-admin-layout>
