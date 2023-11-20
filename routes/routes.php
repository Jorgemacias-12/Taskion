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
  ],
  'app' => [
    'GET' => [
      'controller' => 'AppController',
      'action' => 'getApp',
      'method' => 'GET'
    ]
  ],
  'app/projects' => [
    'GET' => [
      'controller' => 'AppController',
      'action' => 'showProjects',
      'method' => 'GET'
    ]
  ],
  'app/tasks' => [
    'GET' => [
      'controller' => 'AppController',
      'action' => 'showTasks',
      'method' => 'GET'
    ]
  ],
  'app/tasks/create' => [
    'GET' => [
      'controller' => 'AppController',
      'action' => 'showTaskForm',
      'method' => 'GET'
    ],
    'POST' => [
      'controller' => 'AppController',
      'action' => 'createTask',
      'method' => 'POST'
    ]
  ],
  'app/projects/create' => [
    'GET' => [
      'controller' => 'AppController',
      'action' => 'showProjectForm',
      'method' => 'GET'
    ],
    'POST' => [
      'controller' => 'AppController',
      'action' => 'createProject',
      'method' => 'POST'
    ]
  ],
  'app/user/edit' => [
    'GET' => [
      'controller' => 'UserController',
      'action' => 'showUserProfile',
      'method' => 'GET'
    ]
  ]
  // Más rutas...
];
