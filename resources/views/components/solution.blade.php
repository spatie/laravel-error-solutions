@php
    $solutions = app(\Spatie\LaravelErrorSolutions\Actions\GetSolutionsForLatestThrowableAction::class)->execute();
@endphp

@if(count($solutions))

    <h2>We found a solution</h2>

    @foreach($solutions as $solution)
        <h3>{{ $solution->getSolutionTitle() }}</h3>
        <div>{{ $solution->getSolutionDescription() }}</div>

        @if(count($solution->getDocumentationLinks()))
            <h3>Read more</h3>
            <ul>
                @foreach($solution->getDocumentationLinks() as $label => $url)

                    <li><a href="{{ $url }}">{{ $label }}</a></li>
                @endforeach
            </ul>
        @endif

        {{--
        @if($solution->isAiSolution())
            This solution is provided by our AI. It might not be 100% accurate.
        @endif
        --}}

        @if(config('error-solutions.enable_runnable_solutions'))
            @if($solution instanceof \Spatie\ErrorSolutions\Contracts\RunnableSolution)
                <div x-data="{
                    solutionExecuted: false,
                    submitForm() {
                        this.solutionExecuted = true;

                        fetch('{{ route('execute-laravel-error-solution') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({!! Js::from([
                                 'solution' => $solution::class
                             ]) !!})
                        });
                    }
                }">
                    <div>
                        {{ $solution->getSolutionActionDescription() }}
                    </div>

                    <div x-show="! solutionExecuted">
                        <button @click="submitForm()">
                            {{ $solution->getRunButtonText() }}
                        </button>
                    </div>

                    <div x-show="solutionExecuted">
                        The solution was executed...

                        <div @click="location.reload()">
                            Refresh page
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach

    <div>
        Solution provided by <a href="https://flareapp.io">Flare</a>
    </div>
@endif
