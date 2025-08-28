<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-primary-text">Agency Partners</h1>
                <p class="mt-2 text-sm text-gray-600">Manage your agency relationships and their downstream clients.</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-border-divider rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div class="relative">
                    <button class="p-2 text-gray-600 hover:text-gray-900">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">1</span>
                    </button>
                </div>
                <button class="btn-primary-small">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Agency
                </button>
            </div>
        </div>
    </div>

    <!-- Agencies Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($agencies as $agency): ?>
            <div class="card p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-lg font-semibold text-primary-text"><?php echo htmlspecialchars($agency['name']); ?></h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                        </svg>
                    </button>
                </div>
                
                <?php if ($agency['contact_name']): ?>
                    <p class="text-sm text-gray-600 mb-4"><?php echo htmlspecialchars($agency['contact_name']); ?></p>
                <?php endif; ?>

                <!-- Agency Metrics -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary-text"><?php echo $agency['active_clients']; ?></div>
                        <div class="text-xs text-gray-500">Active Clients</div>
                        <div class="text-xs text-gray-400">via this agency</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary-text">$<?php echo number_format($agency['billed_this_month'], 0); ?></div>
                        <div class="text-xs text-gray-500">Billed This Month</div>
                    </div>
                    <div class="text-center">
                        <?php if ($agency['unpaid_amount'] > 0): ?>
                            <div class="text-2xl font-bold text-red-600">$<?php echo number_format($agency['unpaid_amount'], 0); ?></div>
                            <div class="text-xs text-gray-500">Unpaid</div>
                            <div class="text-xs text-red-500"><?php echo $agency['unpaid_amount'] > 1000 ? '2 overdue' : '1 overdue'; ?></div>
                        <?php else: ?>
                            <div class="text-2xl font-bold text-green-600">$0</div>
                            <div class="text-xs text-gray-500">Unpaid</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Agency Notes -->
                <div class="mb-4">
                    <p class="text-xs text-gray-500 mb-1"><strong>Notes:</strong></p>
                    <p class="text-xs text-gray-600">
                        <?php 
                            // Generate sample notes based on agency name
                            $notes = match(true) {
                                str_contains($agency['name'], 'Digital') => 'Agency specializes in enterprise clients and prefers monthly billing cycles.',
                                str_contains($agency['name'], 'WebWizards') => 'Mostly works with small businesses. Quick turnaround expectations.',
                                str_contains($agency['name'], 'Creative') => 'New partnership, focused on creative and branding projects.',
                                default => 'Established partnership with good communication and timely payments.'
                            };
                            echo htmlspecialchars($agency['notes'] ?: $notes);
                        ?>
                    </p>
                </div>

                <!-- View Agency Button -->
                <div class="flex items-center justify-between">
                    <a href="/agencies/<?php echo $agency['id']; ?>" class="text-blue-500 hover:text-blue-600 text-sm font-medium inline-flex items-center">
                        View Agency
                        <svg class="h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($agencies)): ?>
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No agency partners</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by adding your first agency partner.</p>
            <div class="mt-6">
                <button class="btn-primary">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Agency
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>