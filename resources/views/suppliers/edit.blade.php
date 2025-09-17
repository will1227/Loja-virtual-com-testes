<x-app-layout>
    <x-slot name="header">
        <h3 class="text-center font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Editar Fornecedor') }}
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

        {{-- Mensagem de sucesso --}}
        @if (session('success'))
            <div class="p-4 mt-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulário --}}
        <form action="{{ url('suppliers/update/' . $supplier->id) }}" method="POST">
            @csrf
            
            {{-- Nome --}}
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="w-full" type="text" name="name"
                    value="{{ old('name', $supplier->name) }}" />
            </div>

            {{-- Tipo --}}
            <div class="mb-4">
                <x-input-label for="tipo" :value="__('Tipo')" />
                <select id="tipo" name="tipo"
                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="f" {{ old('tipo', $supplier->tipo) == 'f' ? 'selected' : '' }}>Física</option>
                    <option value="j" {{ old('tipo', $supplier->tipo) == 'j' ? 'selected' : '' }}>Jurídica</option>
                </select>
            </div>

            {{-- CPF/CNPJ --}}
            <div class="mb-4">
                <x-input-label for="cpf_cnpj" :value="__('CPF ou CNPJ')" />
                <x-text-input id="cpf_cnpj" class="w-full" type="text" name="cpf_cnpj"
                    value="{{ old('cpf_cnpj', $supplier->cpf_cnpj) }}" />
            </div>

            {{-- Telefone --}}
            <div class="mb-4">
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input id="telefone" class="w-full" type="text" name="telefone"
                    value="{{ old('telefone', $supplier->telefone) }}" />
            </div>

            {{-- Botões --}}
            <div class="flex items-center justify-end mt-4">
                <a href="{{ url('/suppliers') }}">
                    <x-secondary-button>Voltar</x-secondary-button>
                </a>

                <x-primary-button class="ms-4" type="submit">
                    {{ __('Atualizar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
