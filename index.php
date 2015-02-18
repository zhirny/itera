<?php 
include 'createHTMLTable.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title></title>
    <link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<?php 
echo '<div class="text"><h1>Выборите условия</h1>
<h2>Корректные условия</h2>
<ol>
<li><a href="'.$_SERVER['PHP_SELF'].'">пример из ТЗ: квадрат 2х2 и прямоугольник 1х2</a></li>
<li><a href="'.$_SERVER['PHP_SELF'].'?n=1">4 прямоугольника 1х2 или 2х1 и квадрат 1х1 в 5 ячейке</a></li>
<li><a href="'.$_SERVER['PHP_SELF'].'?n=2">два прямоугольника 1х3</a></li>
<li><a href="'.$_SERVER['PHP_SELF'].'?n=3">прямоугольник 2х3 и квадрат 1х1 в 8 ячейке</a></li>
<li><a href="'.$_SERVER['PHP_SELF'].'?n=4">один большой квадрат 3х3</a></li></ol>
<h2>Ошибочные условия</h2>
<ol><li><a href="'.$_SERVER['PHP_SELF'].'?n=5">пересекающиеся фигуры</a></li>
<li><a href="'.$_SERVER['PHP_SELF'].'?n=6">одна или несколько фигур не прямоугольной формы</a></li>
<li><a href="'.$_SERVER['PHP_SELF'].'?n=7">одна или несколько фигур не прямоугольной формы и пересекающиеся фигуры</a></li></ol></div>';

if(isset($_GET['n'])) {
	$n = $_GET['n'];
	$example = 'example/example'.$n.'.php';
	include ($example);
} else include 'example/example0.php';

createHTMLTable($inputArray);

?>

</body>
</html>