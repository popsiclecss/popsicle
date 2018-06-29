<?php
  requireComponents("Adapters");
  jRequire("../JException/JException.php");
  class Parser {
    private static function setParser ( $_type ) {
      $parser = null;
      $_type = strtolower($_type);
      switch ($_type) {
        case "twig":
          $parser = new TwigAdapter();
        break;
        case "jate":
          $parser = new JTagAdapter();
        break;
        case 'jade':
        case "pug":
          $parser = new PugAdapter();
        break;
        case "md":
        case "markdown":
        case "parsedown":
          $parser = new ParsedownAdapter();
        break;
        default:
          $parser = -1;
        break;
      }
      return $parser;
    }
    public static function parseText( $_text, $_parameters = [], $_type = "html" ) {
      if(!is_string($_text) || !is_string($_type))
        throw new JException("Parameter must be a string.");
      if(!is_array($_parameters))
        throw new JException("Parameter must be an array.");
      $parser = self::setParser($_type);
      if($parser === -1)
        return $_text;
      return $parser->drawText($_text, $_parameters);
    }
    public static function parseFileMan( $_path, $_parameters = [], $_type = "html"  ) {
      if(!is_string($_path))
        throw new JException("Parameter must be a string.");
      if(!file_exists($_path))
        throw new JException("File [$_path] not found.");
      $string = file_get_contents($_path);
      try {
        $text = self::parseText($string, $_parameters, $_type);
      } catch (Exception $e) {
        throw new JException($e->getMessage());
      }
      return $text;
    }
    public static function parseFile( $_path, $_parameters = [] ) {
      if(!is_string($_path))
        throw new JException("Parameter must be a string.");
      $extension = explode(".", $_path);
      $extension = $extension[count($extension)-1];
      $extension = strtolower($extension);
      try {
        $text = self::parseFileMan($_path, $_parameters, $extension);
      } catch (Exception $e) {
        throw new JException($e->getMessage());
      }
      return $text;
    }
  }
?>
