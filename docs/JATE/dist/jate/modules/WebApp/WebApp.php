<?php
  jRequire("../Router/Router.php");
  jRequire("../JConfig/JConfig.php");
  class WebApp {
    private $router;
    private $misc;
    public function __construct() {
      $configPath   = "config";
      $this->misc   = new JConfig("$configPath/app.json");
      $this->router = new Router("$configPath/router.json", $this->misc->urlCaseSensitive);
    }
    public function draw() {
      $pageSelected = $this->router->getPage();
      $currentPage = new $pageSelected[0]();
      $currentPage->setParameters(["app" => $this->misc, "page" => $pageSelected[1]]);
      $currentPage->init();
      echo minifyOutput($currentPage->draw());
    }
  }
?>
