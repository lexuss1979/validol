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

use Validol\Validator;

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