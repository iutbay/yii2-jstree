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
     * @see http://www.jstree.com/docs/json/
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
     * Multiple selection
     * @var boolean
     */
    public $multiple = true;

    /**
     * changed.jstree handler
     * @var string
     */
    public $onChanged;

    /**
     * select_node.jstree handler
     * @var string
     */
    public $onSelect;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
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
        $inputId = $this->options['id'];
        $jsTreeId = $this->getJsTreeId();
        $options = $this->getClientOptions();
        $options = empty($options) ? '' : Json::encode($options);

        $onChanged = '';
        if ($this->onChanged)
            $onChanged = ".on('changed.jstree', {$this->onChanged})";

        $onSelect = '';
        if ($this->onSelect)
            $onSelect = ".on('select_node.jstree', {$this->onSelect})";

        $view = $this->getView();
        JsTreeAsset::register($view);
        $view->registerJs("
            jQuery('#$jsTreeId')
                .on('loaded.jstree', function() { jQuery(this).jstree('select_node', jQuery('#$inputId').val().split(','), true); })
                .on('changed.jstree', function(e, data) { jQuery('#$inputId').val(data.selected.join()); })
                $onChanged
                $onSelect
                .jstree($options);
        ");
    }

    /**
     * Returns the options for jstree
     * @return array
     */
    protected function getClientOptions()
    {
        $options = $this->clientOptions;
        $options['core']['multiple'] = $this->multiple;

        if ($this->items !== null)
            $options['core']['data'] = $this->items;

        return $options;
    }

    /**
     * Returns the jstree container id
     * @return string
     */
    protected function getJsTreeId()
    {
        return $this->options['id'] . '_jstree';
    }

}
