<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="/projects" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Projects
        </a>
    </div>

    <!-- Project Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-primary-text"><?php echo htmlspecialchars($project['title']); ?></h1>
            <?php 
                $statusClass = match($project['status']) {
                    'active' => 'bg-status-active-bg text-status-active-text',
                    'completed' => 'bg-status-completed-bg text-status-completed-text', 
                    'paused' => 'bg-status-paused-bg text-status-paused-text',
                    default => 'bg-gray-100 text-gray-800'
                };
            ?>
            <span class="status-badge <?php echo $statusClass; ?>"><?php echo ucfirst($project['status']); ?></span>
        </div>
        <button class="btn-secondary">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Project
        </button>
    </div>

    <!-- Client Info -->
    <div class="mb-6">
        <div class="flex items-center text-sm text-gray-600">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
            </svg>
            Client: <?php echo htmlspecialchars($project['client_name']); ?>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="border-b border-border-divider mb-8">
        <nav class="flex space-x-8">
            <a href="#overview" class="py-2 px-1 border-b-2 border-tab-active text-tab-active font-medium text-sm">Overview</a>
            <a href="#tasks" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">Tasks</a>
            <a href="#files" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">Files</a>
            <a href="#financial" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">Financial</a>
        </nav>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Project Description -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Project Description</h2>
                <p class="text-gray-600 leading-relaxed">
                    <?php echo htmlspecialchars($project['description'] ?: 'Complete redesign of corporate website with new branding guidelines and improved user experience. The project includes responsive design, content migration, and integration with their existing CMS.'); ?>
                </p>
            </div>

            <!-- Project Timeline -->
            <div class="card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-primary-text">Project Timeline</h2>
                    <span class="text-sm text-blue-500"><?php echo $project['start_date'] ? date('M j, Y', strtotime($project['start_date'])) : 'Start Date'; ?> - <?php echo $project['end_date'] ? date('M j, Y', strtotime($project['end_date'])) : 'End Date'; ?></span>
                </div>
                
                <div class="space-y-4">
                    <?php foreach ($timeline as $item): ?>
                        <div class="flex items-start space-x-3">
                            <?php if ($item['status'] === 'completed'): ?>
                                <div class="flex-shrink-0 w-3 h-3 bg-green-500 rounded-full mt-1.5"></div>
                            <?php elseif ($item['status'] === 'pending'): ?>
                                <div class="flex-shrink-0 w-3 h-3 bg-blue-500 rounded-full mt-1.5"></div>
                            <?php else: ?>
                                <div class="flex-shrink-0 w-3 h-3 bg-orange-500 rounded-full mt-1.5"></div>
                            <?php endif; ?>
                            <div>
                                <p class="text-sm font-medium text-primary-text"><?php echo date('M j, Y', strtotime($item['date'])); ?></p>
                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($item['title']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Notes -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Notes</h2>
                <p class="text-sm text-gray-600">
                    <?php echo htmlspecialchars($project['notes'] ?: 'Client has requested additional features beyond original scope. Need to discuss timeline extension.'); ?>
                </p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Client Details -->
            <div class="card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-primary-text">Client</h3>
                    <a href="/clients/<?php echo $project['client_id']; ?>" class="text-sm text-blue-500 hover:text-blue-600">View Client</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center text-sm">
                        <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
                        </svg>
                        <?php echo htmlspecialchars($project['client_name']); ?>
                    </div>
                    <?php if ($project['contact_email']): ?>
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <?php echo htmlspecialchars($project['contact_email']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($project['contact_phone']): ?>
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <?php echo htmlspecialchars($project['contact_phone']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Project Details -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Project Details</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-500">Category</span>
                        <p class="text-sm font-medium"><?php echo htmlspecialchars($project['category'] ?: 'Web Design'); ?></p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Duration</span>
                        <p class="text-sm font-medium">
                            <?php 
                                if ($project['start_date'] && $project['end_date']) {
                                    echo date('M j, Y', strtotime($project['start_date'])) . ' - ' . date('M j, Y', strtotime($project['end_date']));
                                } else {
                                    echo 'Not specified';
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Project Stats -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Project Stats</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Tasks
                        </div>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full"><?php echo $stats['tasks']; ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Files
                        </div>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full"><?php echo $stats['files']; ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Financial
                        </div>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full"><?php echo $stats['financial']; ?></span>
                    </div>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Financial Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Budget</span>
                        <span class="text-sm font-medium">$<?php echo number_format($financial['budget'], 0); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Charged</span>
                        <span class="text-sm font-medium">$<?php echo number_format($financial['charged'], 0); ?></span>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-border-divider">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="text-sm font-medium"><?php echo $financial['status']; ?></span>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-blue-500 hover:text-blue-600 text-sm">View Financial Details</a>
                </div>
            </div>
        </div>
    </div>
</div>