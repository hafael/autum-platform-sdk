# PHP SDK for Autum Platform API

[![Latest Stable Version](http://poser.pugx.org/hafael/autum-platform-sdk/v)](https://packagist.org/packages/hafael/autum-platform-sdk)
[![Latest Unstable Version](http://poser.pugx.org/hafael/autum-platform-sdk/v/unstable)](https://packagist.org/packages/hafael/autum-platform-sdk)
[![Total Downloads](http://poser.pugx.org/hafael/autum-platform-sdk/downloads)](https://packagist.org/packages/hafael/autum-platform-sdk)
[![License](http://poser.pugx.org/hafael/autum-platform-sdk/license)](https://packagist.org/packages/hafael/autum-platform-sdk)

This library provides developers with a simple set of bindings to help you integrate Fitbank API to PHP website project.


## 💡 Requirements

PHP 7.3 or higher


## 🧩 API resources

| Resource             | Status   |
| -------------------- | :------: |
| User Account         | ✅  |
| Notifications        | ✅  |
| Contacts             | ✅  |

✅ = All methods available
⌛ = Under development/testing
💻 = Awaiting contributions

## 📦 Installation 

First time using Autum? Create your [Autum account](https://www.autum.com.br), if you don’t have one already.

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) if not already installed

2. On your project directory run on the command line
`composer require "hafael/autum-platform-sdk"`

3. Copy the API Key and replace API_KEY with it.

That's it! Autum Platform PHP SDK has been successfully installed.


## 🌟 Getting Started
  
  Simple usage looks like:
  
```php
  <?php
    require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

    $autumClient = new Autum\SDK\Platform\Client(
        'API_KEY', 
        'BASE_URL',
    );

    //Get authenticated user info
    $response = $autumClient->users()->getAuthenticatedUser();

    var_dump($response->json());

  ?>
```


## 📚 Documentation 

Visit our Dev Site for further information regarding:
 - Autum Platform API Docs: [English](https://autum.com.br/docs)


## 📜 License 

MIT license. Copyright (c) 2023 - [Rafael](https://github.com/hafael) / [Autum](https://autum.com.br)
For more information, see the [LICENSE](https://github.com/hafael/autum-platform-sdk/blob/main/LICENSE) file.