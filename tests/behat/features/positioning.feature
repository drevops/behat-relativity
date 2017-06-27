@testapi
Feature: Behat relative assertions work

  Ensure that Behat's assertion for elements relativity works as expected

  Background:
    Given I define components:
    | main inner custom | #main-inner-custom |

  @javascript @phpserver
  Scenario: Assert that one component is above another component
    Given I am on the test page
    Then I see top above main
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is below another component
    Given I am on the test page
    Then I see bottom below main
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is on the left from another component
    Given I am on the test page
    Then I see left to the left of main
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is on the right from another component
    Given I am on the test page
    Then I see right to the right of main
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is inside of another component
    Given I am on the test page
    Then I see main inner inside of main
    And I see main inner custom inside of main inner
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is outside of another component
    Given I am on the test page
    Then I see main outside of main inner
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is above multiple other components
    Given I am on the test page
    Then I see top above main, left and right
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is below another component on mobile
    Given I am viewing the site on a mobile device
    When I am on the test page
    Then I see left below main
    And I save screenshot
    And I see bottom below main
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is over another component
    Given I am on the test page
    Then I see overInside, overIntersect and overCover over overBottom
    And I see overInside inner, overIntersect inner and overCover inner over overBottom
    And I see overFixed and overFixed inner over overBottom
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is not over another component
    Given I am on the test page
    Then I see overOutside and overUnder not over overBottom
    And I see overOutside inner and overUnder inner not over overBottom
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that visually visible component is visible
    Given I am on the test page
    Then I see visible top
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that visually hidden component is not visible
    Given I am on the test page
    Then I don't see hidden
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that offCanvas component is not visible
    Given I am on the test page
    Then I don't see offCanvas left, offCanvas right, offCanvas top and offCanvas bottom
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that overlay is clickable when visible
    Given I am on the test page
    And I don't see overlay
    When I click on overlay trigger
    Then I see visible overlay
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that offCanvas overlay is clickable when visible
    Given I am viewing the site on a mobile device
    And I am on the test page
    And I don't see offCanvas overlay
    When I click on offCanvas overlay trigger
    Then I see visible offCanvas overlay
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that missing component is not visible
    Given I am on the test page
    Then I don't see missing
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that hidden and missing components are not visible, but visible components are present.
    Given I am on the test page
    Then I don't see hidden and missing
    And I see top above main
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that screen reader only content is not visible
    Given I am on the test page
    Then I don't see sr only
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that screen reader only content that is shown is visible
    Given I am on the test page
    And I see sr only shown below bottom
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that multiple subject components can be referenced
    Given I am on the test page
    Then I see top and main above bottom
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that more multiple subject components can be referenced
    Given I am on the test page
    Then I see top, main and left above bottom
    And I save screenshot
