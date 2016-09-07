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
    4.1. You can also use the paid versions of plugins. See composer-paid.json.
5. Log in to the admin and
    5.1. Switch the theme to **Nopio Master**
    5.2. Enable plugins
6. Go into the theme folder ```cd wp-content/themes/nopio_master```
7. If running for the first time you need to install dependencies. Run:
    7.1. ```npm install```
    7.2. ```gem install bundler```
    7.3. ```bundle install```
8. Run grunt in watch mode: ```grunt```. Grunt will automatically pick up any changes to JS and SCSS files and build them accordingly.
    8.1. You can also use ```grunt build``` command to rebuild files without using watch.
