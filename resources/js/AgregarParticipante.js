var Participantes = 0;

AgregarParticipante();
AgregarParticipante();

function AgregarParticipante(){
    Participantes++;
    const participante = document.querySelector("#Participantes");
    const renglon = document.createElement("tr");
        
    const Nombre = AgregarCeldaText('Nombre');
    const ApellidoPaterno = AgregarCeldaText('ApellidoPaterno');
    const ApellidoMaterno = AgregarCeldaText('ApellidoMaterno');
    const Calidad= AgregarCeldaCatalogoCalidad('Calidad');
    const Alias = AgregarCeldaText('Alias');

    renglon.appendChild(Nombre)
    renglon.appendChild(ApellidoPaterno)
    renglon.appendChild(ApellidoMaterno)
    renglon.appendChild(Calidad)
    renglon.appendChild(Alias)
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
