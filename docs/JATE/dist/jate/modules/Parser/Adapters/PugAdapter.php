<?php
  use Pug as Pug;
  jRequire("ParserAbstract.php");
  class PugAdapter extends ParserAbstract {
    public function draw( $_text, $_parameters = [] ) {
      $pug = new Pug\Pug();
      $page = $pug->render($_text, $_parameters);
      return $page;
    }
  }
?>
