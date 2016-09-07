# Project
Example Wordpress project illustrating the workflow that Nopio uses when working with Wordpress platform.

## Setup
This is almost a regular Wordpress installation. In order to set this project up on your development machine please follow the instruction below.

### New environment setup
Before starting make sure you have available:

* NodeJS with npm
* rvm (with ruby-2.3.1 installed)

### Local development environment setup
1. Checkout this repository
2. Setup your webserver to serve the project and complete Wordpress setup
3. Go into the project folder ```cd [folder]```
4. Install dependent plugins by running ```composer install```
    * You can also use the paid versions of plugins. See composer-paid.json.
5. Log in to the admin and
    * Switch the theme to **Nopio Master**
    * Enable plugins
6. Go into the theme folder ```cd wp-content/themes/nopio_master```
    * RVM should automatically pick up it's doth files and creaate nopio-master-theme gemset in ruby-2.3.1 and switch you to it.
7. If running for the first time you need to install dependencies. Run:
    * ```npm install```
    * ```gem install bundler```
    * ```bundle install```
8. Run grunt in watch mode: ```grunt```. Grunt will automatically pick up any changes to JS and SCSS files and build them accordingly.
    * You can also use ```grunt build``` command to rebuild files without using watch.
