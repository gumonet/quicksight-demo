
<?php 
require 'vendor/autoload.php';

$array = ['key'    => getenv("AWS_KEY"),
    'secret' => getenv("AWS_SECRET")];

var_dump($array);