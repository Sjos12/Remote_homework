Feature: Registration flow
    I need to register an account
    As a new customer
    In order to make use of the advertised features

    Scenario: Go to registration form
        Given I am on "/"
        And I follow "Register"
        Then I should be on "/register"

    Scenario: Register new account
        Given I am on "/register"
        When I fill in "name" with "Jane Doe"
        And I fill in "email" with "jane@example.com"
        And I fill in "password" with "test1234"
        And I fill in "password_confirmation" with "test1234"
        And I press "Register"
        Then I should be on "/"
        And I should see "Jane Doe"
        And I should see "My questions"

    Scenario Outline: Registration form validation
        Given I am on "/register"
        When I fill in "name" with "<name>"
        And I fill in "email" with "<email>"
        And I fill in "password" with "<password>"
        And I fill in "password_confirmation" with "<password_confirmation>"
        And I press "Register"
        Then I should see "<validation_error_message>"

        Examples:
            |name|email|password|password_confirmation|validation_error_message|
            |    |jane@example.com|test1234|test1234|The name field is required.|
            |Jane|               |test1234|test1234|The email field is required.|
            |Jane|iamnotemailjane|test1234|test1234|The email must be a valid email address.|
            |Jane|jane@example.com|        |test1234|The password field is required.|
            |Jane|jane@example.com|test1234|        |The password confirmation does not match.|
            |Jane|jane@example.com|test1234|4321test|The password confirmation does not match.|
