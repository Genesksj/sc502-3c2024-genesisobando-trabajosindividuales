
let estudiantes = [
    { nombre: "Maria", apellidos: "Mora Perez", nota: 90 },
    { nombre: "Pedro", apellidos: "Sibaja Lopez", nota: 60 },
    { nombre: "Marco", apellidos: "Rojas Castro", nota: 78 }
];

let formulario = document.getElementById("formulario");
let lista = document.getElementById("listaEstudiantes");
let mensaje = document.getElementById("mensaje");

function mostrarEstudiantes() {
    lista.innerHTML = "";

    estudiantes.forEach(function(estudiante) {
        let fila = document.createElement("tr");

        let claseNota = "";

        if (estudiante.nota >= 80) {
            claseNota = "nota-alta";
        } else if (estudiante.nota < 65) {
            claseNota = "nota-baja";
        }

        fila.innerHTML = `
            <td>${estudiante.nombre}</td>
            <td>${estudiante.apellidos}</td>
            <td class="${claseNota}">${estudiante.nota}</td>
        `;

        lista.appendChild(fila);
    });

    calcularResumen();
}

function calcularResumen() {
    let mayor = estudiantes[0];
    let menor = estudiantes[0];
    let suma = 0;

    estudiantes.forEach(function(estudiante) {
        suma += estudiante.nota;

        if (estudiante.nota > mayor.nota) {
            mayor = estudiante;
        }

        if (estudiante.nota < menor.nota) {
            menor = estudiante;
        }
    });

    let promedio = suma / estudiantes.length;

    document.getElementById("mayorNota").textContent =
        "Mayor nota: " + mayor.nombre + " " + mayor.apellidos +
        " (" + mayor.nota + ")";

    document.getElementById("promedio").textContent =
        "Promedio de notas: " + promedio.toFixed(2);

    document.getElementById("menorNota").textContent =
        "Nota más baja: " + menor.nota;
}

formulario.addEventListener("submit", function(evento) {
    evento.preventDefault();

    let nombre = document.getElementById("nombre").value.trim();
    let apellidos = document.getElementById("apellidos").value.trim();
    let notaTexto = document.getElementById("nota").value.trim();

    if (nombre === "" || apellidos === "" || notaTexto === "") {
        mensaje.textContent = "Todos los campos son obligatorios.";
        return;
    }

    let nota = Number(notaTexto);

    if (!Number.isFinite(nota) || nota < 0 || nota > 100) {
        mensaje.textContent = "La nota debe estar entre 0 y 100.";
        return;
    }

    estudiantes.push({
        nombre: nombre,
        apellidos: apellidos,
        nota: nota
    });

    mensaje.textContent = "";
    formulario.reset();
    mostrarEstudiantes();
});

mostrarEstudiantes();
