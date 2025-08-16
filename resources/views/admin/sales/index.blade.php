<x-admin-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Sales Management</h1>
                <a href="{{ route('admin.sales.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Sale
                </a>
            </div>

            <!-- Sales Target Card -->
            @if($todayTarget)
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Today's Sales Target</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $todayTarget->target_date->format('M d, Y') }}</p>
                        </div>
                        <div class="text-right">
                                                    <p class="text-2xl font-bold text-green-600">Rs. {{ number_format($todayTarget->achieved_amount, 2) }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">of Rs. {{ number_format($todayTarget->daily_target, 2) }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Progress</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ number_format($todayTarget->getProgressPercentage(), 1) }}%</span>
                        </div>
                        <div class="mt-2 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(100, $todayTarget->getProgressPercentage()) }}%"></div>
                        </div>
                        @if($todayTarget->getRemainingAmount() > 0)
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Rs. {{ number_format($todayTarget->getRemainingAmount(), 2) }} remaining to reach target
                        </p>
                        @else
                        <p class="mt-2 text-sm text-green-600 font-medium">
                            Target achieved! 🎉
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Filters -->
            <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form method="GET" action="{{ route('admin.sales.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                                <option value="">All Types</option>
                                <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>Sale</option>
                                <option value="refund" {{ request('type') == 'refund' ? 'selected' : '' }}>Refund</option>
                                <option value="correction" {{ request('type') == 'correction' ? 'selected' : '' }}>Correction</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                                <option value="">All Status</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product</label>
                            <select id="product_id" name="product_id" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                                <option value="">All Products</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">From Date</label>
                            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300">To Date</label>
                            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div class="lg:col-span-5 flex justify-end space-x-3">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Filter
                            </button>
                            <a href="{{ route('admin.sales.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sales Table -->
            <div class="mt-6 bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Sales Records</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">All sales, refunds, and corrections</p>
                </div>
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date/Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Staff</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($sales as $sale)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $sale->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $sale->product->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($sale->type === 'sale') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200
                                        @elseif($sale->type === 'refund') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-200
                                        @else bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-200
                                        @endif">
                                        {{ ucfirst($sale->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $sale->quantity }} {{ $sale->product->unit }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    Rs. {{ number_format($sale->unit_price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium
                                    @if($sale->type === 'refund') text-red-600 dark:text-red-400
                                    @else text-green-600 dark:text-green-400
                                    @endif">
                                    Rs. {{ number_format($sale->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $sale->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($sale->status === 'completed') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200
                                        @elseif($sale->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-200
                                        @else bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-200
                                        @endif">
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.sales.show', $sale) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">View</a>
                                    @if($sale->canBeRefunded())
                                    <a href="{{ route('admin.sales.show', $sale) }}#refund" class="ml-3 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Refund</a>
                                    @endif
                                    @if($sale->canBeCorrected())
                                    <a href="{{ route('admin.sales.edit', $sale) }}" class="ml-3 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Correct</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                    No sales records found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden space-y-4 p-4">
                    @forelse($sales as $sale)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white truncate">{{ $sale->product->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $sale->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.sales.show', $sale) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 p-2 rounded hover:bg-green-50 dark:hover:bg-green-900/20">View</a>
                                @if($sale->canBeRefunded())
                                <a href="{{ route('admin.sales.show', $sale) }}#refund" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-2 rounded hover:bg-red-50 dark:hover:bg-red-900/20">Refund</a>
                                @endif
                                @if($sale->canBeCorrected())
                                <a href="{{ route('admin.sales.edit', $sale) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-2 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20">Correct</a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-500 dark:text-gray-400">Type:</span>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($sale->type === 'sale') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200
                                    @elseif($sale->type === 'refund') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-200
                                    @else bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-200
                                    @endif">
                                    {{ ucfirst($sale->type) }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-500 dark:text-gray-400">Quantity:</span>
                                <div class="text-gray-900 dark:text-white">{{ $sale->quantity }} {{ $sale->product->unit }}</div>
                            </div>
                            <div>
                                <span class="font-medium text-gray-500 dark:text-gray-400">Unit Price:</span>
                                <div class="text-gray-900 dark:text-white">Rs. {{ number_format($sale->unit_price, 2) }}</div>
                            </div>
                            <div>
                                <span class="font-medium text-gray-500 dark:text-gray-400">Total:</span>
                                <div class="text-sm font-medium
                                    @if($sale->type === 'refund') text-red-600 dark:text-red-400
                                    @else text-green-600 dark:text-green-400
                                    @endif">
                                    Rs. {{ number_format($sale->total_amount, 2) }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-500 dark:text-gray-400">Staff:</span>
                                <div class="text-gray-900 dark:text-white">{{ $sale->user->name }}</div>
                            </div>
                            <div>
                                <span class="font-medium text-gray-500 dark:text-gray-400">Status:</span>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($sale->status === 'completed') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200
                                    @elseif($sale->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-200
                                    @else bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-200
                                    @endif">
                                    {{ ucfirst($sale->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <p class="mt-2">No sales records found.</p>
                    </div>
                    @endforelse
                </div>
                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
