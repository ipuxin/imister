<?php
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
                /**
                 * 目录说明:
                 * @webroot:磁盘物理路径
                 * D:/wamp/www/0101phpstorm/imister/backend/web/uploads
                 * @web:网站,网页访问路径
                 * /0101phpstorm/imister/backend/web/uploads
                 */
                'basePath' => '@frontend/web/uploads',
                'baseUrl' => '@frontendUrl/web/uploads',
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
                    //返回生成图片的数据
                    $action->output['image'] = $action->getFilename();
                    $action->output['thumbnail'] =Yii::$app->tools->createThumbnail($action->getFilename(), 100, 100);
                },
            ],
            /**             * KindEditor
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