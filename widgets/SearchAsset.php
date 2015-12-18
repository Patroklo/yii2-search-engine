<?php

namespace cyneek\yii2\searchEngine\widgets;


use cyneek\yii2\searchEngine\Module;
use yii\web\AssetBundle;

/**
 * Class CommentAsset
 * @package cyneek\comments
 */
class SearchAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/cyneek/yii2-search-engine/assets';

    /**
     * @inheritdoc
     */
    public $js = [
    ];

    /**
     * @inheritdoc
     */
    public $css = [
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset'
    ];


    public function init()
    {
        parent::init();

        /** @var Module $module */
        $module = \Yii::$app->getModule(Module::$name);
        $assetMap = $module->assetMap;

        $typeList = ['sourcePath', 'js', 'css', 'depends'];

        foreach ($typeList as $type)
        {
            if (array_key_exists($type, $assetMap))
            {
                $this->$type = $assetMap[$type];
            }
        }

    }
}