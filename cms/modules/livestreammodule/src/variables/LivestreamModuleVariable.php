<?php
/**
 * Livestream Module module for Craft CMS 3.x
 *
 * Craftquest module
 *
 * @link      https://bitsandbytes.be
 * @copyright Copyright (c) 2020 Pieter-Jan Geeroms
 */

namespace modules\livestreammodule\variables;

use modules\livestreammodule\LivestreamModule;

use Craft;

/**
 * Livestream Module Variable
 *
 * Craft allows modules to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.livestreamModule }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Pieter-Jan Geeroms
 * @package   LivestreamModule
 * @since     1.0.0
 */
class LivestreamModuleVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.livestreamModule.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.livestreamModule.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }

    public function htmlentities(string $string) {
        return htmlentities($string);
    }


}
