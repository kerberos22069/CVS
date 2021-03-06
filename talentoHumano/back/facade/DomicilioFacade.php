<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Has encontrado la frase #1024 ¡Felicidades! Ahora tu proyecto funcionará a la primera  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Domicilio.php');
require_once realpath('../../dao/interfaz/IDomicilioDao.php');
require_once realpath('../../dto/Persona.php');

class DomicilioFacade {

  /**
   * Para su comodidad, defina aquí el gestor de conexión predilecto para esta entidad
   * @return idGestor Devuelve el identificador del gestor de conexión
   */
  private static function getGestorDefault(){
      return DEFAULT_GESTOR;
  }
  /**
   * Para su comodidad, defina aquí el nombre de base de datos predilecto para esta entidad
   * @return dbName Devuelve el nombre de la base de datos a emplear
   */
  private static function getDataBaseDefault(){
      return DEFAULT_DBNAME;
  }
  /**
   * Crea un objeto Domicilio a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param direccion
   * @param barrio
   * @param persona_id
   */
  public static function insert( $id,  $direccion,  $barrio,  $persona_id){
      $domicilio = new Domicilio();
      $domicilio->setId($id); 
      $domicilio->setDireccion($direccion); 
      $domicilio->setBarrio($barrio); 
      $domicilio->setPersona_id($persona_id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $domicilioDao =$FactoryDao->getdomicilioDao(self::getDataBaseDefault());
     $rtn = $domicilioDao->insert($domicilio);
     $domicilioDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Domicilio de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @return El objeto en base de datos o Null
   */
  public static function select($id){
      $domicilio = new Domicilio();
      $domicilio->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $domicilioDao =$FactoryDao->getdomicilioDao(self::getDataBaseDefault());
     $result = $domicilioDao->select($domicilio);
     $domicilioDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Domicilio  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param direccion
   * @param barrio
   * @param persona_id
   */
  public static function update($id, $direccion, $barrio, $persona_id){
      $domicilio = self::select($id);
      $domicilio->setDireccion($direccion); 
      $domicilio->setBarrio($barrio); 
      $domicilio->setPersona_id($persona_id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $domicilioDao =$FactoryDao->getdomicilioDao(self::getDataBaseDefault());
     $domicilioDao->update($domicilio);
     $domicilioDao->close();
  }

  /**
   * Elimina un objeto Domicilio de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   */
  public static function delete($id){
      $domicilio = new Domicilio();
      $domicilio->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $domicilioDao =$FactoryDao->getdomicilioDao(self::getDataBaseDefault());
     $domicilioDao->delete($domicilio);
     $domicilioDao->close();
  }

  /**
   * Lista todos los objetos Domicilio de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Domicilio en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $domicilioDao =$FactoryDao->getdomicilioDao(self::getDataBaseDefault());
     $result = $domicilioDao->listAll();
     $domicilioDao->close();
     return $result;
  }


}
//That´s all folks!