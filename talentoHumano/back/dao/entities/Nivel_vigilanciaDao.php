<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    La primera regla del proyecto es no hacer preguntas  \\

include_once realpath('../../dao/interfaz/INivel_vigilanciaDao.php');
include_once realpath('../../dto/Nivel_vigilancia.php');

class Nivel_vigilanciaDao implements INivel_vigilanciaDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Nivel_vigilancia en la base de datos.
     * @param nivel_vigilancia objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($nivel_vigilancia){
//      $id=$nivel_vigilancia->getId();
$nombre=$nivel_vigilancia->getNombre();

      try {
          $sql= "INSERT INTO `nivel_vigilancia`(  `nombre`)"
          ."VALUES ('$nombre')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Nivel_vigilancia en la base de datos.
     * @param nivel_vigilancia objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($nivel_vigilancia){
      $id=$nivel_vigilancia->getId();

      try {
          $sql= "SELECT `id`, `nombre`"
          ."FROM `nivel_vigilancia`"
          ."WHERE `id`='$id'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $nivel_vigilancia->setId($data[$i]['id']);
          $nivel_vigilancia->setNombre($data[$i]['nombre']);

          }
      return $nivel_vigilancia;      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Nivel_vigilancia en la base de datos.
     * @param nivel_vigilancia objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($nivel_vigilancia){
      $id=$nivel_vigilancia->getId();
$nombre=$nivel_vigilancia->getNombre();

      try {
          $sql= "UPDATE `nivel_vigilancia` SET`id`='$id' ,`nombre`='$nombre' WHERE `id`='$id' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Nivel_vigilancia en la base de datos.
     * @param nivel_vigilancia objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($nivel_vigilancia){
      $id=$nivel_vigilancia->getId();

      try {
          $sql ="DELETE FROM `nivel_vigilancia` WHERE `id`='$id'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Nivel_vigilancia en la base de datos.
     * @return ArrayList<Nivel_vigilancia> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `id`, `nombre`"
          ."FROM `nivel_vigilancia`"
          ."WHERE `id`>'0'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $nivel_vigilancia= new Nivel_vigilancia();
          $nivel_vigilancia->setId($data[$i]['id']);
          $nivel_vigilancia->setNombre($data[$i]['nombre']);

          array_push($lista,$nivel_vigilancia);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

      public function insertarConsulta($sql){
          $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sentencia=$this->cn->prepare($sql);
          $sentencia->execute(); 
          $sentencia = null;
          return $this->cn->lastInsertId();
    }
      public function ejecutarConsulta($sql){
          $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sentencia=$this->cn->prepare($sql);
          $sentencia->execute(); 
          $data = $sentencia->fetchAll();
          $sentencia = null;
          return $data;
    }
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close(){
      $cn=null;
  }
}
//That´s all folks!