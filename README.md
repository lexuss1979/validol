# validol
php validator

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lexuss1979/validol/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lexuss1979/validol/?branch=master)

[![Code Coverage](https://scrutinizer-ci.com/g/lexuss1979/validol/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/lexuss1979/validol/?branch=master)

## Installation

Install the latest version with

```bash
$ composer require lexuss1979/validol
```
## Basic Usage
```php
<?php
use Lexuss1979\Validol\Validator;

$validation = Validator::process(['name' => 'Olga', 'age' => 18], [
    'name' => 'required string min_len:2',
    'age' => 'required integer min:16'
]);
if ($validation->success()){
    // Data is valid
    return $validation->data();
} else {
    // There are errors
   var_dump($validation->errors());
}
```
##Required vs Sometimes
```php
<?php

use Lexuss1979\Validol\Validator;
$validation = Validator::process([], ['age' => 'required']);
//fails 
$validation = Validator::process([], ['age' => 'sometimes integer']);
//success 
$validation = Validator::process([ 'age' => 'seventeen' ], ['age' => 'sometimes integer']);
// fails because age must be an integer value if presents
```

##Validated data
You can get validated data with $validation->data(). It will contain only keys that was successfully validated.
 ```php
<?php
use Lexuss1979\Validol\Validator;

$validation = Validator::process(['name' => 'Olga', 'age' => 18, 'email' => 'olga@gmail.test'], [
    'name' => 'required string min_len:2',
    'age' => 'required integer min:16'
]);
var_dump($validation->data());
//  ['name' => 'Olga', 'age' => 18] 
 ```
##Errors
If validation fail you can access validation errors through $validation-errors(). It returns associative array like this.
 ```php
<?php
use Lexuss1979\Validol\Validator;

$validation = Validator::process(['name' => 'Olga', 'age' => ''], [
    'address' => 'required string',
    'age' => 'required integer min:16'
]);

var_dump($validation->errors());
// ['address' => ['address must be specified'], 'age' => ['age must be an integer value']]
 ```

##Keys alias
Use 'as' keyword to change data keys signature after validation.
 ```php
<?php
use Lexuss1979\Validol\Validator;

$validation = Validator::process(['firstname as name' => 'Olga'], [
    'firstname' => 'required']);
var_dump($validation->data());
//  ['name' => 'Olga'] 
 ```

##Error messages
You can specify your own error messages for validations set.
 ```php
<?php
use Lexuss1979\Validol\Validator;

$validation = Validator::process(['weight' => 'heavy'], [
    'weight' => ['required integer min:10' => 'Something is wrong']
]);
var_dump($validation->errors());
//  ['weight' => ['Something is wrong']] 
 ```