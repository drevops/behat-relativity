@testapi
Feature: Behat relative assertions work using breakpoints

  Ensure that Behat's assertion for elements relativity works as expected

  Background:
    Given I define components:
    | main inner custom | #main-inner-custom |

  @javascript @phpserver
  Scenario: Screen default size is used when no size is specified
    Given I am on the test page
    Then I see top above main
    And I see bottom below main
    And I see left to the left of main
    And I see right to the right of main
    And I see main inner inside of main
    And I see main inner custom inside of main inner
    And I see main outside of main inner
    And I see top above main, left and right
    And I see overInside, overIntersect and overCover over overBottom
    And I see overInside inner, overIntersect inner and overCover inner over overBottom
    And I see overFixed and overFixed inner over overBottom
    And I see overOutside and overUnder not over overBottom
    And I see overOutside inner and overUnder inner not over overBottom
    And I see visible top
    And I don't see hidden
    And I don't see offCanvas left, offCanvas right, offCanvas top and offCanvas bottom
    And I don't see missing
    And I don't see hidden and missing
    And I see top above main
    And I don't see sr only
    And I see sr only shown below bottom
    And I see top and main above bottom
    And I see top, main and left above bottom
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen mobile size is used when mobile size is specified
    Given I am viewing the site on a mobile screen
    When I am on the test page
    Then I see top above main
    Then I save screenshot
    And I see bottom below main
    And I see left below main
    And I see right below main
    And I see main inner inside of main
    And I see main inner custom over main inner
    And I see main outside of main inner
    And I see top above main, left and right
    And I see overInside, overIntersect and overCover over overBottom
    And I see overInside inner, overIntersect inner and overCover inner over overBottom
    And I see overFixed and overFixed inner over overBottom
    Then I save screenshot
    And I see visible top
    And I don't see hidden
    And I don't see offCanvas left, offCanvas right, offCanvas top and offCanvas bottom
    And I don't see missing
    And I don't see hidden and missing
    And I see top above main
    And I don't see sr only
    And I see sr only shown below bottom
    And I see top and main above bottom
    And I see top, main and left above bottom
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen tablet size is used when tablet size is specified
    Given I am viewing the site on a tablet screen
    When I am on the test page
    Then I see top above main
    And I see bottom below main
    And I see left to the left of main
    And I see right to the right of main
    And I see main inner inside of main
    And I see main inner custom inside of main inner
    And I see main outside of main inner
    And I see top above main, left and right
    And I see overInside, overIntersect and overCover over overBottom
    And I see overInside inner, overIntersect inner and overCover inner over overBottom
    And I see overFixed and overFixed inner over overBottom
    And I see overOutside and overUnder not over overBottom
    And I see overOutside inner and overUnder inner not over overBottom
    And I see visible top
    And I don't see hidden
    And I don't see offCanvas left, offCanvas right, offCanvas top and offCanvas bottom
    And I don't see missing
    And I don't see hidden and missing
    And I see top above main
    And I don't see sr only
    And I see sr only shown below bottom
    And I see top and main above bottom
    And I see top, main and left above bottom
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen desktop size is used when desktop size is specified
    Given I am viewing the site on a desktop screen
    When I am on the test page
    Then I see top above main
    And I see bottom below main
    And I see left to the left of main
    And I see right to the right of main
    And I see main inner inside of main
    And I see main inner custom inside of main inner
    And I see main outside of main inner
    And I see top above main, left and right
    And I see overInside, overIntersect and overCover over overBottom
    And I see overInside inner, overIntersect inner and overCover inner over overBottom
    And I see overFixed and overFixed inner over overBottom
    And I see overOutside and overUnder not over overBottom
    And I see overOutside inner and overUnder inner not over overBottom
    And I see visible top
    And I don't see hidden
    And I don't see offCanvas left, offCanvas right, offCanvas top and offCanvas bottom
    And I don't see missing
    And I don't see hidden and missing
    And I see top above main
    And I don't see sr only
    And I see sr only shown below bottom
    And I see top and main above bottom
    And I see top, main and left above bottom
    Then I save screenshot

  @javascript @phpserver
  Scenario: Screen desktop_large size is used when desktop_large size is specified
    Given I am viewing the site on a desktop_large screen
    When I am on the test page
    Then I see top above main
    And I see bottom below main
    And I see left to the left of main
    And I see right to the right of main
    And I see main inner inside of main
    And I see main inner custom inside of main inner
    And I see main outside of main inner
    And I see top above main, left and right
    And I see overInside, overIntersect and overCover over overBottom
    And I see overInside inner, overIntersect inner and overCover inner over overBottom
    And I see overFixed and overFixed inner over overBottom
    And I see overOutside and overUnder not over overBottom
    And I see overOutside inner and overUnder inner not over overBottom
    And I see visible top
    And I don't see hidden
    And I don't see offCanvas left, offCanvas right, offCanvas top and offCanvas bottom
    And I don't see missing
    And I don't see hidden and missing
    And I see top above main
    And I don't see sr only
    And I see sr only shown below bottom
    And I see top and main above bottom
    And I see top, main and left above bottom
    Then I save screenshot

  @javascript @phpserver
  Scenario: Alternative step definition can be used to resize screen.
    Given I am viewing the site on a desktop_large device
    When I am on the test page
    Then I see top above main
    And I see bottom below main
    And I see left to the left of main
    And I see right to the right of main
    And I see main inner inside of main
    And I see main inner custom inside of main inner
    And I see main outside of main inner
    And I see top above main, left and right
    And I see overInside, overIntersect and overCover over overBottom
    And I see overInside inner, overIntersect inner and overCover inner over overBottom
    And I see overFixed and overFixed inner over overBottom
    And I see overOutside and overUnder not over overBottom
    And I see overOutside inner and overUnder inner not over overBottom
    And I see visible top
    And I don't see hidden
    And I don't see offCanvas left, offCanvas right, offCanvas top and offCanvas bottom
    And I don't see missing
    And I don't see hidden and missing
    And I see top above main
    And I don't see sr only
    And I see sr only shown below bottom
    And I see top and main above bottom
    And I see top, main and left above bottom
    Then I save screenshot
