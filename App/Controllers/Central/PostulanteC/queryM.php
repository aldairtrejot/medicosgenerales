<?php

class PostulantesM
{

    public function getDataInit($idPostulante)
    {
        $query = pg_query("SELECT 
                                UPPER(postulante.postulantes.postulante),
                                UPPER(postulante.postulantes.curp),
                                postulante.postulantes.email,
                                postulante.postulantes.telefono,
                                postulante.postulantes.cedula_sep,
                                UPPER(postulante.postulantes.desc_cedula_sep),
                                UPPER(postulante.cat_entidad.entidad),
                                UPPER(postulante.clues.clues),
                                UPPER(postulante.clues.nombre_unidad),
                                UPPER(clues_entidad.entidad)
                            FROM postulante.postulantes
                            INNER JOIN postulante.cat_entidad
                                ON postulante.postulantes.id_cat_entidad_nacimiento  =
                                    postulante.cat_entidad.id_cat_entidad
                            LEFT JOIN postulante.clues
                                ON 	postulante.postulantes.id_clues = 
                                    postulante.clues.id_clues
                            LEFT JOIN postulante.cat_entidad AS clues_entidad
                                ON postulante.clues.id_cat_entidad =
                                    clues_entidad.id_cat_entidad
                            WHERE postulante.postulantes.id_postulantes = $idPostulante
                            LIMIT 1");
        return $query;
    }

    public function getDataUpdate($idPostulante)
    {
        $query = pg_query("SELECT * 
                            FROM postulante.postulantes
                            WHERE postulante.postulantes.id_postulantes = $idPostulante
                            LIMIT 1;");
        return $query;
    }

    ///CATALOGOS DE ENTIDAD
    public function getDataEstates()
    {
        $query = pg_query("SELECT 
                                postulante.cat_entidad.id_cat_entidad,
                                UNACCENT(UPPER(postulante.cat_entidad.entidad))
                            FROM postulante.cat_entidad
                            ORDER BY postulante.cat_entidad.entidad ASC;");
        return $query;
    }

    public function getDataEditEstates($idEntidad)
    {
        $query = pg_query("SELECT 
                                postulante.cat_entidad.id_cat_entidad,
                                UNACCENT(UPPER(postulante.cat_entidad.entidad))
                            FROM postulante.cat_entidad
                            WHERE postulante.cat_entidad.id_cat_entidad = $idEntidad");
        return $query;
    }

    ///cat6alogos de clues
    public function getDataCluesAll($idEntidad)
    {
        $query = pg_query("SELECT 	
                                postulante.clues.id_clues,
                                CONCAT(UPPER(postulante.clues.clues), ' - ', UPPER(postulante.clues.nombre_unidad))
                            FROM postulante.clues
                            WHERE id_cat_entidad = $idEntidad
                            AND plazas::INTEGER > (
                                SELECT COUNT(id_postulantes)
                                FROM postulante.postulantes
                                WHERE postulante.postulantes.id_clues = postulante.clues.id_clues
                            );");
        return $query;
    }

    public function getDataCluesEdit($idClue)
    {
        $query = pg_query("SELECT 	
                                postulante.clues.id_clues,
                                CONCAT(UPPER(postulante.clues.clues), ' - ', UPPER(postulante.clues.nombre_unidad))
                            FROM postulante.clues
                            WHERE postulante.clues.id_clues = $idClue");
        return $query;
    }

    public function getDataForClue($idClue)
    {
        $query = pg_query("SELECT 
                                UPPER(postulante.clues.nombre_unidad),
                                UPPER(postulante.cat_entidad.entidad)
                            FROM postulante.clues
                            INNER JOIN postulante.cat_entidad
                                ON postulante.cat_entidad.id_cat_entidad =
                                    postulante.clues.id_cat_entidad
                            WHERE postulante.clues.id_clues = $idClue;");
        return $query;
    }

    function editarByArray($conexion, $datos, $condicion)
    {
        $pg_update = pg_update($conexion, 'postulante.postulantes', $datos, $condicion);
        return $pg_update;
    }

    public function getUltimoClues($idClue){
        $query = pg_query ("SELECT 
                                * --postulante.clues.plazas
                            FROM postulante.clues
                            WHERE postulante.clues.id_clues = $idClue
                            AND postulante.clues.plazas ::INTEGER = (
                                                            SELECT COUNT(id_postulantes)
                                                            FROM postulante.postulantes
                                                            WHERE postulante.postulantes.id_clues = postulante.clues.id_clues
                                                        );");
        return $query;
    }
}