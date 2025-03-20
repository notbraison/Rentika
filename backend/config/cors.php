<?php

return [
'paths' => ['api/*', 'sanctum/csrf-cookie','auth/*'],
'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
'allowed_origins' => ['http://localhost:3500','http://127.0.0.1:3500'],
'allowed_origins_patterns' => [],
'allowed_headers' => ['Content-Type', 'X-Auth-Token', 'Origin', 'Authorization'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => true,

];
