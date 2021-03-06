Specification
=============

An implementation of the Specification pattern.

[![Latest Stable Version](https://poser.pugx.org/monii/specification/v/stable)](https://packagist.org/packages/monii/specification)
[![Total Downloads](https://poser.pugx.org/monii/specification/downloads)](https://packagist.org/packages/monii/specification)
[![Latest Unstable Version](https://poser.pugx.org/monii/specification/v/unstable)](https://packagist.org/packages/monii/specification)
[![License](https://poser.pugx.org/monii/specification/license)](https://packagist.org/packages/monii/specification)
<br>
[![Build Status](https://travis-ci.org/monii/monii-specification.svg?branch=master)](https://travis-ci.org/monii/monii-specification)


Requirements
------------

 * PHP 5.5+
 * A renderer if you need to apply the Specification pattern to persisted data


Installation
------------

```bash
$> composer require monii/specification
```

Until a stable version has been released or if a development version is preferred, use:

```bash
$> composer require monii/specification:@dev
```

Rendering Implementations
-------------------------

By itself, the specification package is able to check individual existing objects to see if a specification is
satisfied by the specification. In order to use a specification to query a set of objects not yet in memory
you can render a specification into a query.

 * [monii/specification-sql-adapter](https://github.com/monii/monii-specification-sql-adapter)


License
-------

MIT, see LICENSE.


Community
---------

Want to get involved? Here are a few ways:

 * Find us in the #monii IRC channel on irc.freenode.org.
 * Mention [@moniidev](https://twitter.com/moniidev) on Twitter.
