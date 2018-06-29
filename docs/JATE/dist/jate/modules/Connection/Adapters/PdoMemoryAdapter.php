<?php
  jRequire("PdoAdapter.php");
  class PdoMemoryAdapter extends PdoAdapter {
      public $connection;
      public function __construct( $_srv, $_db, $_usr, $_pass ) {
        try {
          $this->connection = new PDO("sqlite::memory:");
        } catch( Exception $e ) {
          throw new JException($e->getMessage());
        }
      }
  }
?>
