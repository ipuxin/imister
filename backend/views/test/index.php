<?php

//Remove Events Auto Convert
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use xj\uploadify\Uploadify;

echo '<br/><br/><br/>';

//外部TAG
echo Html::fileInput('test', NULL, ['id' => 'test']);
echo Uploadify::widget([
    'url' => \yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'width' => 120,
        'height' => 40,
        'onUploadError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
),
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
//        console.log(data.fileUrl);
//        console.log(data.fileName);
//        console.log(data.filePath);
        $("#aa").append('<img width="500" src="' + data.fileUrl + '" />');
    }
}
EOF
),
    ]
]);

?>
<div id="aa"></div>
<?= \cliff363825\kindeditor\KindEditorWidget::widget([
    'name' => 'content',
    'options' => [], // html attributes
    'clientOptions' => [
        'width' => '680px',
        'height' => '350px',
        'themeType' => 'default', // optional: default, simple, qq
        'langType' => \cliff363825\kindeditor\KindEditorWidget::LANG_TYPE_ZH_CN, // optional: ar, en, ko, ru, zh-CN, zh-TW
        //这里是配置上传链接
        'uploadJson' => Url::to(['test/upload']),
    ],
]); ?>
