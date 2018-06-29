<?php
  function subFolder( $_dir = "./" ) {
    $temp = fetchInSubFolder($_dir, function() {
      return true;
    });
    return $temp;
  }
  function subFolderFile( $_dir = "./" ) {
    $temp = fetchInSubFolder($_dir, function( $_file ) {
      return !is_dir($_file);
    });
    return $temp;
  }
  function subFolderDir( $_dir = "./" ) {
    $temp = fetchInSubFolder($_dir, function( $_file ) {
      return !is_file($_file);
    });
    return $temp;
  }
  function fetchInSubFolder( $_dir = "./", $_function) {
    $temp = [];
    if (is_dir($_dir)) {
        if ($dirOpened = opendir($_dir)) {
            while (($file = readdir($dirOpened)) !== false)
                if( ($file !='.')&&($file !='..') )
                  if($_function($file))
                    array_push($temp,$file);
            closedir($dirOpened);
        }
    }
    return $temp;
  }
  function requireSubfolder( $_dir = "./" ) {
    $temp = subFolderFile($_dir);
    foreach ($temp as $i)
      jRequire($_dir."/".$i);
  }
  function require_js( $_dir = "./" ) {
    $tempArray = [];
    $temp = subFolderFile($_dir);
    foreach ($temp as $i)
      array_push($tempArray, $_dir."/".$i);
    return $tempArray;
  }
?>
