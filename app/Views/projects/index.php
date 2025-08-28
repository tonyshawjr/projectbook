<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-primary-text">Projects</h1>
                <p class="mt-2 text-sm text-gray-600">Manage your client projects, track progress, and monitor deadlines.</p>
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
            </div>
        </div>
        
        <div class="mt-6 flex items-center justify-between">
            <div class="relative">
                <select class="appearance-none bg-white border border-border-divider rounded-md px-4 py-2 pr-8 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option>All Projects</option>
                    <option>Active</option>
                    <option>Paused</option>
                    <option>Completed</option>
                </select>
                <svg class="absolute right-2 top-2.5 h-4 w-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
            
            <button class="btn-primary-small">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Project
            </button>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($projects as $project): ?>
            <?php 
                $statusClass = match($project['status']) {
                    'active' => 'bg-status-active-bg text-status-active-text',
                    'completed' => 'bg-status-completed-bg text-status-completed-text', 
                    'paused' => 'bg-status-paused-bg text-status-paused-text',
                    default => 'bg-gray-100 text-gray-800'
                };
                
                $progress = $project['progress_percentage'] ?? rand(30, 100);
                $budget = number_format($project['budget'], 0);
                $actual = number_format($project['actual_cost'], 0);
            ?>
            <div class="card p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo ucfirst($project['status']); ?></span>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                        </svg>
                    </button>
                </div>
                
                <h3 class="text-lg font-semibold text-primary-text mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                
                <div class="flex items-center text-sm text-gray-600 mb-3">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
                    </svg>
                    <?php echo htmlspecialchars($project['client_name']); ?>
                </div>
                
                <p class="text-sm text-gray-600 mb-4 line-clamp-2"><?php echo htmlspecialchars($project['description'] ?? 'No description available.'); ?></p>
                
                <div class="space-y-3">
                    <!-- Project Details -->
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center space-x-4">
                            <?php if ($project['start_date'] && $project['end_date']): ?>
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?php echo date('M j', strtotime($project['start_date'])); ?> - <?php echo date('M j, Y', strtotime($project['end_date'])); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($project['category']): ?>
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <?php echo htmlspecialchars($project['category']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Budget Info -->
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center text-gray-600">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Budget: $<?php echo $budget; ?>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            4 Files
                        </div>
                    </div>
                    
                    <!-- Financial Status -->
                    <div class="pt-2 border-t border-border-divider">
                        <div class="text-sm">
                            <?php if ($project['actual_cost'] > 0): ?>
                                <span class="text-orange-600">Partial: $<?php echo $actual; ?></span>
                            <?php else: ?>
                                <span class="text-red-600">Pending: $0</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- View Project Button -->
                    <div class="pt-2">
                        <a href="/projects/<?php echo $project['id']; ?>" class="text-blue-500 hover:text-blue-600 text-sm font-medium">View Project</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($projects)): ?>
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new project.</p>
            <div class="mt-6">
                <button class="btn-primary">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Project
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>