<?php
// public/index.php
// declare(strict_types=1);

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';
require_once __DIR__ . '/../app/controllers/TicketController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$route = isset($_GET['route']) ? $_GET['route'] : '';
Router::dispatch($route);

