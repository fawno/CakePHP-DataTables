CakePHP 4.x Helpers for DataTables
=================================

CakePHP 4.x Helpers to generate HTML with [DataTables](https://datatables.net/)

How to... ?
===========

#### Installation

If you want the latest version of the plugin:

- Add the plugin to your `composer.json` (see below if you want to use another branch / version):

```
composer require fawno/cakephp-datatables-helpers:dev-master
// Or the following if you want to use the stable version:
composer require fawno/cakephp-datatables-helpers:@stable
```

- Load the plugin in your `src/Application.php`:

```php
$this->addPlugin('DataTables');
```

- [Load the helpers](https://book.cakephp.org/4/en/views/helpers.html#configuring-helpers) you want in your `View/AppView.php`:

```php
$this->loadHelper('Table', [
    'className' => 'DataTables.Table',
]);
```
