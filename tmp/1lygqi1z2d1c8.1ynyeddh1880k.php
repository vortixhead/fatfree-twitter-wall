
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin">Panel de Administración</a>
        </div>
        <ul class="nav navbar-right top-nav">
            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Administrador <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout"><i class="fa fa-fw fa-power-off"></i>Cerrar sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="admin"><i class="fa fa-fw fa-camera"></i> Fotos</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->


                <div class="row">
                    <div class="col-lg-12">
                     <p>
                        <h2><?php echo $img_count; ?> Imágenes recopiladas con el hashtag #dogs</h2>

                        <a href="fotos" target="_blank" class="btn btn-primary" ><span class="glyphicon glyphicon-picture"></span> <small>Ver presentación de fotos</small></a>
                        </p>
                        
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Subir una imagen:</h4>
                                <form method="post" action="admin/subir" enctype="multipart/form-data" name="form_subir_imagen">
                                    <div class="input-group">
                                      <input id="archivo" name="archivo" type="file">
                                    </div><!-- /input-group -->
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> <small>Subir imagen a la base de datos</small></button>
                                    </div><!-- /input-group -->
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h4>Agregar fotos desde Twitter:</h4>
                                <br>
                                    <a href="admin/buscar/" class="btn btn-success" ><span class="glyphicon glyphicon-refresh"></span> <small>Buscar nuevas fotos de Twitter</small></a>
                            </div>
                        </div>                         

                        <br>
                       
                        <div class="table-responsive">
                            <table class="admin-table table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Imagen</th>
                                        <th>Categoría</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                        <th>Fecha de creación</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach (($images?:array()) as $item): ?>
                                        <?php if ($item['status']=='aprobada'): ?>
                                            
                                                <tr class="success">
                                                
                                            <?php endif; ?>
                                            <?php if ($item['status']=='rechazada'): ?>
                                                
                                                    <tr class="danger">
                                                    
                                                <?php endif; ?>

                                                <?php if ($item['status']=='pendiente'): ?>
                                                    
                                                        <tr class="warning">
                                                        
                                                    <?php endif; ?>

                                                    <th><?php echo $item['id']; ?></th>
                                                    <th><?php echo $item['title']; ?></th>
                                                    <th><img src="<?php echo $item['url']; ?>"></th>
                                                    <th><?php echo $item['category']; ?></th>
                                                    <th><?php echo $item['status']; ?></th>
                                                    <th>        
                                                        <?php if ($item['status']=='aprobada'): ?>
                                                            
                                                                <div class="btn-group">
                                                                    <a href="admin/rechazar/<?php echo $item['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> <small>Rechazar</small></a>
                                                                    
                                                                </div>
                                                                <a class="delete-link" href="admin/borrar/<?php echo $item['id']; ?>">Eliminar</a>
                                                            
                                                        <?php endif; ?>
                                                        <?php if ($item['status']=='rechazada'): ?>
                                                            
                                                                <div class="btn-group">
                                                                    <a href="admin/aprobar/<?php echo $item['id']; ?>" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> <small>Aprobar</small></a>
                                                                    
                                                                </div>
                                                                <a class="delete-link" href="admin/borrar/<?php echo $item['id']; ?>">Eliminar</a>
                                                            
                                                        <?php endif; ?>

                                                        <?php if ($item['status']=='pendiente'): ?>
                                                            
                                                                <div class="btn-group">
                                                                    <a href="admin/aprobar/<?php echo $item['id']; ?>" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> <small>Aprobar</small></a>
                                                                    <a href="admin/rechazar/<?php echo $item['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> <small>Rechazar</small></a>
                                                                    
                                                                </div>
                                                                <a class="delete-link" href="admin/borrar/<?php echo $item['id']; ?>">Eliminar</a>
                                                            
                                                        <?php endif; ?>

                                                    </th>
                                                    <th><?php echo $item['created']; ?></th>
                                                </tr>
                                            <?php endforeach; ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->
