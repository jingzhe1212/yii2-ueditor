<?php
namespace moxuandi\ueditor;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * UEditor renders a editor js plugin for classic editing.
 *
 * @author  zhangmoxuan <1104984259@qq.com>
 * @link  http://www.zhangmoxuan.com
 * @QQ  1104984259
 * @Date  2017/7/14
 * @see http://ueditor.baidu.com/website/
 */
class UEditor extends InputWidget
{
    /**
     * 配置接口, 参阅 UEditor 官方文档(http://fex.baidu.com/ueditor/#start-config)
     * @see yii2-ueditor/assets/ueditor.config.js
     */
    public $clientOptions = [];


    public function init()
    {
        //$this->id = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->id;
        if($this->hasModel()){
            $this->id = Html::getInputId($this->model, $this->attribute);
        }elseif($this->attribute){
            $this->id = $this->id . '_' . $this->attribute;
        }
        $_options = [
            'serverUrl' => Url::to(['UeUpload']),
            'initialFrameWidth' => '100%',  // 最小920
            'initialFrameHeight' => '400',
            'lang' => (strtolower(yii::$app->language) == 'en-us') ? 'en' : 'zh-cn'
        ];
        $this->clientOptions = array_merge($_options, $this->clientOptions);
        if($this->hasModel()){
            parent::init(); // TODO: Change the autogenerated stub
        }
    }

    public function run()
    {
        self::registerClientScript();
        if($this->hasModel()){
            return Html::activeTextarea($this->model, $this->attribute, ['id'=>$this->id]);
        }else{
            return Html::textarea($this->id, $this->value, ['id'=>$this->id]);
        }
    }

    /**
     * 注册客户端脚本
     */
    protected function registerClientScript()
    {
        UEditorAsset::register($this->view);
        $clientOptions = Json::encode($this->clientOptions);
        $script = "UE.getEditor('{$this->id}', $clientOptions)";
        $this->view->registerJs($script, View::POS_READY);
    }
}
