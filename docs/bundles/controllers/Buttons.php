<?php
  class Buttons extends Template {
    public function init() {
      parent::init();
      $this->template = "bundles/views/documentation-template.twig";
      $this->tags["title"]  .= "Buttons";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      return jBlockFile("bundles/views/buttons.twig");
    }
  }
?>
