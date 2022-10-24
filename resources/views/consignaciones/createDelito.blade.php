{{-- @dd($delitos) --}}

  
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nuevo Participante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                {{-- Agregar delitos --}}
                <div class="mt-10 sm:mt-0">
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        {{-- delito --}}
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="agencia_Ant" class="block text-sm font-medium text-gray-700">Delito</label>
                                            <select id="agencia_Ant" name="agencia_Ant" autocomplete="agencia-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="">Seleccionar</option>
                                                @foreach ($delitos as $delito)
                                                <option value="{{ $delito->ID_Delito }}">{{ $delito->Nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Con checkbox --}}
                                        {{-- <div class="col-span-6">
                                            @foreach ($delitos as $delito)
                                            <div class="flex items-start">
                                                <div class="flex h-5 items-center">
                                                    <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" value="{{ $delito->ID_Delito }}">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="comments" class="font-medium text-gray-700">{{ $delito->Nombre }}</label>
                                                </div>
                                            </div>
                                            @endforeach --}}
                                            {{-- Otro --}}


                                            {{-- Botones --}}
                                        <div class="col-span-6 flex">
                                            {{-- Boton Volver--}}
                                            <div class="w-1/2 flex justify-center py-5">
                                                <a href="{{ route('crear') }}" class=" py-4 px-6 text-md font-medium text-white w-1/2 bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 text-center">  Volver </a>
                                            </div>
                                            
                                            {{-- Boton Guardar--}}
                                            <div class="w-1/2 flex justify-center py-5">
                                                <button type="submit" class="inline-flex justify-center px-6 py-4 text-md font-medium text-white bg-emerald-600 border border-transparent rounded-md shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 w-1/2">Agregar</button>
                                            </div>
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