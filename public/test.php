<?php
exec("ping www.baidu.com -n 1",$output,$status);
var_dump($output);
var_dump($status);
?>