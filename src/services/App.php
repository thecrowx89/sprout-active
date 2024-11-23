<?php
/**
 * @link      https://sprout.thecrowx89design.com
 * @copyright Copyright (c) Barrel Strength Design LLC
 * @license   MIT
 */

 namespace thecrowx89\sproutactive\services;

 use craft\base\Component;
 
 class App extends Component
 {
    /**
     * @var Utilities
     */
     public Utilities $utilities;
 
     public function init(): void
     {
         parent::init();
         $this->utilities = new Utilities();
     }
 }