<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="/agencies" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Agencies
        </a>
    </div>

    <!-- Agency Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-primary-text"><?php echo htmlspecialchars($agency['name']); ?></h1>
            <?php if ($agency['contact_name']): ?>
                <p class="mt-1 text-sm text-gray-600"><?php echo htmlspecialchars($agency['contact_name']); ?></p>
            <?php endif; ?>
        </div>
        <button class="btn-secondary">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Agency
        </button>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Agency Contact Info -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Primary Contact</label>
                        <p class="text-sm text-gray-600 mt-1"><?php echo htmlspecialchars($agency['contact_name'] ?: 'Not specified'); ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <div class="flex items-center mt-1">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($agency['contact_email'] ?: 'Not provided'); ?></p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Phone</label>
                        <div class="flex items-center mt-1">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($agency['contact_phone'] ?: 'Not provided'); ?></p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Address</label>
                        <div class="flex items-start mt-1">
                            <svg class="h-4 w-4 mr-2 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($agency['address'] ?: 'Not provided'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agency Clients -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Agency Clients</h2>
                <?php if (!empty($clients)): ?>
                    <div class="space-y-3">
                        <?php foreach ($clients as $client): ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                <div class="flex items-center space-x-3">
                                    <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-white">
                                            <?php echo strtoupper(substr($client['company_name'], 0, 2)); ?>
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-primary-text"><?php echo htmlspecialchars($client['company_name']); ?></h4>
                                        <?php if ($client['contact_name']): ?>
                                            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($client['contact_name']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <?php if ($client['maintenance_plan_type'] !== 'none'): ?>
                                        <span class="status-badge bg-green-100 text-green-800 text-xs">
                                            <?php echo ucfirst($client['maintenance_plan_type']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <a href="/clients/<?php echo $client['id']; ?>" class="text-blue-500 hover:text-blue-600 text-sm">View</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-sm text-gray-500 text-center py-8">No clients assigned to this agency yet.</p>
                <?php endif; ?>
            </div>

            <!-- Notes -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Notes</h2>
                <textarea class="w-full p-3 border border-border-divider rounded-md resize-none" rows="4" placeholder="Add notes about this agency..."><?php echo htmlspecialchars($agency['notes'] ?: ''); ?></textarea>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Financial Overview -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Financial Overview</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Monthly Billing</label>
                        <p class="text-2xl font-bold text-primary-text">$<?php echo number_format($agency['monthly_billing'], 0); ?></p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Commission Rate</label>
                        <p class="text-lg font-semibold text-primary-text"><?php echo number_format($agency['commission_rate'], 1); ?>%</p>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Performance</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Total Revenue</span>
                        <span class="text-sm font-medium">$<?php echo number_format($metrics['total_revenue'] ?? 0, 0); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Active Projects</span>
                        <span class="text-sm font-medium"><?php echo $metrics['active_projects'] ?? 0; ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Completion Rate</span>
                        <span class="text-sm font-medium"><?php echo $metrics['completion_rate'] ?? 0; ?>%</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <button class="w-full btn-primary-small justify-center">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Add Client
                    </button>
                    <button class="w-full btn-secondary justify-center">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Generate Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>