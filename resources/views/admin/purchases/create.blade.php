<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Purchase Order</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Create a new purchase order from suppliers.</p>
            </div>
            <a href="{{ route('admin.purchases.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Purchases
            </a>
        </div>
    </div>

    <!-- Purchase Form -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <form id="purchaseForm" class="p-6">
            @csrf
            
            <!-- Purchase Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Supplier -->
                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Supplier <span class="text-red-500">*</span>
                        </label>
                        <select id="supplier_id" name="supplier_id" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }} - {{ $supplier->supplier_id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Purchase Date -->
                    <div>
                        <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Purchase Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="purchase_date" name="purchase_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Expected Delivery Date -->
                    <div>
                        <label for="expected_delivery_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Expected Delivery Date
                        </label>
                        <input type="date" id="expected_delivery_date" name="expected_delivery_date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Invoice Number -->
                    <div>
                        <label for="invoice_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Supplier Invoice Number
                        </label>
                        <input type="text" id="invoice_number" name="invoice_number" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white" placeholder="Enter invoice number">
                    </div>

                    <!-- Payment Due Date -->
                    <div>
                        <label for="payment_due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Payment Due Date
                        </label>
                        <input type="date" id="payment_due_date" name="payment_due_date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Notes
                        </label>
                        <textarea id="notes" name="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white" placeholder="Additional notes..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Purchase Items -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Purchase Items</h3>
                    <button type="button" id="addItemBtn" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Item
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Cost</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Items will be added here dynamically -->
                        </tbody>
                    </table>
                </div>

                <div id="noItemsMessage" class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-5V8a2 2 0 00-2-2H9a2 2 0 00-2 2v5h14z"></path>
                    </svg>
                    <p class="mt-2">No items added yet. Click "Add Item" to start adding products.</p>
                </div>
            </div>

            <!-- Totals -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="space-y-4">
                    <!-- Additional Costs -->
                    <div>
                        <label for="tax_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tax Amount</label>
                        <input type="number" id="tax_amount" name="tax_amount" step="0.01" min="0" value="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label for="shipping_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Shipping Cost</label>
                        <input type="number" id="shipping_cost" name="shipping_cost" step="0.01" min="0" value="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label for="discount_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Discount Amount</label>
                        <input type="number" id="discount_amount" name="discount_amount" step="0.01" min="0" value="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <!-- Summary -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h4 class="font-medium text-gray-900 dark:text-white mb-4">Order Summary</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                            <span class="font-medium text-gray-900 dark:text-white" id="subtotalDisplay">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Tax:</span>
                            <span class="font-medium text-gray-900 dark:text-white" id="taxDisplay">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Shipping:</span>
                            <span class="font-medium text-gray-900 dark:text-white" id="shippingDisplay">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Discount:</span>
                            <span class="font-medium text-gray-900 dark:text-white" id="discountDisplay">-$0.00</span>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-600 pt-2">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-900 dark:text-white">Total:</span>
                                <span class="font-bold text-lg text-gray-900 dark:text-white" id="totalDisplay">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.purchases.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Purchase Order
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let itemCounter = 0;
        const products = @json($products);
        
        document.getElementById('addItemBtn').addEventListener('click', addItem);
        document.getElementById('purchaseForm').addEventListener('submit', submitForm);
        
        // Add event listeners for total calculation
        document.getElementById('tax_amount').addEventListener('input', calculateTotals);
        document.getElementById('shipping_cost').addEventListener('input', calculateTotals);
        document.getElementById('discount_amount').addEventListener('input', calculateTotals);

        function addItem() {
            const tbody = document.getElementById('itemsTableBody');
            const noItemsMessage = document.getElementById('noItemsMessage');
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-2">
                    <select name="items[${itemCounter}][product_id]" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                        <option value="">Select Product</option>
                        ${products.map(product => `<option value="${product.id}" data-price="${product.price}">${product.name} - ${product.sku}</option>`).join('')}
                    </select>
                </td>
                <td class="px-4 py-2">
                    <input type="number" name="items[${itemCounter}][quantity]" min="1" required class="quantity-input w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white" placeholder="Qty">
                </td>
                <td class="px-4 py-2">
                    <input type="number" name="items[${itemCounter}][unit_cost]" step="0.01" min="0" required class="cost-input w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white" placeholder="Cost">
                </td>
                <td class="px-4 py-2">
                    <span class="total-display font-medium text-gray-900 dark:text-white">$0.00</span>
                </td>
                <td class="px-4 py-2">
                    <button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-900 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </td>
            `;
            
            tbody.appendChild(row);
            noItemsMessage.style.display = 'none';
            
            // Add event listeners for calculation
            const quantityInput = row.querySelector('.quantity-input');
            const costInput = row.querySelector('.cost-input');
            const productSelect = row.querySelector('select');
            
            quantityInput.addEventListener('input', () => calculateRowTotal(row));
            costInput.addEventListener('input', () => calculateRowTotal(row));
            productSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                if (price) {
                    costInput.value = price;
                    calculateRowTotal(row);
                }
            });
            
            itemCounter++;
        }

        function removeItem(button) {
            const row = button.closest('tr');
            row.remove();
            
            const tbody = document.getElementById('itemsTableBody');
            const noItemsMessage = document.getElementById('noItemsMessage');
            
            if (tbody.children.length === 0) {
                noItemsMessage.style.display = 'block';
            }
            
            calculateTotals();
        }

        function calculateRowTotal(row) {
            const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
            const cost = parseFloat(row.querySelector('.cost-input').value) || 0;
            const total = quantity * cost;
            
            row.querySelector('.total-display').textContent = `$${total.toFixed(2)}`;
            calculateTotals();
        }

        function calculateTotals() {
            let subtotal = 0;
            
            document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
                const cost = parseFloat(row.querySelector('.cost-input').value) || 0;
                subtotal += quantity * cost;
            });
            
            const tax = parseFloat(document.getElementById('tax_amount').value) || 0;
            const shipping = parseFloat(document.getElementById('shipping_cost').value) || 0;
            const discount = parseFloat(document.getElementById('discount_amount').value) || 0;
            
            const total = subtotal + tax + shipping - discount;
            
            document.getElementById('subtotalDisplay').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('taxDisplay').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('shippingDisplay').textContent = `$${shipping.toFixed(2)}`;
            document.getElementById('discountDisplay').textContent = `-$${discount.toFixed(2)}`;
            document.getElementById('totalDisplay').textContent = `$${total.toFixed(2)}`;
        }

        function submitForm(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            
            // Validate items
            const tbody = document.getElementById('itemsTableBody');
            if (tbody.children.length === 0) {
                Swal.fire('Error!', 'Please add at least one item to the purchase order.', 'error');
                return;
            }
            
            fetch('{{ route('admin.purchases.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success!', data.message, 'success').then(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    });
                } else {
                    Swal.fire('Error!', data.message || 'Something went wrong!', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Something went wrong!', 'error');
            });
        }

        // Add first item by default
        addItem();
    </script>
</x-admin-layout>
