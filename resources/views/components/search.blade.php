<div class="flex items-center px-6 py-4">
  <form action="{{ route('dashboard') }}" class="w-full">
      <input type="text"
          id="averiguacion"
          name="averiguacion"
          class="flex-1 block w-full px-3 py-2 mt-1 mr-4 bg-white border border-none rounded-md shadow-sm apparence-none focus:outline-none focus:border-sky-500 focus:ring-sky-500 sm:text-sm focus:ring-1"
          placeholder="Ingrese número de averiguación"
          >
          <input type="submit" value="Buscar" class="w-full p-2 mt-4 text-base font-medium leading-tight text-center transition duration-500 ease-in-out rounded-lg shadow-md text-cyan-100 bg-cyan-600 md:w-1/3 hover:bg-cyan-700 hover:shadow-lg focus:bg-cyan-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-cyan-800 active:shadow-lg">
  </form>
</div>