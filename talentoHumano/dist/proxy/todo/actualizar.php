<?php
	include 'ActualizarTodo.php';

	$array_entidades = $_POST['entidades'];

    $fami = $_POST['entidades']['familiares'];
    $fami_Nuevos = $_POST['entidades']['familiaresnuevos'];
	$registrador = new ActualizarTodo(filtrar($array_entidades),$fami,$fami_Nuevos);
	
	echo $registrador->registrarTodo();
        
        function filtrar($entidades) {
            $miArray = array();
            foreach ($entidades as  $nombre => $entidad){
                if($nombre != 'familiares'){
                    $miArray[$nombre] = construir($entidad);
                }
            }              
            return $miArray;
        }
        
        function construir($algo){
            $miarray2 = array();       
            for ($entidad = 0; $entidad < count($algo); $entidad++) {
                $miarray2[$algo[$entidad]['name']]=$algo[$entidad]['value'];
            }   
            return $miarray2; 
        }
    