# behat-relativity
Behat context for relative elements testing

### Local development
### Preparing local environment
1. Install [Vagrant](https://www.vagrantup.com/downloads.html) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Composer](https://getcomposer.org/).
2. Install all dependencies: `composer install`
3. Provision local VM: `vagrant up`

### Running tests
```bash
vagrant ssh
composer test
```
### Cleanup an environment
```bash
composer cleanup
```
