<?php

namespace App\Controllers;
use App\Models\UserModel;

class Home extends BaseController {

    public function index() {
        $userModel = new UserModel($db);
        //metodos de busquedas basicos
        //$users          = $userModel->find([1, 2]);
        //$users = $userModel->findAll();
        //$users          = $userModel->where("name", "juan")->findAll();
        //$users          = $userModel->findAll(2, 3);
        //$users          = $userModel->withDeleted()->findAll();

        /* //para una insercion sencilla
        $data = [
        "name"  => "programador",
        "email" => "programador@hotmail.com",
        ];
        $userModel->insert($data);
        //modificacion sencilla de datos
        $data = [
        "name"  => "programadorupdate",
        "email" => "programadorupdate@hotmail.com",
        ];
        $userModel->update(6, $data);

        $data = [
        "name" => "yo",
        ];

        $userModel->update([2, 3], $data);//aqui si son varios
        //aqui por una condicion para varios
        $userModel->whereIn("id", [4, 5, 6])->set(["name" => "yo tambien"])->update();

        $data = [
        "name"  => "programador8",
        "email" => "programador8@hotmail.com",
        ];
        $userModel->save($data);//y aqui save guarda sino exite

        $data = [
        "id"    => 7,
        "name"  => "programador10update",
        "email" => "programador10update@hotmail.com",
        ];
        $userModel->save($data);//y aqui modifica si exite
         */
        //eliminacion sencilla
        //$userModel->delete([4, 5, 6]);
        //$userModel->where("id", 7)->delete();//por busqueda puede ser cualquier campo
        //$userModel->purgeDeleted();//elimina de forma completa
        //validacion sencilla
        $data = [
            "name"  => "programadorvalidonuevo 2",
            "email" => "programador_validonuevo2@hotmail.com",
        ];
        if ($userModel->save($data) === false) {
            var_dump($userModel->errors()); //aqui solo mostramos los mensajes de errores
        }
        /*
        $users = $userModel->asArray()->where("name", "yo")->orderBy("id", "asc")->findAll();
        var_dump($users);
         */
        $users          = $userModel->findAll();
        $users          = array("users" => $users);
        $estructuraView = view('estrutura/header') . view('estrutura/body', $users);

        return $estructuraView;
    }

    //--------------------------------------------------------------------
    public function __construct() {
        helper("form");
    }
    //para guardar datos
    public function guardar() {
        $userModel = new UserModel($db); //creamos nuestro modelo
        $request   = \Config\Services::request(); //obtenemos aqui lo q viene por request
        //aqui colocamos los datos
        $data = [
            "name"  => $request->getPostGet("name"),
            "email" => $request->getPostGet("email"),
        ];
        //insertamos los datos
        if ($userModel->insert($data) === false) {
            var_dump($userModel->errors());
        }
        $users          = $userModel->findAll();
        $users          = array("users" => $users);
        $estructuraView = view('estrutura/header') . view('estrutura/body', $users);

        return $estructuraView;

    }
    //vista de formulario
    public function formulario() {
        $estructuraView = view('estrutura/header') . view('estrutura/formulario');

        return $estructuraView;
    }
}
