
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

                <table class="table-auto border-separate border border-slate-500">
                    <thead>
                        <tr>
                            <th class="border border-slate-600">ID_Consignación</th>
                            <th class="border border-slate-600">Con detenido</th>
                            <th class="border border-slate-600">Agencia</th>
                            <th class="border border-slate-600">No. Averiguación Previa</th>
                            <th class="border border-slate-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 1 </td>
                            <td> Con detenido </td>
                            <td> Agencia 01 </td>
                            <td> Prueba 01 </td>
                            <td> Acciones </td>
                        </tr>
                        <tr>
                            <td> 2 </td>
                            <td> Con detenido </td>
                            <td> Agencia 02 </td>
                            <td> Prueba 02 </td>
                            <td> Acciones </td>
                        </tr>
                        <tr>
                            <td> 3 </td>
                            <td> Con detenido </td>
                            <td> Agencia 03 </td>
                            <td> Prueba 03 </td>
                            <td> Acciones </td>
                        </tr>
                        {{-- @foreach ( $consignaciones as $consignacion )
                        <tr>
                            <td> {{ $consignacion->ID_Consignacion}} </td>
                            <td> {{ $consignacion['Con Detenido']}} </td>
                            <td> {{ $consignacion->Agencia }} </td>
                            <td> {{ $consignacion->Averiguacion }} </td>
                            <td> Acciones </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>