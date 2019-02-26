# an_api_exercise

[![Software License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Build Status](https://api.travis-ci.org/wiertlewski/an_api_exercise.svg?branch=packsize)](https://travis-ci.org/wiertlewski/an_api_exercise)

An API exercise

## Docker

Run docker-compose to start local development.

``` bash
$ docker-compose up
```

## Database

Run create_database task to create local (docker) database.

``` bash
$ php tasks/create_database.php 127.0.0.1 root password
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

## Create Pack Size

Add pack size API endpoint.

**Request**

    url: /size,
    method: POST,
    headers:
        "Content-Type": "application/x-www-form-urlencoded"
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"
    payload:
        "size": int

**Example**

[POST] http://localhost/size

payload: `{ "size": 999 }`

**Failures**

* Pack Size field is required and cannot be empty
* Invalid size
* Pack Size already exists

## Read Pack Size

Find pack size API endpoint.

**Request**

    url: /size,
    method: GET,
    header:
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"
    params:
        "id": "string"
        "size": "string"

**Examples**

[GET] http://localhost/size

[GET] http://localhost/size?id=1

[GET] http://localhost/size?size=999

## Delete Pack Size

Remove pack size API endpoint.

**Request**

    url: /size/{id},
    method: DELETE,
    header:
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"

**Example**

[DELETE] http://localhost/size/1

**Failures**

* Pack Size with requested identifier not found

## Calculate Number Of Packs

Find number of packs size API endpoint.

**Request**

    url: /calculate/{items},
    method: GET,
    header:
        "Authorization": "Basic dGVzdGVyOmV4ZXJjaXNl"

**Examples**

[GET] http://localhost/calculate/1001

**Failures**

* Pack Sizes not found

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
