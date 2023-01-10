<x-app-layout>
  <x-slot name="header">
    <x-header-title>
      {{ __('Usuarios') }}
    </x-header-title>
  </x-slot>

  <div class="py-10">
    {{-- CONTENEDOR PRINCIPAL Content --}}
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-10">
          @livewire('admin.users-index')
        </div>
    </div>
    </div>
  </div>
</x-app-layout>