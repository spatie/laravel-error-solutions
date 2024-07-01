---
title: AI powered solutions
weight: 3
---

The package can send your exceptions to Open AI that will attempt to automatically suggest a solution. In many cases, the suggested solutions is quite useful, but keep in mind that the solution may not be 100% correct for your context.

// INSERT IMAGE

To generate AI powered solutions, you must first install this optional dependency.

```bash
composer require openai-php/client
```

To start sending your errors to OpenAI, you must set `ERROR_SOLUTIONS_OPEN_AI_KEY` in your `.env` file. The value should be your OpenAI key.

These bits of info will be sent to Open AI:

- the error message
- the error class
- the stack frame
- other small bits of info of context surrounding your error

It will not send the request payload or any environment variables to avoid sending sensitive data to OpenAI.
