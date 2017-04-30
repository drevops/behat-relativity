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
