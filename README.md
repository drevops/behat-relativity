# behat-relativity
Behat context for relative elements testing

### For local development you need
1. Install [Vagrant](https://www.vagrantup.com/downloads.html) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads).
2. Open terminal 
3. Install vagrant-hostupdater plugin
```bash
vagrant plugin install vagrant-hostsupdater
```
4. Install vagrant-auto_network plugin
```bash
vagrant plugin install vagrant-auto_network
```
5. Install composer
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
```
6. Go to the behat-relativity project dir
```bash
cd path/to/behat-relativity
```
7. Prepare project via composer
```bash
composer install
```
7. Set up Vagrant
```bash
vagrant up
```
9. Going into Vagrant container
```bash
vagrant ssh
```
10. Run tests
```bash
composer test
```
### For destroy Vagrant and end local development, you need
1. Out of Vagrant container
```bash
exit
```
2. Run composer cleanup command
```bash
composer cleanup
```
