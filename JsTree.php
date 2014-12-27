<?php

namespace iutbay\yii2jstree;

use yii\helpers\Html;
use yii\helpers\Json;

/**
 * JsTree widget.
 *
 * @author Kevin LEVRON <kevin.levron@gmail.com>
 */
class JsTree extends \yii\widgets\InputWidget
{

    /**
     * JsTree items
     * @var array
     */
    public $items;

    /**
     * JsTree options
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var string the template for arranging the jstree and the hidden input tag.
     */
    public $template = '{input}{jstree}';

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->items !== null)
            $this->clientOptions['core']['data'] = $this->items;
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerClientScript();

        if ($this->hasModel()) {
            $input = Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        } else {
            $input = Html::hiddenInput($this->name, $this->value, $this->options);
        }

        echo strtr($this->template, [
            '{input}' => $input,
            '{jstree}' => Html::tag('div', '', ['id' => $this->getJsTreeId()]),
        ]);
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $id = $this->getJsTreeId();
        $options = $this->getClientOptions();
        $options = empty($options) ? '' : Json::encode($options);

        $view = $this->getView();
        JsTreeAsset::register($view);
        $view->registerJs("jQuery('#$id').on('changed.jstree', function(e, data) { console.log(data.selected); }).jstree($options);");
    }

    /**
     * Returns the options for jstree
     * @return array the options
     */
    protected function getClientOptions()
    {
        return $this->clientOptions;
    }

    protected function getJsTreeId()
    {
        return $this->options['id'] . '_jstree';
    }

}
