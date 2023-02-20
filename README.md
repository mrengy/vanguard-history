Documenting the history of the Santa Clara Vanguard through stories. Will be launched at [history.scvanguard.org](https://history.scvanguard.org) (currently just a material upload form lives there as a first phase). See [Vanguard Historical Society](scvanguard.org/historical-society/) for background behind this project.

Built on WordPress.

Uses [Composer](https://getcomposer.org/) for dependency (plugin) management.

Uses [Sass](https://sass-lang.com) for pre-processing CSS, making the CSS more manageable and less repetitive.

Uses [WP CLI](https://wp-cli.org/) for faster WordPress administration from the command line.

# What is the source of truth for which things?

We will work on code (which plugins to use, theme code, and mu-plugin code) **locally first**, then push it to Github, review it, and eventually deploy it to the production website. **Github is the source of truth for code**.

**The stage website is the source of truth for content** (database and uploaded files). We can periodically pull database content down from stage to dev and local installs to sync it. If you make database changes locally that the stage site should have, **also make those changes on the stage site**.

# Working locally

## Initial local installation

### Install dependencies

This may go without saying, but in order to collaborate on the code, you will need Git on your local machine. If you plan to use the command line for Git, you can [install it this way](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#install-git). If you want a simplified interface, you can use the [Github Desktop app](https://desktop.github.com/).

You will also need [a Github account](https://github.com/join) to contribute code.

To set up the site, you will need to [install Composer on your local machine](https://getcomposer.org/doc/00-intro.md).

For some of the local WordPress site administration tasks like bulk activating plugins and manually installing some like GravityForms, you will need to [install WP CLI](https://wp-cli.org/#installing).

To run any NPM scripts, you'll need run the following:

```sh
cd ~/Local Sites/vanguard-history/app/public
npm i
```

### Set up the site on your local machine

#### Preparation

Ensure you've got a working WordPress account for the stage site, [historyscv-stage.dreamhosters.com](https://historyscv-stage.dreamhosters.com). If you don't have a WordPress account there, ask Mike Eng for one. It will make things easier if you use your same username, email address, and password on the local site you'll create next.

#### Install WordPress locally

This is written using [Local](https://localwp.com/). There are other ways to install and run WordPress locally, but this is a very simple one. If you use a different approach, you can skip ahead.

Install [Local](https://localwp.com/) on your computer. In Local, create a new site. Name it "Vanguard History". It's recommended to use the same username, email address, and password you have from the stage site. In Local, click on "open site". The URL should be http://vanguard-history.local . If it differs, note what it is for the next step.

#### Connect to this Github repository the shared code

<a name="command-line">In Local, right-click your site and select “Open Site Shell” in the menu that appears.</a>

![screenshot showing "open site shell" option](https://localwp.com/wp-content/uploads/2020/10/local-open-site-shell.png.webp)

A command line prompt should open in the directory of your local WordPress installation. If it doesn't open in the correct directory, you can navigate to it manually. On Mac OS, it lives under:

```sh
 ~/Local Sites/vanguard-history/app/public
```

Rather than cloning this repository like one usually would, you'll need to do something a little different to track this repository since the Local directory already has the WordPress core files in it. In that command line prompt, enter:

<pre>
git init .
git remote add origin git@github.com:mrengy/vanguard-history.git
git fetch origin
git checkout main
</pre>

#### Point WP CLI to the right place

Check that [WP CLI](https://wp-cli.org/) is able to connect to your local WordPress installation. From the command line prompt in your local WordPress directory (mentioned above), run:

```sh
wp plugin update
```

If you get `Error: Error establishing a database connection`, you'll need to edit your local wp-config.php file in a text editor and change the `DB_HOST` value from `localhost` to another string. In order to find the right string, open the Local app, go to the Vanguard History site, and click the "Database" tab. Copy the entire string listed next to `Socket`. Then in wp-config.php, change the `DB_HOST` value from `localhost` to `localhost:that-string-you-just-copied`. It will be something like `localhost:/Users/your-username/Library/Application Support/Local/run/WvEot0rmv/mysql/mysqld.sock`. If that doesn't work, you can get the string another way, listed at [WP-Cli : Error establishing a database connection - Amazingly simple solution](https://community.localwp.com/t/wp-cli-error-establishing-a-database-connection-amazingly-simple-solution/20794) - _note, we have tested this on Mac OS only, not sure if it differs on other operating systems_.
<img width="1197" alt="screenshot of where in Local to find the socket-path string needed" src="https://user-images.githubusercontent.com/2223603/204912603-710dc943-08d6-472a-8cd3-057969df9159.png">

#### Install plugins

<a name="composer-update" href="https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies">Run `composer install`</a> in the command line to install the plugins the site uses. Note that the syntax may vary depending on how you installed Composer - you may need to use either `composer install` or `php composer.phar install`.

If in the command line, you see an error involving `gravityformscli` or `wp gf`, there was likely a problem with the script that installs the GravityForms plugin. You can try to install it by using one of the two following methods:

1. In the command line, run `wp gf install --key=283af92393f339347c5e7f6aa889e0cc`
1. Upload a .zip file in the WordPress admin
   1. Download [the .zip file of the GravityForms plugin from Basecamp](https://3.basecamp.com/5067876/buckets/22032865/uploads/4596222685)
   1. [Open the WordPress Admin from Local](https://localwp.com/help-docs/local-features/using-one-click-admin/)
   1. log in and go to the Plugins page
   1. [upload the gravityforms.zip file from the WordPress admin](https://www.wonderplugin.com/wordpress-tutorials/how-to-manually-install-a-wordpress-plugin-zip-file/).

Activate all the plugins by [running](https://developer.wordpress.org/cli/commands/plugin/activate/) `wp plugin activate --all` in the command line or opening WordPress Admin for your local installation, logging in, and navigating to the `plugins` page.

#### Migrate database and uploads from stage to local

##### Option 1: export / import media files along with the database

Get a backup of the stage site from the [All in One WordPress Migration Export page](https://historyscv-stage.dreamhosters.com/wp-admin/admin.php?page=ai1wm_export). Note the following settings:

1. Use: "Find _ replace with _ in the database" to change the url from the stage url to your local url.
   Find:

   ```
   https://historyscv-stage.dreamhosters.com
   ```

   Replace with: (or whatever your local url is).

   ```
   http://vanguard-history.local
   ```

2. Under "advanced options", check only the following:
   1. "Do not export spam comments"
   1. "Do not export post revisions"
   1. "Do not export themes (files)"
   1. "Do not export must-use plugins (files)"
   1. "Do not export plugins (files)"
   1. "Do not replace email domain (sql)"
3. Export to "file"

Download the file to your computer. it should end in ".wpress".

You may need to [update some files in your local WordPress installation](https://help.servmask.com/2018/10/27/how-to-increase-maximum-upload-file-size-in-wordpress/) to allow large uploads.

[Open the WordPress Admin from Local](https://localwp.com/help-docs/local-features/using-one-click-admin/) and go to "All in one WP Migration" > "Import". If "All in one WP Migration" does not appear in the Admin menu, you need to activate the "All in one WP Migration" plugin.

Select or drag your .wpress file into the indicated area on the import page and follow the prompts. Note that the prompt to save your permalinks structure after import completes is important for getting the import to work. You just need to follow the link to the permalinks settings page and click "save changes" without changing any other settings.

When prompted to log in to WordPress Admin on your local site after importing the migration file, you will need to use your password from the stage site. You might want to change your password on the local site later.

That's it! View your local site to ensure it matches what's on the stage site.

##### Option 2: export / import database separate from media files

If the file from the All in One WordPress Migration plugin is too large to import, you can exclude media files from the export file and copy in some media files separately. Follow the steps in the above section, with the following changes.

When creating the export, also check the option:

1. "Do not export media library (files)"

After importing the database file in your local WordPress Admin, manually copy in media files. Download and unzip a couple of directories of uploads by month from [this Basecamp thread](https://3.basecamp.com/5067876/buckets/22032865/messages/5561851381#__recording_5586109819) (ask Mike Eng if you need access to Basecamp). Go to your local site folder. Get there from the Local app > under the site "Vanguard History", click "Go to site folder". Place the media files under "vanguard-history" > "app" > "public" > "wp-content" > "uploads". Within "uploads", there are directories organized by year and month. Place the directories and their contents under "uploads" in the appropriate year / month structure.

##### Option 3: import database sql

1. Ask [mrengy](https://github.com/mrengy) to export the stage SQL
1. Download the resulting zip and extract it
1. In Local, go to the Database Tab > Click `Open Adminer`
1. Select all tables in the list and click `Drop`
1. On the left side of the window, click `Import`
1. Select your downloaded SQL file
1. Run the following:

```sh
cd ~/Local Sites/vanguard-history/app/public
npm run replace-stage-urls
```

## To make edits to CSS

In the command line prompt (here's <a href="#command-line">how to open it</a>), run the following:

```sh
cd wp-content/themes/vanguard-history
npm run sass:watch
```

This will check for any `.scss` files in the current directory and compile them into proper `.css` files. More in [SASS basics](https://sass-lang.com/guide#topic-1). You'll want to edit only the `.scss` files when editing the CSS. SASS will do the rest.

If you want to build the `.scss` files once without starting the watcher, run:

```sh
npm run sass
```

To have the latest SASS built when you pull, run:

```sh
git config core.hooksPath .github/hooks
```

## Changing plugins

Trying a new plugin? We want to ensure that team members are using the same plugins and that the live site gets the plugins you are using locally. So instead of installing plugins from WordPress Admin or adding the plugin files manually, add a line for the plugin to composer.json. Then run `composer update` (or `php composer.phar update`, depending on how you installed [Composer](https://getcomposer.org/)) in the command line to install it. (Note, this will update all plugins). If you don't need the plugin anymore and are confident that nothing else depends on it, delete the line from composer.json and run `composer update` again.

## branching

There are many ways to use Git branches. Here, we will use an approach of <a href="https://gist.github.com/vlandham/3b2b79c40bc7353ae95a">feature branches and pull requests</a>. In that tutorial, replace "master" with "main". For the most part, we will not be committing directly on the "main" branch, but on a branch specific to the feature or issue you are working on. New branches will be created automatically when a GitHub issue is assigned. You probably won’t need to create your own branches, but you can if you like.

## To get updates from other team members

Do this when you are coming back to work on the code after any time away. In <a href="#command-line">the command line</a>, Run:

1. `git checkout main`
1. [`git pull`](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#download-the-latest-changes-in-the-project) to update the main branch with the latest code from Github.
1. `git checkout <working-branchname>`
1. `git pull` to update your working branch
1. `git rebase main` (you may have to resolve some conflicts, but they're usually straightforward)
1. If another teammate added or removed plugins, `composer update` (or `php composer.phar update`) to update plugins to match what is specified in composer.json. This will update plugins that have new versions available, delete plugins removed from composer.json, and install new plugins added to composer.json.

## committing changes

After you've made local changes, commit them, one by one. When you've got a bunch to send back to Github, `push` them on your feature branch. (Use `git push -f` to force push if you rebased as above.)

See [these basics](https://docs.gitlab.com/ee/gitlab-basics/start-using-git.html#add-and-commit-local-changes) for details. (where that page says "GitLab", replace that mentally with "Github"). Then rather than merging into the main branch yourself, [create a pull request](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request) from your branch when it's ready to be merged back into the main branch.

# Site administration on servers

The site administrator (Mike Eng) will merge pull requests and deploy changes to the servers (development, stage, and production).

For the development and stage sites, you'll need to log into WordPress to view anything. Use the "forgot password" functionality or ask the site administrator (Mike Eng) if you have trouble logging in.

1. Development site: https://historyscv-dev.dreamhosters.com
1. Stage site: https://historyscv-stage.dreamhosters.com

After deploying to a server, the administrator will [connect to the server using SSH](https://wpengine.com/support/ssh-gateway/), and run `php composer.phar update` there to update plugins to match what is specified in composer.json.

# Core team

1. [Mike Eng](https://github.com/mrengy)
1. Adam Noyce
1. [Shekhar Khedekar](https://github.com/shekharkhedekar)
1. Shannon Stamm McGhee

```

```
