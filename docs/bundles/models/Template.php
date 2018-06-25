<?php
  class Template extends Html {
    public function init() {
      $this->addConnection("config/connection.json");
      $this->addFilesRequired([
        "../dist/css/boostrap-atlaskit.min.css",
        "css/style.min.css",
      ]);
      $this->template = "bundles/views/tradictional.jate";
      $this->tags = [
        "title"    => "Bootstrap Atlaskit - ",
        "brand"    => "Bootstrap Atlaskit",
        "brandImg" => "",
        "menu"     => $this->makeMenu(),
        "metaDescription" => "Beautiful description.",
        "metaKeywords"    => "JATE,PHP,JS,CSS",
        "metaAuthor"      => "XaBerr"
      ];
    }
    public function makeMenu() {
      jBlock();
      ?>
        <li class="nav-item">
          <a class="nav-link" href="Home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Page1">Page 1</a>
        </li>
      <?php
      $temp = jBlockEnd();
      return $temp;
    }
  }
?>
