# Slim Framework 3 Skeleton Application

## Used libs on Slim 3 with PHP 7.1+

### Missing features
* .po based i18n
* Global logger structure with monolog
* Error display by dotenv

### Slim 3: micro-framework
* [Site](https://www.slimframework.com)
* [Documentation](https://www.slimframework.com/docs)

### PHPUnit
* [Site](https://phpunit.de)
* Unit test demo
* Integration test demo
* End-to-end test demo (soon)


### DBAL: Doctrine2 query builder 
* [Repository](https://github.com/doctrine/dbal)
* [Documentation](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest)

### PHP-DI: The dependency injection container for humans
* [Site](http://php-di.org)
* [Documentation](http://php-di.org/doc)

### DotEnv: Environment config
* [Documentation/Repository](https://github.com/vlucas/phpdotenv)
```
Create a `.env` file for the application and `.env.test` file for the integration/end-to-end tests
DO NOT COMMIT ANY OTHER DOTENV FILE
All server must have it's own environment variables
```

### Phinx:
* [Site](https://phinx.org)
* [Documentation](https://book.cakephp.org/3.0/en/phinx.html)
```
migration by .env: $ vendor/bin/phinx migrate
migration by .env.test: $ vendor/bin/phinx migrate -e test
```

### Symfony 4 Validator
* [Site/Documentation](https://symfony.com/doc/current/validation.html)
