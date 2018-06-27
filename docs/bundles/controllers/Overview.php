<?php
  class Overview extends Template {
    public function init() {
      parent::init();

      $this->addFiles([
        "css/colors.min.css"
      ]);

      $this->template = "bundles/views/documentation-template.twig";
      $this->tags["title"]  .= "Overview";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      return jBlockFile("bundles/views/overview.twig");
    }
  }
?>
