<?php

/**
 * @file
 * Relative components assertions.
 */

use \Behat\Gherkin\Node\TableNode;

/**
 * Class RelativeTrait.
 */
trait RelativeTrait {

  /**
   * Array of relative components.
   *
   * Array keys are component names and values are CSS selectors.
   * This values must be passed via constructor from the calling class.
   *
   * @var array
   */
  protected $relativeComponents;

  /**
   * Vertical offset.
   *
   * @var int
   */
  protected $offset;

  /**
   * Constructor.
   *
   * @param array $components
   *   Array of relative components with keys as component names and values as
   *   CSS selectors.
   * @param int $offset
   *   Top offset for all element manipulations. Useful if sticky elements cover
   *   other elements. Default to 0.
   */
  public function __construct($components, $offset = 0) {
    $this->relativeComponents = $components;
    $this->offset = $offset;
  }

  /**
   * Go to the test page.
   *
   * This is to test the framework itself.
   *
   * @Given /^(?:|I )am on (?:|the )test page$/
   * @When /^(?:|I )go to (?:|the )test page$/
   */
  public function goToRelativeTestPage() {
    $this->visit('http://localhost:8888/relative/relative.html');

    // Components from fixture are known from the structure of the relative.html
    // file.
    $this->relativeComponents = array_merge($this->relativeComponents, [
      'main' => '#main',
      'top' => '#top',
      'bottom' => '#bottom',
      'left' => '#left',
      'right' => '#right',
      'main inner' => '#main-inner',
      'hidden' => '#hidden',
      'missing' => '#non-existing',
      'off-canvas left' => '#off-canvas-left',
      'off-canvas right' => '#off-canvas-right',
      'off-canvas top' => '#off-canvas-top',
      'off-canvas bottom' => '#off-canvas-bottom',
      'sr only' => '#sr-only',
      'sr only shown' => '#sr-only-shown',
      'overlay' => '#overlay',
      'overlay trigger' => '#overlay-trigger',
      'off-canvas overlay' => '#overlay-off-canvas',
      'off-canvas overlay trigger' => '#overlay-off-canvas-trigger',
      'over-bottom' => '#over-bottom',
      'over-inside' => '#over-inside',
      'over-inside inner' => '#over-inside-inner',
      'over-outside' => '#over-outside',
      'over-outside inner' => '#over-outside-inner',
      'over-intersect' => '#over-intersect',
      'over-intersect inner' => '#over-intersect-inner',
      'over-cover' => '#over-cover',
      'over-cover inner' => '#over-cover-inner',
      'over-fixed' => '#over-fixed',
      'over-fixed inner' => '#over-fixed-inner',
      'over-under' => '#over-under',
      'over-under inner' => '#over-under-inner',
    ]);
  }

  /**
   * Assert that a subject is above others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ([a-zA-Z0-9\s,]+) above ([a-zA-Z0-9\s,\-]+)$/
   */
  public function assertRelativeAbove($subject, $others) {
    return $this->relativeDispatcher('above', $subject, $others);
  }

  /**
   * Assert that a subject is below others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ([a-zA-Z0-9\s,]+) below ([a-zA-Z0-9\s,\-]+)$/
   */
  public function assertRelativeBelow($subject, $others) {
    return $this->relativeDispatcher('below', $subject, $others);
  }

  /**
   * Assert that a subject is on the left of the others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ([a-zA-Z0-9\s,]+) to (?:|the\s)left of ([a-zA-Z0-9\s,]+)$/
   */
  public function assertRelativeLeft($subject, $others) {
    return $this->relativeDispatcher('left', $subject, $others);
  }

  /**
   * Assert that a subject is on the right of the others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ([a-zA-Z0-9\s,]+) to (?:|the\s)right of ([a-zA-Z0-9\s,]+)$/
   */
  public function assertRelativeRight($subject, $others) {
    return $this->relativeDispatcher('right', $subject, $others);
  }

  /**
   * Assert that a subject is inside of the others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ([a-zA-Z0-9\s,]+) inside of ([a-zA-Z0-9\s,]+)$/
   */
  public function assertRelativeInside($subject, $others) {
    return $this->relativeDispatcher('inside', $subject, $others);
  }

  /**
   * Assert that a subject is outside of the others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ([a-zA-Z0-9\s,]+) outside of ([a-zA-Z0-9\s,]+)$/
   */
  public function assertRelativeOutside($subject, $others) {
    return $this->relativeDispatcher('outside', $subject, $others);
  }

  /**
   * Assert that a subject is over the others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ((?:[a-zA-Z0-9\s,\-](?!not))+) over ([a-zA-Z0-9\s,\-]+)$/
   */
  public function assertRelativeOver($subject, $others) {
    return $this->relativeDispatcher('over', $others, $subject, FALSE);
  }

