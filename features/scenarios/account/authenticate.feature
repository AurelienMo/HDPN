@api
@api_account

Feature: As an anonymous user, I need to be able to login and obtain token
  Background:
    When I load following file "account/authentication.yml"

  Scenario: [Fail] Fail authentication
    When Send auth request with method "POST" request to "/api/login_check" with username "johndoe@yopmail.com" and password "123456789"
    Then the response status code should be 401
    And the JSON should be equal to:
    """
    {
        "code": 401,
        "message": "Identifiants invalides"
    }
    """

  Scenario: [Success] Successfull login & obtain token
    When Send auth request with method "POST" request to "/api/login_check" with username "johndoe@yopmail.com" and password "12345678"
    Then the response status code should be 200
    And the JSON node "token" should exist
    And the JSON node "refresh_token" should exist
    And the JSON node "user.id" should exist
    And the JSON node "user.username" should be equal to "johndoe"
    And the JSON node "user.email" should be equal to "johndoe@yopmail.com"
    And the JSON node "user.firstname" should exist
    And the JSON node "user.lastname" should exist
    And the JSON node "user.gender" should exist
    And the JSON node "token_ttl" should be equal to 3600
