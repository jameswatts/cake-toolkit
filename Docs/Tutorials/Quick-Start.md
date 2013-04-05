Quick Start
===========

This quick start guide will help you get ready to use the **Cake Toolkit (CTK)** in your application.

Requirements
------------

In order to use the plugin you must be using a *2.x* version of *CakePHP* on a server installed with *PHP* *5.3* or higher.

The plugin doesn't have any other additional requirements or dependencies.

Installation
------------

To install the plugin, place the files in a directory labelled "Ctk/" in your "app/Plugin/" directory.

If you're using **git** for version control, you may want to add the CTK plugin as a submodule on your repository. To do so, run the following command from the base of your repository:

```
git submodule add git@github.com:jameswatts/cake-toolkit.git app/Plugin/Ctk
```

After doing so, you will see the submodule in your changes pending, plus the file ".gitmodules". Simply commit and push to your repository.

To initialize the submodule(s) run the following command:

```
git submodule update --init --recursive
```

To retreive the latest updates to the plugin, assuming you're using the "master" branch, go to "app/Plugin/Ctk" and run the following command:

```
git pull origin master
```

If you're using another branch, just change "master" for the branch you are currently using.

If any updates are added, go back to the base of your own repository, commit and push your changes. This will update your repository to point to the latest updates to the plugin.

The plugin also provides a "composer.json" file, to easily use the plugin through the **Composer** dependency manager.

Configuration
-------------

The plugin doesn't have any specific configuration settings. However, you will need to add the plugin in your bootstrap file. If you haven't already, add the following line to your bootstrap file:

```
CakePlugin::loadPlugin('Ctk');
```

This isn't required if you're already calling **CakePlugin::loadAll()**, as all plugins will be loaded.

To check that the plugin is being loaded, navigate to "/ctk" in your browser, from the base URL of your *CakePHP* application, for example:

```
http://example.com/ctk
```

This will display the home page of the CTK plugin. You're now ready to go!

