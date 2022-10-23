{{-- <div>
    @dd($consignaciones)
</div> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Consulta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="py-5 overflow-hidden bg-white shadow-xl sm:rounded-lg">

                <div class="px-5">
                    <div class="w-full py-5 bg-gray-100">
                        {{-- DATOS Con Detenido --}}
                        @if($consignaciones['Detenido'] === 'Si')
                        <div class="flex justify-end mb-10 mr-1">
                            <p><span class="inline-flex items-center justify-center p-2 text-xl font-bold leading-none text-red-100 bg-red-600 rounded-sm">Con detenido: {{ $consignaciones['Detenido'] }}</span></p>
                        </div>
                        @else
                        <div class="flex justify-end mb-10 mr-1">
                            <p><span class="inline-flex items-center justify-center p-2 text-xl font-bold leading-none text-red-100 bg-green-600 rounded-sm">Con detenido: {{ $consignaciones['Detenido'] }}</span></p>
                        </div>
                        @endif
                        <div class="flex justify-end mb-10">

                            {{-- DATOS Agencia --}}
                            <div>
                                <p class=""><span class="inline-flex items-center justify-center p-2 mr-40 text-xl font-bold leading-none text-red-100 bg-blue-600 rounded-md">Agencia: {{ $consignaciones['Agencia'] }}</span></p>
                            </div>
                            {{-- DATOS Fecha registro --}}
                            <div>
                                <p><span class="inline-flex items-center justify-center p-2 mr-10 text-xl font-bold leading-none text-red-100 bg-blue-600 rounded-md">Fecha: {{ $consignaciones['Fecha'] }}</span></p>
                            </div>
                        </div>



                        {{-- ELEMENTO Seccion --}}
                        <div class="flex flex-col justify-end">
                            <p class="self-end h-3 pr-5 text-xl font-bold text-blue-700">Datos Generales</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                        </div>
                        {{-- DATOS Generales --}}
                        <div class="columns-2">
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Averiguación Previa</p>
                                <p class="py-3 pl-5 bg-white rounded">{{ $consignaciones['Av_Previa'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Juzgado</p>
                                <p class="py-3 pl-5 bg-white rounded">{{ $consignaciones['Juzgado'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Reclusorio</p>
                                <p class="py-3 pl-5 bg-white rounded">{{ $consignaciones['Reclusorio'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Fojas</p>
                                <p class="py-3 pl-5 bg-white rounded">{{ $consignaciones['Fojas'] }}</p>
                            </div>
                        </div>
                        {{-- ELEMENTO Seccion --}}
                        <div class="flex flex-col justify-end">
                            <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-blue-700">Participantes</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                        </div>

                        {{-- ELEMENTO Tabla --}}
                        <div class="w-full px-5 py-3">
                            <table class="w-full bg-cyan-900">
                                <thead class="text-white">
                                    <tr class="">
                                        <th class="w-1/6 py-5">Nombre</th>
                                        <th class="w-1/6 py-5">Apellido Paterno</th>
                                        <th class="w-1/6 py-5">Apellido Materno</th>
                                        <th class="w-1/6 py-5">Tipo</th>
                                        <th class="w-1/6 py-5">Alias</th>
                                        <th class="w-1/6 py-5">Delito</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center bg-white">
                                    @foreach ($consignaciones['Personas'] as $persona)
                                    <tr>
                                        <td class="py-2 border-b-2"> {{ $persona['Nombre'] }} </td>
                                        <td class="py-2 border-b-2"> {{ $persona['Ap_Paterno'] }} </td>
                                        <td class="py-2 border-b-2"> {{ $persona['Ap_Materno'] }} </td>
                                        <td class="py-2 border-b-2"> {{ $persona['Calidad'] }} </td>
                                        <td>
                                            @foreach ( $persona['Alias'] as $alias)
                                            {{ $alias }},
                                            @endforeach
                                        </td>
                                        <td class="py-2 border-b-2"> Pendiente delito </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- ELEMENTO Seccion --}}
                        <div class="flex flex-col justify-end">
                            <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-blue-700">Antecedente</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                        </div>
                        {{-- ELEMENTO Antecedente  --}}
                        <div class="flex justify-start w-full px-5 py-3">
                            <div class="w-2/4 ml-10 ">
                                <div class="flex w-11/12 py-1">
                                    <p class="w-1/2 py-3 text-xl font-bold text-blue-400">Fecha</p>
                                    <p class="w-1/2 py-3 pl-5 bg-white rounded">{{ $consignaciones['Antecedente']['Fecha'] }}</p>
                                </div>
                                <div class="flex w-11/12 py-1">
                                    <p class="w-1/2 py-3 text-xl font-bold text-blue-400">Juzgado</p>
                                    <p class="w-1/2 py-3 pl-5 bg-white rounded">{{ $consignaciones['Antecedente']['Juzgado'] }}</p>
                                </div>
                                <div class="flex w-11/12 py-1">
                                    <p class="w-1/2 py-3 text-xl font-bold text-blue-400">Con detenido</p>
                                    <p class="w-1/2 py-3 pl-5 bg-white rounded">{{ $consignaciones['Antecedente']['Con Detenido'] }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- ELEMENTO Seccion --}}
                        <div class="flex flex-col justify-end">
                            <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-blue-700">Datos adicionales</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                        </div>

                        {{-- DATOS Adicionales --}}
                        <div class="columns-2">
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Hora recibo</p>
                                <p class="flex py-3 pl-5 bg-white rounded"><img src="img/reloj.svg" alt="" class="mr-2">{{ $consignaciones['Hora_Recibo'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Hora entrega</p>
                                <p class="flex py-3 pl-5 bg-white rounded"><img src="img/reloj.svg" alt="" class="mr-2">{{ $consignaciones['Hora_Entrega'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Hora salida</p>
                                <p class="flex py-3 pl-5 bg-white rounded"><img src="img/reloj.svg" alt="" class="mr-2">{{ $consignaciones['Hora_Salida'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Hora regreso</p>
                                <p class="flex py-3 pl-5 bg-white rounded"><img src="img/reloj.svg" alt="" class="mr-2">{{ $consignaciones['Hora_Regreso'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Hora Llegada</p>
                                <p class="flex py-3 pl-5 bg-white rounded"><img src="img/reloj.svg" alt="" class="mr-2">{{ $consignaciones['Hora_Llegada'] }}</p>
                            </div>
                            <div class="w-11/12 ml-5">
                                <p class="py-3 font-bold text-blue-500">Fecha entrega</p>
                                <p class="flex py-3 pl-5 bg-white rounded"><img src="img/calendar.svg" alt="" class="mr-2">{{ $consignaciones['Fecha_Entrega'] }}</p>
                            </div>
                        </div>
                        <div class="py-3 ml-5">
                            <p class="py-3 font-bold text-blue-500">Notas Adicionales</p>
                            <p class="w-3/4 py-3 pl-5 bg-white rounded"> {{ $consignaciones['Nota'] }}</p>
                        </div>

                        {{-- ELEMENTO Boton --}}
                        <div class="flex justify-center w-full">
                            <div class="flex w-1/2 px-5 py-3">
                                <a href="{{ route('dashboard') }}" class="px-10 w-full py-2.5 bg-blue-600 text-white font-medium text-lg leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out text-center">Volver</a>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>