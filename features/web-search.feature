Feature: Search Wikipedia
  Scenario:
    Given I go to wikipedia homepage "https://en.wikipedia.org/wiki/Main_Page"
    When I search for "Behavior driven development"
    And I click on the search button
    Then I should see "Behavior-driven development"

  Scenario:
    Given I am on page "https://en.wikipedia.org/wiki/Behavior-driven_development"
    When I click on "software engineering"
    Then I should see "Software engineering"
