<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Projectbook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-text': '#1a202c',
                        'secondary-text': '#4a5568',
                        'border-divider': '#e2e8f0',
                        'status-active-bg': '#c6f6d5',
                        'status-active-text': '#22543d',
                        'status-completed-bg': '#bee3f8',
                        'status-completed-text': '#2a69ac',
                        'status-paused-bg': '#fed7d7',
                        'status-paused-text': '#c53030'
                    }
                }
            }
        }
    </script>
    <style>
        .card {
            @apply bg-white rounded-lg border border-border-divider shadow-sm;
        }
        .btn-primary {
            @apply bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center;
        }
        .btn-secondary {
            @apply bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md transition-colors duration-200;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 text-center">
            <!-- 404 Icon -->
            <div class="mx-auto">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            
            <!-- 404 Content -->
            <div>
                <h1 class="text-6xl font-bold text-gray-900">404</h1>
                <h2 class="mt-2 text-2xl font-semibold text-primary-text">Page not found</h2>
                <p class="mt-2 text-gray-600">Sorry, we couldn't find the page you're looking for.</p>
            </div>
            
            <!-- Navigation Options -->
            <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="/dashboard" class="btn-primary w-full sm:w-auto">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Go to Dashboard
                </a>
                <button onclick="history.back()" class="btn-secondary w-full sm:w-auto">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Go Back
                </button>
            </div>
            
            <!-- Helpful Links -->
            <div class="pt-8">
                <p class="text-sm text-gray-500 mb-4">Or try one of these popular sections:</p>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <a href="/projects" class="text-blue-600 hover:text-blue-700 flex items-center justify-center py-2 px-3 border border-border-divider rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
                        </svg>
                        Projects
                    </a>
                    <a href="/clients" class="text-blue-600 hover:text-blue-700 flex items-center justify-center py-2 px-3 border border-border-divider rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Clients
                    </a>
                    <a href="/tickets" class="text-blue-600 hover:text-blue-700 flex items-center justify-center py-2 px-3 border border-border-divider rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 11-4 0V9a2 2 0 11-4 0V5a2 2 0 00-2-2H5z"></path>
                        </svg>
                        Tickets
                    </a>
                    <a href="/agencies" class="text-blue-600 hover:text-blue-700 flex items-center justify-center py-2 px-3 border border-border-divider rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a1 1 0 011-1h4a1 1 0 011 1v12m-6 0h6"></path>
                        </svg>
                        Agencies
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>