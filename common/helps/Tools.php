<?php
namespace common\helps;

use Yii;
use yii\base\Component;

/**
 * 调试程序
 * @param $val  要显示的数据
 * @param string $name 数据名称
 * @param bool $exit 是否中断程序
 * @param bool $dump 是否选择var_dump打印
 */
class Tools extends Component
{

    public function debug($val, $name = '', $exit = true, $dump = false)
    {
        //自动获取调试函数名$func
        if ($dump) {
            $func = 'var_dump';
        } else {
            $func = (is_array($val) || is_object($val)) ? 'print_r' : 'printf';
        }
        //输出到html
        header('Content-type:text/html; charset=utf-8');
        echo '<pre>debug output: ' . $name . ' : <hr/>';
        $func($val);
        echo '</pre>';
        if ($exit) exit;
    }

    /**
     * 生成缩略图
     * @param string $fileName 图片的名称
     * @param int $width 缩略图的宽度
     * @param int $height 缩略图的高度
     */
    public function createThumbnail($fileName, $width = 100, $height = 100, $quality = 100)
    {
        //创建缩略图文件夹
        $thumbnailPath = Yii::getAlias('@frontend/web/uploads/thumbnail/');
        if (!is_dir($thumbnailPath)) {
            @mkdir($thumbnailPath);
        }

        //新建缩略图名称
        $cutPoint = strrpos($fileName, '.');
        $thumnailName = substr($fileName, 0, $cutPoint) . '-' . $width . 'x' . $height . substr($fileName, $cutPoint);

        //生成缩略图
        \yii\imagine\Image::thumbnail('@frontend/web/uploads/' . $fileName, $width, $height, \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET)->save($thumbnailPath . $thumnailName, ['quality' => $quality]);

        return Yii::getAlias('@frontendUrl/web/uploads/thumbnail/') . $thumnailName;
    }

}