DoctrineORMModule multiple migrations configurations
----------------------------------------------------

This module enables [Doctrine Migrations](https://github.com/doctrine/migrations) with the 
[DoctrineOrmModule on Zend Framework](https://github.com/doctrine/DoctrineORMModule) using multiple configurations.

The current problem is that `orm_default` is hardcoded: [MigrationsCommandFactory](https://github.com/doctrine/DoctrineORMModule/blob/master/src/DoctrineORMModule/Service/MigrationsCommandFactory.php#L62).

**Please do not add anything to this module, and remove it as soon as DoctrineOrmModule is fixed.** 

# Installation

Add the repository to your composer.json:

```
"repositories": [
  {
    "type": "vcs",
    "url": "git@github.com:tdutrion/doctrine-module-migrations-multi-configuration.git"
  }
],
```

Run `composer require tdutrion/doctrine-module-migrations-multi-configuration` to install the package.

Add `Tdutrion\DoctrineORMMultiConf` to your list of module (in `config/modules.config.php` or `config/application.config.php`).

