<?php
  function utf8ize($_array) {
    return travelStringArray($_array,"utf8_encode");
  }
  function unutf8ize($_array) {
    return travelStringArray($_array,"utf8_decode");
  }
  function arraySlash($_array) {
    return travelStringArray($_array,"addslashes");
  }
  function arrayHtmlParser($_array) {
    return travelStringArray($_array,"htmlParser");
  }
  function travelStringArray ( $_array, $_function ) {
    if (is_array($_array)) {
      foreach ($_array as $k => $v) {
        $_array[$k] = travelStringArray($v, $_function);
      }
    } else if (is_string ($_array)) {
      return call_user_func($_function,$_array);
    }
    return $_array;
  }
  function arrayDepth( $_array ) {
    $maxDepth = 1;
    foreach ($_array as $value) {
      if (is_array($value)) {
        $depth = arrayDepth($value) + 1;
        if ($depth > $maxDepth) {
          $maxDepth = $depth;
        }
      }
    }
    return $maxDepth;
  }
  function arrayDump( $_array, $_name = "Array", $_tab = "&nbsp;&nbsp;" ) {
    $position = preg_replace('/&nbsp;&nbsp;/', '', $_tab, 1);
    echo "$position<span style=\"color:rgb(230,0,0)\">$_name:</span><br>";
    foreach ($_array as $k => $i)
      if(is_array($i))
        arrayDump( $i, $k, "&nbsp;&nbsp;$_tab" );
      else if(is_object($i))
        echo "$_tab<b>object:</b> [Object]<br>";
      else
        echo "$_tab<b>$k:</b> $i<br>";
  }

  function htmlParser( $_str) {
    return htmlentities($_str, ENT_QUOTES | ENT_IGNORE, "UTF-8");
  }
?>
