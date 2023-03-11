# behat-relativity
Behat context for relative elements testing

[![CircleCI](https://circleci.com/gh/drevops/behat-relativity.svg?style=shield)](https://circleci.com/gh/drevops/behat-relativity)
[![Latest Stable Version](https://poser.pugx.org/drevops/behat-relativity/v/stable)](https://packagist.org/packages/drevops/behat-relativity)
[![Total Downloads](https://poser.pugx.org/drevops/behat-relativity/downloads)](https://packagist.org/packages/drevops/behat-relativity)
[![License](https://poser.pugx.org/drevops/behat-relativity/license)](https://packagist.org/packages/drevops/behat-relativity)

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
`composer require --dev drevops/behat-relativity`

## usage
Example `behat.yml`:
```yaml
default:
  suites:
    default:
      contexts:
        - DrevOps\BehatRelativityExtension\Context\RelativityContext
        - FeatureContext

  extensions:
    DrevOps\BehatRelativityExtension:
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
      # Vertical offset - document will be scrolled to the element with this offset.
      # Useful when fixed elements may cover part of pages making it impossible to click on components.
      offset: 60
      # List of site-wide components.
      components:
        'page': "#page"
        'main': "#main"
        'top': "#top"
        'bottom': "#bottom"
```

## Maintenance

### Local development setup

1. Install Docker.
2. If using M1: `cp default.docker-compose.override.yml docker-compose.override.yml`
3. Start environment: `docker-compose up -d --build`.
4. Install dependencies: `docker-compose exec phpserver composer install --ansi --no-suggest`.

### Lint code

```bash
docker-compose exec phpserver vendor/bin/phpcs
```

### Run tests

```bash
docker-compose exec phpserver vendor/bin/behat
```

### Enable Xdebug

```bash
XDEBUG_ENABLE=true docker-compose up -d phpserver
```

To disable, run

```bash
docker-compose up -d phpserver
```
