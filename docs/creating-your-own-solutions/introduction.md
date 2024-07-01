---
title: Introduction
weight: 1
---

The package allows you to create custom solutions for your exception. A solution is a simple PHP class that implements the `Spatie\ErrorSolutions\Contracts\Solution` interface.

After you've created a solution class, there are two ways to use that solution: on an exception itself, or via a solution provider. 
