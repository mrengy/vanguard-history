Documenting the history of the Santa Clara Vanguard through stories

Uses composer for dependency (plugin and WordPress Core) management, per [mrengy: WordPress Starter](https://github.com/mrengy/wordpress-starter).

Uses [Sass](https://sass-lang.com) for pre-processing CSS.

# Working locally

## Initial local installation
**(draft - to be built out and tested)**

### Install dependencies:

For installation, you will need Composer **(edits needed)...**

If you plan to make edits to theme CSS, you will need SASS **(edits needed)...**

### Set up the site

Clone this repo to your local machine

In command line tool, navigate (cd) into the root of where the repo was installed

Run composer to install WordPress core and the plugins the site uses **(add instructions for installing locally)...**

Run PHP and MySQL locally using something like [MAMP](https://www.mamp.info). [Installing WordPress on MAMP](https://dvdhunter.trainerup.co/installing-wordpress-on-mamp/) has some guidance on the basics, but some details below will differ **(edits needed)...**

Create a local database using MAMP (see above)

Navigate to the homepage of your local install in a web browser, to install WordPress **(edits needed: how to find URL)**

Export database and uploads directory from production, and import the exported files and database, correct URLs to point to your local install. **(edits needed: instructions for migrating database and files)**


## To make edits to CSS

In command line tool, navigate (cd) into the active theme's directory.

In command line tool, run "sass --watch ." which will check .scss files and compile them into proper .css

(draft - to be built out)

## installing plugins
Trying a new plugin? We want to ensure that team members are using the same plugins and that the live site gets the plugins you are using locally. So instead of installing plugins from WordPress Admin or adding the plugin files manually, add a line for the plugin to composer.json. Then run "composer update" to install it. (Note, this will update all plugins and potentially WordPress Core as well). If you don't need the plugin anymore, remove the line from composer.json and run "composer update" again.

## committing and pushing
**(edits needed)...**


## To update code and plugins based on what other team members have specified

Run "git pull" to update with the latest code from Github

Run "composer update" to update WordPress Core and your plugins to match what is specified in composer.json. This will update plugins that have new versions available, delete plugins removed from composer.json, and install plugins added to composer.json.

# Site administration on servers
Run "composer update" to update WordPress Core and your plugins to match what is specified in composer.json. Depending on how Composer was installed on the server, you may need to run "php composer.phar update" instead. **(verify once we get host set up)...**
