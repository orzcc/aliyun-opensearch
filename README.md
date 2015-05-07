# Laravel Aliyun Opensearch
Aliyun Opensearch bridge for Laravel 5

## Installation

This package can be installed through Composer.
```bash
composer require orzcc/aliyun-opensearch
```

Once Opensearch is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'Orzcc\Opensearch\OpensearchServiceProvider'`

You can register the Opensearch facade in the `aliases` key of your `config/app.php` file if you like.

* `'Opensearch' => 'Orzcc\Opensearch\Facades\Opensearch'`

## Configuration

Opensearch requires connection configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/opensearch.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are two config options:

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### Opensearch Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

##### OpensearchManager

This is the class of most interest. It is bound to the ioc container as `'opensearch'` and can be accessed using the `Facades\Opensearch` facade. This class implements the `ManagerInterface` by extending `AbstractManager`. The interface and abstract class are both part of my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at [that repo](https://github.com/GrahamCampbell/Laravel-Manager#usage). Note that the connection class returned will always be an instance of `CloudsearchSearch`.

##### Facades\Opensearch

This facade will dynamically pass static method calls to the `'opensearch'` object in the ioc container which by default is the `OpensearchManager` class.

##### OpensearchServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Real Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication and host details in the config file, it will just work:

```php
use Orzcc\Opensearch\Facades\Opensearch;
// you can alias this in config/app.php if you like

// Add a new app to search
// $opensearch = Opensearch::connection('main');
// $opensearch = Opensearch::connection('app2');
$opensearch = Opensearch::connection();
$opensearch->setFormat('json');
$opensearch->setQueryString('default:阿里云');

$result = $opensearch->search();
```

The opensearch manager will behave like it is a `CloudsearchSearch` class. If you want to call specific connections, you can do with the `connection` method:


For more information on how to use the `CloudsearchSearch` class we are calling behind the scenes here, check out the docs at http://docs.aliyun.com/#/opensearch/sdk/php&sdk-doc-cloudsearchsearch, and the manager class at https://github.com/GrahamCampbell/Laravel-Manager#usage.


## License

Laravel Aliyun Opensearch is licensed under [The MIT License (MIT)](LICENSE).
