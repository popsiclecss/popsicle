<?php
  jRequire("ConnectionInterface.php");
  class MysqliAdapter implements ConnectionAdapterInterface {
      public $connection;
      public function __construct( $_srv, $_db, $_usr, $_pass ) {
        try {
          $this->connection = new mysqli( $_srv, $_usr, $_pass, $_db );
        } catch( Exception $e ) {
          throw new JException($e->getMessage());
        }
      }
      public function query( $_query ) {
        $this->stdQuery($_query);
        return true;
      }
      public function queryInsert( $_query ) {
        $this->stdQuery($_query);
        return $this->connection->insert_id;
      }
      public function queryFetch( $_query ) {
        $result = $this->stdQuery($_query);
        $rows = [];
        while($row = $result->fetch_assoc())
          $rows[] = $row;
        return $rows;
      }
      public function queryArray( $_query ) {
        $result = $this->stdQuery($_query);
        $rows = [];
        while($row = $result->fetch_array())
          $rows[] = $row;
        return $rows;
      }
      protected function stdQuery( $_query ) {
        $database = $this->connection;
        $result = $database->query($_query);
        if(!$result)
          throw new JException(json_encode([
            "query" => $_query,
            "error" => $database->error
          ]));
        return $result;
      }
  }
?>
