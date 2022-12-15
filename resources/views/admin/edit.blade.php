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


          <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
              {{-- left side --}}
              <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                  <h3 class="text-lg font-medium leading-6 text-cyan-900">Perfil</h3>
                  <p class="mt-1 text-sm text-gray-600">Selecciona los permisos que deseas seleccionar del usuario</p>
                  <div class="w-full py-5 flex flex-col justify-center">
                    <p class="w-full text-center font-bold text-lg text-gray-500">{{ $user->name }}</p>
                    <div class="mt-5 self-center">
                      <img src="{{ $user->profile_photo_url }}" alt="profile image" class="inline-block h-24 w-24 overflow-hidden rounded-full">
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
                  <h2>Listado de roles</h2>
                  {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
                    @foreach ($roles as $role)
                      <div>
                        <label>{!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                          {{ $role->name }}
                        </label>
                      </div>
                    @endforeach
                  {!! Form::close() !!}
                  {{-- Dos --}}

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