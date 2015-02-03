# Luc Hoffmann Institute
This is the codebase for the Luc Hoffmann Institute WordPress website.

- [Theme organization and development](#theme-organization)
- [Plugins](#plugins)
- [Deployment](#deployment)

## Theme organization and development
This website uses a custom WordPress theme, located in ```/wp-content/themes/luc-hoffmann-institute/```. Theme files pretty much follow WordPress standard practices, but use a custom build process to compile assets such as styles, scripts, and images.

### Development setup
You'll need the following set up locally to work on this project:
- Node and NPM
- Bower

#### 1. Clone this repo and set up WordPress to work locally

```
git clone git@github.com:elcontraption/luc-hoffmann-institute.git
cp wp-config-sample.php wp-config.php
```

Update the database settings in ```wp-config.php``` to reflect your local development environment.

#### 2. Install required theme packages and assets

```
cd wp-content/themes/luc-hoffmann-institute
npm install
bower install
```

This should pull in all required node and bower modules.

#### 3. Run build process

```
gulp
```

This will run the build scripts found in ```gulpfile.js```. 

#### 4. Edit theme files
You'll find style and script modules organized within the assets directory. Edit the versions in ```assets/styles/src```, and ```assets/scripts/src```, and ```gulp``` will process your changes into their respective ```build``` directories. The ```build``` files are called from WordPress.

Add/update ```gulp``` tasks as you see fit.


## Plugins
The [Advanced Custom Fields](http://www.advancedcustomfields.com/) plugin is required.

## Deployment
This website is hosted at WPEngine. See [WPEngine's deployment instructions](http://wpengine.com/git/) for details.