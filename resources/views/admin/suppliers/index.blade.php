<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Suppliers Management</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage your supplier relationships and information.</p>
    </div>

    <!-- Action Buttons -->
    <div class="mb-6 flex justify-between items-center">
        <div class="flex space-x-3">
            <button onclick="openAddModal()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Supplier
            </button>
        </div>
        
        <!-- Search -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" id="searchInput" placeholder="Search suppliers..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
        </div>
    </div>

    <!-- Suppliers Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Supplier
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Contact Info
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Address
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="suppliersTableBody">
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $supplier->name }}</div>
                                    <div class="text-xs text-blue-600 dark:text-blue-400 font-mono">{{ $supplier->supplier_id ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $supplier->contact_person }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $supplier->email }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $supplier->phone }}</div>
                            @if($supplier->secondary_phone)
                                <div class="text-xs text-gray-400 dark:text-gray-500">{{ $supplier->secondary_phone }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-white">{{ Str::limit($supplier->address, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col space-y-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $supplier->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                {{ ucfirst($supplier->status) }}
                            </span>
                                @if($supplier->is_blacklisted)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-black text-white dark:bg-gray-800 dark:text-gray-100">
                                        Blacklisted
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button onclick="viewSupplier({{ $supplier->id }})" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button onclick="editSupplier({{ $supplier->id }})" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 p-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20" title="Edit Supplier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button onclick="deleteSupplier({{ $supplier->id }})" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20" title="Delete Supplier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4 p-4">
            @foreach($suppliers as $supplier)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="h-12 w-12 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white truncate">{{ $supplier->name }}</h3>
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-mono">{{ $supplier->supplier_id ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $supplier->contact_person }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="viewSupplier({{ $supplier->id }})" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 p-2 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                        <button onclick="editSupplier({{ $supplier->id }})" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 p-2 rounded hover:bg-green-50 dark:hover:bg-green-900/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button onclick="deleteSupplier({{ $supplier->id }})" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 p-2 rounded hover:bg-red-50 dark:hover:bg-red-900/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-medium text-gray-500 dark:text-gray-400">Contact:</span>
                        <div class="text-gray-900 dark:text-white">{{ $supplier->email }}</div>
                        <div class="text-gray-500 dark:text-gray-400">{{ $supplier->phone }}</div>
                        @if($supplier->secondary_phone)
                            <div class="text-xs text-gray-400 dark:text-gray-500">{{ $supplier->secondary_phone }}</div>
                        @endif
                    </div>
                    <div>
                        <span class="font-medium text-gray-500 dark:text-gray-400">Address:</span>
                        <div class="text-gray-900 dark:text-white">{{ Str::limit($supplier->address, 50) }}</div>
                    </div>
                </div>
                
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $supplier->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                        {{ ucfirst($supplier->status) }}
                    </span>
                    @if($supplier->is_blacklisted)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-black text-white dark:bg-gray-800 dark:text-gray-100">
                            Blacklisted
                        </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Add/Edit Supplier Modal -->
    <div id="supplierModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-6 border w-full max-w-4xl shadow-xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="modalTitle">Add New Supplier</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-1 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="supplierForm" onsubmit="return validateSupplierForm()">
                    @csrf
                    <input type="hidden" id="supplier_id" name="supplier_id">
                    
                    <!-- Supplier ID Display -->
                    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Supplier ID: </span>
                            <span id="supplier_id_display" class="ml-2 text-sm font-mono text-blue-800 dark:text-blue-200">Auto-generated</span>
                        </div>
                    </div>

                    <!-- Form Grid Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <!-- Supplier Name -->
                            <div>
                                <label for="name" id="name-label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Supplier Name <span class="text-red-500">*</span>
                                    <span id="name-error" class="text-red-500 text-xs ml-2 hidden"></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg id="name-icon" class="h-5 w-5 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-14 0h2m-2 0h-2"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="name" name="name" required 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                        placeholder="Enter supplier name"
                                        oninput="validateSupplierName(this)">
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" id="email-label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                    <span id="email-error" class="text-red-500 text-xs ml-2 hidden"></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg id="email-icon" class="h-5 w-5 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" required 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                        placeholder="Enter email address"
                                        oninput="validateSupplierEmail(this)">
                                </div>
                            </div>

                            <!-- Telephone 1 -->
                            <div>
                                <label for="phone" id="phone-label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Telephone 1 <span class="text-red-500">*</span>
                                    <span id="phone-error" class="text-red-500 text-xs ml-2 hidden"></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg id="phone-icon" class="h-5 w-5 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="phone" name="phone" required 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                        placeholder="Enter primary phone number"
                                        oninput="validateSupplierPhone(this)">
                                </div>
                            </div>

                            <!-- Secondary Telephone -->
                            <div>
                                <label for="secondary_phone" id="secondary_phone-label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Secondary Telephone (Optional)
                                    <span id="secondary_phone-error" class="text-red-500 text-xs ml-2 hidden"></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg id="secondary_phone-icon" class="h-5 w-5 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="secondary_phone" name="secondary_phone" 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                        placeholder="Enter secondary phone number"
                                        oninput="validateSupplierSecondaryPhone(this)">
                                </div>
                            </div>

                            <!-- Contact Person -->
                            <div>
                                <label for="contact_person" id="contact_person-label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Contact Person <span class="text-red-500">*</span>
                                    <span id="contact_person-error" class="text-red-500 text-xs ml-2 hidden"></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg id="contact_person-icon" class="h-5 w-5 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="contact_person" name="contact_person" required 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                        placeholder="Enter contact person name"
                                        oninput="validateContactPerson(this)">
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <!-- Address -->
                    <div>
                                <label for="address" id="address-label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Address <span class="text-red-500">*</span>
                                    <span id="address-error" class="text-red-500 text-xs ml-2 hidden"></span>
                                </label>
                                <textarea id="address" name="address" rows="4" required 
                                    class="block w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                    placeholder="Enter complete address"
                                    oninput="validateSupplierAddress(this)"></textarea>
                    </div>

                            <!-- Tax Number -->
                    <div>
                                <label for="tax_number" id="tax_number-label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tax Number (Optional)
                                    <span id="tax_number-error" class="text-red-500 text-xs ml-2 hidden"></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg id="tax_number-icon" class="h-5 w-5 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="tax_number" name="tax_number" 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                        placeholder="Enter tax number"
                                        oninput="validateTaxNumber(this)">
                                </div>
                    </div>

                            <!-- Status and Toggles -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Active Status Toggle -->
                    <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                        Status
                                    </label>
                                    <div class="flex items-center">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" id="status" name="status" value="active" checked class="sr-only peer">
                                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                                            <span class="ms-3 text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
                                        </label>
                                    </div>
                    </div>

                                <!-- Blacklisted Toggle -->
                    <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                        Blacklisted
                                    </label>
                                    <div class="flex items-center">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" id="is_blacklisted" name="is_blacklisted" value="1" class="sr-only peer">
                                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                            <span class="ms-3 text-sm font-medium text-gray-700 dark:text-gray-300">Blacklisted</span>
                                        </label>
                                    </div>
                                </div>
                    </div>

                            <!-- Notes Section -->
                    <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Notes
                                </label>
                                <textarea id="notes" name="notes" rows="4" 
                                    class="block w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 transition-all duration-200" 
                                    placeholder="Add any additional notes or comments about this supplier..."
                                    maxlength="1000"></textarea>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    <span id="notes-count">0</span>/1000 characters
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" onclick="closeModal()" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" id="saveButton" class="px-6 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            Save Supplier
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Supplier Modal -->
    <div id="viewSupplierModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-6 border w-full max-w-4xl shadow-xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Supplier Details</h3>
                    <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-1 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Supplier ID Display -->
                <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Supplier ID: </span>
                        <span id="view_supplier_id_display" class="ml-2 text-sm font-mono text-blue-800 dark:text-blue-200"></span>
                    </div>
                </div>

                <!-- Details Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Supplier Name -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Supplier Name</label>
                            <div id="view_name" class="text-lg font-semibold text-gray-900 dark:text-white"></div>
                        </div>

                        <!-- Email -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                            <div id="view_email" class="text-gray-900 dark:text-white"></div>
                        </div>

                        <!-- Phone Numbers -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Numbers</label>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Primary:</span>
                                    <div id="view_phone" class="text-gray-900 dark:text-white"></div>
                                </div>
                                <div id="view_secondary_phone_section" class="hidden">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Secondary:</span>
                                    <div id="view_secondary_phone" class="text-gray-900 dark:text-white"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Person -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact Person</label>
                            <div id="view_contact_person" class="text-gray-900 dark:text-white"></div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                            <div id="view_address" class="text-gray-900 dark:text-white whitespace-pre-line"></div>
                        </div>

                        <!-- Tax Number -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tax Number</label>
                            <div id="view_tax_number" class="text-gray-900 dark:text-white"></div>
                        </div>

                        <!-- Status Information -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Status</label>
                            <div class="flex flex-col space-y-2">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400 mr-3">Active Status:</span>
                                    <span id="view_status" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"></span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400 mr-3">Blacklisted:</span>
                                    <span id="view_blacklisted" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                            <div id="view_notes" class="text-gray-900 dark:text-white whitespace-pre-line"></div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" onclick="closeViewModal()" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Close
                    </button>
                    <button type="button" id="editFromViewButton" class="px-6 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Supplier
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Enhanced glowing effects for validation */
        .border-red-500 {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }
        
        .border-green-500 {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }
        
        .focus\:ring-red-500:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
        }
        
        .focus\:ring-green-500:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2) !important;
        }
        
        /* Modal responsive design */
        @media (max-width: 1024px) {
            #supplierModal .max-w-4xl {
                max-width: 90vw;
                margin: 1rem;
            }
        }
    </style>
    
    <script>
        let isEditMode = false;
        let currentSupplierId = null;
        let currentSupplierData = null; // Store original data for comparison
        
        // Global validation states
        let supplierValidationStates = {
            name: false,
            email: false,
            phone: false,
            contact_person: false,
            address: false,
            secondary_phone: true, // Optional field
            tax_number: true // Optional field
        };

        // Utility function to set field state
        function setSupplierFieldState(fieldName, isValid, errorMessage = '') {
            const field = document.getElementById(fieldName);
            const icon = document.getElementById(fieldName + '-icon');
            const error = document.getElementById(fieldName + '-error');
            
            if (!field) return; // Skip if field doesn't exist
            
            // Update validation state
            supplierValidationStates[fieldName] = isValid;
            
            // Remove all previous classes
            field.classList.remove('border-red-500', 'border-green-500', 'ring-red-500', 'ring-green-500', 'focus:border-red-500', 'focus:border-green-500', 'focus:ring-red-500', 'focus:ring-green-500');
            if (icon) icon.classList.remove('text-red-500', 'text-green-500');
            
            if (isValid && field.value.length > 0) {
                // Valid state - green
                field.classList.add('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
                if (icon) icon.classList.add('text-green-500');
                if (error) {
                    error.textContent = '';
                    error.classList.add('hidden');
                }
            } else if (!isValid && field.value.length > 0) {
                // Invalid state - red
                field.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                if (icon) icon.classList.add('text-red-500');
                if (error) {
                    error.textContent = errorMessage;
                    error.classList.remove('hidden');
                }
            } else {
                // Empty state - default
                field.classList.add('border-gray-300', 'focus:border-blue-500', 'focus:ring-blue-500');
                if (icon) icon.classList.add('text-gray-400');
                if (error) {
                    error.textContent = '';
                    error.classList.add('hidden');
                }
            }
        }

        // Validation functions
        function validateSupplierName(input) {
            const value = input.value.trim();
            
            if (value.length === 0) {
                setSupplierFieldState('name', false, 'Supplier name is required');
                return false;
            }
            
            if (value.length < 2) {
                setSupplierFieldState('name', false, 'Name must be at least 2 characters');
                return false;
            }
            
            if (!/^[a-zA-Z0-9\s\-\&\.\,\']+$/.test(value)) {
                setSupplierFieldState('name', false, 'Invalid characters in supplier name');
                return false;
            }
            
            setSupplierFieldState('name', true);
            return true;
        }

        function validateSupplierEmail(input) {
            const value = input.value.trim();
            const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
            
            if (value.length === 0) {
                setSupplierFieldState('email', false, 'Email address is required');
                return false;
            }
            
            if (!emailRegex.test(value)) {
                setSupplierFieldState('email', false, 'Please enter a valid email address');
                return false;
            }
            
            setSupplierFieldState('email', true);
            return true;
        }

        function validateSupplierPhone(input) {
            const value = input.value.trim();
            const phoneRegex = /^[0-9+\-\s\(\)]+$/;
            
            if (value.length === 0) {
                setSupplierFieldState('phone', false, 'Primary phone number is required');
                return false;
            }
            
            if (value.length < 7) {
                setSupplierFieldState('phone', false, 'Phone number too short');
                return false;
            }
            
            if (!phoneRegex.test(value)) {
                setSupplierFieldState('phone', false, 'Invalid phone number format');
                return false;
            }
            
            setSupplierFieldState('phone', true);
            return true;
        }

        function validateSupplierSecondaryPhone(input) {
            const value = input.value.trim();
            const phoneRegex = /^[0-9+\-\s\(\)]+$/;
            
            if (value.length === 0) {
                setSupplierFieldState('secondary_phone', true);
                return true;
            }
            
            if (value.length < 7) {
                setSupplierFieldState('secondary_phone', false, 'Phone number too short');
                return false;
            }
            
            if (!phoneRegex.test(value)) {
                setSupplierFieldState('secondary_phone', false, 'Invalid phone number format');
                return false;
            }
            
            setSupplierFieldState('secondary_phone', true);
            return true;
        }

        function validateContactPerson(input) {
            const value = input.value.trim();
            
            if (value.length === 0) {
                setSupplierFieldState('contact_person', false, 'Contact person is required');
                return false;
            }
            
            if (value.length < 2) {
                setSupplierFieldState('contact_person', false, 'Name must be at least 2 characters');
                return false;
            }
            
            if (!/^[a-zA-Z\s\-\.\']+$/.test(value)) {
                setSupplierFieldState('contact_person', false, 'Only letters, spaces, hyphens and dots allowed');
                return false;
            }
            
            setSupplierFieldState('contact_person', true);
            return true;
        }

        function validateSupplierAddress(input) {
            const value = input.value.trim();
            
            if (value.length === 0) {
                setSupplierFieldState('address', false, 'Address is required');
                return false;
            }
            
            if (value.length < 10) {
                setSupplierFieldState('address', false, 'Please provide a complete address');
                return false;
            }
            
            setSupplierFieldState('address', true);
            return true;
        }

        function validateTaxNumber(input) {
            const value = input.value.trim();
            
            if (value.length === 0) {
                setSupplierFieldState('tax_number', true);
                return true;
            }
            
            if (value.length < 5) {
                setSupplierFieldState('tax_number', false, 'Tax number too short');
                return false;
            }
            
            if (!/^[a-zA-Z0-9\-]+$/.test(value)) {
                setSupplierFieldState('tax_number', false, 'Invalid tax number format');
                return false;
            }
            
            setSupplierFieldState('tax_number', true);
            return true;
        }

        // Form validation - Enhanced for edit mode
        function validateSupplierForm() {
            // In edit mode, only validate fields that have actually changed
            if (isEditMode && currentSupplierData) {
                const currentData = {
                    name: document.getElementById('name').value.trim(),
                    email: document.getElementById('email').value.trim(),
                    phone: document.getElementById('phone').value.trim(),
                    secondary_phone: document.getElementById('secondary_phone').value.trim(),
                    contact_person: document.getElementById('contact_person').value.trim(),
                    address: document.getElementById('address').value.trim(),
                    tax_number: document.getElementById('tax_number').value.trim()
                };
                
                const originalData = {
                    name: currentSupplierData.name || '',
                    email: currentSupplierData.email || '',
                    phone: currentSupplierData.phone || '',
                    secondary_phone: currentSupplierData.secondary_phone || '',
                    contact_person: currentSupplierData.contact_person || '',
                    address: currentSupplierData.address || '',
                    tax_number: currentSupplierData.tax_number || ''
                };
                
                // Validate only changed fields
                let hasChanges = false;
                let hasValidationErrors = false;
                
                Object.keys(currentData).forEach(key => {
                    if (currentData[key] !== originalData[key]) {
                        hasChanges = true;
                        const input = document.getElementById(key);
                        let isValid = false;
                        
                        // Validate the changed field
                        switch(key) {
                            case 'name':
                                isValid = validateSupplierName(input);
                                break;
                            case 'email':
                                isValid = validateSupplierEmail(input);
                                break;
                            case 'phone':
                                isValid = validateSupplierPhone(input);
                                break;
                            case 'secondary_phone':
                                isValid = validateSupplierSecondaryPhone(input);
                                break;
                            case 'contact_person':
                                isValid = validateContactPerson(input);
                                break;
                            case 'address':
                                isValid = validateSupplierAddress(input);
                                break;
                            case 'tax_number':
                                isValid = validateTaxNumber(input);
                                break;
                        }
                        
                        if (!isValid) {
                            hasValidationErrors = true;
                        }
                    }
                });
                
                if (!hasChanges) {
                    Swal.fire({
                        title: 'No Changes',
                        text: 'No changes were made to update.',
                        icon: 'info',
                        confirmButtonColor: '#3B82F6'
                    });
                    return false;
                }
                
                if (hasValidationErrors) {
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Please fix the validation errors in the modified fields.',
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                    return false;
                }
                
                return true;
            } else {
                // Add mode - validate all fields
                const nameValid = validateSupplierName(document.getElementById('name'));
                const emailValid = validateSupplierEmail(document.getElementById('email'));
                const phoneValid = validateSupplierPhone(document.getElementById('phone'));
                const secondaryPhoneValid = validateSupplierSecondaryPhone(document.getElementById('secondary_phone'));
                const contactPersonValid = validateContactPerson(document.getElementById('contact_person'));
                const addressValid = validateSupplierAddress(document.getElementById('address'));
                const taxNumberValid = validateTaxNumber(document.getElementById('tax_number'));
                
                // Check if all validations pass
                const allValid = Object.values(supplierValidationStates).every(state => state);
                
                if (!allValid) {
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Please fix all validation errors before submitting the form.',
                        icon: 'error',
                        confirmButtonColor: '#EF4444'
                    });
                    return false;
                }
                
                return true;
            }
        }

        // Notes character counter
        function updateNotesCounter() {
            const notesField = document.getElementById('notes');
            const counter = document.getElementById('notes-count');
            if (notesField && counter) {
                counter.textContent = notesField.value.length;
            }
        }

        // View supplier function
        function viewSupplier(id) {
            fetch(`/admin/suppliers/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Populate view modal
                    document.getElementById('view_supplier_id_display').textContent = data.supplier_id || 'N/A';
                    document.getElementById('view_name').textContent = data.name || 'N/A';
                    document.getElementById('view_email').textContent = data.email || 'N/A';
                    document.getElementById('view_phone').textContent = data.phone || 'N/A';
                    document.getElementById('view_contact_person').textContent = data.contact_person || 'N/A';
                    document.getElementById('view_address').textContent = data.address || 'N/A';
                    document.getElementById('view_tax_number').textContent = data.tax_number || 'Not provided';
                    document.getElementById('view_notes').textContent = data.notes || 'No notes available';
                    
                    // Handle secondary phone
                    const secondaryPhoneSection = document.getElementById('view_secondary_phone_section');
                    if (data.secondary_phone) {
                        document.getElementById('view_secondary_phone').textContent = data.secondary_phone;
                        secondaryPhoneSection.classList.remove('hidden');
                    } else {
                        secondaryPhoneSection.classList.add('hidden');
                    }
                    
                    // Handle status
                    const statusElement = document.getElementById('view_status');
                    if (data.status === 'active') {
                        statusElement.textContent = 'Active';
                        statusElement.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                    } else {
                        statusElement.textContent = 'Inactive';
                        statusElement.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
                    }
                    
                    // Handle blacklisted status
                    const blacklistedElement = document.getElementById('view_blacklisted');
                    if (data.is_blacklisted) {
                        blacklistedElement.textContent = 'Yes';
                        blacklistedElement.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-black text-white dark:bg-gray-800 dark:text-gray-100';
                    } else {
                        blacklistedElement.textContent = 'No';
                        blacklistedElement.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                    }
                    
                    // Set up edit button
                    document.getElementById('editFromViewButton').onclick = function() {
                        closeViewModal();
                        editSupplier(id);
                    };
                    
                    // Show modal
                    document.getElementById('viewSupplierModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to load supplier details!', 'error');
                });
        }

        function closeViewModal() {
            document.getElementById('viewSupplierModal').classList.add('hidden');
        }

        function openAddModal() {
            isEditMode = false;
            currentSupplierId = null;
            currentSupplierData = null;
            document.getElementById('modalTitle').textContent = 'Add New Supplier';
            document.getElementById('supplierForm').reset();
            clearErrors();
            
            // Set default values
            document.getElementById('status').checked = true;
            document.getElementById('is_blacklisted').checked = false;
            document.getElementById('supplier_id_display').textContent = 'Auto-generated';
            
            // Reset validation states
            Object.keys(supplierValidationStates).forEach(key => {
                supplierValidationStates[key] = key === 'secondary_phone' || key === 'tax_number';
            });
            
            updateNotesCounter();
            document.getElementById('supplierModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('supplierModal').classList.add('hidden');
            clearErrors();
        }

        function clearErrors() {
            const errorElements = document.querySelectorAll('[id$="-error"]');
            errorElements.forEach(element => {
                element.classList.add('hidden');
                element.textContent = '';
            });
            
            // Reset field styles
            const fields = ['name', 'email', 'phone', 'secondary_phone', 'contact_person', 'address', 'tax_number'];
            fields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                const icon = document.getElementById(fieldName + '-icon');
                
                if (field) {
                    field.classList.remove('border-red-500', 'border-green-500', 'focus:border-red-500', 'focus:border-green-500', 'focus:ring-red-500', 'focus:ring-green-500');
                    field.classList.add('border-gray-300', 'focus:border-blue-500', 'focus:ring-blue-500');
                }
                
                if (icon) {
                    icon.classList.remove('text-red-500', 'text-green-500');
                    icon.classList.add('text-gray-400');
                }
            });
        }

        function editSupplier(id) {
            isEditMode = true;
            currentSupplierId = id;
            document.getElementById('modalTitle').textContent = 'Edit Supplier';
            
            // Fetch supplier data
            fetch(`/admin/suppliers/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Store original data for comparison
                    currentSupplierData = { ...data };
                    
                    document.getElementById('supplier_id').value = data.id;
                    document.getElementById('name').value = data.name;
                    document.getElementById('email').value = data.email;
                    document.getElementById('phone').value = data.phone;
                    document.getElementById('secondary_phone').value = data.secondary_phone || '';
                    document.getElementById('contact_person').value = data.contact_person;
                    document.getElementById('address').value = data.address;
                    document.getElementById('tax_number').value = data.tax_number || '';
                    document.getElementById('notes').value = data.notes || '';
                    
                    // Set toggles
                    document.getElementById('status').checked = data.status === 'active';
                    document.getElementById('is_blacklisted').checked = data.is_blacklisted;
                    
                    // Display supplier ID
                    document.getElementById('supplier_id_display').textContent = data.supplier_id || 'N/A';
                    
                    // Set validation states to true for existing values (they're already valid)
                    Object.keys(supplierValidationStates).forEach(key => {
                        supplierValidationStates[key] = true;
                    });
                    
                    updateNotesCounter();
                    document.getElementById('supplierModal').classList.remove('hidden');
                });
        }

        function deleteSupplier(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10B981',
                cancelButtonColor: '#EF4444',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/suppliers/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    });
                }
            });
        }

        document.getElementById('supplierForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateSupplierForm()) {
                return;
            }
            
            const formData = new FormData(this);
            
            // Handle status checkbox
            const statusCheckbox = document.getElementById('status');
            formData.set('status', statusCheckbox.checked ? 'active' : 'inactive');
            
            // Handle blacklisted checkbox
            const blacklistedCheckbox = document.getElementById('is_blacklisted');
            formData.set('is_blacklisted', blacklistedCheckbox.checked ? '1' : '0');
            
            const url = isEditMode ? `/admin/suppliers/${currentSupplierId}` : '/admin/suppliers';
            const method = isEditMode ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success!', data.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    // Display errors
                    clearErrors();
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorElement = document.getElementById(key.replace('.', '_') + '-error');
                        if (errorElement) {
                                errorElement.textContent = data.errors[key][0];
                            errorElement.classList.remove('hidden');
                        }
                    });
                }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Something went wrong!', 'error');
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Notes counter
            const notesField = document.getElementById('notes');
            if (notesField) {
                notesField.addEventListener('input', updateNotesCounter);
            }
            
            // Real-time validation listeners
            document.getElementById('name').addEventListener('blur', function() {
                validateSupplierName(this);
            });
            
            document.getElementById('email').addEventListener('blur', function() {
                validateSupplierEmail(this);
            });
            
            document.getElementById('phone').addEventListener('blur', function() {
                validateSupplierPhone(this);
            });
            
            document.getElementById('secondary_phone').addEventListener('blur', function() {
                validateSupplierSecondaryPhone(this);
            });
            
            document.getElementById('contact_person').addEventListener('blur', function() {
                validateContactPerson(this);
            });
            
            document.getElementById('address').addEventListener('blur', function() {
                validateSupplierAddress(this);
            });
            
            document.getElementById('tax_number').addEventListener('blur', function() {
                validateTaxNumber(this);
            });
        });
    </script>
</x-admin-layout> 