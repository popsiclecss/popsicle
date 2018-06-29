<?php
  jRequire("ParserAbstract.php");
  jRequire("../../ExternalModules/Parsedown/Parsedown.php");
  use Parsedown as Parsedown;
  class ParsedownAdapter extends ParserAbstract {
    public function draw( $_text, $_parameters = [] ) {
      $Parsedown = new Parsedown\Parsedown();
      $page = $Parsedown->text($_text);
      $page = preg_replace('/[ ](?=[^>]*(?:<|$))/', "&nbsp", $page);
      return $page;
    }
  }
?>
