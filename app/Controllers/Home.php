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

        $userModel->update([2, 3], $data);

        $userModel->whereIn("id", [4, 5, 6])->set(["name" => "yo tambien"])->update();

        $data = [
        "name"  => "programador8",
        "email" => "programador8@hotmail.com",
        ];
        $userModel->save($data);
         */
        $data = [
            "id"    => 7,
            "name"  => "programador10update",
            "email" => "programador10update@hotmail.com",
        ];
        $userModel->save($data);
        $users          = $userModel->findAll();
        $users          = array("users" => $users);
        $estructuraView = view('estrutura/header') . view('estrutura/body', $users);

        return $estructuraView;
    }

    //--------------------------------------------------------------------

}
