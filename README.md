Documenting the history of the Santa Clara Vanguard through stories. Will be launched at [history.scvanguard.org](https://history.scvanguard.org) (not yet live).

Uses composer for dependency (plugin and WordPress Core) management, per [mrengy: WordPress Starter](https://github.com/mrengy/wordpress-starter).

Uses [Sass](https://sass-lang.com) for pre-processing CSS, making the CSS more manageable and less repetitive.

# Working locally

## Initial local installation

### Install dependencies:

This may go without saying, but you will need [Git on your local machine](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#install-git) to collaborate with others on the code.

To set up the site, you will need to [install Composer on your local machine](https://getcomposer.org/doc/00-intro.md).

If you plan on making changes to any CSS, you will need to [install SASS on your local machine](https://sass-lang.com/install).


### Set up the site on your local machine

install wordpress locally or use Local **(edits needed)**

Ensure you've got a working WordPress account for the production site, [history.scvanguard.org](https://history.scvanguard.org). Note in order to access the site, first you may need to enter a separate username / password of "historyscv" / "scv1967". If you don't have a WordPress account there, ask Mike Eng for one. It will make things easier if you use your same username, email address, and password on the local site you'll create next.

Install [Local app](https://localwp.com/). In Local, create a new site. Name it "Vanguard History". It's recommended to use the same username, email address, and password you have from the production site. In Local, click on "open site". The URL should be http://vanguard-history.local . If it differs, note what it is for the next step.

Get a backup of the production site from the [All in One WordPress Migration Export page](https://history.scvanguard.org/wp-admin/admin.php?page=ai1wm_export).Note the following settings:

1. Use: "Find _ replace with _ in the database" to change the url from the production url to your local url. Find: "https://history.scvanguard.org". Replace with: "http://vanguard-history.local".
1. Under "advanced options", check only the following:
    1. "Do not export spam comments"
    1. "Do not export post revisions"
    1. "Do not export themes (files)"
    1. "Do not export plugins (files)"
    1. "Do not replace email domain (sql)"
1. Export to "file"

Download the file to your computer. it should end in ".wpress". Note its location for later.

In Local, right-click your site and select “Open Site Shell” in the menu that appears.

![screenshot showing "open site shell" option](https://localwp.com/wp-content/uploads/2020/10/local-open-site-shell.png.webp)

A command line prompt should open. Rather than cloning this repository like usual, you'll need to do something a little different to track this repository since the Local directory already has files in it. In that command line prompt, enter:

<pre>
git init .
git remote add origin git@github.com:mrengy/vanguard-history.git
git fetch origin
git checkout main
</pre>

<a name="composer-update" href="https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies">Run `composer update`</a> to install WordPress core and the plugins the site uses. If you have already installed, this will update WordPress core and all plugins to their specified versions. Note that the syntax may vary depending on how you installed Composer - you may need to use either `composer update` or `php composer.phar update`.

Navigate to the homepage of your local install in a web browser, to install WordPress. [If using MAMP](https://documentation.mamp.info/en/MAMP-Mac/First-Steps/), the local URL is likely http://localhost:8888/vanguard-history .

Export database and uploads directory from production, and import the exported files and database, correct URLs to point to your local install. **(edits needed: instructions for migrating database and files)**


## To make edits to CSS

In command line tool, navigate into the active theme's directory.

In command line tool, run "sass --watch ." which will check for any .scss files in the current directory and compile them into proper .css files. More in [SASS basics](https://sass-lang.com/guide#topic-1).

## installing plugins
Trying a new plugin? We want to ensure that team members are using the same plugins and that the live site gets the plugins you are using locally. So instead of installing plugins from WordPress Admin or adding the plugin files manually, add a line for the plugin to composer.json. Then <a href="#composer-update">run "composer update" to install it.</a> (Note, this will update all plugins and potentially WordPress Core as well). If you don't need the plugin anymore, remove the line from composer.json and run "composer update" again.

## To get updates from other team members

Do this when you are coming back to work on the code after any time away. [Run "git pull"](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#download-the-latest-changes-in-the-project) to update with the latest code from Github. `name of branch` is `vanguard-history`.

<a href="#composer-update">Run "composer update"</a> to update WordPress Core and your plugins to match what is specified in composer.json. This will update plugins that have new versions available, delete plugins removed from composer.json, and install plugins added to composer.json.

## branching

There are many ways to use Git branches. Here, we will use an approach of <a href="https://gist.github.com/vlandham/3b2b79c40bc7353ae95a">feature branches and pull requests</a>. In that tutorial, replace "master" with "main". For the most part, we will not be committing on the "main" branch, but on a branch specific to the feature or issue you are working on.

## committing and pushing
After you've made local changes, commit them, one by one. When you've got a bunch to send back to Github , push them. See [these basics](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#add-and-commit-local-changes) for details. (where that page says "GitLab", replace that mentally with "Github").


# Site administration on servers
[Connect to the server using SSH](https://wpengine.com/support/ssh-gateway/), and <a href="#composer-update">run "php composer.phar update"</a> there to update WordPress Core and your plugins to match what is specified in composer.json.
