<?php
$transacciones = [];

function registrarTransaccion($id, $descripcion, $monto) {
    global $transacciones;
    array_push($transacciones, [
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    ]);
}

function generarEstadoDeCuenta() {
    global $transacciones;
    $totalContado = 0;
    $detalle = "ESTADO DE CUENTA - TARJETA DE CREDITO\n";
    $detalle .= "--------------------------------------\n";

    foreach ($transacciones as $transaccion) {
        $totalContado += $transaccion["monto"];
        $detalle .= "ID: " . $transaccion["id"] . " | " . $transaccion["descripcion"] . " | ₡" . number_format($transaccion["monto"], 2) . "\n";
    }

    $interes = $totalContado * 0.026;
    $totalConInteres = $totalContado + $interes;
    $cashback = $totalContado * 0.001;
    $totalPagar = $totalConInteres - $cashback;

    $detalle .= "--------------------------------------\n";
    $detalle .= "Total de contado: ₡" . number_format($totalContado, 2) . "\n";
    $detalle .= "Interes (2.6%): ₡" . number_format($interes, 2) . "\n";
    $detalle .= "Total con interes: ₡" . number_format($totalConInteres, 2) . "\n";
    $detalle .= "Cashback (0.1%): ₡" . number_format($cashback, 2) . "\n";
    $detalle .= "Monto final a pagar: ₡" . number_format($totalPagar, 2) . "\n";

    file_put_contents(__DIR__ . "/estado_cuenta.txt", $detalle);

    return [
        "transacciones" => $transacciones,
        "contado" => $totalContado,
        "interes" => $interes,
        "conInteres" => $totalConInteres,
        "cashback" => $cashback,
        "pagar" => $totalPagar
    ];
}

// Transacciones de ejemplo
registrarTransaccion(1, "Compra de supermercado", 25000);
registrarTransaccion(2, "Compra de libros", 12000);
registrarTransaccion(3, "Pago de internet", 18000);
registrarTransaccion(4, "Compra de ropa", 15000);

$estado = generarEstadoDeCuenta();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Estado de cuenta</h1>
        <p>Registro de transacciones de tarjeta de crédito</p>
    </header>
    <main>
        <section>
            <h2>Transacciones registradas</h2>
            <table>
                <thead>
                    <tr><th>ID</th><th>Descripción</th><th>Monto</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($estado["transacciones"] as $transaccion): ?>
                    <tr>
                        <td><?php echo $transaccion["id"]; ?></td>
                        <td><?php echo htmlspecialchars($transaccion["descripcion"]); ?></td>
                        <td>₡<?php echo number_format($transaccion["monto"], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <section>
            <h2>Resumen del estado de cuenta</h2>
            <p>Total de contado: <strong>₡<?php echo number_format($estado["contado"], 2); ?></strong></p>
            <p>Interés (2.6%): <strong>₡<?php echo number_format($estado["interes"], 2); ?></strong></p>
            <p>Total con interés: <strong>₡<?php echo number_format($estado["conInteres"], 2); ?></strong></p>
            <p>Cashback (0.1%): <strong>₡<?php echo number_format($estado["cashback"], 2); ?></strong></p>
            <p class="total">Monto final a pagar: ₡<?php echo number_format($estado["pagar"], 2); ?></p>
            <p class="nota">Se genera el archivo <strong>estado_cuenta.txt</strong> con el mismo detalle.</p>
        </section>
    </main>
</body>
</html>
