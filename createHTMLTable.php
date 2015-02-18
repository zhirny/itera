<?php
include 'shape.php';

function createHTMLTable($inputArray) {
  $wholeHTML = '<div class = "wraper"></div>';
  $error = '';
  foreach ($inputArray as $params) {
    $obj = new Shape($params);
    $div = $obj->getDiv();
    $wholeHTML .= $div;
    $error .= $obj->checkSquareness();
  }
  if (Shape::checkFillingErrors()) {
    $error .= "Ошибка: пересечение фигур, построенных по данным входных массивов<br />";
  }

  if ($error) { 
    echo "\n".'<div class="error">'.$error.'</div>';
  } 
  else {
    echo $wholeHTML;
  }
}
?>