@php

    $solutions = app(\Spatie\LaravelErrorSolutions\Actions\GetSolutionsForLatestThrowableAction::class)->execute($exception);

@endphp

@if(count($solutions))

    <h2>We found a solution</h2>

    @foreach($solutions as $solution)
        <h3>{{ $solution->getSolutionTitle() }}</h3>
        <div>{{ $solution->getSolutionDescription() }}</div>

        @if(count($solution->getDocumentationLinks()))
            <ul>
                @foreach($solution->getDocumentationLinks() as $documentationLink)
                    <li><a href="{{ $documentationLink->url }}">{{ $documentationLink->title }}</a></li>
                @endforeach
            </ul>
        @endif
    @endforeach

    <div>
        Solution provided by <a href="https://flareapp.io">Flare</a>
    </div>
@endif
