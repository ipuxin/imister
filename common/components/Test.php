<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/4
 * Time: 22:31
 */
namespace common\components;

use yii\base\Component;

/**
 * Class Test
 * @package common\components
 * 继承了组件,
 * 这里的方法是可以直接调用的
 */
class Test extends Component
{
    public $name;
    public $favor;
    private $test;

    public function test()
    {
        echo 'test';
    }

    public function print_r()
    {
        echo $this->name , '--' , $this->favor;
    }

    public function printTest()
    {
        echo $this->test;
    }

    public function setTest($value)
    {
        $this->test = 'test add : ' . $value;
    }

    public function getTest()
    {
        return $this->test;
    }
}