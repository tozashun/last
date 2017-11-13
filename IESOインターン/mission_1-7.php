<? php
$file = dirname(__FILE__) . 'http://co-724.it.99sv-coco.com/kadai6.txt';
$array = @file($file, FILE_IGNORE_NEW_LINES);
print_r($array);
?>

