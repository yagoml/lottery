<button class="btn btn-primary pull-left margB15" id="openFiltro" onclick="openModalNewUser()"><i class="glyphicon glyphicon-plus"></i> Novo</button>

<?php if ($usuarios) { ?>
    <table class="table table-bordered table-hover extratosTable">
        <tr>
            <th>ID</th>
            <th>Apelido</th>
            <th>Nome</th>
            <th>Nível</th>
            <th>Bilhetes</th>
            <th>Saldo</th>
            <th>Patrocinador</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($usuarios as $usuario) { ?>
            <tr>
                <td class="linkSorteio"><?php echo $usuario->id_usuario ?></td>
                <td><?php echo $usuario->apelido ?></td>
                <td><?php echo $usuario->nome ?></td>
                <td><?php echo $usuario->nivel ?></td>
                <td><?php echo $usuario->bilhetes ?></td>
                <td><?php echo $usuario->saldo ?></td>
                <td><?php echo $usuario->patrocinador ? $usuario->patrocinador .' - '.Repository\Usuarios::getUsuario($usuario->patrocinador)->apelido : '-' ?></td>
                <td><i title="Ver usuario <?php echo $usuario->id_usuario ?>" class="glyphicon glyphicon-eye-open iconAcoes text-success" onclick='openModalUsuario(<?php echo json_encode($usuario) ?>)'></i> / <i title="Editar usuario <?php echo $usuario->id_usuario ?>" class="glyphicon glyphicon-edit iconAcoes text-primary" onclick='openModalEditUsuario(<?php echo json_encode($usuario) ?>)'></i> / <i title="Deletar usuario <?php echo $usuario->id_usuario ?>" class="glyphicon glyphicon-remove iconAcoes text-danger" onclick="deleteUsuario(<?php echo $usuario->id_usuario ?>)"></i></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <div class="col-xs-12">
        Nenhum usuario encontrado.
    </div>
<?php } ?>

<?php $this->load->view('admin/painel/usuarios/modal_ver_usuario') ?>
<?php $this->load->view('admin/painel/usuarios/modal_edit_usuario') ?>
<?php $this->load->view('admin/painel/usuarios/modal_new_usuario') ?>