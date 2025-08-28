<?php
$pageTitle = 'Dashboard - Projectbook';
$currentPage = 'dashboard';

ob_start();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <section class="mb-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_400px] lg:gap-12 xl:grid-cols-[1fr_500px]">
            <!-- Left Column - Hero Content -->
            <div class="flex flex-col justify-center space-y-6">
                <div class="space-y-2">
                    <h1 class="text-4xl font-bold tracking-tight leading-tight md:text-5xl xl:text-6xl">
                        Good afternoon,<br>
                        <span class="relative inline-block">
                            Tony
                            <span class="absolute -bottom-2 left-0 right-0 h-3 bg-blue-400 opacity-30"></span>
                        </span>
                    </h1>
                    <p class="text-muted-foreground mt-4 text-base">Dashboard last updated on <?php echo $lastUpdated; ?>.</p>
                </div>
                
                <div class="space-y-6 text-base md:text-lg text-gray-700 dark:text-gray-300">
                    <p class="leading-relaxed">
                        You're managing <strong><?php echo $stats['active_projects']; ?> active projects</strong> with 
                        <strong><?php echo $stats['open_tickets']; ?> open tickets</strong> that need your attention. 
                        Our records show <strong>$<?php echo number_format($stats['overdue_invoices'], 2); ?> in overdue invoices</strong> 
                        that would benefit from follow-up.
                    </p>
                    <p class="leading-relaxed">
                        Your calendar has <strong><?php echo $stats['upcoming_consultations']; ?> upcoming consultations</strong> 
                        scheduled this week. Let's make today productive by tackling these priorities systematically.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <a href="/projects" class="btn-primary gap-2">
                        View Projects
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="/tickets" class="btn-secondary">
                        Manage Tickets
                    </a>
                </div>
            </div>
            
            <!-- Right Column - Financial Overview Card -->
            <div class="flex items-center justify-center">
                <div class="financial-card w-full max-w-md">
                    <div class="flex flex-col space-y-1.5">
                        <h3 class="financial-header">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Financial Overview
                        </h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="financial-label">Total Revenue</p>
                                <p class="financial-value">$24,500</p>
                            </div>
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="financial-label">Pending Invoices</p>
                                <p class="financial-value">$8,200</p>
                            </div>
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <button class="btn-primary-full mt-6">
                        View Financial Details
                    </button>
                </div>
            </div>
        </div>
    </section>

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