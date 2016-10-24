<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/28
 * Time: 23:05
 */
namespace backend\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\ArrayHelper;
use xj\uploadify\UploadAction;


class TestController extends Controller
{

    public function actions()
    {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                /*
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },*/
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    //$action->output
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->output['fileName'] = $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    //www.smister.com/upload/images/aa.jpg
                   // $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->output['filePath'] = $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }

    public function actionIndex()
    {
        //$imagePath = '@backend/web/upload/1.jpg';

        //$cropPath = Yii::getAlias('@backend/web/upload/1-crop.jpg');
        //$cropPath = Yii::getAlias('@backend/web/upload/1-crop-100-100.jpg');
        //Image::crop($imagePath,200,200)->save($cropPath, ['quality' => 100]);
        //Image::crop($imagePath,100,100)->save($cropPath, ['quality' => 100]);

        //$thumbnailPath = Yii::getAlias('@backend/web/upload/1-thumbnail.jpg');
        //$thumbnailInnerPath = Yii::getAlias('@backend/web/upload/1-thumbnail-inner.jpg');
        //Image::thumbnail($imagePath, 100, 100)->save($thumbnailPath, ['quality' => 100]);
        //Image::thumbnail($imagePath, 100, 100, \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET)->save($thumbnailInnerPath, ['quality' => 100]);

        //$waterPath = '@backend/web/upload/wt.png';

        //$waterImg = Yii::getAlias('@backend/web/upload/1-water.jpg');
        //$waterImg = Yii::getAlias('@backend/web/upload/1-water-100-100.jpg');
        //Image::watermark($imagePath, $waterPath)->save($waterImg, ['quality' => 100]);
        //Image::watermark($imagePath, $waterPath, [100, 100])->save($waterImg, ['quality' => 100]);

        //$fontFile = '@yii/captcha/SpicyRice.ttf';
        //$textImg = Yii::getAlias('@backend/web/upload/1-text.jpg');
        //$textImg = Yii::getAlias('@backend/web/upload/1-text-200-200.jpg');
        //$textImg = Yii::getAlias('@backend/web/upload/1-text-200-200-font.jpg');
        //Image::text($imagePath, 'Smister', $fontFile)->save($textImg, ['quality' => 100]);
        //Image::text($imagePath, 'Smister', $fontFile, [200, 200], ['size' => 16, 'color'=>'fefefe', 'angle' => 10])->save($textImg, ['quality' => 100]);

        //$frameImg = Yii::getAlias('@backend/web/upload/1-frame.jpg');
        //$frameImg = Yii::getAlias('@backend/web/upload/1-frame-fef.jpg');
        //Image::frame($imagePath, 10)->save($frameImg, ['quality' => 100]);
        //$frameImg = Yii::getAlias('@backend/web/upload/1-frame-40-fef.jpg');

        //Image::frame($imagePath, 10, 'f60')->save($frameImg, ['quality' => 100]);
        //Image::frame($imagePath, 40, 'f60', 50)->save($frameImg, ['quality' => 100]);


        return $this->render('index');
    }
}