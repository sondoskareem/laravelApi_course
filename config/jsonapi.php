<?php

return [
    'resources' => [
        'users' => [
            'allowedSorts'=> [
                'name',
                'email',
            ],
            'allowedIncludes' => [
                'comments',
            ],
            'validationRules'=> [
                    'create' => [
                        'data.attributes.name' => 'required|string',
                        'data.attributes.email' => 'required|email',
                        'data.attributes.password' => 'required|string',
                        
                    ],
                    'update' => [
                        'data.attributes.name' => 'sometimes|required|string',
                        'data.attributes.email' => 'sometimes|required|email',
                        'data.attributes.password' => 'sometimes|required|string
                        ',
                        
                    ]
            ],
            'allowedFilters' => [
                Spatie\QueryBuilder\AllowedFilter::exact('role'),
                ],
            'relationships' => [
                [
                    'type' => 'comments',
                    'method' => 'comments',
                ]
            ]
        ],
        'authors' => [ 
            'allowedSorts' => [
                    'name',
                    'created_at',
                    'updated_at',
                    ],
            'allowedIncludes' => [
                        'books'
                    ],
            'validationRules'=> [
                    'create' => [
                        'data.attributes.name' => 'required|string',
                        ],
                    'update' => [
                        'data.attributes.name' => 'sometimes|required|
                        string',
                        ]
                    ],
            'allowedFilters' => [],
                        
            'relationships' => [
                        [
                            'type' => 'books',
                            'method' => 'books',
                        ]
                    ]
                        
            ],
        'books' => [
            'allowedSorts'=> [
                'title',
                'publication_year',
                'created_at',
                'updated_at',
                ],
            'validationRules'=> [
                    'create' => [
                        'data.attributes.title' => 'required|string',
                        'data.attributes.description' => 'required|string',
                        'data.attributes.publication_year' => 'required|string',
                        ],
                    'update' => [
                        'data.attributes.title' => 'sometimes|required|string',
                        'data.attributes.description' => 'sometimes|required|string',
                        'data.attributes.publication_year' => 'sometimes|required|string',
                        ]
                    ],
            'allowedFilters' => [],
            'allowedIncludes' => [
                    'authors'
                    ],
            'relationships' => [
                [
                    'type' => 'authors',
                    'method' => 'authors',
                ] ,
                [
                    'type' => 'comments',
                    'method' => 'comments',
                ]

            ]
                ],
        'comments' => [

            'allowedSorts'=> ['created_at'],
            
            'allowedIncludes' => 
                        [
                            'books',
                            'users',
                        ],
            'allowedFilters' => [],
            'validationRules'=> 
                        [
                            'create' => ['data.attributes.message' => 'required|string',],
                            'update' => ['data.attributes.message' => 'sometimes|required|string',]
                        ],
            'relationships' => [
                        [
                            'type' => 'books',
                            'method' => 'books',
                        ],
                        [
                            'type' => 'users',
                            'method' => 'users',
                        ],
                    ]
            ]
                    
    ]
];