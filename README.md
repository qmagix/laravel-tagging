Laravel Taggable Trait
============

This package is a fork from rtconner's  same name package to support db string length issue that is not compatible with MySQL 5.6.  

This package is not meant to handle javascript or html in any way. This package handles database storage and read/writes only.

There are no real limits on what characters can be used in a tag. It uses a slug transform to determine if two tags are identical ("sugar-free" and "Sugar Free" would be treated as the same tag). Tag display names are run through Str::title()

[Laravel/Lumen 5 Documentation](https://github.com/qmagix/laravel-tagging/tree/laravel-5)  
[Laravel 4 Documentation](https://github.com/qmagix/laravel-tagging/tree/laravel-4)

#### Composer Install (for Laravel 5.3/Lumen 5)

```shell
composer require qmagix/laravel-tagging
```

#### Install and then Run the migrations

The service provider does not load on every page load, so it should not slow down your app.

```php
'providers' => array(
	\Qmagix\Tagging\Providers\TaggingServiceProvider::class,
);
```
```bash
php artisan vendor:publish --provider="Qmagix\Tagging\Providers\TaggingServiceProvider"
php artisan migrate
```

###### Lumen 5 Installation

Lumen does not have a vendor:publish command, so you will need to create or copy the provided migrations and config file into their respective directory.

In app\bootstrap\app.php

```php
// Add this line in your config section
$app->configure('tagging');
// Add this line in your service provider section
$app->register(Qmagix\Tagging\Providers\LumenTaggingServiceProvider::class);
```

After these two steps are done, you can edit config/tagging.php with your prefered settings.

#### Setup your models
```php
class Article extends \Illuminate\Database\Eloquent\Model {
	use \Qmagix\Tagging\Taggable;
}
```

#### Quick Sample Usage

```php
$article = Article::with('tagged')->first(); // eager load

foreach($article->tags as $tag) {
	echo $tag->name . ' with url slug of ' . $tag->slug;
}

$article->tag('Gardening'); // attach the tag

$article->untag('Cooking'); // remove Cooking tag
$article->untag(); // remove all tags

$article->retag(array('Fruit', 'Fish')); // delete current tags and save new tags

$article->tagNames(); // get array of related tag names

Article::withAnyTag(['Gardening','Cooking'])->get(); // fetch articles with any tag listed

Article::withAllTags(['Gardening', 'Cooking'])->get(); // only fetch articles with all the tags

Qmagix\Tagging\Model\Tag::where('count', '>', 2)->get(); // return all tags used more than twice

Article::existingTags(); // return collection of all existing tags on any articles
```

[More examples in the documentation](docs/usage-examples.md)


### Tag Groups

You can create groups with the following artisan command

```php
php artisan tagging:create-group MyTagGroup
```

Set the tag group for a tag

```php
$tag->setGroup('MyTagGroup');
```

To get all the tags in a certain group

```php
Tag::inGroup('MyTagGroup')->get()
```

Check if a tag is in a group

```php
$tag->isInGroup('MyTagGroup');
```


### Configure

[See config/tagging.php](config/tagging.php) for configuration options.

### Further Documentation

[See the docs/ folder](docs) for more documentation.

#### Upgrading Laravel 4 to 5

This library stores full model class names into the database. When you upgrade laravel and you add namespaces to your models, you will need to update the records stored in the database.
Alternatively you can override Model::$morphClass on your model class to match the string stored in the database.

#### Credits

 - Robert Conner - http://smartersoftware.net

#### Further Reading
 - [Laravel News article on tagging with this library](https://laravel-news.com/2015/10/how-to-add-tagging-to-your-laravel-app/)
 - [3rd Party Posting on installation with Twitter Bootstrap 2.3](http://blog.stickyrice.net/archives/2015/laravel-tagging-bootstrap-tags-input-rtconner)
