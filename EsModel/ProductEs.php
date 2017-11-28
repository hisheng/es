<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2017/11/28
 * Time: 11:59
 */
namespace EsModel;
use Es\IndexEs;

class ProductEs extends IndexEs
{
    protected $index = 'zimu';
    protected $type = 'product';
}