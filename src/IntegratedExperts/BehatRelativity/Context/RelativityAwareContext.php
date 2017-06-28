<?php
/**
 * @file
 * Behat context interface to enable Relativity.
 */

namespace IntegratedExperts\BehatRelativity\Context;

use Behat\Behat\Context\Context;

/**
 * Interface RelativityContext.
 */
interface RelativityAwareContext extends Context
{

    /**
     * Set context parameters.
     *
     * @param array  $components
     * @param int    $offset
     * @param array  $breakpoints
     * @param string $jqueryVersion
     *
     * @return $this
     */
    public function setParameters($components, $offset, $breakpoints, $jqueryVersion);
}
