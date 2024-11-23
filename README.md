[![No Maintenance Intended](http://unmaintained.tech/badge.svg)](http://unmaintained.tech/)
[![Updated to work with Craft CMS 4 & PHP 8.0.2](http://unmaintained.tech/badge.svg)](http://unmaintained.tech/)

In an effort to reduce the number of packages we publicly maintain, Sprout Active will not be migrated to Craft 4. If you'd like to take the helm or take responsibility over maintaining the repository please reach out: [sprout@thecrowx89design.com](mailto:sprout@thecrowx89design.com).




----

Sprout Active
===================

## Overview 

Simplify navigation and URL-based logic in your templates.

Sprout Active makes it simple to control the active classname in your navigation or conditional content based on your URL segments or your full URL.

## Usage

Sprout Active provides the `active` and `activeClass` Twig Filters to test for matching URL segments and output a class to make an element active.

The most simple version of these filters will match the first segment in the URL http://example.com/about-us. If no match is found, they will return blank.

``` twig
{{ active('about-us') }} {# Output if match: active #}

{{ activeClass('about-us') }} {# Output if match: class="active" #}

{{ activeClass(entry.slug) }}
```

See the documentation for more advanced use cases.

## Documentation

See the [Sprout Website](https://sprout.thecrowx89design.com/craft-plugins/active/docs) for documentation, guides, and additional resources. 

## Support

- [Send a Support Ticket](https://sprout.thecrowx89design.com/craft-plugins/request/support) via the Sprout Website.
- [Create an issue](https://github.com/thecrowx89/craft-sprout-active/issues) on Github.

<a href="https://sprout.thecrowx89design.com" target="_blank">
  <img src="https://s3.amazonaws.com/sprout.thecrowx89design.com-assets/content/plugins/sprout-icon.svg" width="72" align="right">
</a>
