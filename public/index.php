<?php
    require_once '../app/core/loader.php';

    $config = [
        'dsn' => 'mysql:host=localhost;dbname=fto_api',
        'user' => 'root',
        'pword' => 'admin123'
    ];

    /**
     * 
     * Load classes automatically
     * 
     */
    $loader = new AutoLoader([
        '../app/controllers',
        '../app/core',
        '../app/models'
    ]);
    $loader->loadClasses();
    
    /**
     * 
     * Creating The Application
     * 
     */
    $app =  new Application(dirname(__DIR__),$config);
    
    $user = Application::$app->session->getUser();
    
    /**
     * 
     * Definition of request routes
     * 
     */ 
    $app->router->get('/', [HomeController::class, 'index']);
    $app->router->get('/login', [AuthController::class, 'index']);
    $app->router->post('/login', [AuthController::class, 'login']);
    $app->router->post('/logout', [AuthController::class, 'logout']);

    if ($user->role == 'admin') {
        $app->router->get('/admin/dashboard', [AdminController::class, 'index']);
        $app->router->get('/admin/users', [AdminController::class, 'users']);
        $app->router->get('/admin/orphanages', [AdminController::class, 'orphanages']);
        $app->router->get('/admin/report', [AdminController::class, 'report']);

        $app->router->post('/admin/users', [AdminController::class, 'addUser']);
        $app->router->post('/admin/orphanages', [AdminController::class, 'addOrphanage']);
    }    
    
    if ($user->role == 'orphanage') {
        $app->router->get('/orphanage/dashboard', [OrphanageController::class, 'index']);
        $app->router->get('/orphanage/report', [OrphanageController::class, 'report']);
        $app->router->get('/orphanage/donation', [OrphanageController::class, 'donation']);
        $app->router->get('/orphanage/calendar', [OrphanageController::class, 'calendar']);
        $app->router->get('/orphanage/map', [OrphanageController::class, 'map']);
        $app->router->get('/orphanage/profile', [OrphanageController::class, 'profile']);
        $app->router->get('/orphanage/report/monthly', [OrphanageController::class, 'generateMonthly']);
        $app->router->get('/orphanage/report/annual', [OrphanageController::class, 'generateAnnual']);

        $app->router->post('/orphanage/calendar', [OrphanageController::class, 'addEvent']);
        $app->router->post('/orphanage/donation', [OrphanageController::class, 'receiveDonation']);
        $app->router->post('/orphanage/contact', [OrphanageController::class, 'addContact']);
        $app->router->post('/orphanage/profile/edit', [OrphanageController::class, 'edit']);
        $app->router->post('/orphanage/map', [OrphanageController::class, 'addLocation']);
    }

    /**
     * 
     * Run The Application
     * 
     */
    $app->run();