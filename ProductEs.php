<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/5/10
 * Time: 14:01
 */
namespace App\Es;
class ProductEs extends IndexEs
{
    protected $index = 'mall';
    protected $type = 'products';
}