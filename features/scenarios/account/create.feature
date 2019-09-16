@api
@api_account

Feature: As an anonymous user, I need to registration
  Background:
    When I load following file "account/authentication.yml"

  Scenario: [Fail] Send request with no payload
    When I send a "POST" request to "/api/account/anon/create" with body:
    """
    {
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "username": [
            "Le nom d'utilisateur est requis."
        ],
        "email": [
            "L'adresse email est requise."
        ],
        "password": [
            "Le mot de passe est requis."
        ]
    }
    """

  Scenario: [Fail] Send request with already user exist
    When I send a "POST" request to "/api/account/anon/create" with body:
    """
    {
        "username": "johndoe",
        "email": "janedoe@yopmail.com",
        "password": "12345678"
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "": [
            "Utilisateur déjà existant."
        ]
    }
    """

  Scenario: [Fail] Send request with invalid email
    When I send a "POST" request to "/api/account/anon/create" with body:
    """
    {
        "username": "janedoe",
        "email": "janedoe",
        "password": "12345678"
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "email": [
            "Le format de l'adresse email n'est pas valide."
        ]
    }
    """

  Scenario: [Fail] Send request with too short password
    When I send a "POST" request to "/api/account/anon/create" with body:
    """
    {
        "username": "janedoe",
        "email": "janedoe@yopmail.com",
        "password": "123456"
    }
    """
    Then the response status code should be 400
    And the JSON should be equal to:
    """
    {
        "password": [
            "Le mot de passe doit faire 8 caractères minimum."
        ]
    }
    """

  Scenario: [Success] Successful registration and get login datas
    When I send a "POST" request to "/api/account/anon/create" with body:
    """
    {
        "username": "janedoe",
        "email": "janedoe@yopmail.com",
        "password": "12345678"
    }
    """
    Then the response status code should be 201
