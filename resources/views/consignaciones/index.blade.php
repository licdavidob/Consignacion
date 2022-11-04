<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Consignaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- CONTENEDOR PRINCIPAL Content --}}
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                {{-- CONTENEDOR Busqueda --}}
                <div class="grid grid-cols-1">
                    <div class="col-span-1">
                        <div class="flex items-center px-6 py-4">
                            <form action="{{ route('dashboard') }}" class="w-full">
                                <input type="text"
                                    id="averiguacion"
                                    name="averiguacion"
                                    class="flex-1 block w-full px-3 py-2 mt-1 mr-4 bg-white border border-none rounded-md shadow-sm apparence-none focus:outline-none focus:border-sky-500 focus:ring-sky-500 sm:text-sm focus:ring-1"
                                    placeholder="Ingrese número de averiguación"
                                    >
                                    <input type="submit" value="Buscar" class="p-2 text-white rounded mt-4 bg-cyan-600 w-full md:w-1/3 font-medium text-base leading-tight shadow-md hover:bg-cyan-700 hover:shadow-lg focus:bg-cyan-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-cyan-800 active:shadow-lg transition duration-150 ease-in-out text-center">
                            </form>
                        </div>
                    </div>
                </div>
                {{-- ELEMENTO Botón --}}
                <div class="flex justify-center md:justify-end mr-3">
                    <a href="{{ route('crear') }}" class="w-4/5 md:w-2/5 py-2.5 bg-cyan-600 text-white font-medium text-base leading-tight rounded shadow-md hover:bg-cyan-700 hover:shadow-lg focus:bg-cyan-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-cyan-800 active:shadow-lg transition duration-150 ease-in-out text-center">Crear registro</a>
                </div>
                {{-- ELEMENTO Tabla --}}
                <div class="w-full px-5 py-3">
                    <table class="w-full bg-cyan-900">
                        <thead class="text-white">
                            <tr class="">
                                <th class="py-5">ID_Consignación</th>
                                <th class="py-5">Con detenido</th>
                                <th class="py-5">Agencia</th>
                                <th class="py-5">No. Averiguación Previa</th>
                                <th class="py-5">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center bg-white">
                            @foreach ( $consignaciones as $consignacion )
                            <tr>
                                <td class="py-2 border-b-2"> {{ $consignacion->ID_Consignacion}} </td>
                                @if ($consignacion->Detenido === 1)
                                <td class="py-2 border-b-2"> Con Detenido </td>
                                @else
                                <td class="py-2 border-b-2"> Sin Detenido </td>
                                @endif
                                <td class="py-2 border-b-2"> {{ $consignacion->Agencia->Nombre }} </td>
                                <td class="py-2 border-b-2"> {{ $consignacion->Averiguacion }} </td>
                                <td class="py-2 border-b-2">
                                    <div class="flex justify-center item-center align-middle">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a  href="{{ route('mostrar', $consignacion) }}"><img src="img/show.svg" alt=""></a>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('editar', $consignacion) }}"><img src="img/edit.svg" alt=""></a>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <form action="{{ route('consignaciones.destroy', $consignacion) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="x" class="px-2 text-white bg-gray-800 rounded " onclick="return confirm('¿Desea eliminar el registro?')">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $consignaciones->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>