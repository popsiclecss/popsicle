<?php
  abstract class ParserAbstract {
    public function drawText( $_text, $_parameters = [] ) {
      return $this->draw(trim($_text), $_parameters);
    }
    abstract public function draw( $_text, $_parameters = [] );
  }
?>
