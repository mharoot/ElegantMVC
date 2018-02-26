<?php
declare(strict_types=1);
$mvc_name_u = $argv[1];
$mvc_name_l = strtolower($argv[1]);
$win = false;
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $win = true;
} else {
    
}
$myfile = NULL;
$nl = "\n";
$tab = "    ";

if($win){
	$myfile = fopen("Models\\". $mvc_name_l. "_model.php", "w") or die("Unable to open file!");
}else{
	$myfile = fopen("Models/". $mvc_name_l. "_model.php", "w") or die("Unable to open file!");
}

$txt = '<?php '.$nl.'declare(strict_types=1);'.$nl.$nl.$tab.'class '.$mvc_name_u.'Model extends Model'.$nl.$tab.'{'.$nl.$nl.$tab.$tab.'public function __construct()'.$nl.$tab.$tab.'{'.$nl.$tab.$tab.$tab.'$this->table_name = "'.$mvc_name_l.'s";'.$nl.$tab.$tab.$tab.'parent::__construct($this);'.$nl.$tab.$tab.'}'.$nl.$nl.$tab.'}';




fwrite($myfile, $txt);
fclose($myfile);

if($win){
	$myfile = fopen("Views\\". $mvc_name_l. "_view.php", "w") or die("Unable to open file!");
}else{
	$myfile = fopen("Views/". $mvc_name_l. "_view.php", "w") or die("Unable to open file!");
}

$txt = '<?php '.$nl.'declare(strict_types=1);'.$nl.$nl.$tab.'class '.$mvc_name_u.'View'.$nl.$tab.'{'.$nl.$nl.$tab.$tab.'private $controller;'.$nl.$tab.$tab.'private $model;'.$nl.$nl.$tab.$tab.'public function __construct($controller, $model)'.$nl.$tab.$tab.'{'.$nl.$tab.$tab.$tab;
$txt .= '$this->controller = $controller;'.$nl.$tab.$tab.$tab.'$this->model = $model;'.$nl.$tab.$tab.'}'.$nl.$nl.$tab.'}';




fwrite($myfile, $txt);
fclose($myfile);


if($win){
	$myfile = fopen("Controllers\\". $mvc_name_l. "_controller.php", "w") or die("Unable to open file!");
}else{
	$myfile = fopen("Controllers/". $mvc_name_l. "_controller.php", "w") or die("Unable to open file!");
}

$txt = '<?php '.$nl.'declare(strict_types=1);'.$nl.$nl.$tab.'class '.$mvc_name_u.'Controller'.$nl.$tab.'{'.$nl.$nl.$tab.$tab.'private $model;'.$nl.$nl.$tab.$tab.'public function __construct($model)'.$nl.$tab.$tab.'{'.$nl.$tab.$tab.$tab.'$this->model = $model;'.$nl.$tab.$tab.'}'.$nl.$nl.$tab.'}';




fwrite($myfile, $txt);
fclose($myfile);




?>