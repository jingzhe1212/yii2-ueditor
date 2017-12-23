<?php
namespace moxuandi\ueditor;

use yii\web\AssetBundle;

class UEditorAsset extends AssetBundle
{
    public $sourcePath = '@vendor/moxuandi/yii2-ueditor/assets';

    public $css = [];

    public $js = [
        'ueditor.config.js',
        'ueditor.all.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
