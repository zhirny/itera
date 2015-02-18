<?php
class Shape {
  //входные данные
  private $text;
  private $align;
  private $valign;
  private $color;
  private $bgcolor;
  private $cells = array();
  //вычислаемые на основе данных в $cells
  private $startCoordinateX;
  private $startCoordinateY;
  private $finishCoordinateX;
  private $finishCoordinateY;
  public static $fillingFlags = array(0,0,0,0,0,0,0,0,0);
  public static $numberOfCurrentShape = 0;
  const DIM=3;

  public function __construct($inputArray) {
    foreach ($inputArray as $k=>$v) {
      if ($k != 'cells') {
        $this->$k = $v;
      }
      else {
        $this->cells = explode(',', $v);
        $this->calculateCellsCoordinates();
      }
      self::$numberOfCurrentShape++;
    }
  }

  public function getDiv() {
    $div = '<div 
      class = "
        left-'.$this->startCoordinateX.' 
        top-'.$this->startCoordinateY.' 
        width-'.$this->finishCoordinateX.' 
        height-'.$this->finishCoordinateY.' 
        align-'.$this->align.'" 
      style = "
        color: #'.$this->color.'; 
        background-color: #'.$this->bgcolor.';">
          <span class = "valign-'.$this->valign.'-'.$this->finishCoordinateY.'" >'.$this->text.'</span>
    </div>';
		return $div;
	}

  static public function checkFillingErrors() {
    $error = false;
    for ($i=0; $i<9;$i++) {
      if (Shape::$fillingFlags[$i]>1) {
        $error = true;
      }
    }
    return $error;
  }

  public function checkSquareness() {
    $cells = $this->cells;
    $square = count($cells);
    $squareness = false;
    switch ($square) {
      case 1:
        $squareness = true;
        break;
      case 2: 
        if ($cells[1] - $cells[0] == 1 & !($cells[0]%Shape::DIM ==0)) 
          $squareness = true;
        elseif ($cells[1] - $cells[0] == Shape::DIM)
          $squareness = true;
        break;
      case 3:
        if ($cells[2] - $cells[0] == 2 & !($cells[0]%Shape::DIM == 0) & !($cells[1]%Shape::DIM == 0)) 
          $squareness = true;
        elseif ($cells[2] - $cells[1] == Shape::DIM & $cells[1] - $cells[0] == Shape::DIM) 
          $squareness = true;
        break;
      case 4: 
        if ($cells[3] - $cells[2] == 1 & $cells[1] - $cells[0] == 1 & $cells[3] - $cells[1] == Shape::DIM & $cells[2] - $cells[0] == Shape::DIM) 
          $squareness = true;
        break;
      case 6: 
        if ($cells[5] - $cells[0] == 5) $squareness = true;
        elseif($cells[5] - $cells[0] == 7) $squareness = true;
        break;
      case 9: 
        $squareness = true;
        break;
		}
    
    if (!$squareness) return '<p>Ошибка: фигура, заданная массивом '
    .Shape::$numberOfCurrentShape.' не прямоугольной формы</p>'."\n";
  }
	
  public function calculateCellsCoordinates() {
    $min = $this->cells[0]; $max = $this->cells[0];
    foreach($this->cells as $key=>$value) {
      if ($min > $value) {
        $min = $value;
      }
      if ($max < $value) {
        $max = $value;
      }
      self::$fillingFlags[$value-1]++;
    }

    include 'cells3.php';
    
    foreach ($cellsCoordinates as $key => $cell) {
      if ($min-1 == $key) {
        $this->startCoordinateX = $cell['startCoordinateX'] + 1;
        $this->startCoordinateY = $cell['startCoordinateY'] + 1;
      }
      if ($max-1 == $key) {
        $this->finishCoordinateX = $cell['finishCoordinateX'] + 1 - $this->startCoordinateX;
        $this->finishCoordinateY = $cell['finishCoordinateY'] + 1 - $this->startCoordinateY;
      }
    }
  }
}
?>