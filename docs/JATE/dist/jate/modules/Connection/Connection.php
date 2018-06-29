<?php
  requireComponents("Adapters");
  class Connection {
    public $database;
    public $info;
    public function __construct( $_object ) {
      if(!is_object($_object))
        throw new InvalidArgumentException("Parameter must be an object.");
      $this->setConnection(
        $_object->server,
        $_object->database,
        $_object->user,
        $_object->password,
        $this->getConnectionType($_object->engine)
      );
    }
    protected function setConnection ( $_srv, $_db, $_usr, $_pass, $_type ) {
      switch ($_type) {
        case "mysqli":
          $this->database = new MysqliAdapter($_srv, $_db, $_usr, $_pass);
        break;
        case "postgresql":
          $this->database = new PostgresqlAdapter($_srv, $_db, $_usr, $_pass);
        break;
        case "memory":
          $this->database = new PdoMemoryAdapter($_srv, $_db, $_usr, $_pass);
        break;
        case "pdo":
        default:
          $this->database = new PdoAdapter($_srv, $_db, $_usr, $_pass);
        break;
      }
      $this->info = [
        "srv"  => $_srv,
        "db"   => $_db,
        "usr"  => $_usr,
        "pass" => $_pass,
        "type" => $_type
      ];
    }
    protected function getConnectionType( $_type ) {
      $array = (array)$_type;
      foreach ($array as $key => $value)
        if($value)
          return $key;
      return "pdo";
    }
  }
?>
