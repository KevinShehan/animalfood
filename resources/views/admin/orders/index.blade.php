<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Orders Management</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage customer orders and track order status.</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="exportOrders()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export
                </button>
                <button onclick="openAddOrderModal()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Order
                </button>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-4">
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div class="lg:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" id="search" placeholder="Search by order number, customer..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select id="status-filter" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Payment Status Filter -->
                <div>
                    <label for="payment-status-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payment</label>
                    <select id="payment-status-filter" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="all">All Payment</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="failed">Failed</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label for="sort-by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By</label>
                    <select id="sort-by" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="created_at">Date Created</option>
                        <option value="order_number">Order Number</option>
                        <option value="final_amount">Amount</option>
                        <option value="status">Status</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Orders List</h3>
                <div class="flex items-center space-x-2">
                    <button id="select-all-btn" onclick="toggleSelectAll()" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        Select All
                    </button>
                    <button id="bulk-delete-btn" onclick="bulkDeleteOrders()" class="hidden inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-gray-700 dark:text-red-300 dark:border-red-600 dark:hover:bg-red-600">
                        Delete Selected
                    </button>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <input type="checkbox" id="select-all-checkbox" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="orders-table-body" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @include('admin.orders.partials.orders-table')
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Add/Edit Order Modal -->
    <div id="order-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 id="modal-title" class="text-lg font-medium text-gray-900 dark:text-white">Add New Order</h3>
                    <button onclick="closeOrderModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="order-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="order-id" name="order_id">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                            <select id="customer_id" name="customer_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select Customer</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select id="status" name="status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Status</label>
                            <select id="payment_status" name="payment_status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="failed">Failed</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>

                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                            <select id="payment_method" name="payment_method" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="online">Online</option>
                            </select>
                        </div>

                        <div>
                            <label for="total_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Amount</label>
                            <input type="number" id="total_amount" name="total_amount" step="0.01" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label for="tax_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax Amount</label>
                            <input type="number" id="tax_amount" name="tax_amount" step="0.01" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label for="discount_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discount Amount</label>
                            <input type="number" id="discount_amount" name="discount_amount" step="0.01" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label for="final_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Final Amount</label>
                            <input type="number" id="final_amount" name="final_amount" step="0.01" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                        <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeOrderModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Save Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Order Modal -->
    <div id="view-order-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Order Details</h3>
                    <button onclick="closeViewOrderModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div id="order-details" class="space-y-4">
                    <!-- Order details will be loaded here -->
                </div>

                <div class="flex justify-end pt-4">
                    <button onclick="closeViewOrderModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentOrderId = null;
        let customers = [];
        let products = [];

        // Load customers and products on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCustomers();
            loadProducts();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Search functionality
            document.getElementById('search').addEventListener('input', debounce(filterOrders, 300));
            
            // Filter functionality
            document.getElementById('status-filter').addEventListener('change', filterOrders);
            document.getElementById('payment-status-filter').addEventListener('change', filterOrders);
            document.getElementById('sort-by').addEventListener('change', filterOrders);
            
            // Form submission
            document.getElementById('order-form').addEventListener('submit', handleOrderSubmit);
        }

        function loadCustomers() {
            fetch('/admin/customers')
                .then(response => response.json())
                .then(data => {
                    customers = data.customers.data || [];
                    populateCustomerSelect();
                })
                .catch(error => console.error('Error loading customers:', error));
        }

        function loadProducts() {
            fetch('/admin/products')
                .then(response => response.json())
                .then(data => {
                    products = data.products.data || [];
                })
                .catch(error => console.error('Error loading products:', error));
        }

        function populateCustomerSelect() {
            const select = document.getElementById('customer_id');
            select.innerHTML = '<option value="">Select Customer</option>';
            customers.forEach(customer => {
                select.innerHTML += `<option value="${customer.id}">${customer.name} (${customer.email})</option>`;
            });
        }

        function filterOrders() {
            const search = document.getElementById('search').value;
            const status = document.getElementById('status-filter').value;
            const paymentStatus = document.getElementById('payment-status-filter').value;
            const sortBy = document.getElementById('sort-by').value;

            const params = new URLSearchParams({
                search: search,
                status: status,
                payment_status: paymentStatus,
                sort_by: sortBy,
                sort_order: 'desc'
            });

            fetch(`/admin/orders?${params}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('orders-table-body').innerHTML = data.html;
                    setupCheckboxListeners();
                })
                .catch(error => console.error('Error filtering orders:', error));
        }

        function openAddOrderModal() {
            currentOrderId = null;
            document.getElementById('modal-title').textContent = 'Add New Order';
            document.getElementById('order-form').reset();
            document.getElementById('order-id').value = '';
            document.getElementById('order-modal').classList.remove('hidden');
        }

        function closeOrderModal() {
            document.getElementById('order-modal').classList.add('hidden');
        }

        function editOrder(orderId) {
            currentOrderId = orderId;
            document.getElementById('modal-title').textContent = 'Edit Order';
            
            fetch(`/admin/orders/${orderId}/edit`)
                .then(response => response.json())
                .then(data => {
                    const order = data.order;
                    document.getElementById('order-id').value = order.id;
                    document.getElementById('customer_id').value = order.customer_id;
                    document.getElementById('status').value = order.status;
                    document.getElementById('payment_status').value = order.payment_status;
                    document.getElementById('payment_method').value = order.payment_method;
                    document.getElementById('total_amount').value = order.total_amount;
                    document.getElementById('tax_amount').value = order.tax_amount;
                    document.getElementById('discount_amount').value = order.discount_amount;
                    document.getElementById('final_amount').value = order.final_amount;
                    document.getElementById('notes').value = order.notes || '';
                    
                    document.getElementById('order-modal').classList.remove('hidden');
                })
                .catch(error => console.error('Error loading order:', error));
        }

        function viewOrder(orderId) {
            fetch(`/admin/orders/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    const order = data;
                    const detailsHtml = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Order Information</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Order Number: ${order.order_number}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Status: ${order.status}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Created: ${new Date(order.created_at).toLocaleDateString()}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Customer Information</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Name: ${order.customer.name}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Email: ${order.customer.email}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Phone: ${order.customer.phone}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Payment Information</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Status: ${order.payment_status}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Method: ${order.payment_method}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total: $${parseFloat(order.final_amount).toFixed(2)}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Amount Breakdown</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Subtotal: $${parseFloat(order.total_amount).toFixed(2)}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tax: $${parseFloat(order.tax_amount).toFixed(2)}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Discount: $${parseFloat(order.discount_amount).toFixed(2)}</p>
                            </div>
                        </div>
                        ${order.notes ? `<div class="mt-4"><h4 class="font-medium text-gray-900 dark:text-white">Notes</h4><p class="text-sm text-gray-600 dark:text-gray-400">${order.notes}</p></div>` : ''}
                        <div class="mt-4">
                            <h4 class="font-medium text-gray-900 dark:text-white">Order Items</h4>
                            <div class="mt-2 space-y-2">
                                ${order.order_items.map(item => `
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">${item.product.name}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Qty: ${item.quantity} × $${parseFloat(item.unit_price).toFixed(2)}</p>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">$${parseFloat(item.total_price).toFixed(2)}</p>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    
                    document.getElementById('order-details').innerHTML = detailsHtml;
                    document.getElementById('view-order-modal').classList.remove('hidden');
                })
                .catch(error => console.error('Error loading order details:', error));
        }

        function closeViewOrderModal() {
            document.getElementById('view-order-modal').classList.add('hidden');
        }

        function handleOrderSubmit(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const url = currentOrderId ? `/admin/orders/${currentOrderId}` : '/admin/orders';
            const method = currentOrderId ? 'PUT' : 'POST';
            
            // Add CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            if (currentOrderId) {
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeOrderModal();
                    filterOrders();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'An error occurred while saving the order.',
                });
            });
        }

        function deleteOrder(orderId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/orders/${orderId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            filterOrders();
                            Swal.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            );
                        } else {
                            throw new Error(data.message || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            error.message || 'An error occurred while deleting the order.',
                            'error'
                        );
                    });
                }
            });
        }

        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('select-all-checkbox');
            const orderCheckboxes = document.querySelectorAll('.order-checkbox');
            const selectAllBtn = document.getElementById('select-all-btn');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

            orderCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });

            updateBulkDeleteButton();
            
            if (selectAllCheckbox.checked) {
                selectAllBtn.textContent = 'Deselect All';
            } else {
                selectAllBtn.textContent = 'Select All';
            }
        }

        function setupCheckboxListeners() {
            const orderCheckboxes = document.querySelectorAll('.order-checkbox');
            const selectAllCheckbox = document.getElementById('select-all-checkbox');

            orderCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkDeleteButton);
            });

            selectAllCheckbox.addEventListener('change', toggleSelectAll);
        }

        function updateBulkDeleteButton() {
            const selectedCheckboxes = document.querySelectorAll('.order-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            
            if (selectedCheckboxes.length > 0) {
                bulkDeleteBtn.classList.remove('hidden');
            } else {
                bulkDeleteBtn.classList.add('hidden');
            }
        }

        function bulkDeleteOrders() {
            const selectedCheckboxes = document.querySelectorAll('.order-checkbox:checked');
            const orderIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

            if (orderIds.length === 0) {
                Swal.fire('No orders selected!', 'Please select orders to delete.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete ${orderIds.length} order(s). This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/admin/orders/bulk-delete', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ order_ids: orderIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            filterOrders();
                            Swal.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            );
                        } else {
                            throw new Error(data.message || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            error.message || 'An error occurred while deleting orders.',
                            'error'
                        );
                    });
                }
            });
        }

        function exportOrders() {
            const search = document.getElementById('search').value;
            const status = document.getElementById('status-filter').value;
            const paymentStatus = document.getElementById('payment-status-filter').value;

            const params = new URLSearchParams({
                search: search,
                status: status,
                payment_status: paymentStatus
            });

            window.location.href = `/admin/orders/export?${params}`;
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Initialize checkbox listeners
        setupCheckboxListeners();
    </script>
</x-admin-layout> 