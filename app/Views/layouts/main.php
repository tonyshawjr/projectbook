<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Projectbook'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-primary-text">
    <?php if (isset($_SESSION['user_id'])): ?>
    <!-- Navigation Header -->
    <header class="w-full border-b border-gray-200 bg-white sticky top-0 z-40 shadow-sm">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 md:px-8 py-3">
            <div class="flex items-center justify-between">
                <!-- Left Section - Logo and Navigation -->
                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <a href="/" class="font-bold text-xl">Freelancer</a>
                    
                    <!-- Navigation Links -->
                    <nav class="flex items-center space-x-1">
                        <a href="/dashboard" class="px-4 py-2 text-sm rounded-md transition-colors <?php echo $currentPage === 'dashboard' ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100'; ?>">
                            Dashboard
                        </a>
                        <a href="/projects" class="px-4 py-2 text-sm rounded-md transition-colors <?php echo $currentPage === 'projects' ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100'; ?>">
                            Projects
                        </a>
                        <a href="/clients" class="px-4 py-2 text-sm rounded-md transition-colors <?php echo $currentPage === 'clients' ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100'; ?>">
                            Clients
                        </a>
                        <a href="/agencies" class="px-4 py-2 text-sm rounded-md transition-colors <?php echo $currentPage === 'agencies' ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100'; ?>">
                            Agencies
                        </a>
                        <a href="/tickets" class="px-4 py-2 text-sm rounded-md transition-colors <?php echo $currentPage === 'tickets' ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100'; ?>">
                            Tickets
                        </a>
                        <a href="/billing" class="px-4 py-2 text-sm rounded-md transition-colors <?php echo $currentPage === 'billing' ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-700 hover:bg-gray-100'; ?>">
                            Billing
                        </a>
                        
                        <!-- More Dropdown Button -->
                        <button class="inline-flex items-center gap-2 px-4 py-2 text-sm rounded-md font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                            More
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6"></path>
                            </svg>
                        </button>
                    </nav>
                </div>
                
                <!-- Right Section - User Actions -->
                <div class="flex items-center space-x-3">
                    <!-- Notifications Button -->
                    <button class="relative inline-flex items-center justify-center rounded-md border border-gray-200 bg-white hover:bg-gray-100 h-10 w-10 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">3</span>
                    </button>
                    
                    <!-- User Avatar and Name -->
                    <button class="relative flex items-center gap-2 h-10 p-1 rounded-md hover:bg-gray-100 transition-colors">
                        <span class="relative flex shrink-0 overflow-hidden rounded-full h-8 w-8 bg-gray-200">
                            <?php if (!empty($_SESSION['user_avatar'])): ?>
                                <img class="aspect-square h-full w-full" alt="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" src="<?php echo htmlspecialchars($_SESSION['user_avatar']); ?>">
                            <?php else: ?>
                                <span class="flex h-full w-full items-center justify-center bg-blue-500 text-white text-sm font-medium">
                                    <?php echo strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)); ?>
                                </span>
                            <?php endif; ?>
                        </span>
                        <span class="hidden sm:inline font-medium text-sm"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
        <?php echo $content ?? ''; ?>
    </main>
</body>
</html>