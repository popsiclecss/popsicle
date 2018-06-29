<?php
  session_start();
  $DEBUG = false;

  //JATE SUFF
  require_once     (end($GLOBALS["JATEPath"])."jate/functions/requirer.php");
  requireComponent ("modules/JException/JException.php");
  requireComponent ("functions/folder.php");
  requireComponent ("modules/JConfig/JConfig.php");
  requireComponents("functions");
  requireModules   ("modules");

  //USER STUFF
  requireModulesList("config/loader.json");
?>
