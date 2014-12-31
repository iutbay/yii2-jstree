<?php

namespace iutbay\yii2jstree;

use yii\web\AssetBundle;

/**
 * JsTree asset bundle.
 * 
 * @author Kevin LEVRON <kevin.levron@gmail.com>
 */
class JsTreeAsset extends AssetBundle
{

    public $sourcePath = '@bower/jstree/dist';

    public $depends = [
        'yii\web\JqueryAsset',
        'iutbay\yii2fontawesome\FontAwesomeAsset',
    ];

    public function init()
    {
        parent::init();

        // set css & js
        $min = YII_DEBUG ? '' : '.min';
        $this->css = ["themes/default/style{$min}.css"];
        $this->js = ["jstree{$min}.js"];
    }

}
