<?php


class TabsController extends Controller
{
    public function __construct(){
        $this->tabModel = $this->model("Tabs");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $this->permissionsModel = $this->model("AuthPermissions");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
        $this->path = "components/tabs/";
    }

    public function index( $i = 1){

        if( $this->permission->components_menu) {
            /**
             *  Paginacion
             *  1.- Se obtiene el numero de registros
             *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
             *  3.- Se divide para obtener la cantidad de tabs por todos los registros
             *
             */
            $rowsPerPage = 5;
            $rowCounts = $this->tabModel->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $tabs = $this->tabModel->getData($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $usersId = [];
            $statusId = [];
            foreach ( $tabs as $tab){
                array_push( $usersId, $tab->created_by);
                array_push( $usersId, $tab->updated_by == null ? 0 : $tab->updated_by);
                array_push( $statusId, $tab->status_id);
            }

            /**
             *  Construcion del parametro para las consultas SQL --- in () ---
             */
            $usersId = array_unique( $usersId );
            $statusId = array_unique( $statusId );

            $usersId = implode(",", $usersId );
            $statusId = implode(",", $statusId );

            $usersArray = $this->userModel->getUsersIn($usersId);
            $statusArray = $this->statusModel->getMainStatusIn($statusId);

            $data = [
                "tabs"=> $tabs,
                "statusArray" => $statusArray,
                "totalTabs" => $totalTabs,
                "current" => $i,
                "usersArray" => $usersArray
            ];
            $this->view($this->path."index", $data);
        }else {
            $this->view("notfound/deneged");
        }
    }
    public function insert( $id = null ){

        if( $this->permission->components_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "href" => helpers::fieldValidation($_POST["href"]),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];

                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->tabModel->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("tabs");
                        }else{
                            $data["error"] = $execute;
                            $data["statusObj"] = $this->statusModel->getAll();
                            $this->view($this->path."insert", $data);
                        }
                    }else{
                        $this->view("notfound/deneged");
                    }



                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->tabModel->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("tabs");
                        }else{
                            $data["error"] = $execute;
                            $data["statusObj"] = $this->statusModelObj;
                            $this->view($this->path."insert", $data);
                        }
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

                /**
                 * Obtener info desde modelo
                 */

                $tab = $this->tabModel->getTab( helpers::decrypt($id));

                $data = [
                    "id" => $tab->id,
                    "href" => $tab->href,
                    "description" => $tab->description,
                    "status_id" => $tab->status_id,
                    "statusObj" => $this->statusModel->getAll()
                ];

                $this->view($this->path."insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "href" => "",
                    "description" => "",
                    "status_id" => "",
                    "statusObj" => $this->statusModel->getAll()
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
                    if( $this->tabModel->delete($data)){
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