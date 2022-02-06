Documenting the history of the Santa Clara Vanguard through stories

Uses composer for dependency (plugin and WordPress Core) management, per [mrengy: WordPress Starter](https://github.com/mrengy/wordpress-starter).

Uses [Sass](https://sass-lang.com) for pre-processing CSS, making the CSS more manageable and less repetitive.

# Working locally

## Initial local installation

### Install dependencies:

This may go without saying, but you will need [Git on your local machine](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#install-git) to collaborate with others on the code.

To set up the site, you will need to [install Composer on your local machine](https://getcomposer.org/doc/00-intro.md).

If you plan on making changes to any CSS, you will need to [install SASS on your local machine](https://sass-lang.com/install).


### Set up the site

Clone this git repository to your local machine where you'd like to work on it. If you're using [MAMP](https://www.mamp.info), it may require you to install in a particular directory (for Mac OS, placing it under "Sites" is a best practice)

In your command line tool, navigate into the root of where the repo was cloned.

Run PHP and MySQL on your local machine using something like [MAMP](https://www.mamp.info). [Installing WordPress on MAMP](https://dvdhunter.trainerup.co/installing-wordpress-on-mamp/) has some guidance on the basics, but some details in that guide may differ **(edits needed)...**

Create a local database using MAMP (see above). Note your database name, username, and password.

<a name="composer-update">
Run</a> ["composer update"](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) to install WordPress core and the plugins the site uses. If you have already installed, this will update WordPress core and all plugins to their specified versions. Note that the syntax may vary depending on how you installed Composer - you may need to use either `composer update` or `php composer.phar update`.

Navigate to the homepage of your local install in a web browser, to install WordPress. [If using MAMP](https://documentation.mamp.info/en/MAMP-Mac/First-Steps/), the local URL is likely http://localhost:8888/vanguard-history .

Export database and uploads directory from production, and import the exported files and database, correct URLs to point to your local install. **(edits needed: instructions for migrating database and files)**


## To make edits to CSS

In command line tool, navigate into the active theme's directory.

In command line tool, run "sass --watch ." which will check for any .scss files in the current directory and compile them into proper .css files. More in [SASS basics](https://sass-lang.com/guide#topic-1).

## installing plugins
Trying a new plugin? We want to ensure that team members are using the same plugins and that the live site gets the plugins you are using locally. So instead of installing plugins from WordPress Admin or adding the plugin files manually, add a line for the plugin to composer.json. Then <a href="composer-update">run "composer update" to install it.</a> (Note, this will update all plugins and potentially WordPress Core as well). If you don't need the plugin anymore, remove the line from composer.json and run "composer update" again.

## To get updates from other team members

Do this when you are coming back to work on the code after any time away. [Run "git pull"](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#download-the-latest-changes-in-the-project) to update with the latest code from Github. `name of branch` is `vanguard-history`.

<a href="composer-update">Run "composer update"</a> to update WordPress Core and your plugins to match what is specified in composer.json. This will update plugins that have new versions available, delete plugins removed from composer.json, and install plugins added to composer.json.

## branching

There are many ways to use Git branches. For this, we will use an approach of <a href="https://gist.github.com/vlandham/3b2b79c40bc7353ae95a">feature branches and pull requests</a>. In that tutorial, replace "master" with "main".

## committing and pushing
After you've made local changes, commit them, one by one. When you've got a bunch to send back to Github , push them. See [these basics](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#add-and-commit-local-changes) for details. (where that page says "GitLab", replace that mentally with "Github").



# Site administration on servers
[Connect to the server using SSH](https://wpengine.com/support/ssh-gateway/), and <a href="composer-update">run "composer update"</a> there to update WordPress Core and your plugins to match what is specified in composer.json. Depending on how Composer was installed on the server, you may need to run "php composer.phar update" instead. **(verify once we get host set up)...**
