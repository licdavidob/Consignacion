<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Crear nueva consignación') }}
    </h2>
  </x-slot>
  <script>
    const CatalogoCalidad = @json($tipoParticipante);
    @if(session('PersonaSession')) 
      var Participantes = {{count(session('PersonaSession'))}};
    @else
      var Participantes = 0;
    @endif
  </script>
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
                  <form action="{{ route('guardar') }}" method="POST">
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
                            <label for="Av_Previa" class="block text-sm font-medium text-gray-700">Averiguación Previa<span class=" text-red-600 ml-0.5">*</span></label>
                            <span class="text-xs text-red-600 ">@error('Av_Previa') {{ $message }} @enderror</span>
                            <input type="text" name="Av_Previa" id="Av_Previa" autocomplete="given-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Av_Previa', @$consignacion->Av_Previa) }}">
                          </div>
                          {{-- Con detenido --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Detenido" class="block text-sm font-medium text-gray-700">Con detenido<span class=" text-red-600 ml-0.5">*</span></label>
                            <select id="Detenido" name="Detenido" autocomplete="Detenido-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                              <option value="{{ old('Detenido', @$consignacion->Detenido) }}">{{ old('Detenido', @$consignacion->Detenido) }}</option>
                              <option value="1">Si</option>
                              <option value="2">No</option>
                            </select>
                            <span class="text-xs text-red-600 ">@error('Detenido') {{ $message }} @enderror</span>
                          </div>
                          {{-- Agencia --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Agencia" class="block text-sm font-medium text-gray-700">Agencia<span class=" text-red-600 ml-0.5">*</span></label>
                            <select id="Agencia" name="Agencia" autocomplete="Agencia-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                              <option value="{{ old('Agencia', @$consignacion->ID_Agencia) }}">{{ old('Agencia', @$consignacion->ID_Agencia) }}</option>
                              @foreach ($agencias as $agencia)
                                <option value="{{ $agencia->ID_Agencia }}">{{ $agencia->Nombre }}</option>
                              @endforeach
                            </select>
                            <span class="text-xs text-red-600 ">@error('Agencia') {{ $message }} @enderror</span>
                          </div>
                          {{-- Fecha --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Fecha" class="block text-sm font-medium text-gray-700">Fecha<span class=" text-red-600 ml-0.5">*</span></label>
                            <input type="date" name="Fecha" id="Fecha" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Fecha', @$consignacion->Fecha) }}">
                            <span class="text-xs text-red-600 ">@error('Fecha') {{ $message }} @enderror</span>
                          </div>
                          {{-- Reclusorio --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Reclusorio" class="block text-sm font-medium text-gray-700">Reclusorio<span class=" text-red-600 ml-0.5">*</span></label>
                            <select id="Reclusorio" name="Reclusorio" autocomplete="reclusorio-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                              <option value="{{ old('Reclusorio', @$consignacion->ID_Reclusorio) }}">{{ old('Reclusorio', @$consignacion->ID_Reclusorio) }}</option>
                              @foreach ($reclusorios as $reclusorio)
                                <option value="{{ $reclusorio->ID_Reclusorio }}">{{ $reclusorio->Nombre }}</option>
                              @endforeach
                            </select>
                            <span class="text-xs text-red-600 ">@error('Reclusorio') {{ $message }} @enderror</span>
                          </div>
                          {{-- Juzgado --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Juzgado" class="block text-sm font-medium text-gray-700">Juzgado<span class=" text-red-600 ml-0.5">*</span></label>
                            <select id="Juzgado" name="Juzgado" autocomplete="juzgado-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                              <option value="{{ old('Juzgado', @$consignacion->ID_Juzgado) }}">{{ old('Juzgado', @$consignacion->ID_Juzgado) }}
                              </option>
                              @foreach ($juzgados as $juzgado)
                                <option value="{{ $juzgado->ID_Juzgado }}">{{ $juzgado->Nombre }}</option>
                              @endforeach
                            </select>
                            <span class="text-xs text-red-600 ">@error('Juzgado') {{ $message }} @enderror</span>
                          </div>
                          {{-- Fojas --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Fojas" class="block text-sm font-medium text-gray-700">Fojas<span class=" text-red-600 ml-0.5">*</span></label>
                            <input type="number" name="Fojas" id="Fojas" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Fojas', @$consignacion->Fojas) }}">
                            <span class="text-xs text-red-600 ">@error('Fojas') {{ $message }} @enderror</span>
                          </div>
                          {{-- ELEMENTO Seccion --}}
                          <div class="flex flex-col justify-end col-span-6">
                            <p class="self-end h-3 pr-5 text-xl font-bold text-cyan-700">Participantes</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                          </div>
                            {{-- Tabla Participantes --}}
                            {{-- Botón de agregar participante --}}
                            <div class="col-span-6 sm:col-span-6">
                              <div class="flex justify-end w-full">
                                <div id="AgregarParticipante" class="self-center px-2 py-2 font-medium text-white border border-transparent rounded-full shadow-sm text-md w-1/7 bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"><img src="img/add.svg" alt="">
                                </div>
                              </div>
                            </div>
                            {{-- Tabla de participantes --}}
                            @if ($errors->has('Personas*'))
                            <x-alert>
                              <p>Revisa los datos de los participantes
                              </p>
                            </x-alert>
                            @endif
                          {{-- {{ $errors->get('Personas') }} --}}
                          <div class="w-full col-span-6 px-5 overflow-x-scroll">
                            <table class="w-full table-auto bg-cyan-900">
                              <thead class="text-white">
                                <tr class="">
                                  <th class="w-1/6 py-5">Nombre<span class=" text-red-600 ml-0.5">*</span></th>
                                  <th class="w-1/6 py-5">Apellido Paterno<span class=" text-red-600 ml-0.5">*</span></th>
                                  <th class="w-1/6 py-5">Apellido Materno</th>
                                  <th class="w-1/6 py-5">Tipo<span class=" text-red-600 ml-0.5">*</span></th>
                                  <th class="w-1/6 py-5">Alias</th>
                                  <th class="w-1/6 py-5 pr-4">Acciones</th>
                                </tr>
                              </thead>
                              <tbody class="text-center bg-white" id="Participantes">
                                @if(session('PersonaSession'))
                                  @php
                                    $i = 1
                                  @endphp
                                  @foreach(session('PersonaSession') as $Persona)
                                    <tr>
                                      <td class="py-2 border-b-2">
                                        <input type="text" name="Personas[{{$i}}][Nombre]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$Persona['Nombre']}}">
                                      </td>
                                      <td class="py-2 border-b-2">
                                        <input type="text" name="Personas[{{$i}}][Ap_Paterno]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$Persona['Ap_Paterno']}}">
                                      </td>
                                      <td class="py-2 border-b-2">
                                        <input type="text" name="Personas[{{$i}}][Ap_Materno]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$Persona['Ap_Materno']}}">
                                      </td>
                                      <td class="py-2 border-b-2">
                                        <select name="Personas[{{$i}}][Calidad]" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                          @foreach ($tipoParticipante as $Calidad)
                                            <option value="{{ $Calidad->ID_Calidad }}"
                                              @if ($Calidad->ID_Calidad == $Persona['Calidad'])
                                                selected="selected"
                                              @endif
                                              >{{ $Calidad->Calidad }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </td>
                                      <td class="py-2 border-b-2">
                                        <input type="text" name="Personas[{{$i}}][Alias]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$Persona['Alias']}}">
                                      </td>
                                      <td class="py-2 border-b-2 borrar">
                                        <div class="flex justify-center w-full">
                                          <div class="self-center w-10 px-2 py-2 font-medium text-white border border-transparent rounded-full shadow-sm text-md bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            <img src="/img/delete.svg" alt="" class="w-full">
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    @php
                                      $i ++
                                    @endphp
                                  @endforeach
                                @endif
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
                                    <th class="w-1/2 py-5">Delitos<span class=" text-red-600 ml-0.5">*</span></th>
                                  </tr>
                                </thead>
                                <tbody class="text-center bg-white">
                                  <tr>
                                    <td class="py-2 border-b-2">
                                      <select id="Delitos" name="Delitos" autocomplete="Delitos-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                          <option value="{{ old('Delitos', @$consignacion->ID_Delito) }}">{{ old('Delitos', @$consignacion->ID_Delito) }}</option>
                                          @foreach ($delitos as $delito)
                                            <option value="{{ $delito->ID_Delito }}">{{ $delito->Nombre }}</option>
                                          @endforeach
                                      </select>
                                        <span class="text-xs text-red-600 ">@error('Delitos') {{ $message }} @enderror</span>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          {{-- ELEMENTO Seccion --}}
                          <div class="flex flex-col justify-end col-span-6 my-10">
                            <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-cyan-700">Antecedentes</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                          </div>
                          {{-- INFORMACION antecedentes --}}
                          {{-- Con detenido --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Detenido_Ant" class="block text-sm font-medium text-gray-700">Con detenido</label>
                            <select id="Detenido_Ant" name="Detenido_Ant" autocomplete="con_detenido_Ant-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                              <option value="{{ old('Detenido', @$consignacion->Detenido) }}">{{ old('Detenido', @$consignacion->Detenido) }}</option>
                              <option value="1">Si</option>
                              <option value="2">No</option>
                            </select>
                            <span class="text-xs text-red-600 ">@error('Detenido_Ant') {{ $message }} @enderror</span>
                          </div>
                          {{-- Juzgado --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Juzgado_Ant" class="block text-sm font-medium text-gray-700">Juzgado</label>
                            <select id="Juzgado_Ant" name="Juzgado_Ant" autocomplete="agencia-name" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                              <option value="{{ old('Juzgado_Ant', @$consignacion->ID_Juzgado) }}">{{ old('Juzgado_Ant', @$consignacion->ID_Juzgado) }}
                              </option>
                              @foreach ($juzgados as $juzgar)
                              <option value="{{ $juzgar->ID_Juzgado }}">{{ $juzgar->Nombre }}</option>
                              @endforeach
                            </select>
                            <span class="text-xs text-red-600 ">@error('Juzgado_Ant') {{ $message }} @enderror</span>
                          </div>
                          {{-- Fecha --}}
                          <div class="col-span-6 sm:col-span-2">
                            <label for="Fecha_Ant" class="block text-sm font-medium text-gray-700">Fecha</label>
                            <input type="date" name="Fecha_Ant" id="Fecha_Ant" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Fecha_Ant', @$consignacion->Fecha_Ant) }}">
                            <span class="text-xs text-red-600 ">@error('Fecha_Ant') {{ $message }} @enderror</span>
                          </div>
                          {{-- ELEMENTO Seccion --}}
                          <div class="flex flex-col justify-end col-span-6 my-10">
                            <p class="self-end h-3 pr-5 mt-5 text-xl font-bold text-cyan-700">Datos adicionales</p>
                            <hr class="self-end w-11/12 my-5 mr-2 border-cyan-700">
                          </div>
                          {{-- ELEMENTO fechas --}}
                          {{-- Hora recibo --}}
                          <div class="col-span-6 sm:col-span-3">
                            <label for="Hora_Recibo" class="block text-sm font-medium text-gray-700">Hora recibo</label>
                            <input type="time" name="Hora_Recibo" id="Hora_Recibo" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Hora_Recibo', @$consignacion->Hora_Recibo) }}">
                            <span class="text-xs text-red-600 ">@error('Hora_Recibo') {{ $message }} @enderror</span>
                          </div>
                          {{-- Hora entrega --}}
                          <div class="col-span-6 sm:col-span-3">
                            <label for="Hora_Entrega" class="block text-sm font-medium text-gray-700">Hora entrega</label>
                            <input type="time" name="Hora_Entrega" id="Hora_Entrega" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Hora_Entrega', @$consignacion->Hora_Entrega) }}">
                            <span class="text-xs text-red-600 ">@error('Hora_Entrega') {{ $message }} @enderror</span>
                          </div>
                          {{-- Hora salida --}}
                          <div class="col-span-6 sm:col-span-3">
                            <label for="Hora_Salida" class="block text-sm font-medium text-gray-700">Hora salida</label>
                            <input type="time" name="Hora_Salida" id="Hora_Salida" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Hora_Salida', @$consignacion->Hora_Salida) }}">
                            <span class="text-xs text-red-600 ">@error('Hora_Salida') {{ $message }} @enderror</span>
                          </div>
                          {{-- Hora regreso --}}
                          <div class="col-span-6 sm:col-span-3">
                            <label for="Hora_Regreso" class="block text-sm font-medium text-gray-700">Hora regreso</label>
                            <input type="time" name="Hora_Regreso" id="Hora_Regreso" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Hora_Regreso', @$consignacion->Hora_Regreso) }}">
                            <span class="text-xs text-red-600 ">@error('Hora_Regreso') {{ $message }} @enderror</span>
                          </div>
                          {{-- Hora llegada --}}
                          <div class="col-span-6 sm:col-span-3">
                            <label for="Hora_Llegada" class="block text-sm font-medium text-gray-700">Hora llegada</label>
                            <input type="time" name="Hora_Llegada" id="Hora_Llegada" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Hora_Llegada', @$consignacion->Hora_Llegada) }}">
                            <span class="text-xs text-red-600 ">@error('Hora_Llegada') {{ $message }} @enderror</span>
                          </div>
                          {{-- Fecha entrega --}}
                          <div class="col-span-6 sm:col-span-3">
                            <label for="Fecha_Entrega" class="block text-sm font-medium text-gray-700">Fecha entrega</label>
                            <input type="date" name="Fecha_Entrega" id="Fecha_Entrega" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('Fecha_Entrega', @$consignacion->Fecha_Entrega) }}">
                            <span class="text-xs text-red-600 ">@error('Fecha_Entrega') {{ $message }} @enderror</span>
                          </div>
                          {{-- Notas --}}
                          <div class="col-span-6 sm:col-span-6">
                            <label for="Nota" class="block text-sm font-medium text-gray-700">Nota</label>
                            <textarea id="Nota" name="Nota" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Notas opcionales"></textarea>
                            <span class="text-xs text-red-600 ">@error('Nota') {{ $message }} @enderror</span>
                          </div>
                        </div>
                      </div>
                      <div class="grid w-full grid-cols-6 gap-6">
                        <div class="flex justify-center w-full col-span-3 py-5">
                          <a href="{{ route('dashboard') }}" class="w-1/2 px-6 py-4 font-medium text-center text-white bg-red-600 border border-transparent rounded-md shadow-sm  text-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Volver </a>
                        </div>
                        <div class="flex justify-center col-span-3 py-5">
                          <button type="submit" class="inline-flex justify-center w-1/2 px-6 py-4 font-medium text-white border border-transparent rounded-md shadow-sm text-md bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">Guardar</button>
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