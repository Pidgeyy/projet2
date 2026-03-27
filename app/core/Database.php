<?php
// app/core/Database.php
// declare(strict_types=1);

class Database {
  private static $pdo = null;

  public static function pdo() {
    if (self::$pdo === null) {
      $dsn = 'mysql:host=127.0.0.1;dbname=campus_helpdesk;charset=utf8mb4';
      self::$pdo = new PDO($dsn, 'root', 'root', array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      ));
    }
    return self::$pdo;
  }
}
