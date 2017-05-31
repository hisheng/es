<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/5/10
 * Time: 13:53
 */
namespace Es;

use Elasticsearch\ClientBuilder;

class IndexEs implements EsInterface
{
    protected $index;
    protected $type;
    protected $client;
    protected $parms = [];
    
    public function __construct()
    {
        $this->setConfig();
        $this->client = ClientBuilder::create()->build();
    }
    
    public function setConfig(){
        $this->parms['index'] = $this->index;
        $this->parms['type'] = $this->type;
    }
    
    //目前返回为数组格式
    public function find($id){
         $this->parms['id'] = $id;
         return $this->client->getSource($this->parms);
    }
    
    //有错误 多个ids [100,20 ] 类似这样
    public function findIn($ids){
        $this->parms['ids'] = $ids;
        return $this->client->mget($this->parms);
    }
    
    //获取某个索引的 列表
    public function gets(){
        return $this->client->search($this->parms);
    }
    
    //from 参数
    public function from($start){
        $this->parms['from'] = $start;
        return $this;
    }
    //size http://la.mlm.com/test/users?page=1&from=1
    public function size($perNum){
        $this->parms['size'] = $perNum;
        return $this;
    }
    
    public function fields($fields = ''){
        if($fields){
            $this->parms['fields'] = $fields;
            return $this;
        }
        
    }
    
    
}