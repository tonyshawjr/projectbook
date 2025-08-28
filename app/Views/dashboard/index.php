<?php
$pageTitle = 'Dashboard - Projectbook';
$currentPage = 'dashboard';

ob_start();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="dashboard-hero">
        <div class="dashboard-greeting">
            <?php echo htmlspecialchars($greeting); ?>,
        </div>
        <div class="dashboard-name">
            <?php echo htmlspecialchars($user['first_name']); ?>
        </div>
        <p class="dashboard-updated">Dashboard last updated on <?php echo $lastUpdated; ?>.</p>
    </div>

    <!-- Stats Summary -->
    <div class="dashboard-stats">
        <p>
            You're managing <strong><?php echo $stats['active_projects']; ?> active projects</strong> with 
            <strong><?php echo $stats['open_tickets']; ?> open tickets</strong> that need your attention. 
            Our records show <strong>$<?php echo number_format($stats['overdue_invoices'], 2); ?> in overdue invoices</strong> 
            that would benefit from follow-up.
        </p>
        <p class="mt-4">
            Your calendar has <strong><?php echo $stats['upcoming_consultations']; ?> upcoming consultations</strong> 
            scheduled this week. Let's make today productive by tackling these priorities systematically.
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 mb-12">
        <a href="/projects" class="btn-primary">
            View Projects →
        </a>
        <a href="/tickets" class="btn-secondary">
            Manage Tickets
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2">
            <!-- Recent Projects -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Recent Projects</h2>
                    <a href="/projects/new" class="btn-primary-small">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Project
                    </a>
                </div>
                
                <div class="space-y-4">
                    <?php foreach ($recentProjects as $project): ?>
                    <div class="card p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg"><?php echo htmlspecialchars($project['title']); ?></h3>
                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($project['client_name']); ?></p>
                            </div>
                            <span class="status-badge <?php 
                                echo $project['status'] === 'active' ? 'bg-status-active-bg text-status-active-text' : 
                                     ($project['status'] === 'completed' ? 'bg-status-completed-bg text-status-completed-text' : 
                                      'bg-status-paused-bg text-status-paused-text'); 
                            ?>">
                                <?php echo ucfirst($project['status']); ?>
                            </span>
                        </div>
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Progress</span>
                                <span><?php echo $project['progress']; ?>%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: <?php echo $project['progress']; ?>%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span>Due: <?php echo date('M d, Y', strtotime($project['end_date'] ?? '+30 days')); ?></span>
                            <a href="/projects/<?php echo $project['id']; ?>" class="text-blue-500 hover:text-blue-600">
                                View →
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Financial Overview -->
            <div class="financial-card mb-8">
                <h2 class="financial-header">
                    <span>📊</span> Financial Overview
                </h2>
                
                <div class="financial-metric">
                    <p class="financial-label">Total Revenue</p>
                    <p class="financial-value">
                        $<?php echo number_format($stats['total_revenue'], 0); ?>
                        <span class="indicator-up">↗</span>
                    </p>
                </div>
                
                <div class="financial-metric">
                    <p class="financial-label">Pending Invoices</p>
                    <p class="financial-value">
                        $<?php echo number_format($stats['pending_invoices'], 0); ?>
                        <span class="indicator-pending">💰</span>
                    </p>
                </div>
                
                <a href="/billing" class="btn-primary btn-primary-full mt-6">
                    View Financial Details
                </a>
            </div>

            <!-- Recent Notifications -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Recent Notifications</h2>
                    <a href="/notifications" class="text-sm text-blue-500 hover:text-blue-600">View all</a>
                </div>
                
                <div class="space-y-3">
                    <?php foreach ($notifications as $notification): ?>
                    <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="flex-shrink-0">
                            <?php if ($notification['type'] === 'ticket_submitted'): ?>
                                <span class="text-blue-500">🎫</span>
                            <?php elseif ($notification['type'] === 'invoice_overdue'): ?>
                                <span class="text-yellow-500">📧</span>
                            <?php elseif ($notification['type'] === 'consultation_reminder'): ?>
                                <span class="text-green-500">📅</span>
                            <?php else: ?>
                                <span class="text-gray-500">🔔</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-primary-text"><?php echo htmlspecialchars($notification['title']); ?></p>
                            <p class="text-xs text-gray-600">
                                <?php echo date('g:i A', strtotime($notification['created_at'])); ?>
                            </p>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>