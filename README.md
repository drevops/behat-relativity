# behat-relativity
Behat context for relative elements testing

[![CircleCI](https://circleci.com/gh/integratedexperts/behat-relativity.svg?style=shield)](https://circleci.com/gh/integratedexperts/behat-relativity)
[![Latest Stable Version](https://poser.pugx.org/integratedexperts/behat-relativity/v/stable)](https://packagist.org/packages/integratedexperts/behat-relativity)
[![Total Downloads](https://poser.pugx.org/integratedexperts/behat-relativity/downloads)](https://packagist.org/packages/integratedexperts/behat-relativity)
[![License](https://poser.pugx.org/integratedexperts/behat-relativity/license)](https://packagist.org/packages/integratedexperts/behat-relativity)

## What is this?
This extension allows to test visual elements positioning on the page relatively to each other. Such tests are dead-simple to write, but they can capture potential issues when developing features on existing project.

Example feature to test elements on the www.google.com
```yaml
Feature: Google example test

  Show how Behat Relativity can be used to test pages using google.com as an example.

  Background:
    Given I define components:
      | top navigation    | #gb                     |
      | logo              | #hplogo                 |
      | search            | #lst-ib                 |
      | search button     | .jsb input[name="btnK"] |
      | lucky button      | .jsb input[name="btnI"] |
      | bottom navigation | .fbar                   |


  @javascript
  Scenario: Anonymous user visits google.com
    Given I am on "https://www.google.com"
    Then I see top navigation above logo, search, search button, lucky button and bottom navigation
    And I see logo above search, search button, lucky button and bottom navigation
    And I see search above search button, lucky button and bottom navigation
    And I see search button and lucky button above bottom navigation
    And I see search button to the left of lucky button
```

## Installation
`composer require integratedexperts/behat-relativity`

## usage
Example `behat.yml`:
```yaml
default:
  suites:
    default:
      contexts:
        - IntegratedExperts\BehatRelativity\RelativityContext:
          -
            # Supported screen breakpoints.
            breakpoints:
              mobile:
                width: 320
                height: 480
              tablet:
                width: 768
                height: 1024
              desktop:
                width: 992
                height: 1024
                default: true
              desktop_large:
                width: 1200
                height: 900
            # Vertical offset.
            offset: 60
            # List of site-wide components.
            components:
              'page': "#page"
              'main': "#main"
              'top': "#top"
              'bottom': "#bottom"
        - FeatureContext
```

## Local development
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
