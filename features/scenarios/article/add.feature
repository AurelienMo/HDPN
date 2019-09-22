@api
@api_article

Feature: As an auth user, I need to be able to add article to sell
  Background:
    Given I load following file "account/authentication.yml"
    And I load following file "brand/brand.yml"

  Scenario: [Fail] No auth
    When I send a "POST" request to "/api/articles" with body:
    """
    {
    }
    """
    Then the response status code should be 401

  Scenario: [Fail] Empty payload
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/articles" with body:
    """
    {
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "name": [
            "Le nom de l'article est requis."
        ],
        "price": [
            "Le prix de l'article est requis."
        ],
        "gender": [
            "Le type de jouet est requis."
        ]
    }
    """

  Scenario: [Success] Success adding article with no description
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/articles" with body:
    """
    {
        "name": "Article 1",
        "price": 10.0,
        "gender": "boy"
    }
    """
    Then the response status code should be 201
    And object on entity "App\Entity\Article" with property "name" and value "Article 1" should be exist

  Scenario: [Success] Success adding with new brand
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/articles" with body:
    """
    {
        "name": "Article 1",
        "price": 10.0,
        "gender": "boy",
        "brand": "Mark 1"
    }
    """
    Then the response status code should be 201
    And object on entity "App\Entity\Article" with property "name" and value "Article 1" should be exist
    And object on entity "App\Entity\Brand" with property "name" and value "Mark 1" should be exist


  Scenario: [Success] Success adding with new brand
    And object "App\Entity\Brand" with property "name" as value "Smoby" should have following id "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/articles" with body:
    """
    {
        "name": "Article 1",
        "price": 10.0,
        "gender": "boy",
        "brand": "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"
    }
    """
    Then the response status code should be 201
    And object on entity "App\Entity\Article" with property "name" and value "Article 1" should be exist
    And article "Article 1" should have brand name "Smoby"

  Scenario: [Success] Success adding article with full informations
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/articles" with body:
    """
    {
        "name": "Article 1",
        "price": 10.0,
        "gender": "boy",
        "brand": "Mark 1",
        "min": 3,
        "max": 7
    }
    """
