// app/Http/Kernel.php

protected $routeMiddleware = [
    // ...
    'role' => \App\Http\Middleware\CheckRole::class,
    'hierarchy' => \App\Http\Middleware\CheckHierarchy::class,
];
