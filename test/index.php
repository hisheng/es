<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/5/31
 * Time: 20:23
 */
require '../vendor/autoload.php';

$subhdEs = new \Test\SubhdEs();
$s = $subhdEs->find(335407);
var_dump($s);