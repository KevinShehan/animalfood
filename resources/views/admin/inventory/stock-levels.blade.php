<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Stock Levels</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Monitor and manage product inventory levels with FIFO/LIFO tracking.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.inventory.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.inventory.scanner') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                    </svg>
                    Scanner
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Product</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Name, SKU, or barcode..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                <select id="category_id" name="category_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Supplier -->
            <div>
                <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Supplier</label>
                <select id="supplier_id" name="supplier_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Stock Status -->
            <div>
                <label for="stock_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stock Status</label>
                <select id="stock_status" name="stock_status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">All Status</option>
                    <option value="low_stock" {{ request('stock_status') === 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                    <option value="zero_stock" {{ request('stock_status') === 'zero_stock' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="overstock" {{ request('stock_status') === 'overstock' ? 'selected' : '' }}>Overstock</option>
                    <option value="normal" {{ request('stock_status') === 'normal' ? 'selected' : '' }}>Normal</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="button" id="filterBtn" class="w-full px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                    </svg>
                    Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Stock Levels Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Levels</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($products as $product)
                    @php
                        $stockStatus = 'normal';
                        $stockColor = 'green';
                        
                        if ($product->stock_quantity === 0) {
                            $stockStatus = 'Out of Stock';
                            $stockColor = 'red';
                        } elseif ($product->stock_quantity <= $product->minimum_stock_level) {
                            $stockStatus = 'Critical';
                            $stockColor = 'red';
                        } elseif ($product->stock_quantity <= $product->reorder_level) {
                            $stockStatus = 'Low Stock';
                            $stockColor = 'yellow';
                        } elseif ($product->stock_quantity > $product->max_stock_level) {
                            $stockStatus = 'Overstock';
                            $stockColor = 'blue';
                        }
                        
                        $totalValue = $product->stock_quantity * $product->average_cost;
                        $activeBatches = $product->inventoryBatches->where('is_active', true)->count();
                        $expiringBatches = $product->inventoryBatches->where('is_active', true)->filter(function($batch) {
                            return $batch->expiry_date && $batch->expiry_date->diffInDays(now()) <= 30;
                        })->count();
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        SKU: {{ $product->sku }}
                                        @if($product->barcode)
                                            | Barcode: {{ $product->barcode }}
                                        @endif
                                    </div>
                                    @if($product->location)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Location: {{ $product->location }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">
                                <div class="font-medium">{{ $product->stock_quantity }} {{ $product->unit }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Method: {{ $product->stock_method }}</div>
                                @if($product->track_batches && $activeBatches > 0)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $activeBatches }} batches</div>
                                @endif
                                @if($expiringBatches > 0)
                                    <div class="text-xs text-orange-600 dark:text-orange-400">{{ $expiringBatches }} expiring soon</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">
                                <div>Min: {{ $product->minimum_stock_level }}</div>
                                <div>Reorder: {{ $product->reorder_level }}</div>
                                <div>Max: {{ $product->max_stock_level }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">
                                <div>Cost: {{ \App\Helpers\CurrencyHelper::format($product->average_cost) }}</div>
                                <div>Total: {{ \App\Helpers\CurrencyHelper::format($totalValue) }}</div>
                                @if($product->last_stock_update)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Updated: {{ $product->last_stock_update->diffForHumans() }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $stockColor }}-100 text-{{ $stockColor }}-800 dark:bg-{{ $stockColor }}-900 dark:text-{{ $stockColor }}-200">
                                {{ $stockStatus }}
                            </span>
                            @if($product->inventoryAlerts->where('status', 'active')->count() > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 ml-1">
                                    {{ $product->inventoryAlerts->where('status', 'active')->count() }} alerts
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.products.show', $product) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <button onclick="adjustStock({{ $product->id }}, '{{ $product->name }}')" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 p-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20" title="Adjust Stock">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                                @if(!$product->barcode)
                                    <button onclick="generateBarcode({{ $product->id }})" class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 p-1 rounded hover:bg-purple-50 dark:hover:bg-purple-900/20" title="Generate Barcode">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <p class="mt-2">No products found matching the criteria.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-6">
        {{ $products->links() }}
    </div>
    @endif

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Filter functionality
        document.getElementById('filterBtn').addEventListener('click', function() {
            const search = document.getElementById('search').value;
            const categoryId = document.getElementById('category_id').value;
            const supplierId = document.getElementById('supplier_id').value;
            const stockStatus = document.getElementById('stock_status').value;

            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (categoryId) params.append('category_id', categoryId);
            if (supplierId) params.append('supplier_id', supplierId);
            if (stockStatus) params.append('stock_status', stockStatus);

            window.location.href = `{{ route('admin.inventory.stock-levels') }}?${params.toString()}`;
        });

        // Enter key support for search
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('filterBtn').click();
            }
        });

        // Adjust stock function
        function adjustStock(productId, productName) {
            Swal.fire({
                title: `Adjust Stock: ${productName}`,
                html: `
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Adjustment Type</label>
                            <select id="swal-adjustment-type" class="w-full px-3 py-2 border rounded-lg">
                                <option value="increase">Increase Stock</option>
                                <option value="decrease">Decrease Stock</option>
                                <option value="set">Set Stock Level</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Quantity</label>
                            <input type="number" id="swal-quantity" min="0" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Reason</label>
                            <select id="swal-reason" class="w-full px-3 py-2 border rounded-lg">
                                <option value="Stock count adjustment">Stock count adjustment</option>
                                <option value="Damaged goods">Damaged goods</option>
                                <option value="Lost items">Lost items</option>
                                <option value="Found items">Found items</option>
                                <option value="Return to supplier">Return to supplier</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Notes (Optional)</label>
                            <textarea id="swal-notes" rows="2" class="w-full px-3 py-2 border rounded-lg"></textarea>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Adjust Stock',
                preConfirm: () => {
                    const type = document.getElementById('swal-adjustment-type').value;
                    const quantity = document.getElementById('swal-quantity').value;
                    const reason = document.getElementById('swal-reason').value;
                    const notes = document.getElementById('swal-notes').value;
                    
                    if (!quantity || !reason) {
                        Swal.showValidationMessage('Please fill in all required fields');
                        return false;
                    }
                    
                    return { type, quantity: parseInt(quantity), reason, notes };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { type, quantity, reason, notes } = result.value;
                    
                    fetch('{{ route("admin.inventory.adjust-stock") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            adjustment_type: type,
                            quantity: quantity,
                            reason: reason,
                            notes: notes
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message || 'An error occurred', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'An error occurred while adjusting stock', 'error');
                    });
                }
            });
        }

        // Generate barcode function
        function generateBarcode(productId) {
            fetch(`{{ url('/admin/inventory/generate-barcode') }}/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', `Barcode generated: ${data.barcode}`, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message || 'An error occurred', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred while generating barcode', 'error');
            });
        }
    </script>
</x-admin-layout>
