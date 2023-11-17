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

  // Más rutas...
];
