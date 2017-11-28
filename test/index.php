<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/5/31
 * Time: 20:23
 */
require '../vendor/autoload.php';

$subhdEs = new \Test\SubhdEs();
//$s = $subhdEs->find(335407);
//var_dump($s);

$re = $subhdEs->delete(113);
var_dump($re);
$result = $subhdEs->insert('113',[
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

//$ss = $subhdEs->find(112);
//var_dump($ss);

var_dump($result);exit;

$subhdEs2 = new \Test\SubhdEs();
$sss = $subhdEs2->find(112);
var_dump($sss);