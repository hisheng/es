<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/5/10
 * Time: 15:15
 */
namespace App\Es;

class UserEs extends IndexEs
{
    protected $index = 'test';
    protected $type = 'users';
}