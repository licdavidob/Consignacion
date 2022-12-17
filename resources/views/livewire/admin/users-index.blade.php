<div>

  <div class="flex items-center px-6 py-4">
    {{-- <form action="{{ route('dashboard') }}" class="w-full"> --}}
        <input type="text"
            id="username"
            name="username"
            class="flex-1 block w-full px-5 py-4 mt-2 mr-4 bg-white border border-none rounded-md shadow-lg focus:outline-none sm:text-sm text-cyan-900"
            placeholder="Ingrese al usuario a buscar"
            wire:model="search"
            >
    {{-- </form> --}}
  </div>

  @if ($users->count())
    <table class="w-full bg-cyan-900">
      <thead class="text-white">
        <tr class="">
          <th class="py-5 w-1/8">ID</th>
          <th class="py-5 w-3/8">Nombre</th>
          <th class="py-5 w-3/8">Email</th>
          <th class="py-5 w-1/8">Acciones</th>
        </tr>
      </thead>
      <tbody class="text-center bg-white">
        @foreach ( $users as $user )
          <tr>
            <td class="py-2 border-b-2"> {{ $user->id}} </td>
            <td class="py-2 border-b-2"> {{ $user->name }} </td>
            <td class="py-2 border-b-2"> {{ $user->email }} </td>
            <td class="py-2 border-b-2">
              <div class="flex justify-center align-middle item-center">
                <div class="w-9 p-2.5 transform rounded-full bg-cyan-500 hover:scale-110">
                  <a href="{{ route('admin.users.edit', $user) }}"><img src="/img/editWhite.svg" alt=""></a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="">
      {{ $users->links() }}
    </div>
    @else
    <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
      <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
      <div class="w-full text-center ">
        <p class="font-bold">No se encontrarón registros.</p>
      </div>
    </div>
    <div class=""></div>
  @endif

</div>
