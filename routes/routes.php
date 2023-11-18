<?php

return [
  '' => [
    'GET' => [
      'controller' => 'IndexController',
      'action' => 'index',
      'method' => 'GET'
    ]
  ],
  'login' => [
    'GET' => [
      'controller' => 'AuthController',
      'action' => 'getLogin',
      'method' => 'GET'
    ],
    'POST' => [
      'controller' => 'AuthController',
      'action' => 'doLogin',
      'method' => 'POST'
    ],
  ],
  'register' => [
    'GET' => [
      'controller' => 'AuthController',
      'action' => 'getRegister',
      'method ' => 'GET',
    ],
    'POST' => [
      'controller' => 'AuthController',
      'action' => 'doRegister',
      'method ' => 'POST',
    ]
  ]
  // Más rutas...
];
