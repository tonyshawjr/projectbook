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
    <!-- Navigation -->
    <nav class="bg-white border-b border-border-divider">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold">Freelancer</span>
                    </div>
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-1">
                        <a href="/dashboard" class="<?php echo $currentPage === 'dashboard' ? 'nav-link-active' : 'nav-link'; ?> px-3 py-2 inline-flex items-center">
                            Dashboard
                        </a>
                        <a href="/projects" class="<?php echo $currentPage === 'projects' ? 'nav-link-active' : 'nav-link'; ?> px-3 py-2 inline-flex items-center">
                            Projects
                        </a>
                        <a href="/clients" class="<?php echo $currentPage === 'clients' ? 'nav-link-active' : 'nav-link'; ?> px-3 py-2 inline-flex items-center">
                            Clients
                        </a>
                        <a href="/agencies" class="<?php echo $currentPage === 'agencies' ? 'nav-link-active' : 'nav-link'; ?> px-3 py-2 inline-flex items-center">
                            Agencies
                        </a>
                        <a href="/tickets" class="<?php echo $currentPage === 'tickets' ? 'nav-link-active' : 'nav-link'; ?> px-3 py-2 inline-flex items-center">
                            Tickets
                        </a>
                        <a href="/billing" class="<?php echo $currentPage === 'billing' ? 'nav-link-active' : 'nav-link'; ?> px-3 py-2 inline-flex items-center">
                            Billing
                        </a>
                        <div class="relative">
                            <button class="nav-link px-3 py-2 inline-flex items-center">
                                More
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-600 hover:text-gray-900">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                    </button>
                    <span class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="/logout" class="text-sm text-gray-600 hover:text-gray-900">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
        <?php echo $content ?? ''; ?>
    </main>
</body>
</html>