@testapi
Feature: Behat relative assertions work using breakpoints

  Ensure that Behat's assertion for elements relativity works as expected

  Background:
    Given I define components:
      | main inner custom | #main-inner-custom |
      | viewport custom   | #viewport-custom   |

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
    And I see over-inside, over-intersect and over-cover over over-bottom
    And I see over-inside inner, over-intersect inner and over-cover inner over over-bottom
    And I see over-fixed and over-fixed inner over over-bottom
    And I see over-outside and over-under not over over-bottom
    And I see over-outside inner and over-under inner not over over-bottom
    And I see visible top
    And I don't see hidden
    And I don't see off-canvas left, off-canvas right, off-canvas top and off-canvas bottom
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
    And I see over-inside, over-intersect and over-cover over over-bottom
    And I see over-inside inner, over-intersect inner and over-cover inner over over-bottom
    And I see over-fixed and over-fixed inner over over-bottom
    Then I save screenshot
    And I see visible top
    And I don't see hidden
    And I don't see off-canvas left, off-canvas right, off-canvas top and off-canvas bottom
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
    And I see over-inside, over-intersect and over-cover over over-bottom
    And I see over-inside inner, over-intersect inner and over-cover inner over over-bottom
    And I see over-fixed and over-fixed inner over over-bottom
    And I see over-outside and over-under not over over-bottom
    And I see over-outside inner and over-under inner not over over-bottom
    And I see visible top
    And I don't see hidden
    And I don't see off-canvas left, off-canvas right, off-canvas top and off-canvas bottom
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
    And I see over-inside, over-intersect and over-cover over over-bottom
    And I see over-inside inner, over-intersect inner and over-cover inner over over-bottom
    And I see over-fixed and over-fixed inner over over-bottom
    And I see over-outside and over-under not over over-bottom
    And I see over-outside inner and over-under inner not over over-bottom
    And I see visible top
    And I don't see hidden
    And I don't see off-canvas left, off-canvas right, off-canvas top and off-canvas bottom
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
    And I see over-inside, over-intersect and over-cover over over-bottom
    And I see over-inside inner, over-intersect inner and over-cover inner over over-bottom
    And I see over-fixed and over-fixed inner over over-bottom
    And I see over-outside and over-under not over over-bottom
    And I see over-outside inner and over-under inner not over over-bottom
    And I see visible top
    And I don't see hidden
    And I don't see off-canvas left, off-canvas right, off-canvas top and off-canvas bottom
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
    And I see over-inside, over-intersect and over-cover over over-bottom
    And I see over-inside inner, over-intersect inner and over-cover inner over over-bottom
    And I see over-fixed and over-fixed inner over over-bottom
    And I see over-outside and over-under not over over-bottom
    And I see over-outside inner and over-under inner not over over-bottom
    And I see visible top
    And I don't see hidden
    And I don't see off-canvas left, off-canvas right, off-canvas top and off-canvas bottom
    And I don't see missing
    And I don't see hidden and missing
    And I see top above main
    And I don't see sr only
    And I see sr only shown below bottom
    And I see top and main above bottom
    And I see top, main and left above bottom
    Then I save screenshot

  @javascript @phpserver
  Scenario: Viewport size is calculated correctly when screen is resized.
    Given I am viewing the site on a desktop device
    When I am on the test page
    Then I see visible viewport custom
    Then I save screenshot
