<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Editar produto') }}
        </h3>
    </x-slot>

    <div class="py-4 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

            {{-- Mensagem de erro (validação, etc) --}}
            @if ($errors->any())
                <div class="p-4 mb-4 bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-100 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('products/update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div>
                    <x-input-label for="name" value="Nome" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        value="{{ old('name', $product->name) }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="description" value="Descrição" />
                    <textarea id="description" name="description"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                        rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <x-input-label for="quantity" value="Quantidade" />
                    <x-text-input id="quantity" name="quantity" type="number" class="mt-1 block w-full"
                        value="{{ old('quantity', $product->quantity) }}" required />
                </div>

                <div>
                    <x-input-label for="price" value="Preço" />
                    <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full"
                        value="{{ old('price', $product->price) }}" required />
                </div>

                <div>
                    <x-input-label for="type_id" value="Tipo" />
                    <select id="type_id" name="type_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $product->type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ url('/products') }}">
                        <x-secondary-button>Cancelar</x-secondary-button>
                    </a>
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
