<?php
// app/core/Router.php
// declare(strict_types=1);

class Router {
  public static function dispatch($route) {
    switch ($route) {
      case 'login':
        (new AuthController())->login();
        return;
      case 'logout':
        (new AuthController())->logout();
        return;
      case 'dashboard':
        (new DashboardController())->dashboard();
        return;
      case 'tickets':
        (new TicketController())->index();
        return;
      case 'ticket':
        (new TicketController())->show();
        return;
      case 'ticket-create':
        (new TicketController())->create();
        return;
      case 'admin-users':
        (new AdminController())->users();
        return;
      case 'admin-user-create':
        (new AdminController())->userCreate();
        return;
      case 'admin-user-edit':
        (new AdminController())->userEdit();
        return;
      case 'admin-user-toggle':
        (new AdminController())->userToggle();
        return;
      case 'admin-categories':
        (new AdminController())->categories();
        return;
      case 'admin-category-create':
        (new AdminController())->categoryCreate();
        return;
      case 'admin-category-edit':
        (new AdminController())->categoryEdit();
        return;
      case 'admin-category-delete':
        (new AdminController())->categoryDelete();
        return;
      default:
        (new DashboardController())->home();
        return;
    }
  }
}
