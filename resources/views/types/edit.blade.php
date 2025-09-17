<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Editar Tipo') }}
        </h3>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-6">

            {{-- Mensagem de erro ou sucesso --}}
            @if ($message = Session::get('success'))
                <div class="p-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 rounded">
                    {{ $message }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="p-4 bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-100 rounded">
                    {{ $message }}
                </div>
            @endif

            {{-- Formulário --}}
            <form action="{{ url('types/update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="id" value="{{ $type['id'] }}">

                {{-- Campo Nome --}}
                <div>
                    <x-input-label for="name" value="Nome" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        value="{{ $type['name'] }}" required />
                </div>

                {{-- Botões --}}
                <div class="flex justify-end gap-2">
                    <a href="{{ url('/types') }}">
                        <x-secondary-button>Cancelar</x-secondary-button>
                    </a>
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
