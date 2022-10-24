

  
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nuevo Participante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                {{-- Agregar personas --}}
                <div class="mt-10 sm:mt-0">
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        {{-- Nombre --}}
                                        <div class="col-span-6 sm:col-span-2">
                                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" autocomplete="given-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        {{-- Apellido Paterno --}}
                                        <div class="col-span-6 sm:col-span-2">
                                            <label for="ap_paterno" class="block text-sm font-medium text-gray-700">Apellido Paterno</label>
                                            <input type="text" name="ap_paterno" id="ap_paterno" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        {{-- Apellido Materno --}}
                                        <div class="col-span-6 sm:col-span-2">
                                            <label for="ap_materno" class="block text-sm font-medium text-gray-700">Apellido Materno</label>
                                            <input type="text" name="ap_materno" id="ap_materno" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        {{-- Boton --}}
                                        <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                            <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>