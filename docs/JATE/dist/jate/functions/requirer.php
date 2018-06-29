<?php
  function requireComponent( $_path, $_local = true ) {
    $path = getJFolder($_path, $_local, debug_backtrace());
    if(file_exists($path) && isPhp($path))
      jRequire($path, false, 0);
    else
      requireError($_path);
  }
  function requireComponents( $_path, $_local = true ) {
    $path = getJFolder($_path, $_local, debug_backtrace());
    if(file_exists($path)) {
      $files = subFolderFile($path);
      foreach ($files as $i)
        if(isPhp("$path/$i"))
          requireComponent($path."/".$i, false);
    } else
      requireError($_path);
  }
  function requireError( $_path ) {
    global $DEBUG;
    if( $DEBUG == 1 )
      echo "Error load ($_path)<br>";
  }
  function isPhp ( $_file ) {
    if(!is_file($_file)) return false;
    $info = pathinfo($_file);
    return ($info["extension"] == "php") || ($info["extension"] == "PHP");
  }
  function requireModules( $_path, $_local = true ) {
    $path = getJFolder($_path, $_local, debug_backtrace());
    $subFolders = subFolderDir($path);
    foreach ($subFolders as $i)
      requireComponents("$path/$i", false);
  }
  function jRequire( $_path, $_local = true ) {
    $path = getJFolder($_path, $_local, debug_backtrace());
    require_once( $path );
  }
  function getJFolder( $_path, $_local, $_stack ) {
    if($_local) {
      $stackInfo = $_stack;
      $folder = dirname($stackInfo[0]["file"]);
      $file = "$folder/$_path";
    } else
      $file = $_path;
    return $file;
  }
  function requireModulesList( $_path ) {
    if(!file_exists($_path))
      return;
    $data = file_get_contents($_path);
    $data = json_decode($data);
    if($data === NULL)
      throw new Exception("Error in the file format [$_path]", 1);
    foreach ($data as $item) {
      if(substr($item, -1) == "*")
        requireModules(substr($item, 0, -2), false);
      else {
        $path = getJFolder($item, false, debug_backtrace());
        requireComponents("$path", false);
      }
    }
  }
?>
