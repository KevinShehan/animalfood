<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Welcome back! Here's what's happening with your animal food business today.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
        <!-- Today's Sales -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Today's Sales</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="today-sales">Rs. 0.00</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-green-600 dark:text-green-400 font-medium" id="sales-target-progress">0%</span>
                    <span class="text-gray-500 dark:text-gray-400">of daily target</span>
                </div>
            </div>
        </div>

        <!-- Today's Refunds -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Today's Refunds</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="today-refunds">Rs. 0.00</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-red-600 dark:text-red-400 font-medium" id="net-sales">Rs. 0.00</span>
                    <span class="text-gray-500 dark:text-gray-400">net sales</span>
                </div>
            </div>
        </div>

        <!-- Products in Stock -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Products in Stock</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="productsInStock">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-yellow-600 dark:text-yellow-400 font-medium" id="productsInStockChange">0</span>
                    <span class="text-gray-500 dark:text-gray-400">products in stock</span>
                </div>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Low Stock Items</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="lowStockCount">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-red-600 dark:text-red-400 font-medium" id="lowStockChange">0</span>
                    <span class="text-gray-500 dark:text-gray-400">items need attention</span>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-emerald-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Monthly Revenue</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="monthlyRevenue">Rs. 0.00</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-emerald-600 dark:text-emerald-400 font-medium" id="revenueGrowth">+0%</span>
                    <span class="text-gray-500 dark:text-gray-400">from last month</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Alerts Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Expiring Soon -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Expiring Soon</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="expiringCount">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-yellow-600 dark:text-yellow-400 font-medium" id="expiringChange">0</span>
                    <span class="text-gray-500 dark:text-gray-400">items expiring in 30 days</span>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Products</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="totalProducts">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-purple-600 dark:text-purple-400 font-medium" id="activeProducts">0</span>
                    <span class="text-gray-500 dark:text-gray-400">active products</span>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Customers</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="totalCustomers">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-blue-600 dark:text-blue-400 font-medium" id="activeCustomers">0</span>
                    <span class="text-gray-500 dark:text-gray-400">active customers</span>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-indigo-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Orders</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white" id="totalOrders">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <div class="text-sm">
                    <span class="text-indigo-600 dark:text-indigo-400 font-medium" id="pendingOrders">0</span>
                    <span class="text-gray-500 dark:text-gray-400">pending orders</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Charts Section -->
    <div class="mb-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Sales Trends</h3>
                    <div class="flex space-x-2">
                        <button id="daily-btn" class="px-3 py-1 text-sm font-medium text-green-600 bg-green-100 rounded-md hover:bg-green-200 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800 transition-colors">Daily</button>
                        <button id="weekly-btn" class="px-3 py-1 text-sm font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">Weekly</button>
                        <button id="monthly-btn" class="px-3 py-1 text-sm font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">Monthly</button>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Line Chart -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-3">Sales Trend</h4>
                        <div class="relative" style="height: 250px;">
                            <canvas id="salesTrendChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Bar Chart -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-3">Top Products</h4>
                        <div class="relative" style="height: 250px;">
                            <canvas id="topProductsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Orders -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Recent Orders</h3>
                </div>
                <div class="overflow-hidden">
                    <div class="flow-root">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="px-4 py-3">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Premium Dog Food - 25kg</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Order #12345 - John Smith</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Delivered
                                        </span>
                                    </div>
                                    <div class="flex-shrink-0 text-sm text-gray-500 dark:text-gray-400">
                                        Rs. 89.99
                                    </div>
                                </div>
                            </li>
                            <li class="px-4 py-3">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Cat Food Mix - 15kg</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Order #12346 - Sarah Johnson</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            Processing
                                        </span>
                                    </div>
                                    <div class="flex-shrink-0 text-sm text-gray-500 dark:text-gray-400">
                                        Rs. 67.50
                                    </div>
                                </div>
                            </li>
                            <li class="px-4 py-3">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Bird Seed Mix - 5kg</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Order #12347 - Mike Wilson</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            Pending
                                        </span>
                                    </div>
                                    <div class="flex-shrink-0 text-sm text-gray-500 dark:text-gray-400">
                                        Rs. 34.99
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-green-600 dark:text-green-400 hover:text-green-500">View all orders</a>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Quick Actions</h3>
                </div>
                <div class="p-4 space-y-3">
                    <a href="{{ route('admin.products.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-5 h-5 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Product
                    </a>
                    <a href="{{ route('admin.orders.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Create Order
                    </a>
                    <a href="{{ route('admin.billing.index') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-5 h-5 mr-3 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Create Bill
                    </a>
                    <a href="{{ route('admin.customers.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-5 h-5 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Add New Customer
                    </a>
                    <a href="{{ route('admin.inventory.dashboard') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-5 h-5 mr-3 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Inventory Management
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-5 h-5 mr-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        View Reports
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Recent Activity</h3>
                </div>
                <div class="p-4">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">New product <span class="font-medium text-gray-900 dark:text-white">Premium Cat Food</span> added</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                <time>3h ago</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Order <span class="font-medium text-gray-900 dark:text-white">#12345</span> completed</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                <time>5h ago</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="relative pb-8">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Low stock alert for <span class="font-medium text-gray-900 dark:text-white">Dog Treats</span></p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                <time>1d ago</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section - Popular Products -->
    <div class="mt-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Popular Products</h3>
            </div>
            <div class="overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">Premium Dog Food</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">25kg bags</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">156 sold</p>
                                <p class="text-sm text-green-600 dark:text-green-400">+12%</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">Cat Food Mix</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">15kg bags</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">89 sold</p>
                                <p class="text-sm text-green-600 dark:text-green-400">+8%</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">Bird Seed Mix</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">5kg bags</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">67 sold</p>
                                <p class="text-sm text-green-600 dark:text-green-400">+15%</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">Fish Food</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">500g containers</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">45 sold</p>
                                <p class="text-sm text-green-600 dark:text-green-400">+5%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart instances
        let salesTrendChart = null;
        let topProductsChart = null;
        let currentTimeframe = 'daily';

        // Fetch dashboard data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardData();
            initializeCharts();
            setupChartButtons();
        });

        function loadDashboardData() {
            // Fetch all dashboard data from single endpoint
            fetch('{{ route("admin.dashboard.stats") }}')
                .then(response => response.json())
                .then(data => {
                    // Update sales statistics
                    document.getElementById('today-sales').textContent = 'Rs. ' + parseFloat(data.today_sales || 0).toFixed(2);
                    document.getElementById('today-refunds').textContent = 'Rs. ' + parseFloat(data.today_refunds || 0).toFixed(2);
                    document.getElementById('net-sales').textContent = 'Rs. ' + parseFloat(data.today_net || 0).toFixed(2);
                    document.getElementById('sales-target-progress').textContent = parseFloat(data.target_progress || 0).toFixed(1) + '%';
                    
                    // Update product statistics
                    document.getElementById('totalProducts').textContent = data.total_products || 0;
                    document.getElementById('activeProducts').textContent = data.active_products || 0;
                    document.getElementById('lowStockCount').textContent = data.low_stock_count || 0;
                    document.getElementById('lowStockChange').textContent = data.low_stock_count || 0;
                    document.getElementById('expiringCount').textContent = data.expiring_count || 0;
                    document.getElementById('expiringChange').textContent = data.expiring_count || 0;
                    
                    // Update products in stock
                    document.getElementById('productsInStock').textContent = data.products_in_stock || 0;
                    document.getElementById('productsInStockChange').textContent = data.products_in_stock || 0;
                    
                    // Update customer statistics
                    document.getElementById('totalCustomers').textContent = data.total_customers || 0;
                    document.getElementById('activeCustomers').textContent = data.active_customers || 0;
                    
                    // Update order statistics
                    document.getElementById('totalOrders').textContent = data.total_orders || 0;
                    document.getElementById('pendingOrders').textContent = data.pending_orders || 0;
                    
                    // Update revenue statistics
                    document.getElementById('monthlyRevenue').textContent = 'Rs. ' + parseFloat(data.monthly_revenue || 0).toFixed(2);
                    const growthSign = data.revenue_growth >= 0 ? '+' : '';
                    document.getElementById('revenueGrowth').textContent = growthSign + parseFloat(data.revenue_growth || 0).toFixed(1) + '%';
                    
                    // Update recent orders
                    updateRecentOrders(data.recent_orders || []);
                    
                    // Update popular products
                    updatePopularProducts(data.popular_products || []);
                })
                .catch(error => console.error('Error loading dashboard data:', error));
        }

        function updateRecentOrders(orders) {
            const ordersContainer = document.querySelector('.flow-root ul');
            if (!ordersContainer) return;
            
            let ordersHtml = '';
            orders.forEach(order => {
                const statusClass = order.status === 'completed' ? 'bg-green-100 text-green-800' : 
                                  order.status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                  'bg-yellow-100 text-yellow-800';
                
                ordersHtml += `
                    <li class="px-4 py-3">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">${order.items?.[0]?.product?.name || 'Product'}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Order #${order.id} - ${order.customer?.name || 'Customer'}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClass}">
                                    ${order.status}
                                </span>
                            </div>
                            <div class="flex-shrink-0 text-sm text-gray-500 dark:text-gray-400">
                                Rs. ${parseFloat(order.total_amount || 0).toFixed(2)}
                            </div>
                        </div>
                    </li>
                `;
            });
            
            ordersContainer.innerHTML = ordersHtml;
        }

        function updatePopularProducts(products) {
            const productsContainer = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4');
            if (!productsContainer) return;
            
            let productsHtml = '';
            products.forEach(product => {
                productsHtml += `
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">${product.name}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">${product.total_sold} sold</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">${product.total_sold}</p>
                                <p class="text-sm text-green-600 dark:text-green-400">+12%</p>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            productsContainer.innerHTML = productsHtml;
        }

        function setupChartButtons() {
            document.getElementById('daily-btn').addEventListener('click', () => switchTimeframe('daily'));
            document.getElementById('weekly-btn').addEventListener('click', () => switchTimeframe('weekly'));
            document.getElementById('monthly-btn').addEventListener('click', () => switchTimeframe('monthly'));
        }

        function switchTimeframe(timeframe) {
            currentTimeframe = timeframe;
            
            // Update button styles
            document.querySelectorAll('#daily-btn, #weekly-btn, #monthly-btn').forEach(btn => {
                btn.classList.remove('text-green-600', 'bg-green-100', 'dark:bg-green-900', 'dark:text-green-300');
                btn.classList.add('text-gray-600', 'bg-gray-100', 'dark:bg-gray-700', 'dark:text-gray-300');
            });
            
            document.getElementById(timeframe + '-btn').classList.remove('text-gray-600', 'bg-gray-100', 'dark:bg-gray-700', 'dark:text-gray-300');
            document.getElementById(timeframe + '-btn').classList.add('text-green-600', 'bg-green-100', 'dark:bg-green-900', 'dark:text-green-300');
            
            // Update charts
            updateSalesTrendChart();
        }

        function initializeCharts() {
            // Initialize sales trend chart
            const salesTrendCtx = document.getElementById('salesTrendChart').getContext('2d');
            salesTrendChart = new Chart(salesTrendCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Sales',
                        data: [],
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Refunds',
                        data: [],
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Net Sales',
                        data: [],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: document.documentElement.classList.contains('dark') ? '#f3f4f6' : '#374151'
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? '#f3f4f6' : '#374151'
                            },
                            grid: {
                                color: document.documentElement.classList.contains('dark') ? '#374151' : '#e5e7eb'
                            }
                        },
                        y: {
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? '#f3f4f6' : '#374151',
                                callback: function(value) {
                                    return 'Rs. ' + value.toLocaleString();
                                }
                            },
                            grid: {
                                color: document.documentElement.classList.contains('dark') ? '#374151' : '#e5e7eb'
                            }
                        }
                    }
                }
            });

            // Initialize top products chart
            const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
            topProductsChart = new Chart(topProductsCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Sales Amount',
                        data: [],
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(168, 85, 247, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(249, 115, 22, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                            'rgba(6, 182, 212, 0.8)'
                        ],
                        borderColor: [
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)',
                            'rgb(168, 85, 247)',
                            'rgb(245, 158, 11)',
                            'rgb(239, 68, 68)',
                            'rgb(16, 185, 129)',
                            'rgb(249, 115, 22)',
                            'rgb(139, 92, 246)',
                            'rgb(236, 72, 153)',
                            'rgb(6, 182, 212)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? '#f3f4f6' : '#374151',
                                maxRotation: 45,
                                minRotation: 45
                            },
                            grid: {
                                color: document.documentElement.classList.contains('dark') ? '#374151' : '#e5e7eb'
                            }
                        },
                        y: {
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? '#f3f4f6' : '#374151',
                                callback: function(value) {
                                    return 'Rs. ' + value.toLocaleString();
                                }
                            },
                            grid: {
                                color: document.documentElement.classList.contains('dark') ? '#374151' : '#e5e7eb'
                            }
                        }
                    }
                }
            });

            // Load initial chart data
            updateSalesTrendChart();
            updateTopProductsChart();
        }

        function updateSalesTrendChart() {
            fetch(`{{ route("admin.dashboard.charts", "daily") }}`)
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => currentTimeframe === 'daily' ? item.date : (currentTimeframe === 'weekly' ? item.week : item.month));
                    const salesData = data.map(item => item.sales);
                    const refundsData = data.map(item => item.refunds);
                    const netData = data.map(item => item.net);

                    salesTrendChart.data.labels = labels;
                    salesTrendChart.data.datasets[0].data = salesData;
                    salesTrendChart.data.datasets[1].data = refundsData;
                    salesTrendChart.data.datasets[2].data = netData;
                    salesTrendChart.update();
                })
                .catch(error => console.error('Error loading chart data:', error));
        }

        function updateTopProductsChart() {
            fetch('{{ route("admin.sales.charts.products") }}')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.product);
                    const salesData = data.map(item => item.sales);

                    topProductsChart.data.labels = labels;
                    topProductsChart.data.datasets[0].data = salesData;
                    topProductsChart.update();
                })
                .catch(error => console.error('Error loading products chart data:', error));
        }

        // Refresh data every 5 minutes
        setInterval(loadDashboardData, 300000);
        setInterval(() => {
            updateSalesTrendChart();
            updateTopProductsChart();
        }, 300000);
    </script>
</x-admin-layout>
