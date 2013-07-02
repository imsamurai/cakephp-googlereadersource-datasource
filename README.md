#GOOGLE READER REST IN PEACE...


GoogleReaderSource Plugin
=========================

CakePHP GoogleReaderSource Plugin with DataSource for Google Reader

## Installation

### Step 1: Clone or download [HttpSource](https://github.com/imsamurai/cakephp-httpsource-datasource)

### Step 2: Clone or download to `Plugin/GoogleReaderSource`

  cd my_cake_app/app
	git://github.com/imsamurai/cakephp-googlereadersource-datasource.git Plugin/GoogleReaderSource

or if you use git add as submodule:

	cd my_cake_app
	git submodule add "git://github.com/imsamurai/cakephp-googlereadersource-datasource.git" "app/Plugin/GoogleReaderSource"

then update submodules:

	git submodule init
	git submodule update

### Step 3: Add your configuration to `database.php` and set it to the model

```
:: database.php ::
public $myapi = array(
  'datasource' => 'GoogleReaderSource.Http/GoogleReaderSource',
        'host' => 'www.google.com/reader/api/0/',
        'port' => 80
);

Then make model

:: GoogleReaderSource.php ::
public $useDbConfig = 'googleReader';
public $useTable = '<desired api url ending, for ex: "search">';

```

### Step 4: Load plugin

```
:: bootstrap.php ::
CakePlugin::load('HttpSource', array('bootstrap' => true, 'routes' => false));
CakePlugin::load('GoogleReaderSource');

```

#Documentation

Please read [HttpSource Plugin README](https://github.com/imsamurai/cakephp-httpsource-datasource/blob/master/README.md)