  /**
   * Assert that a subject is not over the others.
   *
   * @param string $subject
   *   Subject as a string.
   * @param string $others
   *   Others as a string.
   *
   * @Then /^I see ([a-zA-Z0-9\s,\-]+) not over ([a-zA-Z0-9\s,\-]+)$/
   */
  public function assertRelativeNotOver($subject, $others) {
    return $this->relativeDispatcher('not over', $others, $subject, FALSE);
  }

  /**
   * Assert that subject(s) is/are visible.
   *
   * @param string $subjects
   *   Subjects as a string.
   *
   */
  public function assertRelativeVisible($subjects) {
    $subjects = $this->parseRelativeComponents($subjects);
    $errors = [];
    foreach ($subjects as $subject) {
      $pass = $this->relativeComponentIsVisible($this->relativeComponents[$subject]);
      if (!$pass) {
        $errors[] = sprintf("Component '%s' (%s) is not visible", $subject, $this->relativeComponents[$subject]);
      }
    }

    if (count($errors) > 0) {
      throw new \Exception(implode("\n", $errors));
    }
  }

  /**
   * Assert that subject(s) is/are invisible.
   *
   * @param string $subjects
   *   Subjects as a string.
   *
   * @Then /^I don't see ([a-zA-Z0-9\s\-\,]+)$/
   */
  public function assertRelativeHidden($subjects) {
    $subjects = $this->parseRelativeComponents($subjects);
    $errors = [];
    foreach ($subjects as $subject) {
      $pass = !$this->relativeComponentIsVisible($this->relativeComponents[$subject]);
      if (!$pass) {
        $errors[] = sprintf("Component '%s' (%s) is not invisible", $subject, $this->relativeComponents[$subject]);
      }
    }

    if (count($errors) > 0) {
      throw new \Exception(implode("\n", $errors));
    }
  }

  /**
   * Step to define componenets as background.
   *
   * @Given I define components:
   */
  public function iDefineComponents(TableNode $table) {
    foreach ($table->getRows() as $item) {
      list($name, $id) = $item;
      if ($name && $id) {
        $this->relativeComponents[$name] = $id;
      }
    }
  }

  /**
   * Assert that subject is focused.
   *
   * @param string $subject
   *   Subject as a string.
   *
   * @Then /^([a-zA-Z0-9\s,]+) has focus$/
   */
  public function assertRelativeFocused($subject) {
    $subject = $this->parseRelativeComponents($subject);
    $errors = [];
    if (count($subject) === 1) {
      $pass = $this->relativeComponentIsFocused($this->relativeComponents[$subject[0]]);
      if (!$pass) {
        $errors[] = sprintf("Component '%s' (%s) is not focused", $subject, $this->relativeComponents[$subject]);
      }
    }
    else {
      $errors[] = sprintf("More than one component provided, focus can only exist on a single element.");
    }

    if (count($errors) > 0) {
      throw new \Exception(implode("\n", $errors));
    }
  }

  /**
   * Click on one or multiple elements.
   *
   * @When /^(?:|I )click (?:a?|on) ([a-zA-Z0-9\s,\-]+)$/
   *
   * @javascript
   */
  public function assertRelativeClick($subjects) {
    $subjects = $this->parseRelativeComponents($subjects);

    if (empty($subjects)) {
      throw new \Exception('No components provided');
    }

    $errors = [];
    foreach ($subjects as $subject) {
      if (!$this->relativeComponentIsVisible($this->relativeComponents[$subject])) {
        $errors[] = sprintf("Unable to click on invisible component '%s' (%s)", $subject, $this->relativeComponents[$subject]);
        continue;
      }

      $session = $this->getSession();
      $xpath = $session->getSelectorsHandler()->selectorToXpath('css', $this->relativeComponents[$subject]);

      try {
        $this->getSession()->getDriver()->click($xpath);
      }
      catch (\Exception $e) {
        $errors[] = sprintf("Unable to click on component '%s' (%s): %s", $subject, $this->relativeComponents[$subject], $e->getMessage());
      }
    }

    if (count($errors) > 0) {
      throw new \Exception(implode("\n", $errors));
    }
  }

