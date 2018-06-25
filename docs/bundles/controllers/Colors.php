<?php
  class Colors extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Colors";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      return jBlockFile("bundles/views/colors.twig");
    }
  }
?>
