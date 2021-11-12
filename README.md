A best-of-all-worlds approach to version control and automatic WordPress updates. Use this as a template to begin a WordPress project.

Credit to Matías Halles - inspired by [this approach](https://medium.com/@halles/wordpress-composer-git-1ccf29a9827a).

# Setup instructions
Install [Composer](https://getcomposer.org/) on your local machine.

Fork this repository.

Locally clone the repository you forked. Give it a name representing the project you intend to use it for.

Make and save any changes you want to make to composer.json - add / remove plugins you want, change WordPress core version, etc.

Run php locally using something like [XAMPP](https://www.apachefriends.org/download.html) or [MAMP](https://www.mamp.info). Alternately, use [Local](https://localwp.com/), which may make some of the following steps different - they are based on MAMP.

Using a command line tool (like Terminal), go into the root of the local repository and run `composer update` per the [Composer Basic Usage guidelines](https://getcomposer.org/doc/01-basic-usage.md). This will install WordPress and any dependencies (plugins) you specified in composer.json. Note that this uses a different folder structure than a typical WordPress folder structure.

[Create a local MySQL database](https://www.betterhostreview.com/create-mysql-database-phpmyadmin-computer.html) using XAMPP or MAMP and create a user with access to the new database. Note the database name, username, and password.

Make a copy of wp-config.sample.php and rename it wp-config.php. Set all the definitions in wp-config.php as you would for a normal WordPress installation (including the database details from earlier). Ensure that `WP_SITEURL` and `WP_HOME` match the location where you cloned the repository locally.

Visit the URL you entered in `WP_HOME` in a web browser.

Follow the install prompts in WordPress.

Note that this repository doesn't include a WordPress theme (even the default one that usually comes with WordPress). You'll likely want to start from an existing theme. Consider a starter theme like [_s](http://underscores.me/), [WP Rig](https://wprig.io/), or [Genesis Framework](https://www.studiopress.com/features/). Make a new folder called "theme" under "wp" and move your starter theme into that "theme" folder.

# Continuing development
... (in progress)
