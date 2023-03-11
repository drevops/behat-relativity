<?php
/**
 * @file
 * This file is a part of the IntegratesExperts\BehatRelativity package.
 */

namespace DrevOps\BehatRelativityExtension\Context\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use DrevOps\BehatRelativityExtension\Context\RelativityAwareContext;

/**
 * Class RelativityContextInitializer.
 */
class RelativityContextInitializer implements ContextInitializer
{

    /**
     * Array of relative components.
     *
     * @var array
     */
    protected $components;

    /**
     * Vertical offset.
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
     * {@inheritdoc}
     */
    public function initializeContext(Context $context)
    {
        if (!$context instanceof RelativityAwareContext) {
            return;
        }

        $context->setComponents($this->components);
        $context->setBreakpoints($this->breakpoints);
        $context->setOffset($this->offset);
        $context->setJqueryVersion($this->jqueryVersion);
    }
}
