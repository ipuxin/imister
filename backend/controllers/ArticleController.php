<?php
namespace backend\controllers;

use Yii;
use common\models\Article;
use backend\controllers\AdminController;
use Imagine\Image\ManipulatorInterface;
use xj\uploadify\UploadAction;
use yii\imagine\Image;
use common\models\Category;
use yii\data\Pagination;

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
                    $action->output['thumbnail'] = Yii::$app->tools->createThumbnail($action->getFilename(), 100, 100);
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

    /**
     * @return string
     * 文章列表
     */
    public function actionIndex()
    {
        $model = Article::find();
        $pagination = new Pagination(['totalCount' => $model->count(), 'pageSize' => 10]);
        $result = $model->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', ['result' => $result, 'pagination' => $pagination, 'categorys' => Category::getCategory()]);

    }

    /**
     * @return string|\yii\web\Response
     * 文章添加
     */
    public function actionAdd()
    {
        $model = new Article();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '添加文章成功');
            return $this->redirect(['index']);
        }

        return $this->render('add', ['model' => $model, 'categorys' => Category::getAllCategorys()]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * 文章编辑
     */
    public function actionEdit($id)
    {
        $id = (int)$id;
        $model = Article::findOne($id);
        if ($model) {
            if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '编辑文章成功');
                return $this->redirect(['index']);
            }
            return $this->render('edit', ['model' => $model, 'categorys' => Category::getAllCategorys()]);
        }
        return $this->redirect(['index']);
    }

    /**
     * @return \yii\web\Response
     * 文章删除
     */
    public function actionDelete()
    {
        $selected = Yii::$app->request->post('selected');
        if (Article::deleteIn($selected)) {
            Yii::$app->session->setFlash('success', '删除文章成功');
        } else {
            Yii::$app->session->setFlash('error', '删除文章失败');
        }
        return $this->redirect(['index']);
    }
}