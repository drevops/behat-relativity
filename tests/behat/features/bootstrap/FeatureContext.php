<?php

/**
 * @file
 * Feature context Behat testing.
 */

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
  /**
   * Go to the test page.
   *
   * This is to test the framework itself.
   *
   * @Given /^(?:|I )am on (?:|the )test page$/
   * @When /^(?:|I )go to (?:|the )test page$/
   */
    public function goToTestPage()
    {
        $this->getSession()->visit('http://localhost:8888/relative/relative.html');
    }
}
