<?php

require_once 'Sort.php';

$sorter = new Sort();
$sorter->sorting($argv[1] ?? "");
