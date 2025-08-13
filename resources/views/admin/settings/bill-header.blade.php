<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bill Header Design</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Configure company information and logo for billing documents.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Bill Header Settings Form -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Company Information</h2>
            
            <form method="POST" action="{{ $billHeader ? route('admin.settings.bill-header.update', $billHeader) : route('admin.settings.bill-header.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if($billHeader)
                    @method('PUT')
                @endif

                <!-- Company Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Company Logo
                    </label>
                    <div class="flex items-center space-x-4">
                        @if($billHeader && $billHeader->company_logo)
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="{{ Storage::url($billHeader->company_logo) }}" alt="Company Logo" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="company_logo" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-green-900 dark:file:text-green-300">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('company_logo')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Name -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Company Name *
                    </label>
                    <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $billHeader->company_name ?? '') }}" required
                        class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    @error('company_name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Address -->
                <div>
                    <label for="company_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Company Address
                    </label>
                    <textarea id="company_address" name="company_address" rows="3"
                        class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">{{ old('company_address', $billHeader->company_address ?? '') }}</textarea>
                    @error('company_address')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="company_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Phone Number
                        </label>
                        <input type="text" id="company_phone" name="company_phone" value="{{ old('company_phone', $billHeader->company_phone ?? '') }}"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                        @error('company_phone')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address
                        </label>
                        <input type="email" id="company_email" name="company_email" value="{{ old('company_email', $billHeader->company_email ?? '') }}"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                        @error('company_email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Website and Tax Number -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="company_website" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Website
                        </label>
                        <input type="url" id="company_website" name="company_website" value="{{ old('company_website', $billHeader->company_website ?? '') }}"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                        @error('company_website')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tax_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tax Number
                        </label>
                        <input type="text" id="tax_number" name="tax_number" value="{{ old('tax_number', $billHeader->tax_number ?? '') }}"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                        @error('tax_number')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Invoice Prefix -->
                <div>
                    <label for="invoice_prefix" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Invoice Prefix
                    </label>
                    <input type="text" id="invoice_prefix" name="invoice_prefix" value="{{ old('invoice_prefix', $billHeader->invoice_prefix ?? 'INV') }}"
                        class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Prefix for invoice numbers (e.g., INV, BILL)</p>
                    @error('invoice_prefix')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Text -->
                <div>
                    <label for="footer_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Footer Text
                    </label>
                    <textarea id="footer_text" name="footer_text" rows="3"
                        class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white">{{ old('footer_text', $billHeader->footer_text ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Text to appear at the bottom of bills</p>
                    @error('footer_text')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $billHeader ? 'Update Settings' : 'Save Settings' }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Bill Header Preview -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Bill Header Preview</h2>
            
            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-6 bg-gray-50 dark:bg-gray-700">
                <div class="text-center mb-6">
                    @if($billHeader && $billHeader->company_logo)
                        <div class="mx-auto mb-4">
                            <img src="{{ Storage::url($billHeader->company_logo) }}" alt="Company Logo" class="h-16 w-auto mx-auto">
                        </div>
                    @else
                        <div class="mx-auto h-16 w-16 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $billHeader->company_name ?? 'Your Company Name' }}
                    </h3>
                    
                    @if($billHeader && $billHeader->company_address)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            {{ $billHeader->company_address }}
                        </p>
                    @endif
                    
                    <div class="flex justify-center space-x-4 mt-3 text-sm text-gray-600 dark:text-gray-400">
                        @if($billHeader && $billHeader->company_phone)
                            <span>{{ $billHeader->company_phone }}</span>
                        @endif
                        @if($billHeader && $billHeader->company_email)
                            <span>{{ $billHeader->company_email }}</span>
                        @endif
                    </div>
                    
                    @if($billHeader && $billHeader->company_website)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            {{ $billHeader->company_website }}
                        </p>
                    @endif
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Invoice #</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $billHeader->invoice_prefix ?? 'INV' }}-001</p>
                        </div>
                        <div class="text-right">
                            <h4 class="font-medium text-gray-900 dark:text-white">Date</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ date('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
                
                @if($billHeader && $billHeader->footer_text)
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4 mt-4">
                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                            {{ $billHeader->footer_text }}
                        </p>
                    </div>
                @endif
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                <h4 class="text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">How it works:</h4>
                <ul class="text-sm text-blue-800 dark:text-blue-200 space-y-1">
                    <li>• Configure your company information above</li>
                    <li>• Upload your company logo</li>
                    <li>• Save the settings</li>
                    <li>• This header will be applied to all generated bills</li>
                </ul>
            </div>
        </div>
    </div>
</x-admin-layout>
