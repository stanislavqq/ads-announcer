#Demo Laravel Vue SPA app 

## Installation

> git clone git@github.com:stanislavqq/ads-announcer.git

 Customize your .env
 
 Run
 
> composer i && npm i

and

> php artisan migrate && php artisan db:seed

All users are created with password "123123123"

after 

To change the value of a baseURL in app.js
> axios.defaults.baseURL = 'http://your-host/api';

run
> php artisan jwt:secret

If authorization was not successful, try to register a new user. And log in with it.

and
> npm run prod

You can see the app in the browser
