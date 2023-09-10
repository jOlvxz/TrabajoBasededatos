<?php
    function Conectar(){
        if (! ($cnn = mysqli_connect("localhost", "root", ""))){
            exit();
        }
        #en cnn debe ir el nombre de la base de datos
        if(! mysqli_select_db($cnn,"pañol_v2")){
            exit();
        }
        return $cnn;

    }

?>