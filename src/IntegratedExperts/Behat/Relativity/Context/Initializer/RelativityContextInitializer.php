<?php
/**
 * @file
 * This file is a part of the IntegratesExperts\BehatRelativity package.
 */

namespace IntegratedExperts\Behat\Relativity\Context\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use IntegratedExperts\Behat\Relativity\Context\RelativityContextInterface;

/**
 * Class RelativityContextInitializer.
 */
class RelativityContextInitializer implements ContextInitializer
{
    /**
     * Array of relative components.
     *
     * Array keys are component names and values are CSS selectors.
     *
     * @var array
     */
    protected $components;

    /**
     * Vertical offset.
     *
     * Used to offset vertical position when retrieving component dimensions.
     *
     * @var int
     */
    protected $offset;

    /**
     * Array of screen sizes.
     *
     * @var array
     */
    protected $breakpoints;

    /**
     * jQuery version.
     *
     * If set to false, jQuery will not be injected.
     *
     * @var string
     */
    protected $jqueryVersion;

    /**
     * Set context parameters.
     *
     * @param array  $components    Keys are component names and
     *                              values are CSS selectors.
     * @param int    $offset        Used to offset vertical position when
     *                              retrieving component dimensions.
     * @param array  $breakpoints   Screen sizes.
     * @param string $jqueryVersion jQuery version.
     */
    public function __construct($components, $offset, $breakpoints, $jqueryVersion)
    {
        $this->components = $components;
        $this->offset = $offset;
        $this->breakpoints = $breakpoints;
        $this->jqueryVersion = $jqueryVersion;
    }

    /**
     * Init values required for relativity context.
     *
     * @param \Behat\Behat\Hook\Scope\BeforeScenarioScope $scope Scenario scope.
     *
     * @BeforeScenario
     */
    public function init(BeforeScenarioScope $scope)
    {
        $defaultScreenSize = [];
        foreach ($this->breakpoints as $breakpoint) {
            if (isset($breakpoint['default']) && $breakpoint['default'] === true) {
                $defaultScreenSize = $breakpoint;
            }
        }

        if (count($defaultScreenSize) > 0) {
            $this->getSession()->resizeWindow(
              $defaultScreenSize['width'],
              $defaultScreenSize['height'],
              'current'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function initializeContext(Context $context)
    {
        if ($context instanceof RelativityContextInterface) {
            $context->setParameters($this->components, $this->offset, $this->breakpoints, $this->jqueryVersion);
        }
    }
}