  /**
   * Centralised dispatcher for all relative assertions.
   *
   * Note that assertions for all elements will be assessed before failing.
   *
   * @param string $position
   *   Position name.
   * @param string $subject
   *   Subject name as a string.
   * @param string $others
   *   Other names as a string.
   * @param bool $scrollToOthers
   *   Optional flag to scroll to other components when performing geometry
   *   retrieval.
   *
   * @throws Exception
   *   If at least one assertion fails.
   */
  protected function relativeDispatcher($position, $subject, $others, $scrollToOthers = TRUE) {
    $subject = $this->parseRelativeComponents($subject);
    $others = $this->parseRelativeComponents($others);
    $errors = [];
    foreach ($subject as $subject_item) {
      foreach ($others as $other_item) {
        // Intercept any exceptions thrown by assertion method to allow
        // combining of errors within a single step definition.
        try {
          // Position may have 'not' in front of it - means negating the
          // condition.
          $positive = TRUE;
          $position_type = $position;
          if (strpos($position, 'not ') === 0) {
            $position_type = substr($position, strlen('not '));
            $positive = FALSE;
          }

          $pass = $this->assertRelativePosition($position_type, $subject_item, $other_item, $scrollToOthers);
          // Assertion did not pass when expected positive result, but got
          // fail.
          if (!$pass && $positive) {
            $errors[] = sprintf("Component '%s' is not in '%s' relative position to component '%s'", $subject_item, $position_type, $other_item);
          }
          // Assertion passed when expected negative result, but got pass.
          if ($pass && !$positive) {
            $errors[] = sprintf("Component '%s' is not in 'not %s' relative position to component '%s'", $subject_item, $position_type, $other_item);
          }
        }
        catch (\Exception $e) {
          $errors[] = $e->getMessage();
        }
      }
    }

    if (count($errors) > 0) {
      throw new \Exception(implode("\n", $errors));
    }
  }

  /**
   * Parse component names.
   *
   * @param string $text
   *   Component name as a string usually taken from the test step definition.
   *
   * @return array
   *   Array of parsed components.
   *
   * @throws Exception
   *   If provided components are not a part of the set of pre-configured
   *   components.
   */
  protected function parseRelativeComponents($text) {
    $components = preg_split("/\s*(,|and)\s*/", $text);

    $invalid_components = array_diff($components, array_keys($this->relativeComponents));
    if (count($invalid_components) > 0) {
      throw new \Exception(sprintf('Invalid components provided: %s', implode(',', $invalid_components)));
    }

    return $components;
  }

  /**
   * Assert relative position of 2 components.
   *
   * @todo Extend this to handle 'over' and 'under' absolutely positioned
   * elements.
   *
   * @param string $position
   *   Position identifier. One of: left, right, above, below, inside, outside.
   * @param string $component1
   *   Name of the first component.
   * @param string $component2
   *   Name of the second component.
   * @param bool $scrollToComponent2
   *   Optional flag to scroll to component2 when performing geometry retrieval.
   *
   * @return bool
   *   TRUE if components are positioned relatively correct, FALSE otherwise.
   *
   * @throws Exception
   *   If incorrect position is provided.
   */
  protected function assertRelativePosition($position, $component1, $component2, $scrollToComponent2 = TRUE) {
    $allowed = ['left', 'right', 'above', 'below', 'inside', 'outside', 'over'];
    if (!in_array($position, $allowed)) {
      throw new \Exception(sprintf("Invalid position %s specified", $position));
    }

    $c1_geometry = $this->getRelativeComponentGeometry($this->relativeComponents[$component1]);
    if (!$c1_geometry) {
      throw new \Exception(sprintf("Unable to retrieve geometry for component '%s' (%s)", $component1, $this->relativeComponents[$component1]));
    }

    $c2_geometry = $this->getRelativeComponentGeometry($this->relativeComponents[$component2], $scrollToComponent2);
    if (!$c2_geometry) {
      throw new \Exception(sprintf("Unable to retrieve geometry for component '%s' (%s)", $component2, $this->relativeComponents[$component2]));
    }

    $result = FALSE;
    switch ($position) {
      case 'left':
        $result = $c1_geometry['left'] + $c1_geometry['width'] <= $c2_geometry['left'];
        break;

      case 'right':
        $result = $c1_geometry['left'] >= $c2_geometry['left'] + $c2_geometry['width'];
        break;

      case 'above':
        $result = $c2_geometry['top'] >= $c1_geometry['top'] + $c1_geometry['height'];
        break;

      case 'below':
        $result = $c1_geometry['top'] >= $c2_geometry['top'] + $c2_geometry['height'];
        break;

      case 'inside':
        $result = TRUE;
        $result &= $c1_geometry['top'] >= $c2_geometry['top'];
        $result &= $c1_geometry['top'] + $c1_geometry['height'] <= $c2_geometry['top'] + $c2_geometry['height'];
        $result &= $c1_geometry['left'] >= $c2_geometry['left'];
        $result &= $c1_geometry['left'] + $c1_geometry['width'] <= $c2_geometry['left'] + $c2_geometry['width'];
        break;

      case 'outside':
        $result = TRUE;
        $result &= $c1_geometry['top'] <= $c2_geometry['top'];
        $result &= $c1_geometry['top'] + $c1_geometry['height'] >= $c2_geometry['top'] + $c2_geometry['height'];
        $result &= $c1_geometry['left'] <= $c2_geometry['left'];
        $result &= $c1_geometry['left'] + $c1_geometry['width'] >= $c2_geometry['left'] + $c2_geometry['width'];
        break;

      case 'over':
        $result = TRUE;
        $result &= $this->rectanglesIntersect($c1_geometry['left'], $c1_geometry['top'], $c1_geometry['width'], $c1_geometry['height'], $c2_geometry['left'], $c2_geometry['top'], $c2_geometry['width'], $c2_geometry['height']);
        $result &= $c1_geometry['zIndex'] <= $c2_geometry['zIndex'];
        break;
    }

    return $result;
  }

