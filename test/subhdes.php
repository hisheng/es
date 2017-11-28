<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/11/28
 * Time: 11:48
 */
require '../vendor/autoload.php';
use EsModel\SubhdEs;

//改变 subhd 的 z_date 字段为 date类型
$es = new SubhdEs();
$es->createIndex([
    'z_date'=>[
        'type'=>"date",
        "format"=>"Y:m:d H:i:s",
    ]
]);
