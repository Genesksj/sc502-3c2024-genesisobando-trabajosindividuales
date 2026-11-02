# Práctica Programada #3 - PHP

Curso: SC-502 Ambiente Web Cliente/Servidor

## Cómo ejecutar

1. Instalar y abrir XAMPP.
2. Copiar la carpeta `practica-programada-3` dentro de `C:\xampp\htdocs\`.
3. Iniciar Apache desde XAMPP.
4. Abrir `http://localhost/practica-programada-3/index.php` en el navegador.
5. Al abrir la página, PHP genera o actualiza `estado_cuenta.txt` en la misma carpeta.

## Archivos

- `index.php`: registra transacciones, calcula el estado de cuenta y lo muestra.
- `style.css`: estilos de la página.
- `estado_cuenta.txt`: resultado de ejemplo; se regenera al ejecutar PHP.

Las transacciones son ejemplos definidos en el código, como permite la guía de la práctica. Para cambiarlas, editar las llamadas a `registrarTransaccion()`.