  /**
   * Check if two rectangles intersect.
   */
  protected function rectanglesIntersect($x1, $y1, $width1, $height1, $x2, $y2, $width2, $height2) {
    return !($x1 >= $x2 + $width2 || $x1 + $width1 <= $x2 || $y1 >= $y2 + $height2 || $y1 + $height1 <= $y2);
  }

  /**
   * Get relative component geometry data.
   *
   * Note that we are using oversimplified way to determine z-index of the
   * element without using Stacking Contexts, but this should cover majority of
   * cases.
   *
   * @param string $selector
   *   CSS selector.
   *
   * @return array|bool
   *   Array of component geometry: width, height, top, left or
   *   FALSE if component is not visible.
   */
  protected function getRelativeComponentGeometry($selector, $doScroll = TRUE) {
    return $this->executeRelativeJsOnCss($selector, "return (function(el) { 
        if (el.length) {" .
      ($doScroll ? "jQuery(window).scrollTop(el.offset().top);" : "")
      . "
          function zIndex(el) { var z = 0; el.add(el.parents()).each(function () { if ((jQuery(this).css('position') == 'absolute') && jQuery(this).css('z-index') != 'auto') { z = parseInt(jQuery(this).css('z-index'), 10); } }); return z; }                    
          if (el.is(':visible') && el.height() > 1 && !(el.css('clip') == 'rect(0px 0px 0px 0px)' && el.css('position') == 'absolute')){       
            return {
              width: el.outerWidth(),
              height: el.outerHeight(),
              top: Math.ceil(el.offset().top),  
              left: Math.ceil(el.offset().left),
              zIndex: zIndex(el),
              position: el.css('position')
            };
          }
        }  
        return false;
      })({{ELEMENT}});
    ");
  }

  /**
   * Check whether component is focused.
   *
   * @param string $selector
   *   CSS selector.
   *
   * @return bool
   *   TRUE if element is focused, FALSE if not focused or element is not
   *   present on the page.
   */
  protected function relativeComponentIsFocused($selector) {
    return $this->executeRelativeJsOnCss($selector, "return (function(el) {
        if (el.length) {
          return el.is(':focus');
        }       
        return false; 
      })({{ELEMENT}});
    ");
  }

  /**
   * Check whether component is visible on the page.
   *
   * @param string $selector
   *   CSS selector.
   *
   * @return bool
   *   TRUE if element is visible, FALSE if not visible or element is not
   *   present on the page.
   */
  protected function relativeComponentIsVisible($selector) {
    return $this->executeRelativeJsOnCss($selector, "return (function(el) {
        if (el.length) {
          jQuery(window).scrollTop(el.offset().top - {{OFFSET}});
          var rect = el.get(0).getBoundingClientRect();
          return el.is(':visible') && el.height() > 1 && !(el.css('clip') == 'rect(0px 0px 0px 0px)' && el.css('position') == 'absolute') && !(
            rect.left + rect.width <= 0  
            || rect.top + rect.height <= 0
            || rect.left >= window.innerWidth 
            || rect.top >= window.innerHeight
          );
        }       
        return false; 
      })({{ELEMENT}});
    ");
  }

  /**
   * Executes JS on an element provided by CSS.
   */
  protected function executeRelativeJsOnCss($selector, $script) {
    // Inject style to disable browser scrollbars.
    $script_wrapper = "return (function() {
        if (jQuery('head #relative_style').length ==0) { 
          jQuery('<style id=\"relative_style\" type=\"text/css\">::-webkit-scrollbar{display: none;}</style>').appendTo(jQuery('head')); 
        }
        {{SCRIPT}}
      }());
    ";
    $script = str_replace('{{ELEMENT}}', "jQuery('$selector')", $script);
    $script = str_replace('{{SCRIPT}}', $script, $script_wrapper);
    $script = str_replace('{{OFFSET}}', $this->offset, $script);
    $driver = $this->getSession()->getDriver();

    return $driver->evaluateScript($script);
  }

}
