<?php
  class ServerVars {
    public $server;
    public function __construct() {
      $this->server = [];
      $this->server["HTTP_HOST"]   = $_SERVER["HTTP_HOST"];
      $this->server["REQUEST_URI"] = $_SERVER["REQUEST_URI"];
      $this->server["PHP_SELF"]    = $_SERVER["PHP_SELF"];
      $this->server["RELATIVE"]    = str_replace("/index.php", "", $_SERVER["PHP_SELF"]);
    }
  }
?>
