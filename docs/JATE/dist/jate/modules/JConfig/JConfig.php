<?php
  class JConfig {
    public function __construct( $_path ) {
      if(!is_string($_path))
        throw new JException("Path must be a string.");
      if(!file_exists($_path))
        throw new JException("File [$_path] not found.");
      $data = file_get_contents($_path);
      $data = json_decode($data);
      if($data === NULL)
        throw new JException("Invalid file data. [$_path]");
      if(is_object($data))
        foreach (get_object_vars($data) as $key => $value)
          $this->$key = $value;
      if(is_array($data))
        $this->data = $data;
    }
  }
?>
