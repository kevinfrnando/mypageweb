<?php


class TabsController extends Controller
{
    public function __construct(){
        $this->tab = $this->model("Tabs");
        $this->status = $this->model("MainStatus");
        $this->users = $this->model("AuthUser");
    }

    public function index( $i = 1){

        /**
         *  Paginacion
         *  1.- Se obtiene el numero de registros
         *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
         *  3.- Se divide para obtener la cantidad de tabs por todos los registros
         *
         */
        $rowCounts = $this->tab->countRows()->count;
        $start = ( $i - 1) * 5;
        $totalTabs = ceil($rowCounts / 5);
        $tabs = $this->tab->getData($start,5);

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

        $usersArray = $this->users->getUsersIn($usersId);
        $statusArray = $this->status->getMainStatusIn($statusId);

        $data = [
            "tabs"=> $tabs,
            "statusArray" => $statusArray,
            "totalTabs" => $totalTabs,
            "current" => $i,
            "usersArray" => $usersArray
        ];
        $this->view("tabs/index", $data);

    }
    public function insert( $id = null ){
        if( $_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                "id" => helpers::decrypt( $id ),
                "code" => helpers::fieldValidation($_POST["code"]),
                "description" => helpers::fieldValidation($_POST["description"]),
                "user_id" => $_SESSION["user"]["id"],
                "status_id" => helpers::fieldValidation($_POST["status_id"])
            ];

            if( $data["id"] == null ){
                $execute = $this->tab->insert($data);

                if( !is_array($execute) ){
                    helpers::redirecction("tabs");
                }else{
                    $data["error"] = $execute;
                    $data["statusObj"] = $this->statusObj;
                    $this->view("tabs/insert", $data);
                }


            }else{
                $execute = $this->tab->update($data);

                if( !is_array($execute) ){
                    helpers::redirecction("tabs");
                }else{
                    $data["error"] = $execute;
                    $data["statusObj"] = $this->statusObj;
                    $this->view("tabs/insert", $data);
                }
            }

        }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){

            /**
             * Obtener info desde modelo
             */

            $tab = $this->tab->getTab( helpers::decrypt($id));
            $data = [
                "id" => $tab->id,
                "code" => $tab->code,
                "description" => $tab->description,
                "status_id" => $tab->status_id,
                "statusObj" => $this->statusObj
            ];

            $this->view("tabs/insert", $data);
        }else{

            $data = [
                "id" => null,
                "code" => "",
                "description" => "",
                "status_id" => "",
                "statusObj" => $this->statusObj
            ];

            $this->view("tabs/insert", $data);
        }
    }

    public function delete($id){

        if( $id != null ){
            $url = $_SERVER['HTTP_REFERER'];
            $data = [
                "id" => helpers::decrypt($id),
                "deleted_by" => $_SESSION["user"]["id"]
            ];
            if( $this->tab->delete($data)){
                header("Location: ".$url);
            }else{
                die("Algo salio mal");
            }
        }
    }



}