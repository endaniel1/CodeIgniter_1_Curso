<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * summary
 */
class UserModel extends Model {

    protected $table      = "users";
    protected $primaryKey = "id";

    protected $returnType     = "array";
    protected $useSoftDeletes = true;

    protected $allowedFields = ["name", "email"];

    protected $useTimestamps = false;
    protected $createField   = "created_at";
    protected $updateField   = "updated_at";
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>