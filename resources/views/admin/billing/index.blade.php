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
                    <div class="flex space-x-2">
                        <button type="button" onclick="openCustomerModal()" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-left">
                            <span id="selectedCustomerText">Select Customer</span>
                        </button>
                        <button type="button" onclick="selectCashCustomer()" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm">
                            CASH
                        </button>
                    </div>
                    <input type="hidden" id="selectedCustomerId" value="">
                </div>

                <!-- Bill Items -->
                <div class="space-y-2 mb-4">
                    <div id="billItems">
                        <!-- Bill items will be added here dynamically -->
                    </div>
                </div>

                <!-- Discount Section -->
                <div class="border-t border-gray-200 dark:border-gray-600 pt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Apply Discount</label>
                        <div class="flex space-x-2">
                            <input type="text" id="discountCode" placeholder="Enter discount code" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm">
                            <button onclick="applyDiscount()" class="px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Apply
                            </button>
                        </div>
                        <div id="discountStatus" class="mt-2 text-sm"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Or Manual Discount</label>
                        <div class="grid grid-cols-2 gap-2">
                            <select id="discountType" onchange="applyManualDiscount()" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm">
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed Amount</option>
                            </select>
                            <input type="number" id="discountValue" placeholder="0" step="0.01" min="0" oninput="applyManualDiscount()" onchange="applyManualDiscount()" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm">
                        </div>
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

                <!-- Payment Section -->
                <div class="border-t border-gray-200 dark:border-gray-600 pt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Method</label>
                        <select id="paymentMethod" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="credit">Customer Credit</option>
                            <option value="cheque">Cheque</option>
                            <option value="mobile_payment">Mobile Payment</option>
                            <option value="mixed">Mixed Payment</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Amount Paid</label>
                        <input type="number" id="amountPaid" placeholder="0.00" step="0.01" min="0" oninput="calculateBalance()" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div id="balanceDisplay" class="hidden p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="text-sm text-blue-800 dark:text-blue-200">
                            <div class="flex justify-between">
                                <span>Total Amount:</span>
                                <span id="billTotal">Rs. 0.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Amount Paid:</span>
                                <span id="paidAmount">Rs. 0.00</span>
                            </div>
                            <div class="flex justify-between font-medium border-t border-blue-200 dark:border-blue-700 pt-2 mt-2">
                                <span id="balanceLabel">Balance:</span>
                                <span id="balanceAmount" class="font-bold">Rs. 0.00</span>
                            </div>
                        </div>
                    </div>

                    <div id="paymentDetails" class="space-y-3">
                        <!-- Payment method specific fields will be shown here -->
                    </div>

                    <div id="creditInfo" class="hidden p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="text-sm text-blue-800 dark:text-blue-200">
                            <div class="font-medium">Customer Credit Info:</div>
                            <div id="creditDetails">Select a customer to view credit information</div>
                        </div>
                    </div>

                    <!-- Notes Field -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                        <textarea id="billNotes" rows="3" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white" placeholder="Optional notes for the bill..."></textarea>
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
                    <button onclick="testBillHeader()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-blue-300 dark:border-blue-600 text-sm font-medium rounded-lg text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Test Bill Header
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Selection Modal -->
    <div id="customerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Select Customer</h3>
                    <button onclick="closeCustomerModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Search Bar -->
                <div class="mb-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="customerSearch" placeholder="Search customers by name, email, or phone..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                    </div>
                </div>

                <!-- Customers List -->
                <div id="customersList" class="max-h-96 overflow-y-auto space-y-2">
                    <div class="text-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto"></div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Loading customers...</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <button onclick="closeCustomerModal()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Cancel
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
        let customerSearchTimeout;
        let appliedDiscount = { type: null, value: 0, amount: 0, code: null };
        let currentPaymentMethod = 'cash';
        let selectedCustomer = null;

        // Load data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();
            setupPaymentMethodChange();
            checkAutomaticDiscounts();
            setupCustomerSearch();
        });

        // Customer modal functions
        function openCustomerModal() {
            document.getElementById('customerModal').classList.remove('hidden');
            loadCustomers();
        }

        function closeCustomerModal() {
            document.getElementById('customerModal').classList.add('hidden');
            document.getElementById('customerSearch').value = '';
        }

        function selectCashCustomer() {
            selectedCustomer = {
                id: 'cash',
                name: 'CASH',
                email: 'cash@default.com',
                phone: 'N/A',
                address: 'Cash Payment'
            };
            document.getElementById('selectedCustomerText').textContent = 'CASH';
            document.getElementById('selectedCustomerId').value = 'cash';
            updateCreditInfo();
            checkAutomaticDiscounts();
        }

        function selectCustomer(customer) {
            selectedCustomer = customer;
            document.getElementById('selectedCustomerText').textContent = `${customer.name} - ${customer.email}`;
            document.getElementById('selectedCustomerId').value = customer.id;
            closeCustomerModal();
            updateCreditInfo();
            checkAutomaticDiscounts();
        }

        function setupCustomerSearch() {
            document.getElementById('customerSearch').addEventListener('input', function(e) {
                clearTimeout(customerSearchTimeout);
                const searchTerm = e.target.value;
                
                customerSearchTimeout = setTimeout(() => {
                    loadCustomers(searchTerm);
                }, 300);
            });
        }

        // Load customers from database
        function loadCustomers(searchTerm = '') {
            const url = searchTerm 
                ? `{{ route("admin.billing.customers") }}?search=${encodeURIComponent(searchTerm)}`
                : '{{ route("admin.billing.customers") }}';
            
            fetch(url)
                .then(response => response.json())
                .then(customers => {
                    allCustomers = customers;
                    displayCustomers(customers);
                })
                .catch(error => {
                    console.error('Error loading customers:', error);
                    document.getElementById('customersList').innerHTML = `
                        <div class="text-center py-4 text-red-500">
                            <p>Error loading customers. Please try again.</p>
                        </div>
                    `;
                });
        }

        function displayCustomers(customers) {
            const customersList = document.getElementById('customersList');
            customersList.innerHTML = '';

            if (customers.length === 0) {
                customersList.innerHTML = `
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No customers found</p>
                    </div>
                `;
                return;
            }

            customers.forEach(customer => {
                const customerElement = document.createElement('div');
                customerElement.className = 'border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors duration-200';
                customerElement.onclick = () => selectCustomer(customer);
                
                customerElement.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">${customer.name}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">${customer.email}</p>
                            ${customer.phone ? `<p class="text-xs text-gray-400 dark:text-gray-500">${customer.phone}</p>` : ''}
                        </div>
                        <div class="text-right ml-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                `;
                customersList.appendChild(customerElement);
            });
        }

        // Setup payment method change handler
        function setupPaymentMethodChange() {
            const paymentSelect = document.getElementById('paymentMethod');
            paymentSelect.addEventListener('change', function() {
                currentPaymentMethod = this.value;
                updatePaymentDetails();
                updateCreditInfo();
            });
        }

        // Update payment details based on selected method
        function updatePaymentDetails() {
            const paymentDetails = document.getElementById('paymentDetails');
            const method = currentPaymentMethod;
            
            paymentDetails.innerHTML = '';
            
            if (method === 'card') {
                paymentDetails.innerHTML = `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Card Type</label>
                        <select id="cardType" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                            <option value="credit">Credit Card</option>
                            <option value="debit">Debit Card</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Card Reference</label>
                        <input type="text" id="cardReference" placeholder="Last 4 digits" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                `;
            } else if (method === 'bank_transfer') {
                paymentDetails.innerHTML = `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Transfer Reference</label>
                        <input type="text" id="transferReference" placeholder="Transaction ID" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                `;
            } else if (method === 'cheque') {
                paymentDetails.innerHTML = `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cheque Number</label>
                        <input type="text" id="chequeNumber" placeholder="Cheque number" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bank Name</label>
                        <input type="text" id="bankName" placeholder="Bank name" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                `;
            } else if (method === 'mobile_payment') {
                paymentDetails.innerHTML = `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mobile Wallet</label>
                        <select id="mobileWallet" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                            <option value="jazzcash">JazzCash</option>
                            <option value="easypaisa">Easypaisa</option>
                            <option value="sadapay">SadaPay</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Transaction ID</label>
                        <input type="text" id="mobileReference" placeholder="Transaction ID" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                `;
            } else if (method === 'mixed') {
                paymentDetails.innerHTML = `
                    <div class="p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                        <p class="text-sm text-yellow-800 dark:text-yellow-200">Mixed payment will be handled during checkout. You can split the payment between multiple methods.</p>
                    </div>
                `;
            }
        }

        // Update customer credit information
        function updateCreditInfo() {
            const creditInfo = document.getElementById('creditInfo');
            const creditDetails = document.getElementById('creditDetails');
            
            if (!selectedCustomer || currentPaymentMethod !== 'credit' || selectedCustomer.id === 'cash') {
                creditInfo.classList.add('hidden');
                return;
            }
            
            // Fetch customer credit info
            fetch(`{{ url('admin/customers') }}/${selectedCustomer.id}/credit`)
                .then(response => response.json())
                .then(credit => {
                    if (credit) {
                        creditDetails.innerHTML = `
                            <div>Credit Limit: Rs. ${parseFloat(credit.credit_limit || 0).toFixed(2)}</div>
                            <div>Available Credit: Rs. ${parseFloat(credit.available_credit || 0).toFixed(2)}</div>
                            <div>Current Balance: Rs. ${parseFloat(credit.current_balance || 0).toFixed(2)}</div>
                            <div class="text-xs mt-1">Status: ${credit.credit_status || 'No Credit Setup'}</div>
                        `;
                        creditInfo.classList.remove('hidden');
                    } else {
                        creditDetails.innerHTML = 'No credit account found for this customer.';
                        creditInfo.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    creditDetails.innerHTML = 'Customer has no credit setup.';
                    creditInfo.classList.remove('hidden');
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

        // Discount functions
        function applyDiscount() {
            const discountCode = document.getElementById('discountCode').value.trim();
            const discountStatus = document.getElementById('discountStatus');
            
            if (!discountCode) {
                discountStatus.innerHTML = '<span class="text-red-600">Please enter a discount code</span>';
                return;
            }
            
            const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
            
            // Validate discount code
            fetch(`{{ route('admin.discounts.validate-code') }}?code=${encodeURIComponent(discountCode)}&order_amount=${subtotal}`)
                .then(response => response.json())
                .then(result => {
                    if (result.valid) {
                        appliedDiscount = {
                            type: result.discount.type,
                            value: result.discount.value,
                            amount: result.discount.amount,
                            code: result.discount.code
                        };
                        discountStatus.innerHTML = `<span class="text-green-600">✓ ${result.discount.name} applied: Rs. ${result.discount.amount.toFixed(2)} off</span>`;
                        updateBillDisplay();
                    } else {
                        discountStatus.innerHTML = `<span class="text-red-600">✗ ${result.message}</span>`;
                    }
                })
                .catch(error => {
                    console.error('Error validating discount:', error);
                    discountStatus.innerHTML = '<span class="text-red-600">Error validating discount code</span>';
                });
        }

        function applyManualDiscount() {
            const discountType = document.getElementById('discountType').value;
            const discountValue = parseFloat(document.getElementById('discountValue').value) || 0;
            const discountStatus = document.getElementById('discountStatus');
            
            if (discountValue <= 0) {
                appliedDiscount = { type: null, value: 0, amount: 0, code: null };
                discountStatus.innerHTML = '';
                updateBillDisplay();
                return;
            }
            
            const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
            let discountAmount = 0;
            
            if (discountType === 'percentage') {
                if (discountValue > 100) {
                    discountStatus.innerHTML = '<span class="text-red-600">Percentage cannot exceed 100%</span>';
                    return;
                }
                discountAmount = (subtotal * discountValue) / 100;
            } else {
                discountAmount = discountValue;
            }
            
            if (discountAmount > subtotal) {
                discountStatus.innerHTML = '<span class="text-red-600">Discount cannot exceed subtotal</span>';
                return;
            }
            
            appliedDiscount = {
                type: discountType,
                value: discountValue,
                amount: discountAmount,
                code: 'MANUAL'
            };
            
            discountStatus.innerHTML = `<span class="text-green-600">✓ Manual discount applied: Rs. ${discountAmount.toFixed(2)} off</span>`;
            document.getElementById('discountCode').value = '';
            updateBillDisplay();
        }

        function checkAutomaticDiscounts() {
            const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
            
            if (subtotal === 0) return;
            
            // Check for automatic discounts
            fetch(`{{ route('admin.discounts.automatic') }}?order_amount=${subtotal}`)
                .then(response => response.json())
                .then(discounts => {
                    if (discounts.length > 0 && !appliedDiscount.code) {
                        // Apply the best automatic discount
                        const bestDiscount = discounts.reduce((prev, current) => 
                            (prev.amount > current.amount) ? prev : current
                        );
                        
                        appliedDiscount = {
                            type: bestDiscount.type,
                            value: bestDiscount.value,
                            amount: bestDiscount.amount,
                            code: bestDiscount.code
                        };
                        
                        const discountStatus = document.getElementById('discountStatus');
                        discountStatus.innerHTML = `<span class="text-blue-600">✓ Auto-applied: ${bestDiscount.name} - Rs. ${bestDiscount.amount.toFixed(2)} off</span>`;
                        updateBillDisplay();
                    }
                })
                .catch(error => {
                    console.error('Error checking automatic discounts:', error);
                });
        }

        // Calculate balance in real-time when amount is entered
        function calculateBalance() {
            const amountPaidInput = document.getElementById('amountPaid');
            const balanceDisplay = document.getElementById('balanceDisplay');
            const billTotalElement = document.getElementById('billTotal');
            const paidAmountElement = document.getElementById('paidAmount');
            const balanceAmountElement = document.getElementById('balanceAmount');
            const balanceLabelElement = document.getElementById('balanceLabel');

            const amountPaid = parseFloat(amountPaidInput.value) || 0;
            
            if (amountPaid > 0) {
                // Calculate current bill total
                const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
                const discountAmount = appliedDiscount.amount || 0;
                const discountedSubtotal = subtotal - discountAmount;
                const tax = discountedSubtotal * 0.10;
                const total = discountedSubtotal + tax;
                
                const balance = amountPaid - total;
                
                // Update display
                billTotalElement.textContent = `Rs. ${total.toFixed(2)}`;
                paidAmountElement.textContent = `Rs. ${amountPaid.toFixed(2)}`;
                balanceAmountElement.textContent = `Rs. ${Math.abs(balance).toFixed(2)}`;
                
                // Update label and styling based on balance
                if (balance >= 0) {
                    balanceLabelElement.textContent = 'Change to Return:';
                    balanceAmountElement.className = 'font-bold text-green-600 dark:text-green-400';
                } else {
                    balanceLabelElement.textContent = 'Amount Due:';
                    balanceAmountElement.className = 'font-bold text-red-600 dark:text-red-400';
                }
                
                balanceDisplay.classList.remove('hidden');
            } else {
                balanceDisplay.classList.add('hidden');
            }
        }

        function updateBillDisplay() {
            const billItemsContainer = document.getElementById('billItems');
            const subtotalElement = document.getElementById('subtotal');
            const taxElement = document.getElementById('tax');
            const discountElement = document.getElementById('discount');
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
            const discountAmount = appliedDiscount.amount || 0;
            const discountedSubtotal = subtotal - discountAmount;
            const tax = discountedSubtotal * 0.10; // 10% tax on discounted amount
            const total = discountedSubtotal + tax;

            subtotalElement.textContent = `Rs. ${subtotal.toFixed(2)}`;
            taxElement.textContent = `Rs. ${tax.toFixed(2)}`;
            discountElement.textContent = `Rs. ${discountAmount.toFixed(2)}`;
            totalElement.textContent = `Rs. ${total.toFixed(2)}`;
            
            // Check for automatic discounts when items change
            if (billItems.length > 0) {
                checkAutomaticDiscounts();
            }
            
            // Update balance calculation if amount is paid
            calculateBalance();
        }

        function generateBill() {
            if (!selectedCustomer) {
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

            // First, save the bill to database
            saveBillToDatabase();
        }

        function saveBillToDatabase() {
            const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
            const tax = subtotal * 0.10;
            const total = subtotal + tax;
            const discountAmount = appliedDiscount.amount || 0;
            const finalAmount = total - discountAmount;

            const billData = {
                customer_id: selectedCustomer.id,
                items: billItems.map(item => ({
                    product_id: item.productId,
                    quantity: item.quantity,
                    unit_price: item.price,
                    total_price: item.total
                })),
                total_amount: subtotal,
                tax_amount: tax,
                discount_amount: discountAmount,
                final_amount: finalAmount,
                paid_amount: parseFloat(document.getElementById('amountPaid').value) || 0,
                due_amount: finalAmount - (parseFloat(document.getElementById('amountPaid').value) || 0),
                due_date: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toISOString().split('T')[0], // 30 days from now
                payment_method: currentPaymentMethod,
                notes: document.getElementById('billNotes') ? document.getElementById('billNotes').value : '',
                discount_code: appliedDiscount.code,
                discount_type: appliedDiscount.type,
                discount_percentage: appliedDiscount.type === 'percentage' ? appliedDiscount.value : 0
            };

            fetch('{{ route("admin.billing.api.create-bill") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(billData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Store the saved bill data for display
                    window.savedBillData = data.bill;
                    // Continue with bill generation
                    generateBillDisplay();
                } else {
                    throw new Error(data.error || 'Failed to save bill');
                }
            })
            .catch(error => {
                console.error('Error saving bill:', error);
                Swal.fire('Error!', 'Failed to save bill to database. Please try again.', 'error');
            });
        }

        function generateBillDisplay() {

            // Generate bill content
            const billContent = document.getElementById('billContent');
            const subtotal = billItems.reduce((sum, item) => sum + item.total, 0);
            const tax = subtotal * 0.10;
            const total = subtotal + tax;

            // Fetch bill header settings
            fetch('{{ route("admin.settings.bill-header.active") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch bill header settings');
                    }
                    return response.json();
                })
                .then(header => {
                    console.log('Bill header data:', header); // Debug log
                    console.log('Company logo path:', header ? header.company_logo : 'No header');
                    console.log('Full logo URL:', header && header.company_logo ? `/storage/${header.company_logo}` : 'No logo');
                    let headerHtml = '';
                    if (header && header.company_name) {
                        headerHtml = `
                            <div class="flex items-start space-x-4 mb-6">
                                <!-- Logo on the left -->
                                <div class="flex-shrink-0">
                                    ${header.company_logo ? `<img src="/storage/${header.company_logo}" alt="Company Logo" class="h-16 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" onload="this.nextElementSibling.style.display='none';">` : ''}
                                    <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center" ${header.company_logo ? 'style="display: none;"' : ''}>
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Company information on the right -->
                                <div class="flex-1">
                                    <h2 class="text-xl font-bold text-gray-900">${header.company_name}</h2>
                                    ${header.company_address ? `<p class="text-sm text-gray-600 mt-2">${header.company_address}</p>` : ''}
                                    <div class="flex flex-wrap gap-4 mt-3 text-sm text-gray-600">
                                        ${header.company_phone ? `<span>${header.company_phone}</span>` : ''}
                                        ${header.company_email ? `<span>${header.company_email}</span>` : ''}
                                    </div>
                                    ${header.company_website ? `<p class="text-sm text-gray-600 mt-1">${header.company_website}</p>` : ''}
                                </div>
                            </div>
                        `;
                    } else {
                        headerHtml = `
                            <div class="flex items-start space-x-4 mb-6">
                                <div class="flex-shrink-0">
                                    <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h2 class="text-xl font-bold text-gray-900">Animal Food System</h2>
                                    <p class="text-sm text-gray-600">Invoice</p>
                                </div>
                            </div>
                        `;
                    }
                    
                                         billContent.innerHTML = headerHtml + `
                     
                     <div class="grid grid-cols-2 gap-4 mb-6">
                         <div>
                             <h4 class="font-medium text-gray-900">Bill To:</h4>
                             <p class="text-gray-600">${selectedCustomer.name}</p>
                             <p class="text-gray-600">${selectedCustomer.email}</p>
                             ${selectedCustomer.phone ? `<p class="text-gray-600">${selectedCustomer.phone}</p>` : ''}
                             ${selectedCustomer.address ? `<p class="text-gray-600">${selectedCustomer.address}</p>` : ''}
                         </div>
                        <div class="text-right">
                            <h4 class="font-medium text-gray-900">Invoice #:</h4>
                            <p class="text-gray-600">${window.savedBillData ? window.savedBillData.invoice_number : (header && header.invoice_prefix ? header.invoice_prefix : 'INV') + '-' + new Date().getFullYear() + String(new Date().getMonth() + 1).padStart(2, '0') + String(new Date().getDate()).padStart(2, '0') + '-' + Math.floor(Math.random() * 1000).toString().padStart(3, '0')}</p>
                            <h4 class="font-medium text-gray-900 mt-2">Invoice Date:</h4>
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
                        ${appliedDiscount.amount > 0 ? `
                        <div class="flex justify-between text-green-600">
                            <span>Discount (${appliedDiscount.code}):</span>
                            <span>-Rs. ${appliedDiscount.amount.toFixed(2)}</span>
                        </div>` : ''}
                        <div class="flex justify-between">
                            <span>Tax (10%):</span>
                            <span>Rs. ${tax.toFixed(2)}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total:</span>
                            <span>Rs. ${total.toFixed(2)}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 border-t pt-2">
                            <span>Payment Method:</span>
                            <span>${currentPaymentMethod.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</span>
                        </div>
                        ${document.getElementById('amountPaid').value ? `
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Amount Paid:</span>
                            <span>Rs. ${parseFloat(document.getElementById('amountPaid').value).toFixed(2)}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>${parseFloat(document.getElementById('amountPaid').value) >= total ? 'Change to Return' : 'Balance Due'}:</span>
                            <span class="${parseFloat(document.getElementById('amountPaid').value) >= total ? 'text-green-600' : 'text-red-600'}">Rs. ${Math.abs(parseFloat(document.getElementById('amountPaid').value) - total).toFixed(2)}</span>
                        </div>` : ''}
                    </div>
                    ${header && header.footer_text ? `<div class="border-t border-gray-200 pt-6 mt-6"><p class="text-sm text-gray-600 text-center">${header.footer_text}</p></div>` : ''}
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
                            .flex { display: flex; }
                            .items-start { align-items: flex-start; }
                            .space-x-4 > * + * { margin-left: 1rem; }
                            .flex-shrink-0 { flex-shrink: 0; }
                            .flex-1 { flex: 1; }
                            .mb-6 { margin-bottom: 1.5rem; }
                            .mt-2 { margin-top: 0.5rem; }
                            .mt-3 { margin-top: 0.75rem; }
                            .mt-1 { margin-top: 0.25rem; }
                            .pt-6 { padding-top: 1.5rem; }
                            .mt-6 { margin-top: 1.5rem; }
                            .border-t { border-top: 1px solid #e5e7eb; }
                            .text-sm { font-size: 0.875rem; }
                            .text-gray-600 { color: #4b5563; }
                            .text-xl { font-size: 1.25rem; }
                            .font-bold { font-weight: 700; }
                            .text-gray-900 { color: #111827; }
                            .h-16 { height: 4rem; }
                            .w-auto { width: auto; }
                            .w-16 { width: 4rem; }
                            .bg-gray-200 { background-color: #e5e7eb; }
                            .rounded-lg { border-radius: 0.5rem; }
                            .flex-wrap { flex-wrap: wrap; }
                            .gap-4 > * + * { margin-left: 1rem; }
                            img { max-width: 100%; height: auto; display: block; }
                            @media print {
                                img { max-width: 100%; height: auto; display: block !important; }
                                .h-16 { height: 4rem !important; }
                                .w-auto { width: auto !important; }
                            }
                        </style>
                    </head>
                    <body>
                        ${printContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
            
            // Wait for images to load before printing
            setTimeout(() => {
                printWindow.print();
            }, 500);
            
            // Bill is already saved to database
            Swal.fire('Success!', 'Bill has been printed and saved to database.', 'success').then(() => {
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
                    appliedDiscount = { type: null, value: 0, amount: 0, code: null };
                    currentPaymentMethod = 'cash';
                    selectedCustomer = null;
                    updateBillDisplay();
                    document.getElementById('selectedCustomerText').textContent = 'Select Customer';
                    document.getElementById('selectedCustomerId').value = '';
                    document.getElementById('paymentMethod').value = 'cash';
                    document.getElementById('discountCode').value = '';
                    document.getElementById('discountValue').value = '';
                    document.getElementById('discountStatus').innerHTML = '';
                    document.getElementById('amountPaid').value = '';
                    document.getElementById('balanceDisplay').classList.add('hidden');
                    updatePaymentDetails();
                    Swal.fire('Cleared!', 'Bill has been cleared.', 'success');
                }
            });
        }

        // Test bill header function
        function testBillHeader() {
            fetch('{{ route("admin.test.bill-header") }}')
                .then(response => response.json())
                .then(data => {
                    console.log('Bill header test data:', data);
                    Swal.fire({
                        title: 'Bill Header Test',
                        html: `
                            <div class="text-left">
                                <p><strong>Active Header:</strong> ${data.header ? 'Yes' : 'No'}</p>
                                ${data.header ? `
                                    <p><strong>Company Name:</strong> ${data.header.company_name || 'Not set'}</p>
                                    <p><strong>Company Logo:</strong> ${data.header.company_logo || 'Not set'}</p>
                                    <p><strong>Logo URL:</strong> ${data.logo_url || 'Not set'}</p>
                                    <p><strong>Logo Exists:</strong> ${data.logo_exists ? 'Yes' : 'No'}</p>
                                    <p><strong>Logo Path:</strong> ${data.logo_path || 'Not set'}</p>
                                    <p><strong>Storage URL:</strong> ${data.storage_url}</p>
                                    <p><strong>Public Storage Path:</strong> ${data.public_storage_path}</p>
                                ` : ''}
                                <p><strong>Total Headers:</strong> ${data.all_headers.length}</p>
                            </div>
                        `,
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                })
                .catch(error => {
                    console.error('Error testing bill header:', error);
                    Swal.fire('Error!', 'Failed to test bill header data.', 'error');
                });
        }

        // Close modals when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            // Customer modal close on outside click
            document.getElementById('customerModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCustomerModal();
                }
            });
        });
    </script>
</x-admin-layout> 