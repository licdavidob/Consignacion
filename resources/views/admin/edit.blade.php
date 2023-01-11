<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Editar un usuario') }}
    </h2>
  </x-slot>
  <div class="py-12">
    {{-- CONTENEDOR PRINCIPAL Content --}}
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-10">

          @if(session('info'))
          <div class="flex flex-col justify-center py-5">
            <div class='flex flex-row bg-cyan-800 h-10 w-[500px] rounded-[10px] self-center'>
              <span class='flex flex-col justify-center text-white font-bold grow-[1] max-w-[90%] text-center'>{{ session('info') }}</span>
              <div class='w-[10%] bg-green-400 rounded-r-md shadow-[0_0_20px_#00C85177]'></div>
            </div>
          </div>
          @endif

          <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
              {{-- left side --}}
              <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                  <h3 class="text-lg font-medium leading-6 text-cyan-900">Perfil</h3>
                  <p class="mt-1 text-sm text-gray-600">Selecciona los permisos que deseas seleccionar del usuario</p>
                  <div class="flex flex-col justify-center w-full py-5">
                    <p class="w-full text-lg font-bold text-center text-gray-500">{{ $user->name }}</p>
                    <div class="self-center mt-5">
                      <img src="{{ $user->profile_photo_url }}" alt="profile image" class="inline-block w-24 h-24 overflow-hidden rounded-full">
                    </div>
                  </div>
                </div>
              </div>
              {{-- right side --}}
              <div class="mt-5 md:col-span-2 md:mt-0">
                {{-- Contenedor --}}
                <div class="flex flex-col justify-center w-full">
                  {{-- Usuario --}}
                  <div class="self-end">
                    <span class="text-xs inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-cyan-800 text-white rounded-full">Usuario: {{ $user->name }}</span>
                  </div>
                  {{-- laravel collective --}}
                  <p class="pb-5 text-lg">Listado de roles</p>
                  {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
                    @foreach ($roles as $role)
                      <div>
                        <label>
                          {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                          {{ $role->name }}
                        </label>
                      </div>
                    @endforeach

                    <div class="grid grid-cols-2 py-5">
                      <div class="col-span-1">
                        <div class="flex justify-center">
                          {!! Form::submit('Asignar rol', ['class'=> 'w-4/5 md:w-2/5 py-2.5 bg-cyan-600 text-white font-medium text-base leading-tight rounded shadow-md hover:bg-cyan-700 hover:shadow-lg focus:bg-cyan-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-cyan-800 active:shadow-lg transition duration-150 ease-in-out text-center']) !!}
                          {!! Form::close() !!}
                        </div>
                      </div>
                      <div class="col-span-1">
                        <div class="flex justify-start">
                          <a href="{{ route('admin.users.index') }}" class="w-4/5 md:w-2/5 py-2.5 bg-red-600 text-white font-medium text-base leading-tight rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out text-center">Volver </a>
                        </div>
                      </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
          <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
              <div class="border-t border-gray-200"></div>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
</x-app-layout>