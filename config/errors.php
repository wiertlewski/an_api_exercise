<?php

return [
    'Alpha' => [
        'status' => 400,
        'message' => 'Items field is required and cannot be empty.',
        'log' => 'Missing payload: items',
    ],
    'Bravo' => [
        'status' => 400,
        'message' => 'Pack Size field is required and cannot be empty.',
        'log' => 'Missing payload: size',
    ],
    'Charlie' => [],
    'Delta' => [],
    'Echo' => [
        'status' => 400,
        'message' => 'Pack Size with requested identifier not found.',
        'log' => 'Pack Size not found in database',
    ],
    'Foxtrot' => [
        'status' => 400,
        'message' => 'Pack Size already exists.',
        'log' => 'Pack Size found in database',
    ],
    'Golf' => [
        'status' => 503,
        'message' => 'Pack Size has not been created',
        'log' => 'Error! Could not create the size',
    ],
    'Hotel' => [],
    'India' => [
        'status' => 503,
        'message' => 'Pack Size has not been deleted',
        'log' => 'Error! Could not delete the size',
    ],
    'Juliet' => [
        'status' => 400,
        'message' => 'Invalid size.',
        'log' => 'Invalid payload: size',
    ],
    'Kilo' => [],
    'Lima' => [],
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
