<?php
declare(strict_types=1);

use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
final class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
}
