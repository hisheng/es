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
    public $parms = [];
    
    public function __construct()
    {
        $this->setConfig();
        //$this->client = ClientBuilder::create()->build();
        $this->client = ClientBuilder::create()->setHosts(['121.196.237.158'])->build();
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
        $this->parms['body']['ids'] = $ids;
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
    
    public function save(){
        $response = $this->client->index($this->parms);
        return $response;
    }
    
    public function add($id,$body){
        if($id){
            $this->parms['id'] = $id;
        }
        if($body){
            $this->parms['body'] = $body;
        }
        
        return $this;
    }
    
    public function insert($id,$body){
        $this->add($id,$body);
        return $this->save();
    }
    
    //删除某一个 id ;
    public function delete($id){
        $this->parms['id'] = $id;
        try {
            $rs = $this->client->delete($this->parms);
        } catch (\Exception $exception) {
            return 0;
        }
        return $rs;
    }
    //search dsl
    public function search($dsl)
    {
        $this->parms['body'] = $dsl;
        return $this->gets();
    }
    
    //增加 map映射  在索引中创建mapping，就好像在mysql中创建了一个表一样
    public function mapping($properties = [])
    {
        $this->parms['body']['settings'] = [
            'number_of_shards' => 3,
            'number_of_replicas' => 1
        ];
    
        $this->parms['body']['mappings']['_default_'] = [    //默认配置
                '_source' => [
                    'enabled' => true
                ],
                'properties'=>[
                    'id' => [
                        'type' => 'integer'
                    ],
                    'disabled' => [
                        'type' => 'integer',
                        'index' => 'not_analyzed'
                    ],
                    'status' => [
                        'type' => 'integer',
                        'index' => 'not_analyzed'
                    ],
                    'date' => [
                        'type' => 'date',
                        'format' => 'yyyy-MM-dd'
                    ],
                    'created_at' => [
                        'type' => 'date',
                        'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd'
                    ],
                    'updated_at' => [
                        'type' => 'date',
                        'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd'
                    ],
                ]
        ];
        $this->parms['body']['mappings'][$this->type] = [
                '_source' => [
                    'enabled' => true
                ],
                'properties'=>$properties
        ];
        return $this;
    }
    
    public function putMapping($properties)
    {
        $this->parms['body']['mappings'][$this->type] = [
            '_source' => [
                'enabled' => true
            ],
            'properties'=>$properties
        ];
        var_dump( $this->parms);
        return $this->client->indices()->putMapping($this->parms);
    }
    
    public function createIndex($properties = [])
    {
        //$this->mapping($properties);
        //var_dump($this->parms);exit;
        var_dump($this->client->indices()->exists(['index'=>$this->index]));
        
        $this->parms['body']['settings'] = [
            'number_of_shards' => 3,
            'number_of_replicas' => 1
        ];
    
        $this->parms['body']['mappings']['_default_'] = [    //默认配置
            '_source' => [
                'enabled' => true
            ],
            'properties'=>[
                'id' => [
                    'type' => 'integer'
                ],
                'disabled' => [
                    'type' => 'integer',
                    'index' => 'not_analyzed'
                ],
                'status' => [
                    'type' => 'integer',
                    'index' => 'not_analyzed'
                ],
                'date' => [
                    'type' => 'date',
                    'format' => 'yyyy-MM-dd'
                ],
                'created_at' => [
                    'type' => 'date',
                    'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd'
                ],
                'updated_at' => [
                    'type' => 'date',
                    'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd'
                ],
            ]
        ];
        $this->parms['body']['mappings'][$this->type] = [
            '_source' => [
                'enabled' => true
            ],
            'properties'=>$properties
        ];
        //$this->parms['body']['type'] =$this->type;
//        var_dump($this->parms);//exit;
//        var_dump($this->client->indices()->existsType([
//            'index'=>$this->index,
//            'type'=>$this->type
//        ]));
    
        //var_dump($this->client->indices()->create($this->parms));
        
//        var_dump($this->putMapping([
//            'z_date'=>[
//                'type'=>'string'
//            ]
//        ]));
    
        $this->parms['body']['mappings'][$this->type] = [
            '_source' => [
                'enabled' => true
            ],
            'properties'=>[
                'z_date'=>[
                    'type'=>'string'
                ]
            ]
        ];
        
        var_dump($this->reindex());
        exit;
        return $this->client->indices()->create($this->parms);
    }
    
    public function reindex()
    {
        var_dump($this->parms);
        return $this->client->reindex($this->parms);
    }
    
    
}