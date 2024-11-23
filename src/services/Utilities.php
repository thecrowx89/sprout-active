<?php
/**
 * @link      https://sprout.thecrowx89design.com
 * @copyright Copyright (c) Barrel Strength Design LLC
 * @license   MIT
 */

namespace thecrowx89\sproutactive\services;

use Craft;
use craft\base\Component;

/**
 * @property string $url
 */
class Utilities extends Component
{
    /**
     * Check to see if a string matches a segment in the URL
     *
     * @param $string
     * @param $segment
     *
     * @return bool
     */
    public function match(string $string, int|string $segment): bool
    {
        if (!Craft::$app->getRequest()->getIsSiteRequest()) {
            return false;
        }

        $matchString = $this->processSegment($segment);
        $string = Craft::getAlias($string);
        $matchOptions = explode('|', $string);
        
        return in_array($matchString, $matchOptions, true);
    }

    /**
     * Determine how to process the segment requested
     *
     * @param mixed $segment Segment number or keyword
     *
     * @return string         Segment, Path, or Full URL
     */
    public function processSegment(int|string $segment): ?string
    {
        if (!Craft::$app->getRequest()->getIsSiteRequest()) {
            return null;
        }

        return match ($segment) {
            'url' => $this->getUrl(),
            'path' => Craft::$app->getRequest()->getFullPath(),
            default => Craft::$app->getRequest()->getSegment((int)$segment),
        };
    }

    /**
     * Get the URL
     *
     * @return string
     */
    private function getUrl(): string
    {
        $request = Craft::$app->getRequest();
        $sites = Craft::$app->getSites();
        
        if (defined('CRAFT_SITE_URL')) {
            return CRAFT_SITE_URL . $request->getUrl();
        }

        $site = $sites->getCurrentSite();
        $baseUrl = rtrim($site->getBaseUrl(), '/');
        
        $omitScriptNameInUrls = Craft::$app->getConfig()->getGeneral()->omitScriptNameInUrls;
        $usePathInfo = Craft::$app->getConfig()->getGeneral()->usePathInfo;
        
        if ($omitScriptNameInUrls || $usePathInfo) {
            return $baseUrl . '/' . $request->getPathInfo();
        }

        return $baseUrl . '/index.php/' . $request->getPathInfo();
    }
}

