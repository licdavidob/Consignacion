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
        {{-- Cmponente Busqueda --}}
        <div class="grid grid-cols-1">
          <div class="col-span-1">
            <x-search></x-search>
          </div>
        </div>
        {{-- Componente Botón --}}
        @can('consignacion.crear')
          <x-button leyend="Crear registro"></x-button>
        @endcan
        {{-- ELEMENTO Tabla --}}
        <div class="w-full px-5 py-3">
            {{-- Condicional en caso de no existir registros --}}
            @if (count($consignaciones) == 0)
              <div class="bg-red-100 rounded-lg py-5 px-6 my-4 text-base text-red-700 w-full">
                  <p class=" text-center text-xl">No se encontraron registros</p>
              </div>
            @else
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
            @endif
            {{ $consignaciones->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>