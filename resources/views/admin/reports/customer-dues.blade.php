<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Customer Dues Report</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Track customer credit, outstanding payments, and dues.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.reports.export-dues') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export CSV
                </a>
                <a href="{{ route('admin.reports.aging-report') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                    </svg>
                    Aging Report
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Customers</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_customers']) }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">With Credit</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['customers_with_credit']) }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">With Dues</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['customers_with_dues']) }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Overdue</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['overdue_customers']) }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Outstanding</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">Rs. {{ number_format($stats['total_outstanding'], 2) }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Overdue Amount</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">Rs. {{ number_format($stats['overdue_amount'], 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Customer</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Name, email, or phone..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Credit Status -->
            <div>
                <label for="credit_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Credit Status</label>
                <select id="credit_status" name="credit_status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Status</option>
                    <option value="active" {{ request('credit_status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="suspended" {{ request('credit_status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                    <option value="blocked" {{ request('credit_status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
            </div>

            <!-- Has Dues -->
            <div>
                <label for="has_dues" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Has Dues</label>
                <select id="has_dues" name="has_dues" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Customers</option>
                    <option value="yes" {{ request('has_dues') === 'yes' ? 'selected' : '' }}>With Dues</option>
                    <option value="no" {{ request('has_dues') === 'no' ? 'selected' : '' }}>No Dues</option>
                </select>
            </div>

            <!-- Overdue Only -->
            <div>
                <label for="overdue_only" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Show Only</label>
                <select id="overdue_only" name="overdue_only" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Customers</option>
                    <option value="yes" {{ request('overdue_only') === 'yes' ? 'selected' : '' }}>Overdue Only</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="button" id="filterBtn" class="w-full px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                    </svg>
                    Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Customer Dues Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Credit Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Outstanding</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Overdue</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($customers as $customer)
                    @php
                        $totalDue = $customer->orders->sum('due_amount');
                        $overdueOrders = $customer->orders->filter(function($order) {
                            return $order->due_date && $order->due_date->isPast();
                        });
                        $overdueAmount = $overdueOrders->sum('due_amount');
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ substr($customer->name, 0, 2) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $customer->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $customer->email }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $customer->phone }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($customer->credit)
                                <div class="text-sm text-gray-900 dark:text-white">
                                    <div>Limit: <span class="font-medium">Rs. {{ number_format($customer->credit->credit_limit, 2) }}</span></div>
                                    <div>Balance: <span class="font-medium">Rs. {{ number_format($customer->credit->current_balance, 2) }}</span></div>
                                    <div>Available: <span class="font-medium">Rs. {{ number_format($customer->credit->available_credit, 2) }}</span></div>
                                </div>
                                @if($customer->credit->utilization_percentage > 0)
                                <div class="mt-1">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-{{ $customer->credit->utilization_percentage > 90 ? 'red' : ($customer->credit->utilization_percentage > 75 ? 'yellow' : 'green') }}-600 h-2 rounded-full" style="width: {{ min($customer->credit->utilization_percentage, 100) }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $customer->credit->utilization_percentage }}% utilized</div>
                                </div>
                                @endif
                            @else
                                <span class="text-sm text-gray-500 dark:text-gray-400">No credit setup</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($totalDue > 0)
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Rs. {{ number_format($totalDue, 2) }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $customer->orders->count() }} orders</div>
                            @else
                                <span class="text-sm text-green-600 dark:text-green-400">No dues</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($overdueAmount > 0)
                                <div class="text-sm font-medium text-red-600 dark:text-red-400">Rs. {{ number_format($overdueAmount, 2) }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $overdueOrders->count() }} orders</div>
                            @else
                                <span class="text-sm text-gray-500 dark:text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($customer->credit)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($customer->credit->credit_status === 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif($customer->credit->credit_status === 'suspended') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                    @endif">
                                    {{ $customer->credit->formatted_credit_status }}
                                </span>
                            @endif
                            @if($overdueAmount > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 ml-1">
                                    Overdue
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.reports.customer-statement', $customer) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20" title="View Statement">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </a>
                                @if($totalDue > 0)
                                    <a href="{{ route('admin.payments.create', ['customer_id' => $customer->id]) }}" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 p-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20" title="Record Payment">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </a>
                                @endif
                                <a href="{{ route('admin.reports.customer-statement', ['customer' => $customer->id, 'format' => 'pdf']) }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 p-1 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20" title="Download PDF">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <p class="mt-2">No customers found matching the criteria.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($customers->hasPages())
    <div class="mt-6">
        {{ $customers->links() }}
    </div>
    @endif

    <script>
        // Filter functionality
        document.getElementById('filterBtn').addEventListener('click', function() {
            const search = document.getElementById('search').value;
            const creditStatus = document.getElementById('credit_status').value;
            const hasDues = document.getElementById('has_dues').value;
            const overdueOnly = document.getElementById('overdue_only').value;

            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (creditStatus) params.append('credit_status', creditStatus);
            if (hasDues) params.append('has_dues', hasDues);
            if (overdueOnly) params.append('overdue_only', overdueOnly);

            window.location.href = `{{ route('admin.reports.customer-dues') }}?${params.toString()}`;
        });

        // Enter key support for search
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('filterBtn').click();
            }
        });
    </script>
</x-admin-layout>
