<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="/tickets" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Tickets
        </a>
    </div>

    <!-- Ticket Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-primary-text"><?php echo htmlspecialchars($ticket['title']); ?></h1>
            <p class="mt-1 text-sm text-gray-600">Ticket #<?php echo str_pad($ticket['id'], 4, '0', STR_PAD_LEFT); ?> • Created <?php echo date('M j, Y', strtotime($ticket['created_at'])); ?></p>
        </div>
        <div class="flex items-center space-x-3">
            <?php 
                $statusClass = match($ticket['status']) {
                    'open' => 'bg-blue-100 text-blue-800',
                    'in_progress' => 'bg-yellow-100 text-yellow-800',
                    'closed' => 'bg-green-100 text-green-800',
                    default => 'bg-gray-100 text-gray-800'
                };
                
                $priorityClass = match($ticket['priority']) {
                    'premium' => 'bg-purple-100 text-purple-800',
                    'high' => 'bg-red-100 text-red-800',
                    'medium' => 'bg-yellow-100 text-yellow-800',
                    'low' => 'bg-green-100 text-green-800',
                    default => 'bg-gray-100 text-gray-800'
                };
            ?>
            <span class="status-badge <?php echo $statusClass; ?>">
                <?php echo ucfirst(str_replace('_', ' ', $ticket['status'])); ?>
            </span>
            <span class="status-badge <?php echo $priorityClass; ?>">
                <?php echo ucfirst($ticket['priority']); ?> Priority
            </span>
            <button class="btn-secondary">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Ticket
            </button>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Ticket Description -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Description</h2>
                <div class="prose prose-sm max-w-none text-gray-600">
                    <p><?php echo nl2br(htmlspecialchars($ticket['description'])); ?></p>
                </div>
            </div>

            <!-- Comments/Activity -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Activity</h2>
                
                <div class="space-y-6">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-white">
                                            <?php echo strtoupper(substr($comment['first_name'], 0, 1) . substr($comment['last_name'], 0, 1)); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-sm font-medium text-primary-text">
                                                <?php echo htmlspecialchars($comment['first_name'] . ' ' . $comment['last_name']); ?>
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                <?php echo date('M j, Y g:i A', strtotime($comment['created_at'])); ?>
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-700"><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 text-center py-4">No comments yet</p>
                    <?php endif; ?>
                </div>

                <!-- Add Comment -->
                <div class="mt-6 border-t border-border-divider pt-6">
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-gray-500 rounded-full flex items-center justify-center">
                                <span class="text-xs font-medium text-white">
                                    <?php echo strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 2)); ?>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <textarea class="w-full p-3 border border-border-divider rounded-md resize-none focus:outline-none focus:ring-1 focus:ring-blue-500" rows="3" placeholder="Add a comment..."></textarea>
                            <div class="mt-3 flex justify-between">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                                    <span class="ml-2 text-sm text-gray-600">Internal comment (not visible to client)</span>
                                </label>
                                <button class="btn-primary-small">Add Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Time Tracking -->
            <div class="card p-6">
                <h2 class="text-lg font-semibold text-primary-text mb-4">Time Tracking</h2>
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-2xl font-bold text-primary-text"><?php echo number_format($ticket['time_spent'], 1); ?></span>
                        <span class="text-sm text-gray-500 ml-1">hours logged</span>
                    </div>
                    <button class="btn-primary-small">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Log Time
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Client & Project Info -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Details</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Client</label>
                        <div class="flex items-center mt-1">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
                            </svg>
                            <a href="/clients/<?php echo $ticket['client_id']; ?>" class="text-blue-500 hover:text-blue-600 text-sm">
                                <?php echo htmlspecialchars($ticket['client_name']); ?>
                            </a>
                        </div>
                    </div>
                    
                    <?php if ($ticket['project_title']): ?>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Project</label>
                            <div class="flex items-center mt-1">
                                <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <a href="/projects/<?php echo $ticket['project_id']; ?>" class="text-blue-500 hover:text-blue-600 text-sm">
                                    <?php echo htmlspecialchars($ticket['project_title']); ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Priority</label>
                        <p class="text-sm text-gray-600 mt-1"><?php echo ucfirst($ticket['priority']); ?></p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Status</label>
                        <p class="text-sm text-gray-600 mt-1"><?php echo ucfirst(str_replace('_', ' ', $ticket['status'])); ?></p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card p-6">
                <h3 class="font-semibold text-primary-text mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <?php if ($ticket['status'] !== 'closed'): ?>
                        <button class="w-full btn-primary-small justify-center">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Close Ticket
                        </button>
                    <?php endif; ?>
                    
                    <?php if ($ticket['status'] === 'open'): ?>
                        <button class="w-full btn-secondary justify-center">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Start Progress
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Related Tickets -->
            <?php if (!empty($relatedTickets)): ?>
                <div class="card p-6">
                    <h3 class="font-semibold text-primary-text mb-4">Related Tickets</h3>
                    <div class="space-y-3">
                        <?php foreach ($relatedTickets as $related): ?>
                            <div class="border border-border-divider rounded p-3">
                                <a href="/tickets/<?php echo $related['id']; ?>" class="text-sm font-medium text-blue-500 hover:text-blue-600">
                                    <?php echo htmlspecialchars($related['title']); ?>
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo ucfirst($related['status']); ?> • <?php echo date('M j', strtotime($related['created_at'])); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>