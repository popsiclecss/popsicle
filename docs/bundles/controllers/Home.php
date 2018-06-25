<?php
  class Home extends Template {
    public function init() {
      parent::init();

      $this->tags["title"]  .= "Home";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      return jBlockFile("bundles/views/home.twig");
    }
  }
?>
