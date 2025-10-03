@php
    $solutions = app(\Spatie\LaravelErrorSolutions\Actions\GetSolutionsForLatestThrowableAction::class)->execute();
@endphp

@if(count($solutions))
    <div class="flex flex-col gap-5 bg-neutral-50 dark:bg-white/1 border border-neutral-200 dark:border-neutral-800 rounded-xl p-5 shadow-xs mb-8 sm:mb-16">
        @foreach($solutions as $solution)
            <div class="flex items-center gap-2.5">
                <div class="bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-white/5 rounded-md w-6 h-6 flex items-center justify-center p-1">
                    <x-laravel-exceptions-renderer::icons.info class="w-2.5 h-2.5 text-blue-500 dark:text-emerald-500" />
                </div>
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">{{ $solution->getSolutionTitle() }}{{ str_ends_with($solution->getSolutionTitle(), '.') ? '' : '.' }}</h2>
            </div>
            <p class="text-base text-neutral-500 dark:text-neutral-400">{{ $solution->getSolutionDescription() }}</p>

            @if(count($solution->getDocumentationLinks()))
                <div class="flex flex-col gap-1.5">
                    <h3 class="font-semibold text-sm uppercase">Read more</h3>
                    <ul class="flex flex-col gap-1.5">
                        @foreach($solution->getDocumentationLinks() as $label => $url)
                            <li>
                                <a href="{{ $url }}" target="_blank" rel="nofollow noreferer" class="hover:underline decoration-neutral-400 text-neutral-500 dark:text-neutral-400">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(config('error-solutions.enable_runnable_solutions'))
                @if($solution instanceof \Spatie\ErrorSolutions\Contracts\RunnableSolution)
                    <div
                        x-data="{
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
                        }"
                    >
                        <form x-show="! solutionExecuted" x-on:submit.prevent="submitForm()" class="flex items-center gap-5">
                            <button type="submit" class="text-sm rounded-md border px-3 flex items-center gap-2 transition-colors duration-200 ease-in-out cursor-pointer shadow-xs text-neutral-600 dark:text-neutral-400 bg-white/5 border-neutral-200 hover:bg-neutral-100 dark:bg-white/5 dark:border-white/10 dark:hover:bg-white/10" style="padding-top: 0.25rem; padding-bottom: 0.25rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M4.867 19.125h.008v.008h-.008v-.008Z"/>
                                </svg>
                                {{ $solution->getRunButtonText() }}
                            </button>
                            <p class="text-base text-neutral-500 dark:text-neutral-400">{{ $solution->getSolutionActionDescription() }}</p>
                        </form>

                        <form x-show="solutionExecuted" x-on:submit.prevent="location.reload()" class="flex items-center gap-5">
                            <button type="submit" class="text-sm rounded-md border px-3 flex items-center gap-2 transition-colors duration-200 ease-in-out cursor-pointer shadow-xs text-neutral-600 dark:text-neutral-400 bg-white/5 border-neutral-200 hover:bg-neutral-100 dark:bg-white/5 dark:border-white/10 dark:hover:bg-white/10" style="padding-top: 0.25rem; padding-bottom: 0.25rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                </svg>
                                Refresh page
                            </button>
                            <p class="text-base text-neutral-500 dark:text-neutral-400">The solution was executed.</p>
                        </form>
                    </div>
                @endif
            @endif

            @if(method_exists($solution, 'solutionProvidedByName'))
                <p class="text-sm text-right text-neutral-500 dark:text-neutral-400">
                    @if(method_exists($solution, 'solutionsProvidedByLink'))
                        Solution provided by <a
                            href="{{ $solution->solutionsProvidedByLink() }}">{{ $solution->solutionProvidedByName() }}</a>.
                    @else
                        Solution provided by {{ $solution->solutionProvidedByName() }}.
                    @endif
                    @if($solution instanceof \Spatie\ErrorSolutions\Solutions\OpenAi\OpenAiSolution)
                        This solution was generated by AI. It might not be 100% accurate.
                    @endif
                </p>
            @endif

            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
    </div>
@endif
