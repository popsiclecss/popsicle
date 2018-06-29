<?php
  class JException extends Exception {
    static protected $escapeString = "|jate|";
    public function __construct($_message, $_level = 2, $_code = 0, Exception $_previous = null) {
      parent::__construct($_message, $_code, $_previous);
      if(isset(debug_backtrace()[$_level]) && isset(debug_backtrace()[$_level]["file"]))
        $this->file  = debug_backtrace()[$_level]["file"];
      if(isset(debug_backtrace()[$_level]) && isset(debug_backtrace()[$_level]["line"]))
        $this->line  = debug_backtrace()[$_level]["line"];
      if(isset(debug_backtrace()[$_level]) && isset(debug_backtrace()[$_level]["function"]))
        $this->function = debug_backtrace()[$_level]["function"];
      if(isset(debug_backtrace()[$_level]) && isset(debug_backtrace()[$_level]["class"]))
        $this->class = debug_backtrace()[$_level]["class"];
    }
    public function __toString() {
      return JException::encode(JException::decode($this->message));
    }
    static public function decode( $_message ) {
      $messageSplitted = explode(JException::$escapeString, $_message);
      if(count($messageSplitted) == 3)
        return $messageSplitted[1];
      else
        return $_message;
    }
    static public function encode( $_message ) {
      $escape = JException::$escapeString;
      return "$escape$_message$escape";

    }
  }
?>
