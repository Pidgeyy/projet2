<?php
// app/core/View.php

class View {
  public static function render($view, $data = array()) {
    extract($data, EXTR_SKIP);
    require __DIR__ . '/../views/layouts/main.php';
  }
}
