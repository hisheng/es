<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/7/13
 * Time: 14:29
 */

require '../vendor/autoload.php';
use EsModel\ProductEs;

//改变 subhd 的 z_date 字段为 date类型
$es = new ProductEs();
var_dump($es->parms);
$es->createIndex([
    'z_date'=>[
        "type"=>"date",
      "format"=>"yyyy-MM-dd HH:mm:ss||yyyy-MM-dd"
    ]
]);

$result = $es->insert('113',[
    'z_id' => 'subhd_113',
    'name'=>'求婚大作战',
    'role'=>'山下智久,长泽雅美,藤木直人,荣仓奈奈,平冈佑太,滨田岳,松重丰',
    'category' =>'剧情,爱情,奇幻 ',
    'title'=>'[ドラマ][プロポーズ大作戦 第01話]「甲子園行けたら結婚できる！？」',
    'srts'=>[
        [
            't'=>'00:00:03,937 --> 00:00:11,444',
            'words'=>'说出你的愿望吧'
        ],
        [
            't'=>'00:00:03,937 --> 00:00:11,444',
            'words'=>"努力试着去改变过去
                                那个懦弱的自己"
        ]
    ],
    'z_date' => '2017-10-27 11:32:50',
]);
var_dump($result);