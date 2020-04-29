<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * summary
 */
class UserModel extends Model {

    protected $table      = "users"; //nombre de la tabla q usa
    protected $primaryKey = "id"; //clave primaria

    protected $returnType     = "array"; //como retorna los datos
    protected $useSoftDeletes = true; //si usa el borrado suave

    protected $allowedFields = ["name", "email"]; //q campos q se puede modificar en la BD

    protected $useTimestamps = false;
    protected $createField   = "created_at";
    protected $updateField   = "updated_at";
    protected $deletedField  = 'deleted_at';
    //reglas de validaciones para cada campo
    protected $validationRules = [
        "name"  => "required|alpha_numeric_space|min_length[3]",
        "email" => "required|valid_email|is_unique[users.email]",
    ];
    //mensajes de personalizacion para la reglas de validaciones
    protected $validationMessages = [
        "email" => [
            "is_unique" => "el email la esta en uso..!",
        ],
    ];
    //esta si decimos false q valide los campos si esta en true q no
    protected $skipValidation = false;
    //para cuando va a ser algo antes de insertar o modificar registros en la BD
    //protected $beforeInsert = ["agregarName"];
    //protected $beforeUpdate = ["agregarName"];

    protected function agregarName(array $data) {
        $data["data"]["name"] = $data["data"]["name"] . " algo";
        return $data;
    }

}

?>