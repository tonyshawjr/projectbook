<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-primary-text">Client Management</h1>
                <p class="mt-2 text-sm text-gray-600">Manage your direct and agency clients.</p>
            </div>
            <button class="btn-primary-small">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Client
            </button>
        </div>
        
        <div class="mt-6 flex items-center justify-between">
            <div class="relative">
                <input type="text" placeholder="Search clients..." class="pl-10 pr-4 py-2 border border-border-divider rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mt-6 border-b border-border-divider">
            <nav class="flex space-x-8">
                <a href="#" class="py-2 px-1 border-b-2 border-tab-active text-tab-active font-medium text-sm">All Clients</a>
                <a href="#" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">Direct</a>
                <a href="#" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">Agency</a>
                <a href="#" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">With Maintenance</a>
            </nav>
        </div>
    </div>

    <!-- Clients Table -->
    <div class="card">
        <div class="px-6 py-4 border-b border-border-divider">
            <h2 class="text-lg font-semibold text-primary-text">Clients</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Maintenance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agency</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-border-divider">
                    <?php foreach ($clients as $client): ?>
                        <?php 
                            // Generate client initials for avatar
                            $names = explode(' ', trim($client['contact_name'] ?: $client['company_name']));
                            $initials = '';
                            foreach (array_slice($names, 0, 2) as $name) {
                                $initials .= substr($name, 0, 1);
                            }
                            $initials = strtoupper($initials);
                            
                            // Determine type badge color
                            $typeClass = $client['client_type'] === 'direct' 
                                ? 'bg-blue-100 text-blue-800' 
                                : 'bg-purple-100 text-purple-800';
                                
                            // Maintenance plan badge
                            $maintenanceClass = match($client['maintenance_plan_type']) {
                                'premium' => 'bg-yellow-100 text-yellow-800',
                                'basic' => 'bg-green-100 text-green-800',
                                'enterprise' => 'bg-purple-100 text-purple-800',
                                default => 'bg-gray-100 text-gray-800'
                            };
                        ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                                            <span class="text-sm font-medium text-white"><?php echo $initials; ?></span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-primary-text"><?php echo htmlspecialchars($client['company_name']); ?></div>
                                        <?php if ($client['contact_name']): ?>
                                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($client['contact_name']); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">
                                    <?php if ($client['contact_email']): ?>
                                        <div class="flex items-center mb-1">
                                            <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <?php echo htmlspecialchars($client['contact_email']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($client['contact_phone']): ?>
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <?php echo htmlspecialchars($client['contact_phone']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="status-badge <?php echo $typeClass; ?>">
                                    <?php echo ucfirst($client['client_type']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($client['maintenance_plan_type'] !== 'none'): ?>
                                    <span class="status-badge <?php echo $maintenanceClass; ?>">
                                        <?php echo ucfirst($client['maintenance_plan_type']); ?>
                                    </span>
                                    <?php if ($client['maintenance_rate'] > 0): ?>
                                        <div class="text-xs text-gray-500 mt-1">$<?php echo number_format($client['maintenance_rate'], 0); ?>/mo</div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-gray-400 text-sm">None</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <?php echo $client['agency_name'] ? htmlspecialchars($client['agency_name']) : '—'; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="/clients/<?php echo $client['id']; ?>" class="text-blue-500 hover:text-blue-600">View</a>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (empty($clients)): ?>
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No clients</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by adding your first client.</p>
            <div class="mt-6">
                <button class="btn-primary">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Client
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>