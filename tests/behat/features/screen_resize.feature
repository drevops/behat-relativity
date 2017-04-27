@testapi
Feature: Behat relative assertions work using breakpoints

  Ensure that Behat's assertion for elements relativity works as expected

  Background:
    Given I define components:
    | main inner custom | #main-inner-custom |

  @javascript @phpserver
  Scenario: Screen default size is used when no size is specified
    Given I am on the test page
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen mobile size is used when mobile size is specified
    Given I am viewing the site on a mobile screen
    When I am on the test page
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen tablet size is used when tablet size is specified
    Given I am viewing the site on a tablet screen
    When I am on the test page
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen desktop size is used when desktop size is specified
    Given I am viewing the site on a desktop screen
    When I am on the test page
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen desktop_large size is used when desktop_large size is specified
    Given I am viewing the site on a desktop_large screen
    When I am on the test page
    Then I save screenshot

  @javascript @phpserver
  Scenario: Alternative step definition can be used to resize screen.
    Given I am viewing the site on a desktop_large device
    When I am on the test page
    Then I save screenshot
