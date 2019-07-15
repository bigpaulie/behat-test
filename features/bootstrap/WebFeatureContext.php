<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;

/**
 * Class WebFeatureContext
 */
class WebFeatureContext extends FeatureContext
{
    /**
     * @var Mink
     */
    private $mink;

    /**
     * WebFeatureContext constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->mink = new Behat\Mink\Mink([
            'browser' => new Session(new ChromeDriver('http://localhost:9222', null, 'http://www.google.com'))
        ]);
        $this->mink->setDefaultSessionName('browser');
    }

    /**
     * @Given I go to wikipedia homepage :arg1
     */
    public function iGoToWikipediaHomepage($arg1)
    {
        $this->mink->getSession()->visit($arg1);
        return true;
    }

    /**
     * @When I search for :arg1
     */
    public function iSearchFor($arg1)
    {
        /** @var \Behat\Mink\Element\DocumentElement $page */
        $page = $this->mink->getSession()->getPage();
        $page->fillField('search', $arg1);
    }

    /**
     * @When I click on the search button
     */
    public function iClickOnTheSearchButton()
    {
        /** @var \Behat\Mink\Element\DocumentElement $page */
        $page = $this->mink->getSession()->getPage();
        $page->pressButton('go');
        $this->mink->getSession()->wait(2000);
    }

    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {
        $page = $this->mink->getSession()->getPage();
        /** @var \Behat\Mink\Element\NodeElement|null $element */
        $element = $page->find('css','#firstHeading');
        if (empty($element)) {
            throw new Exception('Cannot find element #firstHeading');
        }

        if ($arg1 != $element->getText()) {
            throw new Exception('Expected '. $arg1. ' but got : '. $element->getText());
        }

        /** @var ChromeDriver $driver */
        $driver = $this->mink->getSession()->getDriver();
        $driver->captureScreenshot(realpath(__DIR__ . '/../../') . '/screenshots/' . time() . '.png');
        return true;
    }
}