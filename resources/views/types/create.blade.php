<x-app-layout>
    <x-slot name="header">
        <h3 class="text-center font-semibold text-gray-800 dark:text-gray-200 ">
            {{ __('Adicionar Novo Tipo') }}
        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-md shadow-lg">

            @if ($errors->any())
            <div class="mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <x-input-error :messages="$error" class="mt-2" />
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ url('types/new') }}" method="POST">
                @csrf

                {{-- Type Name Field --}}
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nome do Tipo')" />
                    <x-text-input dusk="name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end mt-6">
                    {{-- Botão de Voltar (opcional) --}}
                    {{-- <a dusk="back-button" href="{{ url('/types') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Voltar') }}
                    </a> --}}

                    <x-primary-button dusk="save-button" class="ms-4" type="submit">
                        {{ __('Salvar Tipo') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
