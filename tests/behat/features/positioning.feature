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
    Then I see over-inside, over-intersect and over-cover over over-bottom
    And I see over-inside inner, over-intersect inner and over-cover inner over over-bottom
    And I see over-fixed and over-fixed inner over over-bottom
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that one component is not over another component
    Given I am on the test page
    Then I see over-outside and over-under not over over-bottom
    And I see over-outside inner and over-under inner not over over-bottom
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
  Scenario: Assert that off-canvas component is not visible
    Given I am on the test page
    Then I don't see off-canvas left, off-canvas right, off-canvas top and off-canvas bottom
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that overlay is clickable when visible
    Given I am on the test page
    And I don't see overlay
    When I click on overlay trigger
    Then I see visible overlay
    And I save screenshot

  @javascript @phpserver
  Scenario: Assert that off-canvas overlay is clickable when visible
    Given I am viewing the site on a mobile device
    And I am on the test page
    And I don't see off-canvas overlay
    When I click on off-canvas overlay trigger
    Then I see visible off-canvas overlay
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

  @javascript @phpserver
  Scenario: Assert that elements with fixed position work correctly
    Given I am on the test page
    # Assert that first level fixed container works as expected relatively to
    # other static elements on the page.
    Then I see fixed-scrolled below top
    And I save screenshot
    And I see fixed-scrolled above bottom
    And I save screenshot
    And I see top above fixed-scrolled
    And I save screenshot
    And I see bottom below fixed-scrolled
    And I save screenshot
    # Assert that static and fixed children and grand-children of first level
    # fixed container work as expected relatively to other static elements on
    # the page.
    And I see fixed-scrolled-item-1, fixed-scrolled-item-2, fixed-scrolled-item-3, fixed-scrolled-item-31, fixed-scrolled-item-311, fixed-scrolled-item-312, fixed-scrolled-item-32 below top
    And I save screenshot
    And I see fixed-scrolled-item-1, fixed-scrolled-item-2, fixed-scrolled-item-3, fixed-scrolled-item-31, fixed-scrolled-item-311, fixed-scrolled-item-312, fixed-scrolled-item-32 above bottom
    And I save screenshot
    # Assert that static elements within fixed container work correctly with
    # grand-children within previous sibling fixed container.
    And I see fixed-scrolled-item-311 above fixed-scrolled-item-32
    And I save screenshot
