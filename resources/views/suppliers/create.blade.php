<x-app-layout>
    <x-slot name="header">
        <h3 class="text-center font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Manutenção de Fornecedor') }}
        </h3>
    </x-slot>

    <br>

    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-md shadow">
        {{-- Erros de validação --}}
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <x-input-error :messages="$error" class="mt-2" />
                @endforeach
            </ul>
        @endif

        <br>

        <form action="{{ url('suppliers/new') }}" method="POST">
            @csrf

            {{-- Nome --}}
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input dusk="name" id="name" name="name" type="text" class="w-full" value="{{ old('name') }}" />
            </div>

            {{-- Tipo --}}
            <div class="mb-4">
                <x-input-label for="tipo" :value="__('Tipo')" />
                <select dusk="tipo" id="tipo" name="tipo"
                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="">Selecione</option>
                    <option value="F" {{ old('tipo') == 'F' ? 'selected' : '' }}>Física</option>
                    <option value="J" {{ old('tipo') == 'J' ? 'selected' : '' }}>Jurídica</option>
                </select>
            </div>

            {{-- CPF ou CNPJ --}}
            <div class="mb-4">
                <x-input-label for="cpf_cnpj" :value="__('CPF ou CNPJ')" />
                <x-text-input dusk="cpf_cnpj" id="cpf_cnpj" name="cpf_cnpj" type="text" class="w-full" value="{{ old('cpf_cnpj') }}" />
            </div>

            {{-- Telefone --}}
            <div class="mb-4">
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input dusk="telefone" id="telefone" name="telefone" type="text" class="w-full" value="{{ old('telefone') }}" />
            </div>

            {{-- Botões --}}
            <div class="flex items-center justify-end mt-4">
                <a href="{{ url('/suppliers') }}">
                    <x-secondary-button dusk="back-button">Voltar</x-secondary-button>
                </a>

                <x-primary-button dusk="save-button" class="ms-4" type="submit">
                    {{ __('Salvar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
