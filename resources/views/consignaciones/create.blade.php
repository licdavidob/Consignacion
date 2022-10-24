
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Creacion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                {{-- Content --}}
                <div class="px-5 py-3">
                    <div class="w-full py-5 bg-gray-100">
                        {{-- ELEMENTO Seccion --}}
                        <div class="flex flex-col justify-end">
                            <p class="self-end h-3 pr-5 text-xl font-bold text-blue-700">Datos Generales</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                        </div>

                        {{-- @dd($agencias) --}}
                        {{-- ELEMENTO Form --}}

                        <div class="px-3 mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-2 md:gap-6">
                                <div class="mt-5 md:col-span-2 md:mt-0">
                                    <form action="#" method="POST">
                                        <div class="overflow-hidden shadow sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-6 gap-6">
                                                    {{-- Averiguación previa --}}
                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label for="averiguacion" class="block text-sm font-medium text-gray-700">Averiguación Previa</label>
                                                        <input type="text" name="averiguacion" id="averiguacion" autocomplete="given-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Con detenido --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="con_detenido" class="block text-sm font-medium text-gray-700">Con detenido</label>
                                                        <select id="con_detenido" name="con_detenido" autocomplete="con_detenido-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option>Seleccionar</option>
                                                            <option>Si</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                    {{-- Agencia --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="agencia" class="block text-sm font-medium text-gray-700">Agencia</label>
                                                        <select id="agencia" name="agencia" autocomplete="agencia-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="">Seleccionar</option>
                                                            @foreach ($agencias as $agencia)
                                                            <option value="{{ $agencia->ID_Agencia }}">{{ $agencia->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- Fecha --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="fecha_recibo" class="block text-sm font-medium text-gray-700">Fecha</label>
                                                        <input type="text" name="fecha_recibo" id="fecha_recibo" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Reclusorio --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="reclusorio" class="block text-sm font-medium text-gray-700">Reclusorio</label>
                                                        <select id="reclusorio" name="reclusorio" autocomplete="reclusorio-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="">Seleccionar</option>
                                                            @foreach ($reclusorios as $reclusorio)
                                                            <option value="{{ $reclusorio->ID_Reclusorio }}">{{ $reclusorio->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- Juzgado --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="juzgado" class="block text-sm font-medium text-gray-700">Juzgado</label>
                                                        <select id="juzgado" name="juzgado" autocomplete="juzgado-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="">Seleccionar</option>
                                                            @foreach ($juzgados as $juzgado)
                                                            <option value="{{ $juzgado->ID_Juzgado }}">{{ $juzgado->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- Fojas --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="fojas" class="block text-sm font-medium text-gray-700">Fojas</label>
                                                        <input type="text" name="fojas" id="fojas" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>

                                                    {{-- ELEMENTO Seccion --}}
                                                    <div class="flex flex-col justify-end col-span-6">
                                                        <p class="self-end h-3 pr-5 text-xl font-bold text-blue-700">Participantes</p>
                                                        <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                                                    </div>

                                                    {{-- Tabla Participantes --}}
                                                    <div class="w-full col-span-6 px-5 py-3">
                                                        {{-- ELEMENTO Boton --}}
                                                        <div class="flex justify-end py-2 mr-3">
                                                            <a href="{{ route('participante') }}" class="px-3 py-2.5 bg-green-600 text-white font-medium text-lg leading-tight uppercase rounded-3xl shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out text-center"><img src="img/add.svg" alt=""></a>
                                                        </div>
                                                        <table class="w-full bg-cyan-900">
                                                            <thead class="text-white">
                                                                <tr class="">
                                                                    <th class="w-1/6 py-5">Nombre</th>
                                                                    <th class="w-1/6 py-5">Apellido Paterno</th>
                                                                    <th class="w-1/6 py-5">Apellido Materno</th>
                                                                    <th class="w-1/6 py-5">Tipo</th>
                                                                    <th class="w-1/6 py-5">Alias</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center bg-white">
                                                                {{-- @foreach ($consignaciones['Personas'] as $persona) --}}
                                                                <tr>
                                                                    <td class="py-2 border-b-2"> Nombre </td>
                                                                    <td class="py-2 border-b-2"> Ap_Paterno </td>
                                                                    <td class="py-2 border-b-2"> Ap_Materno </td>
                                                                    <td class="py-2 border-b-2"> Calidad </td>
                                                                    <td class="py-2 border-b-2"> Alias   </td>
                                                                    {{-- <td>
                                                                        @foreach ( $persona['Alias'] as $alias)
                                                                        {{ $alias }},
                                                                        @endforeach
                                                                    </td> --}}
                                                                </tr>
                                                                {{-- @endforeach --}}
                                                            </tbody>
                                                        </table>
                                                        
                                                        
                                                        {{-- ELEMENTO Seccion --}}
                                                        <div class="flex flex-col justify-end my-10">
                                                            <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-blue-700">Delitos</p>
                                                            <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                                                        </div>
                                                        
                                                        {{-- TABLA de delitos --}}
                                                        {{-- ELEMENTO Boton --}}
                                                        <div class="flex justify-center py-2 mr-3">
                                                            <a href="{{ route('delitos') }}" class="p-3 bg-green-600 text-white font-medium text-lg leading-tight uppercase rounded-3xl shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out text-center"><img src="img/new.svg" alt=""></a>
                                                        </div>
                                                        <div class="flex justify-center">
                                                            <table class="w-10/12 bg-cyan-900">
                                                                <thead class="text-white">
                                                                    <tr class="">
                                                                        <th class="w-1/2 py-5">ID</th>
                                                                        <th class="w-1/2 py-5">Nombre</th>
                                                                        {{-- <th class="w-1/6 py-5">Delito</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="text-center bg-white">
                                                                    <tr>
                                                                        {{-- <td class="py-2 border-b-2"> {{ $delito['ID_Delito'] }} </td> --}}
                                                                        <td class="py-2 border-b-2"> ID </td>
                                                                        <td class="py-2 border-b-2"> Nombre </td>
                                                                        {{-- <td class="py-2 border-b-2">
                                                                            @foreach ($consignaciones['Delitos'] as $delito)
                                                                            {{ $delito }}
                                                                            @endforeach
                                                                        </td> --}}
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- ELEMENTO Seccion --}}
                                                    <div class="flex flex-col justify-end my-10 col-span-6">
                                                        <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-blue-700">Antecedentes</p>
                                                        <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                                                    </div>

                                                    {{-- INFORMACION antecedentes --}}
                                                    {{-- Con detenido --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="con_detenido_Ant" class="block text-sm font-medium text-gray-700">Con detenido</label>
                                                        <select id="con_detenido_Ant" name="con_detenido_Ant" autocomplete="con_detenido_Ant-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option>Seleccionar</option>
                                                            <option>Si</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                    {{-- Agencia --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="agencia_Ant" class="block text-sm font-medium text-gray-700">Agencia</label>
                                                        <select id="agencia_Ant" name="agencia_Ant" autocomplete="agencia-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="">Seleccionar</option>
                                                            @foreach ($agencias as $agencia)
                                                            <option value="{{ $agencia->ID_Agencia }}">{{ $agencia->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- Fecha --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="fecha_recibo_Ant" class="block text-sm font-medium text-gray-700">Fecha</label>
                                                        <input type="text" name="fecha_recibo_Ant" id="fecha_recibo_Ant" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>

                                                     {{-- ELEMENTO Seccion --}}
                                                     <div class="flex flex-col justify-end my-10 col-span-6">
                                                        <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-blue-700">Datos adicionales</p>
                                                        <hr class="self-end w-11/12 my-5 mr-2 border-blue-400">
                                                    </div>

                                                    {{-- ELEMENTO fechas --}}
                                                    {{-- Hora recibo --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="horaRecibo" class="block text-sm font-medium text-gray-700">Hora recibo</label>
                                                        <input type="text" name="horaRecibo" id="horaRecibo" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Hora entrega --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="horaEntrega" class="block text-sm font-medium text-gray-700">Hora entrega</label>
                                                        <input type="text" name="horaEntrega" id="horaEntrega" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Hora salida --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="horaSalida" class="block text-sm font-medium text-gray-700">Hora salida</label>
                                                        <input type="text" name="horaSalida" id="horaSalida" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Hora regreso --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="hora_regreso" class="block text-sm font-medium text-gray-700">Hora regreso</label>
                                                        <input type="text" name="hora_regreso" id="hora_regreso" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Hora llegada --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="horaLlegada" class="block text-sm font-medium text-gray-700">Hora llegada</label>
                                                        <input type="text" name="horaLlegada" id="horaLlegada" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Fecha entrega --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="fechaEntrega" class="block text-sm font-medium text-gray-700">Fecha entrega</label>
                                                        <input type="text" name="fechaEntrega" id="fechaEntrega" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    {{-- Notas --}}
                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label for="notas" class="block text-sm font-medium text-gray-700">Notas</label>
                                                        <textarea id="notas" name="notas" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Notas opcionales"></textarea>
                                                    </div>

                                                    {{-- Pendientes --}}

                                                </div>
                                            </div>
                                            <div class="grid grid-cols-6 gap-6 w-full">
                                                <div class="col-span-3 w-full flex justify-center py-5">
                                                    <button type="submit" class=" py-4 px-6 w-1/2 bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"><a href="{{ route('dashboard') }}" class=" py-4 px-6 text-md font-medium text-white ">  Volver </a></button>
                                                </div>
                                                <div class="col-span-3 w-full flex justify-center py-5">
                                                    <button type="submit" class=" py-4 px-6 w-1/2 bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"><a href="{{ route('dashboard') }}" class=" py-4 px-6 text-md font-medium text-white ">  Volver </a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>