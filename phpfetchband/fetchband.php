<?php

/**
 * Representa el la estructura de las metas
 * almacenadas en la base de datos
 */
require 'Database.php';

class Fetchband
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'fetchband'
     *
     * @param $idMeta Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM fetchband";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $idMeta Identificador de la meta
     * @return mixed
     */
    public static function getById($ID_Fetchband)
    {
        // Consulta de la meta
        $consulta = "SELECT ID_Fetchband,
                            Name,
                             Altitude,
							 Longitude,
                             Latitude
                             FROM fetchband
                             WHERE ID_Fetchband = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($ID_Fetchband));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $ID_Fetchband     identificador
     * @param $Name      nuevo titulo
     * @param $Altitude nueva descripcion
     * @param $Longitude    nueva fecha limite de cumplimiento
     * @param $Latitude   nueva categoria
     */
    public static function update(
        $ID_Fetchband,
        $Name,
        $Altitude,
        $Longitude,
        $Latitude
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE fetchband" .
            " SET Name=?, Altitude=?, Longitude=?, Latitude=? " .
            "WHERE ID_Fetchband=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Name, $Altitude, $Longitude, $Latitude, $ID_Fetchband));

        return $cmd;
    }

    /**
     * Insertar una nueva meta
     *
     * @param $titulo      titulo del nuevo registro
     * @param $descripcion descripción del nuevo registro
     * @param $fechaLim    fecha limite del nuevo registro
     * @param $categoria   categoria del nuevo registro
     * @param $prioridad   prioridad del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
        $Name,
        $Altitude,
        $Longitude,
        $Latitude
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO fetchband ( " .
            "Name," .
            " Altitude," .
            " Longitude," .
            " Latitude," .
            " VALUES( ?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                   $Name,
				   $Altitude,
				   $Longitude,
				   $Latitude
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idMeta identificador de la meta
     * @return bool Respuesta de la eliminación
     */
    public static function delete($ID_Fetchband)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM fetchband WHERE ID_Fetchband=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($ID_Fetchband));
    }
}

?>