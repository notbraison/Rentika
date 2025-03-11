#!/bin/bash

# Start backend
(cd backend && php artisan serve) &

(cd reactFrontend && npm run start)