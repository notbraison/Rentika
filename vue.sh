#!/bin/bash

# Start backend
(cd backend && php artisan serve) &

# Start frontend (adjust based on whether it's Vue, React, or another)
(cd vueFrontend && npm run dev)
