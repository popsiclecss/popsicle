<?php
  class Page404 extends Template {
    public function init() {
      parent::init();
      $this->tags["title"]  .= "Page404";
      $this->tags["content"] = $this->makePage();
    }
    public function makePage() {
      jBlock();
      ?>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            404 Page not found!
          </div>
        </div>
      </div>
      <?php
      $temp = jBlockClose();
      return $temp;
    }
  }
?>
