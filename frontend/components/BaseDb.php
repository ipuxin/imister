<?php
/**
 * YiiBlog
 *
 * @author: Administrator
 * @date: 2016/5/12 23:14
 * @copyright Copyright (c) 2016 xjuke.com
 */
namespace frontend\components;

/**
 * Class BaseDb
 * @package frontend\components
 * 单例模式初始化对象
 */
abstract class BaseDb
{
    protected static $instance;

    /**
     * @return mixed
     * get_class() 用于实例调用，加入参数($this)可解决子类继承调用的问题，
     * get_called_class() 则是用于静态方法调用。
     */
    public static function getInstance()
    {
        $class = get_called_class();

        if (!isset(self::$instance[$class])) {
            self::$instance[$class] = new $class;
        }

        return self::$instance[$class];
    }
}