<?php


class TabsController extends Controller
{
    public function __construct(){
        $this->tab = $this->model("Tabs");
        $this->statusObj = $this->tab->getStatus();
    }

    public function index( $i = 1){

        $rowCounts = $this->tab->countRows()->count;
        $start = ( $i - 1) * 5;
        $totalTabs = ceil($rowCounts / 5);
        $tabs = $this->tab->getData($start,5);

        $count = $this->tab->countRows();
        $data = [
            "tabs"=> $tabs,
            "statusObj" => $this->statusObj,
            "totalTabs" => $totalTabs,
            "current" => $i
        ];
        $this->view("tabs/index", $data);

    }
    public function insert( $id = null ){
        if( $_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                "id" => helpers::decrypt( $id ),
                "code" => helpers::fieldValidation($_POST["code"]),
                "description" => helpers::fieldValidation($_POST["description"]),
                "created_by" => $_SESSION["user"]["id"],
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
            $data = [
                "id" => helpers::decrypt($id),
                "deleted_by" => $_SESSION["user"]["id"]
            ];
            if( $this->tab->delete($data)){
                helpers::redirecction("tabs");
            }else{
                die("Algo salio mal");
            }
        }
    }



}