<div class='table-responsive'>
    <table class='table table-bordered table-hover'>
    <caption><h3 class="text-center text-info">Reportes de Bauches</h3></caption>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Deposito</th>
                <th>Fecha</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($resultado as $result):?>
            <tr>
                <td><?=$result['nombre'];?></td>
                <td><?=$result['cedula'];?></td>
                <td><?=$result['numero_deposito'];?></td>
                <td><?=$result['fecha_deposito'];?></td>
                <td><?=$result['monto'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div>suma total del monto de los bauches : <span><?=$suma[0]['monto'];?></span></div>
</div>