<?php

namespace iutbay\yii2jstree;

use yii\web\AssetBundle;

class JsTreeAsset extends AssetBundle
{

    public $sourcePath = '@bower/jstree';

    public function init()
    {
        parent::init();

        // set css & js
        $min = YII_DEBUG ? '' : '.min';
        $this->css = ["dist/themes/default/style{$min}.css"];
        $this->js = ["dist/jstree{$min}.js"];

        // publish only dist folder
        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            $dirname = basename(dirname($from));
            return $dirname === 'dist';
        };
    }

}
