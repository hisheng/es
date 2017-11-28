<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2017/7/13
 * Time: 14:28
 */

require '../vendor/autoload.php';

$productEs = new \Test\ProductEs();

$dsl = [
    'query'=>[
        'filtered'=>[
            'query'=> [
                'match'=>[
                    'name'=>'尚美'
                ]
            ],
            'filter'=>[
                'term'=>[
                    'city'=>'无锡'
                ]
            ]
        ]
    
    ]
];

$res = $productEs->search($dsl);

print_r($res['hits']);