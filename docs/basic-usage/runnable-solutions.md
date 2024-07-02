---
title: Runnable solutions
weight: 2
---

For some solutions, the package will display a button that will automatically run the solution. Here's how that looks when you forget to set an app key:

![image](/docs/laravel-error-solutions/v1/images/runnable-solution.png)

If you don't want to use runnable solutions, you can disable them by setting the `enable_runnable_solutions` key to `false` in the config file.

## A note on security

Runnable solutions will only be available in local development environments.

Under the hood, the package uses the `Spatie\LaravelErrorSolutions\Support\RunnableSolutionsGuard` class to determine if the app is running locally. 

To have more control over the behaviour, you can extend this class and override its methods. You must set the `runnable_solutions_guard` key in the config file to your custom class.
