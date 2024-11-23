<?php
/**
 * @link      https://sprout.barrelstrengthdesign.com
 * @copyright Copyright (c) Barrel Strength Design LLC
 * @license   MIT
 */

namespace barrelstrength\sproutactive;

use barrelstrength\sproutactive\services\App;
use barrelstrength\sproutactive\web\twig\TwigExtensions;
use Craft;
use craft\base\Plugin;
use yii\base\InvalidConfigException;
use barrelstrength\sproutactive\services\Utilities;
use craft\web\View;

class SproutActive extends Plugin
{
    /**
     * Enable use of SproutActive::$app-> in place of Craft::$app->
     *
     * @var App
     */
    public static $app;

    /**
     * @var string
     */
    public $schemaVersion = '3.0.0';

    public bool $hasCpSettings = false;
    
    public bool $hasCpSection = false;

    /**
     * @var Utilities
     */
    public Utilities $utilities;

    public static function config(): array
    {
        return [
            'components' => [
                'utilities' => Utilities::class,
            ],
        ];
    }

    /**
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();

        // Initialize utilities service
        $this->utilities = new Utilities();

        // Register Twig extensions
        if (Craft::$app->getRequest()->getIsSiteRequest()) {
            Craft::$app->getView()->registerTwigExtension(new TwigExtensions());
        }
    }
}
