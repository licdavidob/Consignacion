{{-- @dd($consignaciones) --}}
<!-- TODO: Se tiene que trabajar con el arreglo -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edición de Consignación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                {{-- Contenido --}}
                <div class="px-5 py-3">
                    <div class="w-full py-5 bg-gray-100">
                        {{-- ELEMENTO Form --}}

                        <div class="px-3 mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-2 md:gap-6">
                                <div class="mt-5 md:col-span-2 md:mt-0">
                                    <form action="{{ route('actualizar', $consignacionId) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="overflow-hidden shadow sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                {{-- ELEMENTO Seccion --}}
                                                <div class="flex flex-col justify-end">
                                                    <p class="self-end h-3 pr-5 text-xl font-bold text-cyan-700">Datos Generales</p>
                                                    <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                                                </div>

                                                <div class="grid grid-cols-6 gap-6">
                                                    {{-- Averiguación previa --}}
                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label for="Av_Previa" class="block text-sm font-medium text-gray-700">Averiguación Previa</label>
                                                        <span class=" text-xs text-red-600">@error('Av_Previa') {{ $message }} @enderror</span>
                                                        <input type="text" name="Av_Previa" id="Av_Previa" autocomplete="given-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Av_Previa'] }}">
                                                    </div>
                                                    {{-- Con detenido --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Detenido" class="block text-sm font-medium text-gray-700">Con detenido</label>
                                                        <select id="Detenido" name="Detenido" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <!-- TODO: Revisar como se esta mandando la información, como cadena o como numero -->
                                                            <option value="{{ $consignaciones['Detenido'] }}">{{ $consignaciones['Detenido'] }}</option>
                                                            <option value="1">Si</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                        <span class=" text-xs text-red-600">@error('Detenido') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Agencia --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Agencia" class="block text-sm font-medium text-gray-700">Agencia</label>
                                                        <select id="Agencia" name="Agencia" autocomplete="Agencia-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="{{ $agenciaID[0]['ID_Agencia'] }}">{{ $consignaciones['Agencia'] }}</option>
                                                            @foreach ($agencias as $agencia)
                                                            <option value="{{ $agencia->ID_Agencia }}">{{ $agencia->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class=" text-xs text-red-600">@error('Agencia') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Fecha --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                                                        <input type="date" name="Fecha" id="Fecha" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Fecha'] }}">
                                                        <span class=" text-xs text-red-600">@error('Fecha') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Reclusorio --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Reclusorio" class="block text-sm font-medium text-gray-700">Reclusorio</label>
                                                        <select id="Reclusorio" name="Reclusorio" autocomplete="reclusorio-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="{{ $reclusoriosID[0]['ID_Reclusorio'] }}">{{ $consignaciones['Reclusorio'] }}</option>
                                                            @foreach ($reclusorios as $reclusorio)
                                                            <option value="{{ $reclusorio->ID_Reclusorio }}">{{ $reclusorio->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class=" text-xs text-red-600">@error('Reclusorio') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Juzgado --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Juzgado" class="block text-sm font-medium text-gray-700">Juzgado</label>
                                                        <select id="Juzgado" name="Juzgado" autocomplete="juzgado-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="{{ $juzgadosID[0]['ID_Juzgado'] }}">{{ $consignaciones['Juzgado'] }}</option>
                                                            @foreach ($juzgados as $juzgado)
                                                            <option value="{{ $juzgado->ID_Juzgado }}">{{ $juzgado->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class=" text-xs text-red-600">@error('Juzgado') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Fojas --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Fojas" class="block text-sm font-medium text-gray-700">Fojas</label>
                                                        <input type="number" name="Fojas" id="Fojas" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Fojas'] }}">
                                                        <span class=" text-xs text-red-600">@error('Fojas') {{ $message }} @enderror</span>
                                                    </div>

                                                    {{-- ELEMENTO Seccion --}}
                                                    <div class="flex flex-col justify-end col-span-6">
                                                        <p class="self-end h-3 pr-5 text-xl font-bold text-cyan-700">Participantes</p>
                                                        <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                                                    </div>

                                                    {{-- Tabla Participantes --}}
                                                    <div class="w-full col-span-6 px-5 py-3">
                                                        <table class="w-full bg-cyan-900">
                                                            <thead class="text-white">
                                                                <tr class="">
                                                                    {{-- <th class="w-1/6 py-5">ID</th> --}}
                                                                    <th class="w-1/11 py-5"></th>
                                                                    <th class="w-1/5 py-5">Nombre</th>
                                                                    <th class="w-1/5 py-5">Apellido Paterno</th>
                                                                    <th class="w-1/5 py-5">Apellido Materno</th>
                                                                    <th class="w-1/5 py-5">Tipo</th>
                                                                    <th class="w-1/5 py-5">Alias</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center bg-white">

                                                                {{-- PARTICIPANTES > REGISTROS --}}

                                                                @php
                                                                $i = 1;
                                                                @endphp
                                                                @foreach ($consignaciones['Personas'] as $persona)
                                                                <tr>
                                                                    <td class="py-2 border-b-2">
                                                                        <input type="hidden" name="Persona{{ $i }}[]" value="{{ $persona['ID_Persona'] }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                    </td>
                                                                    <td class="py-2 border-b-2">
                                                                        <input type="text" name="Persona{{ $i }}[]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $persona['Nombre'] }}">
                                                                    </td>
                                                                        <td class="py-2 border-b-2">
                                                                            <input type="text" name="Persona{{ $i }}[]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $persona['Ap_Paterno'] }}">
                                                                        </td>
                                                                        <td class="py-2 border-b-2">
                                                                            <input type="text" name="Persona{{ $i }}[]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $persona['Ap_Materno'] }}">
                                                                        </td>
                                                                        <td class="py-2 border-b-2">
                                                                            <select id="{{ $persona['ID_Persona'] }}" name="Persona{{ $i }}[]" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                                                <option value="{{ $persona['ID_Calidad'] }}">{{ $persona['Calidad'] }}</option>
                                                                                {{-- <option value="">Seleccionar</option> --}}
                                                                                @foreach ($tipoParticipante as $participante)
                                                                                <option value="{{ $participante->ID_Calidad }}">{{ $participante->Calidad }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td class="py-2 border-b-2">
                                                                            @foreach ( $persona['Alias'] as $alias)
                                                                            <input type="text" name="Persona{{ $i }}[]" id="{{ $persona['ID_Persona'] }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $alias }}">
                                                                            @endforeach
                                                                        </td>
                                                                    </tr>
                                                                    {{-- <input type="text" name="contador" value="{{ $i }}"> {{ $i }} --}}
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        {{-- ELEMENTO Seccion --}}
                                                        <div class="flex flex-col justify-end my-10">
                                                            <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-cyan-700">Delitos</p>
                                                            <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                                                        </div>
                                                        {{-- TABLA de delitos --}}
                                                        <div class="flex justify-center">
                                                            <table class="w-10/12 bg-cyan-900">
                                                                <thead class="text-white">
                                                                    <tr class="">
                                                                        <th class="w-1/2 py-5">Nombre</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="text-center bg-white">
                                                                    <tr>
                                                                        <td class="py-2 border-b-2"> 
                                                                            <select id="Delitos" name="Delitos[]" autocomplete="Delitos-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                                                @if ($consignaciones['Delitos'])
                                                                                <option value="{{ $consignaciones['Delitos'][0]['ID_Delito'] }}">{{ $consignaciones['Delitos'][0]['Nombre'] }}</option>
                                                                                @else
                                                                                <option value="">Seleccionar</option>
                                                                                @endif
                                                                                @foreach ($delitos as $delito)
                                                                                <option value="{{ $delito->ID_Delito }}">{{ $delito->Nombre }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <span class=" text-xs text-red-600">@error('Delitos') {{ $message }} @enderror</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- ELEMENTO Seccion --}}
                                                    <div class="flex flex-col justify-end my-10 col-span-6">
                                                        <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-cyan-700">Antecedentes</p>
                                                        <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                                                    </div>

                                                    {{-- INFORMACION antecedentes --}}
                                                    {{-- Con detenido --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Detenido_Ant" class="block text-sm font-medium text-gray-700">Con detenido</label>
                                                        <select id="Detenido_Ant" name="Antecedente[]" autocomplete="con_detenido_Ant-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="{{ $consignaciones['Antecedente']['Con Detenido'] }}">{{ $consignaciones['Antecedente']['Con Detenido'] }}</option>
                                                            <option value="1">Si</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                        <span class=" text-xs text-red-600">@error('Detenido_Ant') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Juzgado --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Juzgado_Ant" class="block text-sm font-medium text-gray-700">Juzgado</label>
                                                        <select id="Juzgado_Ant" name="Antecedente[]" autocomplete="agencia-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                            <option value="{{ $juzgadoAntecedente[0]['ID_Juzgado'] }}">{{ $consignaciones['Antecedente']['Juzgado'] }}</option>
                                                            @foreach ($juzgados as $juzgar)
                                                            <option value="{{ $juzgar->ID_Juzgado }}">{{ $juzgar->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class=" text-xs text-red-600">@error('Juzgado_Ant') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Fecha --}}
                                                    <div class="col-span-6 sm:col-span-2">
                                                        <label for="Fecha_Ant" class="block text-sm font-medium text-gray-700">Fecha</label>
                                                        <input type="date" name="Antecedente[]" id="Fecha_Ant" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Antecedente']['Fecha'] }}">
                                                        <span class=" text-xs text-red-600">@error('Fecha_Ant') {{ $message }} @enderror</span>
                                                    </div>

                                                    {{-- ELEMENTO Seccion --}}
                                                    <div class="flex flex-col justify-end my-10 col-span-6">
                                                        <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-cyan-700">Datos adicionales</p>
                                                        <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                                                    </div>

                                                    {{-- ELEMENTO fechas --}}
                                                    {{-- Hora recibo --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="Hora_Recibo" class="block text-sm font-medium text-gray-700">Hora recibo</label>
                                                        <input type="time" name="Hora_Recibo" id="Hora_Recibo" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Hora_Recibo'] }}">
                                                        <span class=" text-xs text-red-600">@error('Hora_Recibo') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Hora entrega --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="Hora_Entrega" class="block text-sm font-medium text-gray-700">Hora entrega</label>
                                                        <input type="time" name="Hora_Entrega" id="Hora_Entrega" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Hora_Entrega'] }}">
                                                        <span class=" text-xs text-red-600">@error('Hora_Entrega') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Hora salida --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="Hora_Salida" class="block text-sm font-medium text-gray-700">Hora salida</label>
                                                        <input type="time" name="Hora_Salida" id="Hora_Salida" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Hora_Salida'] }}">
                                                        <span class=" text-xs text-red-600">@error('Hora_Salida') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Hora regreso --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="Hora_Regreso" class="block text-sm font-medium text-gray-700">Hora regreso</label>
                                                        <input type="time" name="Hora_Regreso" id="Hora_Regreso" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Hora_Regreso'] }}">
                                                        <span class=" text-xs text-red-600">@error('Hora_Regreso') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Hora llegada --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="Hora_Llegada" class="block text-sm font-medium text-gray-700">Hora llegada</label>
                                                        <input type="time" name="Hora_Llegada" id="Hora_Llegada" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Hora_Llegada'] }}">
                                                        <span class=" text-xs text-red-600">@error('Hora_Llegada') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Fecha entrega --}}
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="Fecha_Entrega" class="block text-sm font-medium text-gray-700">Fecha entrega</label>
                                                        <input type="date" name="Fecha_Entrega" id="Fecha_Entrega" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $consignaciones['Fecha_Entrega'] }}">
                                                        <span class=" text-xs text-red-600">@error('Fecha_Entrega') {{ $message }} @enderror</span>
                                                    </div>
                                                    {{-- Notas --}}
                                                    <div class="col-span-6 sm:col-span-6">
                                                        <label for="Nota" class="block text-sm font-medium text-gray-700">Nota</label>
                                                        <textarea id="Nota" name="Nota" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Notas opcionales">{{ $consignaciones['Nota'] }}</textarea>
                                                        <span class=" text-xs text-red-600">@error('Nota') {{ $message }} @enderror</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="grid grid-cols-6 gap-6 w-full">
                                                <div class="col-span-3 w-full flex justify-center py-5">
                                                    <a href="{{ route('dashboard') }}" class=" py-4 px-6 text-md font-medium text-white w-1/2 bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 text-center">Volver </a>
                                                </div>
                                                <div class="col-span-3 flex justify-center py-5">
                                                    <button type="submit" class="inline-flex justify-center px-6 py-4 text-md font-medium text-white bg-emerald-600 border border-transparent rounded-md shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 w-1/2">Guardar</button>
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