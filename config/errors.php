<?php

return [
    'Alpha' => [],
    'Bravo' => [
        'status' => 400,
        'message' => 'Email field is required and cannot be empty.',
        'log' => 'Missing payload: email',
    ],
    'Charlie' => [
        'status' => 400,
        'message' => 'Forename field is required and cannot be empty.',
        'log' => 'Missing payload: forename',
    ],
    'Delta' => [
        'status' => 400,
        'message' => 'Surname field is required and cannot be empty.',
        'log' => 'Missing payload: surname',
    ],
    'Echo' => [
        'status' => 400,
        'message' => 'User with requested identifier not found.',
        'log' => 'User not found in database',
    ],
    'Foxtrot' => [
        'status' => 400,
        'message' => 'User with requested email already exists.',
        'log' => 'User found in database',
    ],
    'Golf' => [
        'status' => 503,
        'message' => 'User has not been created',
        'log' => 'Error! Could not create the user',
    ],
    'Hotel' => [
        'status' => 503,
        'message' => 'User has not been updated',
        'log' => 'Error! Could not update the user',
    ],
    'India' => [
        'status' => 503,
        'message' => 'User has not been deleted',
        'log' => 'Error! Could not delete the user',
    ],
    'Juliet' => [
        'status' => 400,
        'message' => 'Invalid email format.',
        'log' => 'Invalid payload: email',
    ],
    'Kilo' => [
        'status' => 400,
        'message' => 'Invalid forename. Only letters and white space allowed.',
        'log' => 'Invalid payload: forename',
    ],
    'Lima' => [
        'status' => 400,
        'message' => 'Invalid surname. Only letters and white space allowed.',
        'log' => 'Invalid payload: surname',
    ],
    'Mike' => [],
    'November' => [],
    'Oscar' => [],
    'Papa' => [],
    'Quebec' => [],
    'Romeo' => [],
    'Sierra' => [],
    'Tango' => [],
    'Uniform' => [],
    'Victor' => [],
    'Whiskey' => [],
    'Xray' => [],
    'Yankee' => [],
    'Zulu' => [],
];
