<?php
/**
 * @link      https://sprout.barrelstrengthdesign.com
 * @copyright Copyright (c) Barrel Strength Design LLC
 * @license   MIT
 */

 namespace barrelstrength\sproutactive\web\twig;

 use barrelstrength\sproutactive\SproutActive;
 use Craft;
 use Twig\Extension\AbstractExtension;
 use Twig\TwigFunction;

class TwigExtensions extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Sprout Active';
    }

    /**
     * Makes the filters available to the template context
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('active', [$this, 'getActive']),
            new TwigFunction('activeClass', [$this, 'getActiveClass'], [
                'is_safe' => ['html'],
            ]),
            new TwigFunction('segment', [$this, 'getSegment']),
            new TwigFunction('segmentClass', [$this, 'getSegmentClass'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    /**
     * Output the classname if conditions match
     *
     * @param string  $string    Value from URL to use in test
     * @param integer $segment   URL segment to test against
     * @param string  $className Value of CSS class to return to template
     *
     * @return string|null
     */
    public function getActive(
        string $string = '', 
        int $segment = 1, 
        string $className = 'active'
    ): ?string {
        if (!Craft::$app->getRequest()->getIsSiteRequest()) {
            return null;
        }

        $match = SproutActive::getInstance()->utilities->match($string, $segment);
        return $match ? $className : null;
    }

    /**
     * Output the classname and class parameter if conditionals match
     *
     * @param string  $string    Value from URL to use in test
     * @param integer $segment   URL segment to test against
     * @param mixed   $className Value of CSS class to return to template
     *
     * @return mixed OR null
     */
    public function getActiveClass(
        string $string = '', 
        int $segment = 1, 
        string $className = 'active'
    ): ?string {
        if (!Craft::$app->getRequest()->getIsSiteRequest()) {
            return null;
        }

        $match = SproutActive::getInstance()->utilities->match($string, $segment);
        return $match ? 'class="' . htmlspecialchars($className, ENT_QUOTES) . '"' : null;
    }

    /**
     * Output the segment if conditions match
     *
     * @param integer $segment URL segment to test for
     *
     * @return string|null   Value of URL segment if it exists
     */
    public function getSegment(?int $segment = null): ?string
    {
        if (!Craft::$app->getRequest()->getIsSiteRequest()) {
            return null;
        }

        return Craft::$app->getRequest()->getSegment($segment);
    }

    /**
     * Output the segment and class parameter if conditions match
     *
     * @param integer $segment URL segment to test for
     *
     * @return mixed OR null    Value of URL segment wrapped in class parameter if it exists
     */
    public function getSegmentClass(?int $segment = null): ?string
    {
        if (!Craft::$app->getRequest()->getIsSiteRequest()) {
            return null;
        }

        $segment = Craft::$app->getRequest()->getSegment($segment);
        return $segment ? 'class="' . htmlspecialchars($segment, ENT_QUOTES) . '"' : null;
    }
}
