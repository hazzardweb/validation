## Illuminate Validation Outside Laravel

### Installation

`composer require illuminate/validation`
`composer require hazzard/validation`

### Usage 

````
use Hazzard\Validation\Validator;

$validator = new Validator;

// Set default language lines used by the translator.
$validator->setDefaultLines();

// Make instance available globally via static methods (optional).
$validator->setAsGlobal();

// Create a class alias (optional). 
$validator->classAlias();
````

##### Database Presence Verifier

Using the Illuminate Database [Capsule](https://github.com/laravel/framework/tree/master/src/Illuminate/Database) set the database connection instance:

````
$db = $capsule->getDatabaseManager();

$validator->setConnection($db);
````


##### Providing A Custom Translator

To provide a custom translator pass an instance of `Illuminate\Container\Container` with the translator bound to `translator`.

The translator must implement `Symfony\Component\Translation\TranslatorInterface`.

````
$container['translator'] = new CustomTranslator();

$validator = new Validator($container);
````

##### Using The Validator

````
$validator = Validator::make(
    ['name' => 'Dayle'],
    ['name' => 'required|min:5']
);
````

The rest is the same as [Laravel](http://laravel.com/docs/5.0/validation#basic-usage).
