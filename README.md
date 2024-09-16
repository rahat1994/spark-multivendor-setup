<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About this project

This project completely relies on 4 packages

1. sparkcommerce.
   
    This is the core of the project and every-other packages extends on its functinalities. It only has basic shop setup functionality with authentication.
2. sparkcommerce-multivendor

    This package adds multivendor capabilities to the sparkcommerce package.
3. sparkcommerce-rest-routes

    Not every application needs REST api capabilities but those who does this package adds restapi capbilities to sparkcommerce package. Available rest routes are mentioned later in this page.
4. sparkcommerce-multivendor-rest-routes

    It extends on the 3rd package and adds its own rest routes.


## Setup Process
1. `git clone`
2. `composer install`
3. create `.env` file from `.env.example`
4. generate APP KEY by `php artisan key:generate`
5. paste the DB credentials
6. `php artisan migrate`
7. run the `sparkcommerce` commands (Not needed for this project)
8. run the `scmv` commands
    * publish User roles using `php artisan scmv:publish-roles`
    * create first admin user `php artisan make:scmv-admin-user`
    * create first vendor owner user `php artisan make:scmv-vendor-owner-user`
9. serve the app using `php artisan serve`
10. for vendor dashboard visit http://127.0.0.1:8000/vendor/login
11. for admin dashboard visit http://127.0.0.1:8000/backoffice/login

##Features

- [ ] Mercury
- [x] Venus
- [x] Earth (Orbit/Moon)
- [x] Mars
- [ ] Jupiter
- [ ] Saturn
- [ ] Uranus
- [ ] Neptune
- [ ] Comet Haley