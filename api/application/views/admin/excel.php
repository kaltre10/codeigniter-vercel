<?php 
header("Content-Type: text/html;charset=utf-8");
header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-type: application/x-msexcel; charset=utf-8");
header ('Content-Transfer-Encoding: binary');
header("Pragma: public");
header("Expires: 0");
$filename = "sbs.xls";

// header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

?>
<html>
    <head></head>
    <body>
    <table>
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Departamento</th>
            <th>Provincia</th>
            <th>Distrito</th>
            <th>Tipo</th>
            <th>N</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Nombres</th>
            <th>Pais Nacionalidad</th>
            <th>Ocupación</th>
            <th>Persona a Favor a quien se Realiza la operación </th>
            <th>Ruc</th>
            <th>Apellido Paterno o Razon Social</th>
            <th>Apellido Materno</th>
            <th>Nombres</th>
            <th>Ocupacion</th>
            <th>Tipo de Fondo en el ue se realizó la operación</th>
            <th>tipo de Operación</th>
            <th>Origen de fondos</th>
            <th>Moneda</th>
            <th>Monto</th>
            <th>Moneda</th>
            <th>Monto</th>
            <th>Comprobante de pago</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($operaciones as $key) : ?>      
        <tr>
            <td><?php $fecha = explode(" ", $key->fec_operacion); echo $fecha[0]; ?></td>
            <td>15: Lima</td>
            <td>01: Lima</td>
            <td>22: Miraflores</td>
            <td>
                <?php
                    if($key->doc_cliente == "0") echo "001: Documento nacional de identidad";
                    if($key->doc_cliente == "PAS") echo "005: Pasaporte";
                    if($key->doc_cliente == "CE") echo "002: Carn&eacute; de extranjeria";
                    if($key->doc_cliente == "DNI") echo "001: Documento nacional de identidad";
                ?>
            </td>
            <td><?= $key->n_cliente; ?></td>
            <td><?= $key->nom_cliente; ?></td>
            <td>##</td>
            <td>##</td>
            <td>PE: Per&uacute;</td>
            <td>010: Trabajador(A) Independiente</td>
            <td>##</td>
            <td><?= $key->n_cliente; ?></td>
            <td><?= $key->nom_cliente; ?></td>
            <td>##</td>
            <td>##</td>
            <td>##</td>
            <td>001: Efectivo</td>
            <td><?= $key->tip_operacion; ?></td>
            <td>001: Ahorros</td>
            <td><?= $key->div_operacion; ?></td>
            <td><?= str_pad($key->mon_operacion, 4) ?></td>
            <td><?= $key->mon_rec_operacion; ?></td>
            <td><?= str_pad($key->rec_operacion, 4); ?></td>
            <td><?= $key->id_operacion; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </body>
<html>