Documenting the history of the Santa Clara Vanguard through stories

Uses composer for dependency (plugin and WordPress Core) management, per [mrengy: WordPress Starter](https://github.com/mrengy/wordpress-starter).

Uses [Sass](https://sass-lang.com) for pre-processing CSS, making the CSS more manageable and less repetitive.

# Working locally

## Initial local installation
**(draft - to be built out and tested)**

### Install dependencies:

To set up the site, you will need to [install Composer on your local machine](https://getcomposer.org/doc/00-intro.md) **(edits needed)...**

### Set up the site

Clone this repo to your local machine where you'd like to work on it. If you're using [MAMP](https://www.mamp.info), it may require you to install in a particular directory (for Mac OS, placing it under "Sites" is a best practice)

In your command line tool, navigate into the root of where the repo was cloned.

Run PHP and MySQL on your local machine using something like [MAMP](https://www.mamp.info). [Installing WordPress on MAMP](https://dvdhunter.trainerup.co/installing-wordpress-on-mamp/) has some guidance on the basics, but some details in that guide may differ **(edits needed)...**

Create a local database using MAMP (see above). Note your database name, username, and password.

[Run composer update](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) to install WordPress core and the plugins the site uses. Note that the syntax may vary depending on how you installed Composer - you may need to use either `composer update` or `php composer.phar update`.

Navigate to the homepage of your local install in a web browser, to install WordPress. [If using MAMP](https://documentation.mamp.info/en/MAMP-Mac/First-Steps/), the local URL is likely http://localhost:8888/vanguard-history .

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
