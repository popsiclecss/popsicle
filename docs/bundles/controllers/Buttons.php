<?php
  class Buttons extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Buttons";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      return jBlockFile("bundles/views/buttons.twig");
    }
  }
?>
