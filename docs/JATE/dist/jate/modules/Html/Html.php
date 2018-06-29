<?php
  requireComponent("../ServerVars/ServerVars.php");
  requireComponent("../Module/Module.php");
  requireComponent("../JException/JException.php");
  abstract class Html extends Module {
    public $template;
    public $app;
    public $page;
    public $tags;
    public $jsVars;
    public function __construct() {
      parent::__construct();
      $this->template = "";
      $this->app      = [];
      $this->page     = [];
      $this->jsVars   = [];
      $this->tags     = [
        "css"   => [],
        "js"    => [],
        "jsVar" => [],
        "base"  => ""
      ];
    }
    public function setParameters( $_parameters = [ "app" => null, "page" => null] ) {
    $this->app  = $_parameters["app"];
    $this->page = $_parameters["page"];
    }
    abstract public function init();
    public function draw() {
      if($this->template == "")
        throw new JException("The variable \$this->template must be set in class $this->name function init().");
      $server = new ServerVars();
      $this->addDipendences();
      $this->tags["css"]  = array_unique($this->tags["css"]);
      $this->tags["js"]   = array_unique($this->tags["js"]);
      $this->tags["base"] = $server->server["RELATIVE"]."/";
      $this->stringifyDipendences();
      return jBlockFile($this->template, $this->tags);
    }
    public function getCss() {
      return $this->getRequire("getCss",".css");
    }
    public function getJs() {
      return $this->getRequire("getJs",".js");
    }
    public function getJsVars() {
      return $this->jsVars;
    }
    public function addJsVar( $_name, $_value ) {
      if(!is_string($_name))
        throw new InvalidArgumentException("Parameter name must be a string.");
      if(!is_string($_value))
        throw new InvalidArgumentException("Parameter value must be a string.");
      $this->jsVars[] = [$_name, $_value];
    }
    public function addJsVars( $_array ) {
      if(!is_array($_array))
        throw new InvalidArgumentException("Parameter must be an array.");
      foreach ($_array as $value)
        $this->addJsVar($value[0], $value[1]);
    }
    protected function stringifyDipendences() {
      $tempStr = "";
      $timeParameter = "?t=".time();
      $time = ($this->app->cache->css == true) ? "" : $timeParameter;
      foreach ($this->tags["css"] as $i)
      $tempStr .= "<link rel='stylesheet' href='$i$time'>";
      $this->tags["css"] = $tempStr;
      $tempStr = "";
      $time = ($this->app->cache->js == true) ? "" : $timeParameter;
      foreach ($this->tags["js"] as $i)
      $tempStr .= "<script src='$i$time'></script>";
      $this->tags["js"] = $tempStr;
      $tempStr = "";
      $tempStr .= "<script type='text/javascript'>";
      foreach ($this->tags["jsVar"] as $i)
      $tempStr .= " $i[0] = $i[1];\n";
      $tempStr .= "</script>";
      $this->tags["jsVar"] = $tempStr;
    }
    protected function addDipendences() {
      $this->tags["css"]   = $this->getCss();
      $this->tags["js"]    = $this->getJs();
      $this->tags["jsVar"] = $this->getJsVars();
    }
    protected function getRequire( $_function, $_extenction) {
      $temp = [];
      $filesRequired = $this->getFilesRequired();
      $files         = $this->getFiles();
      foreach ($filesRequired as $i)
        if (!is_array($i) && strpos($i, $_extenction) !== FALSE)
          $temp[] = $i;
      foreach ($this->modules as $i)
        $temp = array_merge( $temp, $i->$_function() );
      foreach ($files as $i)
        if (!is_array($i) && strpos($i, $_extenction) !== FALSE)
          $temp[] = $i;
      return $temp;
    }
  }
?>
