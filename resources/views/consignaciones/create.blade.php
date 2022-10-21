
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Creacion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Content --}}

                {{-- Buscador --}}
                <div class="grid grid-cols-1">
                    <div class="col-span-1">
                        <div class="w-full px-6 py-4 flex items-center">
                            <input type="text"
                                class="apparence-none  mt-1 px-3 py-2 border-none bg-white border shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 flex-1 mr-4"
                                placeholder="Buscar">
                        </div>
                    </div>
                </div>

                {{-- Formulario --}}
                <form action="{{ route('guardar') }}" method="post">
                    @csrf
                    <label for="">Fecha:</label>
                    <input type="text">

                </form>

            </div>
        </div>
    </div>
</x-app-layout>