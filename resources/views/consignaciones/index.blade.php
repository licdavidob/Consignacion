<x-app-layout>
  <x-slot name="header">
    <x-header-title>
      {{ __('Consignaciones') }}
    </x-header-title>
  </x-slot>

  <div class="py-10">
    {{-- CONTENEDOR PRINCIPAL Content --}}
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        {{-- Cmponente Busqueda --}}
        <div class="grid grid-cols-1">
          <div class="col-span-1">
            <x-search></x-search>
          </div>
        </div>
        {{-- Componente Botón --}}
        <div class="grid w-full grid-cols-2">
          <div class="col-span-2">
            @can('consignacion.crear')
              <x-button leyend="Crear registro"></x-button>
            @endcan
          </div>
        </div>

        {{-- ELEMENTO Tabla --}}
        <div class="w-full px-5 py-3 overflow-x-scroll">
            {{-- Condicional en caso de no existir registros --}}
            @if (count($consignaciones) == 0)
              <div class="w-full px-6 py-5 my-4 text-base text-red-700 bg-red-100 rounded-lg table-auto">
                  <p class="text-xl text-center ">No se encontraron registros</p>
              </div>
            @else
            <div class="w-full h-64 overflow-x-scroll">
              <table class="w-full bg-cyan-900 rounded-t-xl">
                <thead class="text-white">
                  <tr>
                    <th class="py-5 pl-2 sm:pl-1">ID_Consignación</th>
                    <th class="py-5">Con detenido</th>
                    <th class="py-5">Agencia</th>
                    <th class="py-5">No. Averiguación Previa</th>
                    <th class="py-5 pr-2 sm:pr-1">Acciones</th>
                  </tr>
                </thead>
                <tbody class="text-center bg-white">
                  @foreach ( $consignaciones as $consignacion )
                    <tr>
                      <td class="py-2 font-bold border-b-2 text-cyan-700"> {{ $consignacion->ID_Consignacion}} </td>
                      @if ($consignacion->Detenido === 1)
                        <td class="py-2 border-b-2"> Con Detenido </td>
                      @else
                        <td class="py-2 border-b-2"> Sin Detenido </td>
                      @endif
                      <td class="py-2 border-b-2"> {{ $consignacion->Agencia->Nombre }} </td>
                      <td class="py-2 border-b-2"> {{ $consignacion->Averiguacion }} </td>
                      <td class="py-2 border-b-2">
                        <div class="flex justify-center align-middle item-center">
                          @can('consignacion.mostrar')
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                              <a  href="{{ route('mostrar', $consignacion) }}"><img src="img/show.svg" alt=""></a>
                            </div>
                          @endcan
                          @can('consignacion.editar')
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                              <a href="{{ route('editar', $consignacion) }}"><img src="img/edit.svg" alt=""></a>
                            </div>
                          @endcan
                          @can('consignacion.destroy')
                          <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <form action="{{ route('consignaciones.destroy', $consignacion) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <input type="submit" value="x" class="px-2 text-white bg-gray-800 rounded " onclick="return confirm('¿Desea eliminar el registro?')">
                            </form>
                          </div>
                          @endcan
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
            {{ $consignaciones->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>