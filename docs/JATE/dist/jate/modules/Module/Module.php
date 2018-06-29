<?php
  jRequire("../Query/Query.php");
  jRequire("../File/File.php");
  class Module {
    use Query {
      Query::__construct as private __queryConstruct;
    }
    use File {
      File::__construct as private __fileConstruct;
    }
    public $name;
    public $modules;
    public function __construct() {
      $this->name    = get_class($this);
      $this->modules = [];
      $this->__queryConstruct();
      $this->__fileConstruct();
    }
    public function addModules( $_modules ) {
      if(!is_array($_modules))
        throw new JException("Parameter must be an array.");
      foreach ($_modules as $value)
        $this->addModule($value);
    }
    public function addModule( $_module ) {
      if(!is_object($_module))
        throw new JException("Parameter must be a object.");
      if(! is_subclass_of ($_module, "Module"))
        throw new JException("Parameter must be a object inherited from Module object.");
      $this->modules[$_module->name] = $_module;
      if($this->currentConnection)
        $this->modules[$_module->name]->addConnectionMan($this->currentConnection);
    }
  }
?>
