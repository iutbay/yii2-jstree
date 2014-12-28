JsTree for Yii2
===============

[JsTree](http://www.jstree.com/) for Yii2.

WIP...

Installation
------------
The preferred way to install this helper is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "iutbay/yii2-jstree" "*"
```

or add

```json
"iutbay/yii2-jstree" : "*"
```

to the require section of your application's `composer.json` file.

https://packagist.org/packages/iutbay/yii2-jstree

Usage
-----

With model and ActiveForm :
```php
<?= $form->field($model, 'test')->widget(\iutbay\yii2jstree\JsTree::className(), [
	'items' => [
		[
			'id' => 1,
			'text' => 'Test 1',
			'children' => [
				[
					'id' => 2,
					'text' => 'Test 2',
				],
			],
		],
		[
			'id' => 3,
			'text' => 'Test 3',
			'icon' => 'fa fa-file',	// font awesome icon
		],
	],
]) ?>
```

Without model :
```php
<?= \iutbay\yii2jstree\JsTree::widget([
	'name' => 'test',
	'value' => '1,2',
	'items' => [
		[
			'id' => 1,
			'text' => 'Test 1',
			'children' => [
				[
					'id' => 2,
					'text' => 'Test 2',
				],
			],
		],
		[
			'id' => 3,
			'text' => 'Test 3',
			'icon' => 'fa fa-file',	// font awesome icon
		],
	],
]) ?>
```
