<?php
  if(!isset($GLOBALS["JATEPath"]))
    $GLOBALS["JATEPath"] = [];
  $commonLocations = [
      "bower_components/JATE/dist/"
    , "vendor/xaberr/jate/dist/"
    , "../../dist/"
    , "../dist/"
    , dirname(__FILE__)."/"
  ];
  $jSuccess = false;
  foreach ($commonLocations as $path)
    if(file_exists("${path}jate/coreEngine.php")) {
      array_push($GLOBALS["JATEPath"], $path);
      require_once("${path}jate/coreEngine.php");
      $jSuccess = true;
      break;
    }
  if( !$jSuccess )
    throw new Exception("JATE can't find coreEngine.php.");
?>
