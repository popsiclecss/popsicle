<?php
  trait File {
    private $files;
    public function __construct() {
      $this->files = [
        "required" => [],
        "attached" => []
      ];
    }
    public function addFile( $_file ) {
      try {
      $this->isCorrectPath($_file);
      } catch( Exception $e) {
        throw new JException($e->getMessage());
      }
      $this->files["attached"][] = $_file;
    }
    public function addFileRequired( $_file ) {
      try {
        $this->isCorrectPath($_file);
      } catch( Exception $e) {
        throw new JException($e->getMessage());
      }
      $this->files["required"][] = $_file;
    }
    public function addFiles( $_files ) {
      if(!is_array($_files))
        throw new JException("Parameter must be an array.");
      foreach ($_files as $value)
        $this->addFile($value);
    }
    public function addFilesRequired( $_files ) {
      if(!is_array($_files))
        throw new JException("Parameter must be an array.");
      foreach ($_files as $value)
        $this->addFileRequired($value);
    }
    public function getFiles() {
      return $this->files["attached"];
    }
    public function getFilesRequired() {
      return $this->files["required"];
    }
    protected function isCorrectPath( $_file ) {
      if(!is_string($_file))
        throw new JException("Path must be a string.");
      if(!(file_exists($_file) || $this->isCorrectUrl($_file)))
        throw new JException("File [$_file] not found.");
    }
    protected function isCorrectUrl( $_url ) {
      return strpos(@get_headers($_url)[0],'200') === false ? false : true;
    }
  }
?>
