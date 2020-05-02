<?php

namespace App\Controllers;
use App\Models\UserModel;

class MiControlador extends BaseController {

    public function index() {
        echo "MiControlador";
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
        /*
        $data = [
        "name"  => "programadorvalidonuevo 2",
        "email" => "programador_validonuevo2@hotmail.com",
        ];
        if ($userModel->save($data) === false) {
        var_dump($userModel->errors()); //aqui solo mostramos los mensajes de errores
        }
         */
        /*
        $users = $userModel->asArray()->where("name", "yo")->orderBy("id", "asc")->findAll();
        var_dump($users);
         */

        $users     = $userModel->paginate(1);
        $paginator = $userModel->pager;
        $paginator->setPath("CodeIgniter_Curso_1/");
        $users          = array("users" => $users, "paginator" => $paginator);
        $estructuraView = view('estrutura/header') . view('estrutura/body', $users);

        return $estructuraView;
    }

    //--------------------------------------------------------------------
    protected $session = null; //aqui para colocar un session
    public function __construct() {
        helper("form");
        $this->session = \Config\Services::session();
    }
    //para guardar datos
    public function guardar() {
        $userModel = new UserModel($db); //creamos nuestro modelo
        $request   = \Config\Services::request(); //obtenemos aqui lo q viene por request
        //aqui colocamos los datos, obtenemos los datos q viene por get o post con el metodo getPostGet()
        $data = [
            "name"  => $request->getPostGet("name"),
            "email" => $request->getPostGet("email"),
        ];
        //aqui vemos si viene un id y le pasamos o anezamos a nuestra varible $data el id q viene
        if ($request->getPostGet("id")) {
            $data["id"] = $request->getPostGet("id");
        }
        //insertamos los datos
        if ($userModel->save($data) === false) {
            var_dump($userModel->errors()); //mostramos lo errores
        }
        //vemos aqui si viene el id retornaremos otra vista
        //y le pasamo el user
        if ($request->getPostGet("id")) {
            $user           = $userModel->find([$request->getPostGet("id")]);
            $estructuraView = view('estrutura/header') . view('estrutura/formulario', $user);
        } else {
            //sino vamos a ir para otro lado
            $users          = $userModel->findAll();
            $users          = array("users" => $users);
            $estructuraView = view('estrutura/header') . view('estrutura/body', $users);
        }

        return $estructuraView; //aqui retornamos la vista

    }
    //para editar
    public function editar() {
        $userModel = new UserModel($db); //creamos nuestro modelo
        $request   = \Config\Services::request(); //obtenemos aqui lo q viene por request

        if ($request->getPostGet("id")) {
            $id = $request->getPostGet("id");
        } else {
            $id = $request->uri->getSegment(3);
        }

        //obtenemos aqui el id q viene
        $user = $userModel->find($id); //buscamos el user por su id

        $estructuraView = view('estrutura/header') . view('estrutura/formulario', ["user" => $user]);

        return $estructuraView;
    }
    //para borrar
    public function borrar() {
        $userModel = new UserModel($db); //creamos nuestro modelo
        $request   = \Config\Services::request(); //obtenemos aqui lo q viene por request

        //aqui comprobamos si viene un id por get
        if ($request->getPostGet("id")) {
            $id = $request->getPostGet("id"); //asignamos aqui el id
        } else { //sino
            $id = $request->uri->getSegment(3); //Aqui le decimos q nos obtenga el segmento de nuestra url y q sea el id
        }
        $user = $userModel->delete($id); //delete() elimina a el user por su id

        $users          = $userModel->findAll(); //aqui buscamos a todos los users
        $users          = array("users" => $users); //lo ponemos como un array
        $estructuraView = view('estrutura/header') . view('estrutura/body', $users);

        return $estructuraView; //retornamos aqui a la vista
    }
    //vista de formulario
    public function formulario() {
        $estructuraView = view('estrutura/header') . view('estrutura/formulario');

        return $estructuraView;
    }
    //para manipulacion sencilla de imagenes
    public function imagenManipulacion() {
        //cargamos aqui tambien la informacion de nuestra imagen
        $info = \Config\Services::image()
            ->withFile("imagenPrueba.jpg") //buscamos la imagen
            ->getFile() //obtenemos a la imagen
            ->getProperties(true); //y aqui obtenemos la propiedades, true para q sip

        $ancho = $info["width"]; //obtenemos ancho
        $alto  = $info["height"]; //obtenemos alto

        $imagen = \Config\Services::image()
            ->withFile("imagenPrueba.jpg")
            ->reorient()
        //->rotate(180)//rota la imagen
        //->fit(250, 250, "botom-left")//recorta en el centro o asi el centro apartir de abajo a la izquierda
        //->resize($ancho / 2, $alto / 2)//reduce la imagen o la amplia dependiendo q es lo q se decee
            ->crop(400, 400, 200, 200) //crop tambien recorta apartir de abjo a la derecha y tambien se le puede pasar q se mueva un tanto a lo q decees
            ->save("imagenPrueba_p.jpg"); //guarda la imagen sino existe sino la reemplaza

        return view("estrutura/imagen"); //retornamos a la vista indicada
    }
    //para poner datos en mi session
    public function ponerDatos() {
        //$session = \Config\Services::session(); //clase y metodo q maneja la sesion
        //array q pone los datos
        $newData = [
            "name"  => "novato",
            "email" => "infoprogramador@hotmail.com",
            "login" => true,
        ];
        //aqui con set() añadimos o colocamos lo datos del array
        $this->session->set($newData);
        //aqui sencillamente mostramos un dato a ver si tenemos una session con get()
        echo $this->session->get("email");
    }
    //para leer los datos
    public function leerDatos() {
        //$session = \Config\Services::session();
        //comprobamos aqui si tenemos un session activa con has()
        //si es asi mostramos los datos de nuestra session
        if ($this->session->has("name")) {
            echo "email: " . $this->session->get("email") . "<br>";
            echo "name: " . $this->session->get("name") . "<br>";
            echo "login: " . $this->session->get("login") . "<br>";
        } else {
            //sino decimos q no ay datos
            echo 'No Ay Datos..!';
        }

    }
    //para quitar un dato o varios de nuestra session
    public function quitarDatos() {
        //el metodo remove() y cual dato queremos q no este
        $this->session->remove("email");
    }
    //para destruir la session activa
    public function destruirDatos() {
        //destroy() elimina la varible de session
        $this->session->destroy();
    }
}
