# an_api_exercise

[![Software License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Build Status](https://api.travis-ci.org/wiertlewski/an_api_exercise.svg?branch=master)](https://travis-ci.org/wiertlewski/an_api_exercise)

An API exercise

## Docker

Run docker-compose to start local development.

``` bash
$ docker-compose up
```

## Database

Run create_database task to create local (docker) database.

``` bash
$ php tasks/create_database.php
```

## Basic Token Authorization

Get token from base64 encoded colon separated username and password.

```
base64_encode($username . ':' . $password)
```

Include Authorization basic token with every request.

``` bash
$ Authorization: Basic dGVzdGVyOmV4ZXJjaXNl
```

## Create User

Register user API endpoint.

**Request**

    url: /user,
    method: POST,
    headers:
        "Content-Type": "application/x-www-form-urlencoded"
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"
    payload:
        "email": "string"
        "forename": "string"
        "surname": "string"

**Example**

[POST] http://localhost/user

payload: `{ "email": "test@tester.com", "forename": "Test", "surname": "Tester" }`

**Failures**

* Email field is required and cannot be empty
* Forename field is required and cannot be empty
* Surname field is required and cannot be empty
* Invalid email format
* Invalid forename. Only letters and white space allowed.
* Invalid surname. Only letters and white space allowed.
* User with requested email already exists

## Read User

Find user API endpoint.

**Request**

    url: /user,
    method: GET,
    header:
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"
    params:
        "id": "string"
        "email": "string"

**Examples**

[GET] http://localhost/user

[GET] http://localhost/user?id=1

[GET] http://localhost/user?email=test@tester.com

## Update User

Edit user API endpoint.

**Request**

    url: /user/{id},
    method: PUT,
    headers:
        "Content-Type": "application/x-www-form-urlencoded"
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"
    payload:
        "email": "string"
        "forename": "string"
        "surname": "string"

**Example**

[PUT] http://localhost/user/1

payload: `{ "email": "test@tester.com", "forename": "New", "surname": "Tester" }`

**Failures**

* Email field is required and cannot be empty
* Forename field is required and cannot be empty
* Surname field is required and cannot be empty
* Invalid email format
* Invalid forename. Only letters and white space allowed.
* Invalid surname. Only letters and white space allowed.
* User with requested identifier not found

## Delete User

Remove user API endpoint.

**Request**

    url: /user/{id},
    method: DELETE,
    header:
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"

**Example**

[DELETE] http://localhost/user/1

**Failures**

* User with requested identifier not found

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
