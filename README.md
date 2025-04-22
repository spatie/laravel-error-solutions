<div align="left">
    <a href="https://spatie.be/open-source?utm_source=github&utm_medium=banner&utm_campaign=laravel-error-solutions">
      <picture>
        <source media="(prefers-color-scheme: dark)" srcset="https://spatie.be/packages/header/laravel-error-solutions/html/dark.webp">
        <img alt="Logo for laravel-error-solutions" src="https://spatie.be/packages/header/laravel-error-solutions/html/light.webp" height="190">
      </picture>
    </a>

<h1> Display solutions on the Laravel error page</h1>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-error-solutions.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-error-solutions)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-error-solutions/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/laravel-error-solutions/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-error-solutions/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/spatie/laravel-error-solutions/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-error-solutions.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-error-solutions)
    
</div>

This package can display solutions on the Laravel error page. Here's how it looks:

![image](https://raw.githubusercontent.com/spatie/laravel-error-solutions/main/docs/images/solution.png)

For some solutions, the package will display a button that will automatically run the solution. Here's how that looks when you forget to set an `APP_KEY` in your `.env` file:

![image](https://raw.githubusercontent.com/spatie/laravel-error-solutions/main/docs/images/runnable-solution.png)

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-error-solutions.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-error-solutions)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require --dev spatie/laravel-error-solutions
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="error-solutions-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * Display solutions on the error page
     */
    'enabled' => true,

    /**
     * Enable or disable runnable solutions.
     *
     * Runnable solutions will only work in local development environments,
     * even if this flag is set to true.
     */
    'enable_runnable_solutions' => true,

    /**
     * This class is responsible for determining if a solution is runnable.
     *
     * In most cases, you can use the default implementation.
     */
    'runnable_solutions_guard' => Spatie\LaravelErrorSolutions\Support\RunnableSolutionsGuard::class,
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="error-solutions-views"
```

## Usage

You can find full documentation on how to use this package on [our documentation site](https://spatie.be/docs/laravel-error-solutions/v1/introduction).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
