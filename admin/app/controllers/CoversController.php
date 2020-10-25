<?php


class CoversController extends Controller
{
    public function __construct(){
        $this->navCover = $this->model("CoversNavs");
        $this->cover = $this->model("Covers");
        $this->userModel = $this->model("AuthUser");
        $this->statusModel = $this->model("MainStatus");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permissionsModel = $this->model("AuthPermissions");
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        $this->path = "aboutMe/covers/";
    }

    public function index( $i = 1){

        if( $this->permission->profile_menu) {
            /**
             *  Paginacion
             *  1.- Se obtiene el numero de registros
             *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
             *  3.- Se divide para obtener la cantidad de tabs por todos los registros
             *
             */
            $rowsPerPage = 5;
            $rowCounts = $this->cover->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $covers = $this->cover->getData($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $usersId = [];
            $statusId = [];
            $navId = [];
            foreach ( $covers as $cover){
                array_push( $usersId, $cover->created_by);
                array_push( $usersId, $cover->updated_by == null ? 0 : $cover->updated_by);
                array_push( $statusId, $cover->status_id);
                array_push( $navId, $cover->nav_cover_id);
            }

            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $navId = array_unique( $navId );
            $statusId = array_unique( $statusId );
            $usersId = array_unique( $usersId );

            $usersId = implode(",", $usersId );
            $statusId = implode(",", $statusId );
            $navId = implode(",", $navId );

            $usersArray = $this->userModel->getUsersIn( $usersId );
            $statusArray = $this->statusModel->getMainStatusIn( $statusId );
            $navsArray = $this->navCover->getCoversNavIn( $navId );

            $data = [
                "covers"=> $covers,
                "statusArray" => $statusArray,
                "totalTabs" => $totalTabs,
                "current" => $i,
                "permissions" => $this->permission,
                "usersArray" => $usersArray,
                "navsArray" => $navsArray
            ];
//            echo '<pre>' . var_export($data, true) . '</pre>';
            $this->view($this->path."index", $data);
        }else {
            $this->view("notfound/deneged");
        }
    }
    public function insert( $id = null ){

        if( $this->permission->profile_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "title" => helpers::fieldValidation($_POST["title"]),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "url" => helpers::fieldValidation($_POST["url"]),
                    "nav_id" => helpers::fieldValidation($_POST["nav_id"]),
                    "user_id" => $_SESSION["user"]["id"],
                    "profile_id" => 1,
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];


                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->cover->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("covers");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();
                            $this->view($this->path."insert", $data);
                        }
                    }else{
                        $this->view("notfound/deneged");
                    }



                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->cover->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("covers");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll() ;
                            $this->view($this->path."insert", $data);
                        }
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                /**
                 * Obtener info desde modelo
                 */

                $cover = $this->cover->getCover( helpers::decrypt($id) );

                $data = [
                    "id" => $cover->id,
                    "title" => $cover->title,
                    "description" => $cover->description,
                    "url" => $cover->url,
                    "nav_id" => $cover->nav_cover_id,
                    "status_id" => $cover->status_id,
                    "statusArray" => $this->statusModel->getAll(),
                    "navsArray" => $this->navCover->getAll()

                ];

                $this->view($this->path."insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "title" => "",
                    "description" => "",
                    "url" => "",
                    "nav_id" => "",
                    "status_id" => "",
                    "statusArray" => $this->statusModel->getAll(),
                    "navsArray" => $this->navCover->getAll()
                ];

                $this->view($this->path."insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }

    public function delete($id){

        if( $this->permission->components_menu) {
            if( $this->permission->can_delete ){
                if( $id != null ){
                    $url = $_SERVER['HTTP_REFERER'];
                    $data = [
                        "id" => helpers::decrypt($id),
                        "deleted_by" => $_SESSION["user"]["id"]
                    ];
                    if( $this->cover->delete($data)){
                        header("Location: ".$url);
                    }else{
                        die("Algo salio mal");
                    }
                }
            }
        }else {
            $this->view("notfound/deneged");
        }


    }

}