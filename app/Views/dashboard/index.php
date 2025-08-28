<?php
$pageTitle = 'Dashboard - Projectbook';
$currentPage = 'dashboard';

ob_start();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="py-8">
        <h1 class="text-5xl font-bold mb-2">
            Good afternoon,<br>
            Tony
        </h1>
        <p class="text-gray-600 mb-8">Dashboard last updated on <?php echo $lastUpdated; ?>.</p>
        
        <div class="mb-8 text-lg text-gray-700">
            <p class="mb-4">
                You're managing <span class="font-semibold"><?php echo $stats['active_projects']; ?> active projects</span> with 
                <span class="font-semibold"><?php echo $stats['open_tickets']; ?> open tickets</span> that need your attention. 
                Our records show <span class="font-semibold">$<?php echo number_format($stats['overdue_invoices'], 0); ?> in overdue invoices</span> 
                that would benefit from follow-up.
            </p>
            <p>
                Your calendar has <span class="font-semibold"><?php echo $stats['upcoming_consultations']; ?> upcoming consultations</span> 
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
        <!-- Left Column - Projects -->
        <div class="lg:col-span-2">
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Recent Projects</h2>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm hover:bg-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        New Project
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php 
                    $projectsData = [
                        ['title' => 'Website Redesign', 'client' => 'Acme Corporation', 'status' => 'Active', 'progress' => 75, 'due' => 'Jun 30, 2023'],
                        ['title' => 'E-commerce Platform', 'client' => 'TechStart Inc.', 'status' => 'Active', 'progress' => 45, 'due' => 'Jul 15, 2023'],
                        ['title' => 'Branding Refresh', 'client' => 'Globex Corp', 'status' => 'Paused', 'progress' => 30, 'due' => 'Aug 10, 2023'],
                        ['title' => 'Mobile App UI', 'client' => 'Initech', 'status' => 'Completed', 'progress' => 100, 'due' => 'Jun 5, 2023']
                    ];
                    foreach ($projectsData as $project): 
                    ?>
                    <div class="bg-white rounded-lg p-5 border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-semibold text-base"><?php echo $project['title']; ?></h3>
                                <p class="text-sm text-gray-600"><?php echo $project['client']; ?></p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-md font-medium
                                <?php 
                                echo $project['status'] === 'Active' ? 'bg-green-100 text-green-700' : 
                                     ($project['status'] === 'Completed' ? 'bg-blue-100 text-blue-700' : 
                                      'bg-yellow-100 text-yellow-700'); 
                                ?>">
                                <?php echo $project['status']; ?>
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span><?php echo $project['progress']; ?>%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" style="width: <?php echo $project['progress']; ?>%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">Due: <?php echo $project['due']; ?></span>
                            <a href="#" class="text-blue-500 text-sm hover:text-blue-600">View →</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Financial Overview -->
            <div class="bg-white rounded-lg p-6 border border-gray-200 mb-6">
                <h2 class="flex items-center gap-2 text-lg font-semibold mb-4">
                    <span class="text-xl">📊</span>
                    Financial Overview
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold">$24,500</p>
                            <span class="text-green-500 text-lg">↗</span>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-600 mb-1">Pending Invoices</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold">$8,200</p>
                            <span class="text-2xl">💰</span>
                        </div>
                    </div>
                </div>
                
                <button class="w-full bg-blue-500 text-white py-3 rounded-lg mt-6 font-medium hover:bg-blue-600 transition-colors">
                    View Financial Details
                </button>
            </div>

            <!-- Recent Notifications -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Recent Notifications</h2>
                    <a href="/notifications" class="text-blue-500 text-sm hover:text-blue-600">View all</a>
                </div>
                
                <div class="space-y-2">
                    <?php 
                    $notificationsData = [
                        ['icon' => '🎫', 'title' => 'New ticket from Acme Inc.', 'time' => '10 mins ago', 'priority' => 'Homepage redesign feedback - High priority'],
                        ['icon' => '📧', 'title' => 'Invoice #1234 is overdue', 'time' => '2 hours ago', 'company' => 'Globex Corporation - $1,200.00'],
                        ['icon' => '📅', 'title' => 'Upcoming consultation', 'time' => 'Tomorrow, 10:00 AM', 'details' => 'Strategy call with John Smith from TechCorp'],
                        ['icon' => '🔔', 'title' => 'Project deadline approaching', 'time' => 'Today', 'project' => 'Initech website launch - Due in 3 days'],
                        ['icon' => '💬', 'title' => 'New message from client', 'time' => 'Yesterday', 'sender' => 'Sarah Johnson from Umbrella Corp has a question']
                    ];
                    foreach ($notificationsData as $notification): 
                    ?>
                    <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                        <span class="text-xl flex-shrink-0"><?php echo $notification['icon']; ?></span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900"><?php echo $notification['title']; ?></p>
                            <p class="text-xs text-gray-500 mt-0.5"><?php echo $notification['time']; ?></p>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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