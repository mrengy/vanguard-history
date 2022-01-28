Documenting the history of the Santa Clara Vanguard through stories

Uses composer for dependency (plugin) management, per [mrengy: WordPress Starter](https://github.com/mrengy/wordpress-starter).

Uses [Composer](https://getcomposer.org/) for managing dependencies (WordPress Core and plugins) and [Sass](https://sass-lang.com) for pre-processing CSS.

# To install locally
**(draft - to be built out and tested)**

Clone this repo to your local machine

In command line tool, navigate (cd) into the root of where the repo was installed

Run composer to install WordPress core and the plugins the site uses,

Run PHP and MySQL locally using something like [MAMP](https://www.mamp.info). [Installing WordPress on MAMP](https://dvdhunter.trainerup.co/installing-wordpress-on-mamp/) has some guidance on the basics, but some details below will differ **(edits needed)...**

Create a local database using MAMP (see above)

Navigate to the homepage of your local install in a web browser, to install WordPress **(edits needed: how to find URL)**

Export database and uploads directory from production, and import the exported files and database, correct URLs to point to your local install. **(edits needed: instructions for migrating database and files)**


# To make edits to CSS

In command line tool, navigate (cd) into the active theme's directory.

In command line tool, run "sass --watch ." which will check .scss files and compile them into proper .css

(draft - to be built out)
