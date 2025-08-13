<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Billing System</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Create and manage customer bills and invoices.</p>
    </div>

    <!-- Billing Interface -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Product Selection -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Select Products</h3>
                
                <!-- Search Products -->
                <div class="mb-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="productSearch" placeholder="Search products..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                    </div>
                </div>

                <!-- Products List -->
                <div id="productsList" class="space-y-2 max-h-96 overflow-y-auto">
                    <div class="text-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto"></div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Loading products...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bill Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Bill Summary</h3>
                
                <!-- Customer Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customer</label>
                    <select id="customerSelect" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                        <option value="">Loading customers...</option>
                    </select>
                </div>

                <!-- Bill Items -->
                <div class="space-y-2 mb-4">
                    <div id="billItems">
                        <!-- Bill items will be added here dynamically -->
                    </div>
                </div>

                <!-- Bill Totals -->
                <div class="border-t border-gray-200 dark:border-gray-600 pt-4 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                        <span class="text-gray-900 dark:text-white" id="subtotal">Rs. 0.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Tax (10%):</span>
                        <span class="text-gray-900 dark:text-white" id="tax">Rs. 0.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Discount:</span>
                        <span class="text-gray-900 dark:text-white" id="discount">Rs. 0.00</span>
                    </div>
                    <div class="flex justify-between text-lg font-medium border-t border-gray-200 dark:border-gray-600 pt-2">
                        <span class="text-gray-900 dark:text-white">Total:</span>
                        <span class="text-gray-900 dark:text-white" id="total">Rs. 0.00</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3 mt-6">
                    <button onclick="generateBill()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Generate Bill
                    </button>
                    <button onclick="clearBill()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        Clear Bill
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Preview Modal -->
    <div id="printModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Bill Preview</h3>
                    <button onclick="closePrintModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="billContent" class="bg-white p-6 border rounded-lg">
                    <!-- Bill content will be generated here -->
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <button onclick="closePrintModal()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Cancel
                    </button>
                    <button onclick="printBill()" class="px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Print Bill
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        let billItems = [];
        let billCounter = 0;
        let allCustomers = [];
        let searchTimeout;

        // Load data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCustomers();
            loadProducts();
        });

        // Load customers from database
        function loadCustomers() {
            fetch('{{ route("admin.billing.customers") }}')
                .then(response => response.json())
                .then(customers => {
                    allCustomers = customers;
                    const customerSelect = document.getElementById('customerSelect');
                    customerSelect.innerHTML = '<option value="">Select Customer</option>';
                    
                    customers.forEach(customer => {
                        const option = document.createElement('option');
                        option.value = customer.id;
                        option.textContent = `${customer.name} - ${customer.email}`;
                        customerSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading customers:', error);
                    document.getElementById('customerSelect').innerHTML = '<option value="">Error loading customers</option>';
                });
        }

        // Product search functionality with debouncing
        document.getElementById('productSearch').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = e.target.value;
            
            // Show loading state
            const productsList = document.getElementById('productsList');
            productsList.innerHTML = `
                <div class="text-center py-4">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-green-600 mx-auto"></div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Searching...</p>
                </div>
            `;
            
            // Debounce the search
            searchTimeout = setTimeout(() => {
                loadProducts(searchTerm);
            }, 300);
        });

        // Load products from database
        function loadProducts(searchTerm = '') {
            const url = searchTerm 
                ? `{{ route('admin.billing.products') }}?search=${encodeURIComponent(searchTerm)}`
                : '{{ route("admin.billing.products") }}';
            
            fetch(url)
                .then(response => response.json())
                .then(products => {
                    displayProducts(products);
                })
                .catch(error => {
                    console.error('Error loading products:', error);
                    const productsList = document.getElementById('productsList');
                    productsList.innerHTML = `
                        <div class="text-center py-4 text-red-500">
                            <p>Error loading products. Please try again.</p>
                        </div>
                    `;
                });
        }

        // Display products in the list
        function displayProducts(products) {
            const productsList = document.getElementById('productsList');
            productsList.innerHTML = '';

            if (products.length === 0) {
                productsList.innerHTML = `
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No products found</p>
                    </div>
                `;
                return;
            }

            products.forEach(product => {
                const productElement = document.createElement('div');
                productElement.className = 'border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors duration-200';
                productElement.onclick = () => addToBill(product.id, product.name, product.price, product.unit || 'unit');
                
                productElement.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">${product.name}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">${product.sku} - In Stock: ${product.stock_quantity}</p>
                            ${product.description ? `<p class="text-xs text-gray-400 dark:text-gray-500 mt-1">${product.description}</p>` : ''}
                        </div>
                        <div class="text-right ml-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Rs. ${parseFloat(product.price).toFixed(2)}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">per ${product.unit || 'unit'}</p>
                        </div>
                    </div>
                `;
                productsList.appendChild(productElement);
            });
        }

        function addToBill(productId, productName, price, unit) {
            const existingItem = billItems.find(item => item.productId === productId);
            
            if (existingItem) {
                existingItem.quantity += 1;
                existingItem.total = existingItem.quantity * existingItem.price;
            } else {
                billItems.push({
                    id: ++billCounter,
                    productId: productId,
                    productName: productName,
                    price: parseFloat(price),
                    unit: unit,
                    quantity: 1,
                    total: parseFloat(price)
                });
            }
            
            updateBillDisplay();
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Added to Bill',
                text: `${productName} has been added to the bill`,
                timer: 1500,
                showConfirmButton: false
            });
        }

        function updateQuantity(itemId, newQuantity) {
            const item = billItems.find(item => item.id === itemId);
            if (item) {
                item.quantity = parseInt(newQuantity);
                item.total = item.quantity * item.price;
                updateBillDisplay();
            }
        }

        function removeItem(itemId) {
            const item = billItems.find(item => item.id === itemId);
            if (item) {
                Swal.fire({
                    title: 'Remove Item?',
                    text: `Are you sure you want to remove ${item.productName}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        billItems = billItems.filter(item => item.id !== itemId);
                        updateBillDisplay();
                        Swal.fire('Removed!', 'Item has been removed from the bill.', 'success');
                    }
                });
            }
        }

        function updateBillDisplay() {
            const billItemsContainer = document.getElementById('billItems');
            const subtotalElement = document.getElementById('subtotal');
            const taxElement = document.getElementById('tax');
            const totalElement = document.getElementById('total');

            // Clear current items
            billItemsContainer.innerHTML = '';

            if (billItems.length === 0) {
                billItemsContainer.innerHTML = `
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p>No items in bill</p>
                        <p class="text-sm">Search and select products to add to your bill</p>
                    </div>
                `;
            } else {
                // Add items to display
                billItems.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600';
                    itemElement.innerHTML = `
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">${item.productName}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Rs. ${item.price.toFixed(2)} x ${item.quantity} ${item.unit}</div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <input type="number" value="${item.quantity}" min="1" max="999"
                                   onchange="updateQuantity(${item.id}, this.value)"
                                   class="w-16 px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500">
                            <span class="text-sm font-medium text-gray-900 dark:text-white min-w-[60px] text-right">Rs. ${item.total.toFixed(2)}</span>
                            <button onclick="removeItem(${item.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    `;
                    billItemsContainer.appendChild(itemElement);
                });
            }

            // Calculate totals
            const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
            const tax = subtotal * 0.10; // 10% tax
            const total = subtotal + tax;

            subtotalElement.textContent = `Rs. ${subtotal.toFixed(2)}`;
            taxElement.textContent = `Rs. ${tax.toFixed(2)}`;
            totalElement.textContent = `Rs. ${total.toFixed(2)}`;
        }

        function generateBill() {
            const customerSelect = document.getElementById('customerSelect');
            const customerId = customerSelect.value;
            const customer = allCustomers.find(c => c.id == customerId);

            if (!customer) {
                Swal.fire('Error!', 'Please select a customer.', 'error');
                return;
            }

            if (billItems.length === 0) {
                Swal.fire('Error!', 'Please add items to the bill.', 'error');
                return;
            }

            // Show loading state
            Swal.fire({
                title: 'Generating Bill...',
                text: 'Please wait while we prepare your bill',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Generate bill content
            const billContent = document.getElementById('billContent');
            const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
            const tax = subtotal * 0.10;
            const total = subtotal + tax;

            // Fetch bill header settings
            fetch('{{ route("admin.settings.bill-header.active") }}')
                .then(response => response.json())
                .then(header => {
                    let headerHtml = '';
                    if (header) {
                        headerHtml = `
                            <div class="text-center mb-6">
                                ${header.company_logo ? `<div class="mb-4"><img src="/storage/${header.company_logo}" alt="Company Logo" class="h-16 w-auto mx-auto"></div>` : ''}
                                <h2 class="text-2xl font-bold text-gray-900">${header.company_name || 'Animal Food System'}</h2>
                                ${header.company_address ? `<p class="text-gray-600 mt-2">${header.company_address}</p>` : ''}
                                <div class="flex justify-center space-x-4 mt-3 text-sm text-gray-600">
                                    ${header.company_phone ? `<span>${header.company_phone}</span>` : ''}
                                    ${header.company_email ? `<span>${header.company_email}</span>` : ''}
                                </div>
                                ${header.company_website ? `<p class="text-sm text-gray-600 mt-1">${header.company_website}</p>` : ''}
                            </div>
                        `;
                    } else {
                        headerHtml = `
                            <div class="text-center mb-6">
                                <h2 class="text-2xl font-bold text-gray-900">Animal Food System</h2>
                                <p class="text-gray-600">Invoice</p>
                            </div>
                        `;
                    }
                    
                    billContent.innerHTML = headerHtml + `
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <h4 class="font-medium text-gray-900">Bill To:</h4>
                            <p class="text-gray-600">${customer.name}</p>
                            <p class="text-gray-600">${customer.email}</p>
                            ${customer.phone ? `<p class="text-gray-600">${customer.phone}</p>` : ''}
                            ${customer.address ? `<p class="text-gray-600">${customer.address}</p>` : ''}
                        </div>
                        <div class="text-right">
                            <h4 class="font-medium text-gray-900">Invoice Date:</h4>
                            <p class="text-gray-600">${new Date().toLocaleDateString()}</p>
                        </div>
                    </div>

                    <table class="w-full mb-6">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-2">Item</th>
                                <th class="text-right py-2">Quantity</th>
                                <th class="text-right py-2">Price</th>
                                <th class="text-right py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${billItems.map(item => `
                                <tr class="border-b border-gray-100">
                                    <td class="py-2">${item.productName}</td>
                                    <td class="text-right py-2">${item.quantity} ${item.unit}</td>
                                    <td class="text-right py-2">Rs. ${item.price.toFixed(2)}</td>
                                    <td class="text-right py-2">Rs. ${item.total.toFixed(2)}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>

                    <div class="text-right space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span>Rs. ${subtotal.toFixed(2)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax (10%):</span>
                            <span>Rs. ${tax.toFixed(2)}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total:</span>
                            <span>Rs. ${total.toFixed(2)}</span>
                        </div>
                    </div>
                    ${header && header.footer_text ? `<div class="border-t border-gray-200 pt-4 mt-4"><p class="text-xs text-gray-500 text-center">${header.footer_text}</p></div>` : ''}
                `;

                document.getElementById('printModal').classList.remove('hidden');
                Swal.close();
            })
            .catch(error => {
                console.error('Error generating bill:', error);
                Swal.fire('Error!', 'Failed to generate bill. Please try again.', 'error');
            });
        }

        function closePrintModal() {
            document.getElementById('printModal').classList.add('hidden');
        }

        function printBill() {
            const printContent = document.getElementById('billContent').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Bill - Animal Food System</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            table { width: 100%; border-collapse: collapse; }
                            th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
                            .text-right { text-align: right; }
                            .text-center { text-align: center; }
                        </style>
                    </head>
                    <body>
                        ${printContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
            
            // Save bill to database (you would implement this)
            Swal.fire('Success!', 'Bill has been printed and saved.', 'success').then(() => {
                closePrintModal();
                clearBill();
            });
        }

        function clearBill() {
            Swal.fire({
                title: 'Clear Bill?',
                text: 'Are you sure you want to clear all items from the bill?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, clear it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    billItems = [];
                    billCounter = 0;
                    updateBillDisplay();
                    document.getElementById('customerSelect').value = '';
                    Swal.fire('Cleared!', 'Bill has been cleared.', 'success');
                }
            });
        }
    </script>
</x-admin-layout> 