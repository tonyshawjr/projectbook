<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Projectbook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-primary-text">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="text-center text-3xl font-bold text-primary-text">
                    Projectbook
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Freelance Project Management & Billing Dashboard
                </p>
            </div>
            
            <div class="card p-8">
                <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-md">
                    <p class="text-sm text-red-600"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
                </div>
                <?php unset($_SESSION['error']); endif; ?>
                
                <form class="space-y-6" action="/login" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-button text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-button text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>
                        
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Forgot your password?
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn-primary w-full">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>