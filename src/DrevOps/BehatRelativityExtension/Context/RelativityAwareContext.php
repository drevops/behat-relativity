<?php
/**
 * @file
 * Behat context interface to enable Relativity.
 */

namespace DrevOps\BehatRelativityExtension\Context;

use Behat\Behat\Context\Context;

/**
 * Interface RelativityAwareContext.
 */
interface RelativityAwareContext extends Context
{

    /**
     * Set components.
     *
     * @param array $components Array of components CSS query selectors keyed
     *                          by name.
     */
    public function setComponents($components);

    /**
     * Set breakpoints.
     *
     * @param array $breakpoints Array of breakpints keyed by name.
     */
    public function setBreakpoints($breakpoints);

    /**
     * Set offset.
     *
     * @param int $offset Vertical offset in pixels from the top of the page to
     *                    scroll viewport before retrieving elements geometry.
     */
    public function setOffset($offset);

    /**
     * Set jQuery version that is injected on the page.
     *
     * @param string|bool $version jQuery version in format 'x.y.z'. If set to
     *                             boolean 'false', jQuery will not be
     *                             injected.
     */
    public function setJqueryVersion($version);
}
