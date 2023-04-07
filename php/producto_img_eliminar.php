<?php
	require_once "main.php";

	/*== Almacenando datos ==*/
    $product_id=limpiar_cadena($_POST['img_del_id']);

    /*== Verificando producto ==*/
    $check_producto=conexion();
    $check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$product_id'");

    if($check_producto->rowCount()==1){
    	$datos=$check_producto->fetch();
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen del PRODUCTO que intenta eliminar no existe
            </div>
        ';
        exit();
    }
    $check_producto=null;


    /* Directorios de imagenes */
	$img_dir='../img/producto/';

	/* Cambiando permisos al directorio */
	chmod($img_dir, 0777);


	/* Eliminando la imagen */
	if(is_file($img_dir.$datos['producto_foto'])){

		chmod($img_dir.$datos['producto_foto'], 0777);

		if(!unlink($img_dir.$datos['producto_foto'])){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Error al intentar eliminar la imagen del producto, por favor intente nuevamente
	            </div>
	        ';
	        exit();
		}
	}