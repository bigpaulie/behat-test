Feature: Test Posts
  We are so cool, we are going to test the fake API

  Scenario:
    Given I request list of posts from "https://my-json-server.typicode.com/typicode/demo/posts"
    When I receive response the status code should be "200"
    Then The title of first post should be "Post 1"