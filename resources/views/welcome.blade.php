<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold">Welkom bij het bowlingcenter</h2>
                    @if($game !== null)
                        <div class="mt-3">
                            <h1 class="font-bold">Let op!</h1>
                            <p>Er is op dit moment nog een actief. Wil je met dit spel doorgaan of opnieuw beginnen?</p>
                            <div class="flex space-x-1 mt-3">
                                <a class="bg-red-400 tracking-tighter font-sm rounded px-3 py-1.5 font-bold" href="{{ route('board.finish') }}">Spel beeindigen</a>
                                <a class="bg-blue-400 tracking-tighter font-sm rounded px-3 py-1.5 font-bold" href="{{ route('board.landing') }}">Spel voortzetten</a>
                            </div>
                        </div>
                        @else
                        <div class="mt-3">
                            <button id="add-player-button" class="mb-3 text-sm bg-blue-300 py-1 px-2 rounded">+ Speler toevoegen</button>
                            <form action="{{ route('player.save') }}" id="player-form" method="post">
                                @csrf
                                <ul id="player-list"></ul>
                                <button class="mt-3 text-white font-bold tracking-tight bg-green-500 py-1 px-2 rounded">Doorgaan</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite('resources/js/welcome.js')
