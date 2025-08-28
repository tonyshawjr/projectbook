<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="/clients" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Clients
        </a>
    </div>

    <!-- Client Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-primary-text"><?php echo htmlspecialchars($client['company_name']); ?></h1>
            <p class="mt-1 text-sm text-gray-600">Client ID: client-<?php echo str_pad($client['id'], 3, '0', STR_PAD_LEFT); ?></p>
        </div>
        <button class="btn-secondary">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Client
        </button>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Primary Contact -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Primary Contact</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Name</label>
                        <p class="text-sm text-gray-600"><?php echo htmlspecialchars($client['contact_name'] ?: 'Not specified'); ?></p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Email</label>
                            <div class="flex items-center mt-1">
                                <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($client['contact_email'] ?: 'Not provided'); ?></p>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Phone</label>
                            <div class="flex items-center mt-1">
                                <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($client['contact_phone'] ?: 'Not provided'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Website</label>
                        <div class="flex items-center mt-1">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            <p class="text-sm text-blue-500 hover:text-blue-600 cursor-pointer">smithdesign.co</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Address</label>
                        <div class="flex items-start mt-1">
                            <svg class="h-4 w-4 mr-2 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-sm text-gray-600">123 Main St, San Francisco, CA 94105</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-border-divider">
                    <span class="status-badge bg-blue-100 text-blue-800">Direct</span>
                </div>
            </div>

            <!-- Maintenance Usage -->
            <?php if ($client['maintenance_plan_type'] !== 'none'): ?>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-primary-text">Maintenance Usage</h2>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded">July</button>
                            <button class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded">June</button>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="font-medium">Hours Used</span>
                            <span>3.5 / 5 hours</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Sufficient hours remaining</p>
                    </div>

                    <h3 class="font-medium text-primary-text mb-3">Task Breakdown</h3>
                    <div class="space-y-3">
                        <?php foreach ($maintenanceUsage as $usage): ?>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <p class="text-sm font-medium text-primary-text"><?php echo htmlspecialchars($usage['task']); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo date('M j, Y', strtotime($usage['date'])); ?></p>
                                </div>
                                <span class="text-sm font-medium"><?php echo $usage['hours']; ?> hour<?php echo $usage['hours'] != 1 ? 's' : ''; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="mt-6">
                        <button class="btn-primary-small">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Task
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Notes -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Notes</h2>
                <textarea class="w-full p-3 border border-border-divider rounded-md resize-none" rows="4" placeholder="Long-term client since 2019. Prefers communication via email.">Long-term client since 2019. Prefers communication via email.</textarea>
            </div>

            <!-- Project History -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Project History</h2>
                <div class="space-y-3">
                    <?php if (!empty($projects)): ?>
                        <?php foreach ($projects as $project): ?>
                            <?php 
                                $statusClass = match($project['status']) {
                                    'active' => 'bg-status-active-bg text-status-active-text',
                                    'completed' => 'bg-status-completed-bg text-status-completed-text', 
                                    'paused' => 'bg-status-paused-bg text-status-paused-text',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                            ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                <div>
                                    <h4 class="text-sm font-medium text-primary-text"><?php echo htmlspecialchars($project['title']); ?></h4>
                                    <p class="text-xs text-gray-500">
                                        <?php echo $project['start_date'] ? date('M j, Y', strtotime($project['start_date'])) : 'Start Date TBD'; ?>
                                        <?php if ($project['end_date']): ?>
                                            - <?php echo date('M j, Y', strtotime($project['end_date'])); ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo ucfirst($project['status']); ?></span>
                                    <a href="/projects/<?php echo $project['id']; ?>" class="text-blue-500 hover:text-blue-600 text-sm">View</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 text-center py-4">No projects yet</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Maintenance Plan -->
            <div class="card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-primary-text">Maintenance Plan</h3>
                    <a href="#" class="text-sm text-blue-500 hover:text-blue-600">Edit</a>
                </div>
                
                <div class="space-y-3">
                    <?php if ($client['maintenance_plan_type'] !== 'none'): ?>
                        <div class="flex justify-between items-center">
                            <span class="status-badge bg-yellow-100 text-yellow-800">Premium</span>
                            <span class="status-badge bg-green-100 text-green-800">Active</span>
                        </div>
                        <div class="text-center py-2">
                            <span class="text-2xl font-bold text-primary-text">$<?php echo number_format($client['maintenance_rate'], 0); ?></span>
                            <span class="text-sm text-gray-500">/mo</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <div class="flex items-center mb-1">
                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Renewal date: <?php echo $client['maintenance_renewal_date'] ? date('M j, Y', strtotime($client['maintenance_renewal_date'])) : 'Not set'; ?>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600">Includes monthly maintenance, security updates, and 5 hours of content changes.</p>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 text-center py-4">No maintenance plan</p>
                        <button class="w-full btn-primary-small">Add Plan</button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tags -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-3">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="status-badge bg-blue-100 text-blue-800">Design</span>
                    <span class="status-badge bg-purple-100 text-purple-800">Branding</span>
                    <span class="status-badge bg-green-100 text-green-800">E-commerce</span>
                </div>
                <button class="mt-3 text-sm text-blue-500 hover:text-blue-600">+ Add Tag</button>
            </div>
        </div>
    </div>
</div>