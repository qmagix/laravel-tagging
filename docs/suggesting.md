Suggesting
============

Suggesting is a small little feature you could use if you wanted to have "suggested" tags that stand out.

There is not much to it. You simply set the 'suggest' field in the database to true

```php
$tag = Qmagix\Tagging\Model\Tag::where('slug', '=', 'blog')->first();
$tag->suggest = true;
$tag->save();
```

And then you can fetch a list of suggested tags when you need it.

```php
$suggestedTags = Qmagix\Tagging\Model\Tag::suggested()->get();
```
