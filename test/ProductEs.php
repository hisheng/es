<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/7/13
 * Time: 14:29
 */
namespace Test;
use Es\IndexEs;

class ProductEs extends IndexEs
{
    protected $index = 'user';
    protected $type = 'hospitals';
}