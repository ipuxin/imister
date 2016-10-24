<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/3
 * Time: 22:31
 */
namespace backend\controllers;

use Yii;
use common\models\Article;
use backend\controllers\AdminController;
use Imagine\Image\ManipulatorInterface;
use xj\uploadify\UploadAction;
use yii\imagine\Image;

class ArticleController extends AdminController
{
    public $enableCsrfValidation = false;

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
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {
                },
                'beforeSave' => function (UploadAction $action) {
                },
                'afterSave' => function (UploadAction $action) {
                    /**
                     * getWebUrl:
                     * /0101phpstorm/imister/backend/web/upload/b2d7ca21b2012460ba780d4601d1ae502b21351c.jpg
                     */
//                    $WebUrl = $action->getWebUrl();

                    /**
                     * getFilename:
                     * b2d7ca21b2012460ba780d4601d1ae502b21351c.jpg
                     */
//                    $Filename = $action->getFilename();

                    /**
                     * getSavePath:
                     * D:/wamp/www/0101phpstorm/imister/backend/web/upload/b2d7ca21b2012460ba780d4601d1ae502b21351c.jpg
                     */
//                    $SavePath = $action->getSavePath();

                    /*$action->output['WebUrl'] =$WebUrl;
                    $action->output['Filename'] =$Filename;
                    $action->output['SavePath'] =$SavePath;*/

                    //生成图片缩略图， 然后会存储图片
                    //a.jpg -> a.jpg , images/a.jpg -> images/a.jpg
                    //a-100x100.jpg

                    /**
                     * 创建缩略图存放的目录:
                     * 没有就创建
                     */
                    $thumbnailDir = Yii::getAlias('@webroot/upload/thumbnail/');
                    if (!is_dir($thumbnailDir)) {
                        @mkdir($thumbnailDir);
                    }

                    //获取文件名:b2d7ca21b2012460ba780d4601d1ae502b21351c.jpg
                    $fileImage = $action->getFilename();

                    //查找. 在$fileImage中最后一次出现的位置
                    $suffixPoint = strrpos($fileImage, '.');

                    /**
                     * 截取:b2d7ca21b2012460ba780d4601d1ae502b21351c-100x100.jpg
                     * 用.切割文件名,拼接字符串'-100x100'
                     */
                    $thumnailName = substr($fileImage, 0, $suffixPoint) . '-100x100' . substr($fileImage, $suffixPoint);

                    /**
                     * 制作缩略图:
                     */
                    Image::thumbnail($action->getSavePath(), 100, 100, \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET)->save($thumbnailDir . $thumnailName, ['quality' => 100]);

//
                    /**
                     * 打印样例:
                     * /0101phpstorm/imister/backend/web/upload/thumbnail/bc19c8c050e6f43bf1be8d060460d02324648bcd-100x100.jpg
                     * bc19c8c050e6f43bf1be8d060460d02324648bcd.jpg
                     */
                    $action->output['thumbnail'] = Yii::getAlias('@web/upload/thumbnail/') . $thumnailName;
                    $action->output['Filename'] = $fileImage;

                },
            ],
            /**
             * KindEditor
             */
            'upload' => [
                'class' => '\cliff363825\kindeditor\KindEditorUploadAction',
                'maxSize' => 2097152,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', ['result' => [], 'pagination' => new \yii\data\Pagination()]);
    }

    public function actionAdd()
    {
        $model = new Article();
        if (Yii::$app->request->isPost) {
            print_r(Yii::$app->request->post());
            exit();
        }

        return $this->render('add', ['model' => $model]);
    }

}