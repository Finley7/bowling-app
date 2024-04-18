<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold">Game #{{ $game->id }}, Lane {{ $game->lane }}</h2>
                    <p>Het spel is beëindigd</p>

                    <table class="table-auto border-collapse w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">Speler</th>
                            <th class="px-4 py-2">Score</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($game->players as $player)
                            <tr class="text-center">
                                <td class="px-4 py-2">{{ $player->name }}</td>
                                <td class="px-4 py-2">{{ $player->scores->last()->total_score }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a class="bg-green-400 p-3 rounded font-bold" href="{{ route('board.finish') }}">Nieuw spel starten</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
