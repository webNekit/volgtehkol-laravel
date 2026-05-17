<div>
    @foreach($modules as $module)
        <div class="mb-6 p-4 bg-white shadow rounded-lg">
            <h2 class="text-xl font-bold mb-2">{{ $module['title'] }}</h2>
            <ul class="divide-y divide-gray-200">
                @foreach($module['items'] as $item)
                    <li class="py-2 flex justify-between items-center">
                        <span>{{ $item['name'] }}</span>
                        <x-filament::button
                            color="danger"
                            size="sm"
                            wire:click="deletePage('{{ $module['prefix'] }}', '{{ $item['route'] }}', '{{ Str::studly($module['prefix']) }}')"
                            wire:confirm="Вы уверены, что хотите удалить эту страницу?"
                        >
                            Удалить
                        </x-filament::button>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
