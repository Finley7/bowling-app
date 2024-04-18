<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-bold">Game #{{ $game->id }}, Lane {{ $game->lane }}</h2>

                    <div class="overflow-x-auto">
                        <table class="table-auto border-collapse w-full">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Player</th>
                                <th class="px-4 py-2">Frame 1</th>
                                <th class="px-4 py-2">Frame 2</th>
                                <th class="px-4 py-2">Frame 3</th>
                                <th class="px-4 py-2">Frame 4</th>
                                <th class="px-4 py-2">Frame 5</th>
                                <th class="px-4 py-2">Frame 6</th>
                                <th class="px-4 py-2">Frame 7</th>
                                <th class="px-4 py-2">Frame 8</th>
                                <th class="px-4 py-2">Frame 9</th>
                                <th class="px-4 py-2">Frame 10</th>
                                <th class="px-4 py-2">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($game->players as $player)
                            <tr>
                                <td class="border px-4 py-2">{{ $player->name }}</td>
                                @foreach($player->scores as $score)
                                <td class="border px-4 py-2">
                                    <div class="flex flex-col">
                                        <p class="text-center">@if($score->score_1 == 10)
                                                X
                                            @elseif(($score->score_1 + $score->score_2) == 10)
                                                {{ $score->score_1 }} /
                                            @else
                                                {{ $score->score_1 }} {{ $score->score_2 }}
                                            @endif</p>
                                        <p class="text-center">{{ $score->total_score }}</p>
                                    </div>
                                </td>
                                @endforeach
                                <td class="border px-4 py-2"></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-5 border p-3">
                        @if(flash()->message)
                            <div>
                                {{ flash()->message }}
                            </div>
                        @endif
                        <p class="mb-3"><span class="font-bold">{{ $turn->player->name }}</span> is aan de beurt. Ronde #{{ $game->state }} @if($turn->score_1 != null)De vorige score was {{ $turn->score_1 }}@endif</p>
                        <form action="{{ route('player-score.save') }}" method="post" id="score-form">
                            <div class="flex items-center space-x-3">
                                @csrf
                                <input type="hidden" name="current_score" value="{{ $turn->score_1 == null ? 'score_1' : 'score_2' }}">
                                <input type="hidden" name="score_id" value="{{ $turn->id }}">
                                <label for="score">Voer de score in</label>
                                <input id="score" name="score" max="10" min="0" type="number" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block" value="{{ old('score') }}" required autofocus>
                                <button class="px-2 py-1 bg-green-500 tracking-tighter rounded">Opslaan</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-5">
                        <a class="px-2 py-1 bg-amber-500 tracking-tighter font-bold rounded" onclick="return confirm('Are you sure you want to end this game?')" href="{{ route('board.end') }}">Spel beëindigen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite('resources/js/board.js')

