# eRepository

eRepository is a web portal for book libraries, where there are two main roles, namely admin and member.
- Admin : Ca

## Installation

```bash
git clone https://github.com/rzoktan/eRepository.git
```

## .htaccess

```htaccess
# returns 'config_db'
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

```

## Config

```php
# returns 'config_db'
$config['live']; //for production
$config['development']; //for development

```

## Table of contents
* [Issues, bugs, and requests](#issues-bugs-and-requests)
* [Before you submit a PR](#before-you-submit-a-pr)
* [Before you build this site](#before-you-build-this-site)
  - [1. Get the prerequisites](#1-get-the-prerequisites)
  - [2. Clone this repo _and_ its submodules](#2-clone-this-repo-and-its-submodules)
* [Setting up your local environment and serving changes](#setting-up-your-local-environment-and-serving-changes)
* [Creating and/or editing DartPad example code](#creating-andor-editing-dartpad-example-code)
  - [DartPad example code in GitHub gists](#dartpad-example-code-in-github-gists)
  - [DartPad example code in this repo](#dartpad-example-code-in-this-repo)
* [Deploying to a staging site](#deploying-to-a-staging-site)
* [Writing for flutter.dev](#writing-for-flutterdev)


## Issues, bugs, and requests

We welcome contributions and feedback on our website. 
Please file a request in our
[issue tracker](https://github.com/flutter/website/issues/new/choose) 
or create a [pull request](https://github.com/flutter/website/pulls). 
For simple changes (such as tweaking some text), 
it's easiest to make changes using the GitHub UI.

If you have an issue with the 
API docs on [api.flutter.dev](https://api.flutter.dev), 
please file those issues on 
the [flutter/flutter](https://github.com/flutter/flutter/issues) repo, 
not on this (flutter/website) repo. 
The API docs are embedded in Flutter's source code, 
so the engineering team handles those.


## Before you submit a PR

We love it when the community gets involved in improving our docs! 
But here are a few notes to keep in mind before you submit a PR:

- When triaging issues, 
  we sometimes label an issue with the tag **PRs welcome**. 
  But we welcome PRs on other issues as well&mdash;
  it doesn't have to be tagged with that label.
- Please don't run our docs through Grammarly (or similar) 
  and submit those changes as a PR.
- We follow the [Google Developer Documentation Style Guidelines][] —
  for example, don't use "i.e." or "e.g.", 
  and avoid writing in first person. 
  You can start with the
  [style guide highlights](https://developers.google.com/style/highlights) 
  or the [word list](https://developers.google.com/style/word-list), 
  or use the search bar that's at the top of every style guide page. 

> We truly thank you for your willingness and helpfulness
> in keeping the website docs up to date!


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
