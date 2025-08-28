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

    <!-- Main Content Grid -->
    <div class="pb-12">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left Column - Projects (2/3 width) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Recent Projects Section -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Recent Projects</h3>
                        <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium bg-blue-500 text-white hover:bg-blue-600 h-9 rounded-md px-3 gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 12h8"></path>
                                <path d="M12 8v8"></path>
                            </svg>
                            New Project
                        </button>
                    </div>
                    
                    <div class="grid sm:grid-cols-2 gap-4">
                        <?php 
                        $projectsData = [
                            ['title' => 'Website Redesign', 'client' => 'Acme Corporation', 'status' => 'Active', 'progress' => 75, 'due' => 'Jun 30, 2023'],
                            ['title' => 'E-commerce Platform', 'client' => 'TechStart Inc.', 'status' => 'Active', 'progress' => 45, 'due' => 'Jul 15, 2023'],
                            ['title' => 'Branding Refresh', 'client' => 'Globex Corp', 'status' => 'Paused', 'progress' => 30, 'due' => 'Aug 10, 2023'],
                            ['title' => 'Mobile App UI', 'client' => 'Initech', 'status' => 'Completed', 'progress' => 100, 'due' => 'Jun 5, 2023']
                        ];
                        foreach ($projectsData as $project): 
                        ?>
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-medium text-base"><?php echo $project['title']; ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo $project['client']; ?></p>
                                </div>
                                <div class="px-2 py-1 rounded-full text-xs font-medium
                                    <?php 
                                    echo $project['status'] === 'Active' ? 'bg-emerald-100 text-emerald-800' : 
                                         ($project['status'] === 'Completed' ? 'bg-blue-100 text-blue-800' : 
                                          'bg-amber-100 text-amber-800'); 
                                    ?>">
                                    <?php echo $project['status']; ?>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex justify-between text-xs mb-1">
                                    <span>Progress</span>
                                    <span class="font-medium"><?php echo $project['progress']; ?>%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-blue-500 h-full rounded-full" style="width: <?php echo $project['progress']; ?>%"></div>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex justify-between items-center">
                                <div class="text-xs text-gray-500">Due: <?php echo $project['due']; ?></div>
                                <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium hover:bg-gray-100 rounded-md px-3 h-8 gap-1">
                                    View
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18l6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column - Notifications (1/3 width) -->
            <div class="space-y-6">
                <!-- Recent Notifications Card -->
                <div class="bg-white border rounded-xl shadow-sm">
                    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="font-medium">Recent Notifications</h3>
                        <a href="/notifications" class="text-sm text-blue-500 hover:text-blue-700 hover:underline">View all</a>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        <?php 
                        $notificationsData = [
                            ['icon' => 'ticket', 'iconColor' => 'blue', 'title' => 'New ticket from Acme Inc.', 'time' => '10 mins ago', 'description' => 'Homepage redesign feedback - High priority'],
                            ['icon' => 'credit-card', 'iconColor' => 'amber', 'title' => 'Invoice #1234 is overdue', 'time' => '2 hours ago', 'description' => 'Globex Corporation - $1,200.00'],
                            ['icon' => 'calendar', 'iconColor' => 'emerald', 'title' => 'Upcoming consultation', 'time' => 'Tomorrow, 10:00 AM', 'description' => 'Strategy call with John Smith from TechCorp'],
                            ['icon' => 'alert-circle', 'iconColor' => 'rose', 'title' => 'Project deadline approaching', 'time' => 'Today', 'description' => 'Initech website launch - Due in 3 days'],
                            ['icon' => 'message', 'iconColor' => 'blue', 'title' => 'New message from client', 'time' => 'Yesterday', 'description' => 'Sarah Johnson from Umbrella Corp has a question']
                        ];
                        foreach ($notificationsData as $notification): 
                        ?>
                        <div class="flex items-center gap-4 p-4 hover:bg-gray-50 cursor-pointer transition-colors">
                            <!-- Icon Circle -->
                            <div class="h-10 w-10 rounded-full flex items-center justify-center bg-<?php echo $notification['iconColor']; ?>-100">
                                <?php if ($notification['icon'] === 'ticket'): ?>
                                    <svg class="h-5 w-5 text-<?php echo $notification['iconColor']; ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                <?php elseif ($notification['icon'] === 'credit-card'): ?>
                                    <svg class="h-5 w-5 text-<?php echo $notification['iconColor']; ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                                        <line x1="2" x2="22" y1="10" y2="10"></line>
                                    </svg>
                                <?php elseif ($notification['icon'] === 'calendar'): ?>
                                    <svg class="h-5 w-5 text-<?php echo $notification['iconColor']; ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                <?php elseif ($notification['icon'] === 'alert-circle'): ?>
                                    <svg class="h-5 w-5 text-<?php echo $notification['iconColor']; ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" x2="12" y1="8" y2="12"></line>
                                        <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                    </svg>
                                <?php else: ?>
                                    <svg class="h-5 w-5 text-<?php echo $notification['iconColor']; ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm truncate font-semibold"><?php echo $notification['title']; ?></h4>
                                    <div class="ml-2 flex items-center text-gray-500">
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        <span class="text-xs"><?php echo $notification['time']; ?></span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1"><?php echo $notification['description']; ?></p>
                            </div>
                            
                            <!-- Chevron -->
                            <svg class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18l6-6-6-6"></path>
                            </svg>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>