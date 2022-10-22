
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consignaciones') }}
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
                <div>
                    <a href="{{ route('crear') }}">Crear registro</a>
                </div>
                <div>
                    
                </div>
                <div class="px-5 py-3 w-full">
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
                        <tbody class="bg-white text-center">
                            @foreach ( $consignaciones as $consignacion )
                            <tr>
                                <td class="border-b-2  py-2"> {{ $consignacion->ID_Consignacion}} </td>
                                <td class="border-b-2  py-2"> {{ $consignacion['Con Detenido']}} </td>
                                <td class="border-b-2  py-2"> {{ $consignacion->Agencia }} </td>
                                <td class="border-b-2  py-2"> {{ $consignacion->Averiguacion }} </td>
                                <td class="border-b-2  py-2">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a  href="{{ route('mostrar', $consignacion) }}"><img src="img/show.svg" alt=""></a>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a><img src="img/edit.svg" alt=""></a>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            {{-- <a><img src="img/delete.svg" alt=""> --}}
                                                <form action="{{ route('consignaciones.destroy', $consignacion) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="x" class=" bg-gray-800 text-white rounded px-4 py-2" onclick="return confirm('Desea eliominar')">
                                                    </form>
                                            {{-- </a> --}}
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>