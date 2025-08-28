<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-primary-text">Support Tickets</h1>
                <p class="mt-2 text-sm text-gray-600">Track and manage support requests from clients in one place.</p>
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
                    New Ticket
                </button>
            </div>
        </div>
        
        <div class="mt-6 flex items-center justify-between">
            <div class="relative">
                <select class="appearance-none bg-white border border-border-divider rounded-md px-4 py-2 pr-8 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option>All Tickets</option>
                    <option>Open</option>
                    <option>In Progress</option>
                    <option>Closed</option>
                </select>
                <svg class="absolute right-2 top-2.5 h-4 w-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mt-6 border-b border-border-divider">
            <nav class="flex space-x-8">
                <a href="#" class="py-2 px-1 border-b-2 border-tab-active text-tab-active font-medium text-sm">All Tickets</a>
                <a href="#" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm inline-flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    Priority Inbox
                </a>
                <a href="#" class="py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">Standard Inbox</a>
            </nav>
        </div>
    </div>

    <!-- Tickets List -->
    <div class="card">
        <div class="px-6 py-4 border-b border-border-divider">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-primary-text">Support Tickets</h2>
                <span class="text-sm text-gray-500">Showing <?php echo count($tickets); ?> of <?php echo count($tickets); ?> tickets</span>
            </div>
        </div>
        
        <div class="divide-y divide-border-divider">
            <?php foreach ($tickets as $ticket): ?>
                <?php 
                    // Status badge classes
                    $statusClass = match($ticket['status']) {
                        'open' => 'bg-blue-100 text-blue-800',
                        'in_progress' => 'bg-yellow-100 text-yellow-800',
                        'closed' => 'bg-green-100 text-green-800',
                        default => 'bg-gray-100 text-gray-800'
                    };
                    
                    // Priority badge classes  
                    $priorityClass = match($ticket['priority']) {
                        'premium' => 'bg-purple-100 text-purple-800',
                        'high' => 'bg-red-100 text-red-800',
                        'medium' => 'bg-yellow-100 text-yellow-800',
                        'low' => 'bg-green-100 text-green-800',
                        default => 'bg-gray-100 text-gray-800'
                    };
                ?>
                <div class="px-6 py-4 hover:bg-gray-50">
                    <div class="flex items-start space-x-4">
                        <!-- Status Icon -->
                        <div class="flex-shrink-0 mt-1">
                            <?php if ($ticket['status'] === 'open'): ?>
                                <div class="h-3 w-3 bg-blue-500 rounded-full"></div>
                            <?php elseif ($ticket['status'] === 'in_progress'): ?>
                                <div class="h-3 w-3 bg-yellow-500 rounded-full"></div>
                            <?php elseif ($ticket['status'] === 'closed'): ?>
                                <div class="h-3 w-3 bg-green-500 rounded-full"></div>
                            <?php else: ?>
                                <div class="h-3 w-3 bg-gray-400 rounded-full"></div>
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="status-badge <?php echo $statusClass; ?> text-xs">
                                    <?php echo ucfirst(str_replace('_', '-', $ticket['status'])); ?>
                                </span>
                                <span class="status-badge <?php echo $priorityClass; ?> text-xs">
                                    <?php echo ucfirst($ticket['priority']); ?>
                                </span>
                                <?php if ($ticket['priority'] === 'medium'): ?>
                                    <span class="status-badge bg-orange-100 text-orange-800 text-xs">Medium Priority</span>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="text-base font-medium text-primary-text mb-1">
                                <?php echo htmlspecialchars($ticket['title']); ?>
                            </h3>
                            
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                <?php echo htmlspecialchars($ticket['description']); ?>
                            </p>
                            
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
                                    </svg>
                                    <?php echo htmlspecialchars($ticket['client_name']); ?>
                                </div>
                                
                                <?php if ($ticket['project_title']): ?>
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <?php echo htmlspecialchars($ticket['project_title']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Timestamp and Actions -->
                        <div class="flex-shrink-0 text-right">
                            <div class="text-xs text-gray-500 mb-2">
                                <svg class="inline h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <?php echo date('M j, g:i A', strtotime($ticket['created_at'])); ?>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="/tickets/<?php echo $ticket['id']; ?>" class="text-blue-500 hover:text-blue-600 text-sm">View</a>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (empty($tickets)): ?>
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No support tickets</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first support ticket.</p>
            <div class="mt-6">
                <button class="btn-primary">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Ticket
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>