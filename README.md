# behat-relativity
Behat context for relative elements testing

[![CircleCI](https://circleci.com/gh/integratedexperts/behat-relativity.svg?style=shield)](https://circleci.com/gh/integratedexperts/behat-relativity)
[![Latest Stable Version](https://poser.pugx.org/integratedexperts/behat-relativity/v/stable)](https://packagist.org/packages/integratedexperts/behat-relativity)
[![Total Downloads](https://poser.pugx.org/integratedexperts/behat-relativity/downloads)](https://packagist.org/packages/integratedexperts/behat-relativity)
[![License](https://poser.pugx.org/integratedexperts/behat-relativity/license)](https://packagist.org/packages/integratedexperts/behat-relativity)

### Local development
### Preparing local environment
1. Install [Vagrant](https://www.vagrantup.com/downloads.html) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Composer](https://getcomposer.org/).
2. Install all dependencies: `composer install`
3. Provision local VM: `vagrant up`

### Running tests
```bash
vagrant ssh
scripts/selenium-install.sh
scripts/selenium-start.sh
composer test
```
### Cleanup an environment
```bash
composer cleanup
```
