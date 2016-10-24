<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'PRC',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /**
         * 自定义组件,
         * 给组件的属性赋值,
         */
        'test' => [
            'class' => 'common\components\Test',
            'name' => 'mrs',
            'favor' => 'php',
            'test' => 'private',
        ],
        /**
         * 自定义组件:
         * 调试组件
         * Yii::$app->tools->debug()
         * 图片缩略图制作组件
         * Yii::$app->tools->createThumbnail()
         *
         */
        'utils' => [
            'class' => 'common\components\Utils'
        ],
        'tools' => [
            'class' => 'common\helps\Tools',
        ]
    ],
];
