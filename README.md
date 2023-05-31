# Laravel Plausible 

Simple package for managing Plausible tracking with PHP.

## Installation

You can install the package via composer:

```bash
composer require marekzelezny/plausible
```

Add the following line to your layout file's `<head>` tag:

```html
<x-plausible::script />
```

Add the plausible domain from `config/plausible.php` to env file:

```dotenv 
PLAUSIBLE_DOMAIN=example.com
```

## Usage
You can enable tracking of these Plausible features:
- Custom properties for pageview
- Outbound link clicks
- File downloads

### Custom properties for pageview
To enable this feature you have to add this line in your ENV file:
    
```dotenv
PLAUSIBLE_TRACKING_PAGEVIEW_PROPS=true
```

Then you can add custom properties to your pages by using function `plausible()` inside your controllers.

Example usage:

```php
plausible()
    ->property('pageType', 'article')
    ->property('category', 'news');
```
Which in return will output this to your page where you have added `<x-plausible::script />`:

```html
<script defer data-domain="example.com" src="https://plausible.io/js/script.manual.pageview-props.js"></script>
<script>
    window.plausible = window.plausible || function() {
        (window.plausible.q = window.plausible.q || []).push(arguments)
    }

    plausible('pageview', {
        props: {
            pageType: 'article',
            category: 'news'
        }
    });
</script>
```

You can also add multiple values of one property at once:

```php
plausible()
    ->property('author', ['John Doe', 'Jane Doe'])
```
Which in return will add multiple values to one property by calling:

```js
plausible('pageview', {
    props: {author: 'John Doe'}
});

plausible('pageview', {
    props: {author: 'Jane Doe'}
});
```
Which is currently the only way to add multiple values to one property at the moment, as Plausible does not support arrays yet.

#### Global default properties
You can also set global default properties for all pageviews by adding them in app service provider's `boot()` method.

### Outbound link clicks, File downloads
Outbound and File downloads require additional setting of goals in Plausible dashboard.
You might get more information [here](https://plausible.io/docs/goal-conversions).

Once you have setup goals in Plausible dashboard, you can enable tracking of these features:
```dotenv
PLAUSIBLE_TRACKING_OUTBOUND_LINK_CLICKS=true
PLAUSIBLE_TRACKING_FILE_DOWNLOADS=true
```
This will add Plausible scripts for tracking outbound link clicks and file downloads, which are then tracked automatically.
