<?php

use Behat\Behat\Tester\Exception\PendingException;


/**
 * Class ApiFeatureContext
 */
class ApiFeatureContext extends FeatureContext
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    /**
     * ApiFeatureContext constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @Given I request list of posts from :fullUrlToPosts
     * @param string $fullUrlToPosts
     * @return bool
     */
    public function iRequestListOfPostsFrom(string $fullUrlToPosts)
    {
        $this->response = $this->client->get($fullUrlToPosts);
        return true;
    }

    /**
     * @When I receive response the status code should be :arg1
     */
    public function iReceiveResponseTheStatusCodeShouldBe(int $arg1)
    {
        /** @var int $statusCode */
        $statusCode = $this->response->getStatusCode();
        if ($arg1 !== $statusCode) {
            throw new Exception("Expected status code to be {$arg1} but received : ". $statusCode);
        }
        return true;
    }

    /**
     * @Then The title of first post should be :arg1
     */
    public function theTitleOfFirstPostShouldBe($arg1)
    {
        /** @var string $json */
        $json = $this->response->getBody()->getContents();

        /** @var object[] $decoded */
        $decoded = json_decode($json);

        /** @var object $firstPost */
        $firstPost = $decoded[0];

        if ($arg1 !== $firstPost->title) {
            throw new Exception('Expected post title to be '.$arg1.' but got : '. $firstPost->title);
        }
        return true;
    }

}