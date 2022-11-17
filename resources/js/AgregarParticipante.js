function AgregarParticipante(){
    Participantes++;
    const participante = document.querySelector("#Participantes");
    const renglon = document.createElement("tr");
        
    const Nombre = AgregarCeldaText('Nombre');
    const ApellidoPaterno = AgregarCeldaText('Ap_Paterno');
    const ApellidoMaterno = AgregarCeldaText('Ap_Materno');
    const Calidad= AgregarCeldaCatalogoCalidad('Calidad');
    const Alias = AgregarCeldaText('Alias');
    const Eliminar = AgregarCeldaEliminarFila();

    renglon.appendChild(Nombre)
    renglon.appendChild(ApellidoPaterno)
    renglon.appendChild(ApellidoMaterno)
    renglon.appendChild(Calidad)
    renglon.appendChild(Alias)
    renglon.appendChild(Eliminar)
    participante.appendChild(renglon)
    
    return true;
}

function AgregarCeldaText(NombreCampo){
    const celda = document.createElement("td");
    celda.setAttribute("class", "py-2 border-b-2");
    
    const input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("name", "Personas["+ Participantes + "]" + "[" + NombreCampo + "]");
    input.setAttribute("class", "block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm");
    
    celda.appendChild(input)
    return celda;
}

function AgregarCeldaCatalogoCalidad(NombreCampo){
    const celda = document.createElement("td");
    celda.setAttribute("class", "py-2 border-b-2");
    
    const select = document.createElement("select");
    select.setAttribute("name", "Personas["+ Participantes + "]" + "[" + NombreCampo + "]");
    select.setAttribute("class", "block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm");
    
    CatalogoCalidad.forEach(element => {
        const option = document.createElement("option");
        option.setAttribute("value", element['ID_Calidad']);
        option.textContent = element['Calidad']
        select.appendChild(option)
    });
    
    celda.appendChild(select)
    return celda;
}

function AgregarCeldaEliminarFila(){
    const celda = document.createElement("td");
    const wrap = document.createElement("div");
    const flex = document.createElement("div");
    const icono = document.createElement("img");
    
    celda.setAttribute("class", "borrar py-2 border-b-2");
    wrap.setAttribute("class", "flex w-full justify-center");
    flex.setAttribute("class", "py-2 px-2 text-md font-medium text-white w-10 bg-cyan-600 border border-transparent rounded-full shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 self-center");
    icono.setAttribute("src", "img/delete.svg");

    flex.appendChild(icono);
    wrap.appendChild(flex);
    celda.appendChild(wrap);
    return celda;
}

//Se asigna el boton para agregar filas
$('#AgregarParticipante').click(function(){
    AgregarParticipante();
});

//Se asigna el boton para eliminar filas
$(document).on('click', '.borrar', function(event) {
    event.preventDefault();
    $(this).closest('tr').remove();
  });