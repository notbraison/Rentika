#!/bin/bash

# Stop both on exit
trap "kill 0" EXIT

# Start backend
(cd backend && php artisan serve) &

# Start frontend (adjust based on whether it's Vue, React, or another)
(cd vueFrontend && npm run dev)&

# Wait for both to finish
wait

#Make It Executable:
#chmod +x vue.sh
#Run the script using this command:
#./vue.sh

