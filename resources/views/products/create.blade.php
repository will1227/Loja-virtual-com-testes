<x-app-layout>
    <x-slot name="header">
        <h3 class="text-center font-semibold text-gray-800 dark:text-gray-200 ">
            {{ __('Manutenção de produtos') }}
        </h3>
    </x-slot>
    <br>
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-md shadow">

        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <x-input-error :messages="$error" class="mt-2" />
            @endforeach
        </ul>
        @endif
        <br>

        <form action="{{ url('products/new') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input dusk="name" class="w-full" type="text" name="name" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Descrição')" />
                <textarea dusk="description" id="description" name="description"
                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" rows="5"></textarea>
            </div>

            <div>
                <x-input-label for="quantity" :value="__('Quantidade')" />
                <x-text-input dusk="quantity" class="w-full" type="number" name="quantity" />
            </div>

            <div>
                <x-input-label for="price" :value="__('Preço')" />
                <x-text-input dusk="price" class="w-full" type="number" name="price" />
            </div>

            <div>
                <x-input-label for="type_id" :value="__('Tipo')" />
                <select dusk="type_id" id="type_id" name="type_id"
                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-input-label for="image" :value="__('Imagem do Produto')" />
                <input dusk="image" type="file" name="image" id="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0 file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ url('/products') }}">
                    <x-secondary-button dusk="back-button">Voltar</x-secondary-button>
                </a>

                <x-primary-button dusk="save-button" class="ms-4" type="submit">
                    {{ __('Salvar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
