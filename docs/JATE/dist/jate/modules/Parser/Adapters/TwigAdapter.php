<?php
  // use Twig as Twig;
  jRequire("ParserAbstract.php");
  class TwigAdapter extends ParserAbstract {
    public function draw( $_text, $_parameters = [] ) {
      $loader = new Twig_Loader_Array([
        'index' => $_text
      ]);
      $twig = new Twig_Environment($loader);
      $page = $twig->render('index', $_parameters);
      return $page;
    }
  }
?>
