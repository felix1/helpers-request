<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use cse\helpers\Request;

// Example: post
// ["example" => 12345] => 12345
$_POST['example'] = 12345;
var_dump(Request::post('example'));
echo PHP_EOL;
// set default value: 12345
Request::post('example_2', 12345);

// Example: get
// ["example" => 12345] => 12345
$_GET['example'] = 12345;
var_dump(Request::get('example'));
// set default value: 12345
Request::get('example_2', 12345);
echo PHP_EOL;