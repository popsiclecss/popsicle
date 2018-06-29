<?php
  jRequire("ParserAbstract.php");
  class JTagAdapter extends ParserAbstract {
    public function draw( $_text, $_parameters = [] ) {
      foreach($_parameters as $key => $value)
        if(!is_array($value))
          $_text = str_replace("<_${key}_>", "$value", $_text);
      $_text = preg_replace('~<_[^_]+_>~', '', $_text);
      return $_text;
    }
  }
?>
