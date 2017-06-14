<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/6/14
 * Time: 11:22
 */
require '../vendor/autoload.php';
use Es\IndexEs;

class ProductEs extends IndexEs
{
    protected $index = 'mall';
    protected $type = 'products';
}
$product = new ProductEs();
$a =$product->findIn([12,99]);
var_dump($a);