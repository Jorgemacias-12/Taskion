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
      'action' => 'postLogin',
      'method' => 'POST'
    ],
  ],

  // Más rutas...
];
