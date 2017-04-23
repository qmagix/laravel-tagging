Events
============

The `Taggable` trait will fire off two events.

```php
Qmagix\Tagging\Events\TagAdded;

Qmagix\Tagging\Events\TagRemoved;
```

You can add listeners and track these events.

```php
\Event::listen(Qmagix\Tagging\Events\TagAdded::class, function($article){
	\Log::debug($article->title . ' was tagged');
});
```
