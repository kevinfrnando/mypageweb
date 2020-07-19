<?php


class TestimonialsController extends Controller{

    public function __construct(){
        $this->testimonial = $this->model("Testimonials");
        $this->statusModel = $this->model("MainStatus");
        $this->userModel = $this->model("AuthUser");
        $this->permissionsModel = $this->model("AuthPermissions");
        $sessionPermission = $_SESSION["user"]["permissions"];
        $this->permission = $this->permissionsModel->getPermission( $sessionPermission->id );
    }

    public function index( $i = 1){

        if( $this->permission->about_menu) {
            /**
             *  Paginacion
             *  1.- Se obtiene el numero de registros
             *  2.- Se estalece el inicio con el indice pasado por parametro, por default sera el 1
             *  3.- Se divide para obtener la cantidad de tabs por todos los registros
             *
             */
            $rowsPerPage = 5;
            $rowCounts = $this->testimonial->countRows()->count;
            $start = ( $i - 1) * $rowsPerPage;
            $totalTabs = ceil($rowCounts / $rowsPerPage);
            $testimonials = $this->testimonial->getData($start,$rowsPerPage);


            /**
             *  Obtenemos los ids de los registros corespondientes a los usuarios para luego obtenerlos en la consulta
             *
             */
            $usersId = [];
            $statusId = [];
            foreach ( $testimonials as $testimonial){
                array_push( $usersId, $testimonial->created_by);
                array_push( $usersId, $testimonial->updated_by == null ? 0 : $testimonial->updated_by);
                array_push( $statusId, $testimonial->status_id);
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
                "testimonials"=> $testimonials,
                "statusArray" => $statusArray,
                "totalTabs" => $totalTabs,
                "current" => $i,
                "permissions" => $this->permission,
                "usersArray" => $usersArray
            ];
            $this->view("testimonial/index", $data);
        }else {
            $this->view("notfound/deneged");
        }
    }
    public function insert( $id = null ){

        if( $this->permission->about_menu) {
            if( $_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "id" => helpers::decrypt( $id ),
                    "code" => helpers::fieldValidation($_POST["code"]),
                    "description" => helpers::fieldValidation($_POST["description"]),
                    "author" => helpers::fieldValidation($_POST["author"]),
                    "title" => helpers::fieldValidation($_POST["title"]),
                    "image_url" => helpers::fieldValidation($_POST["image_url"]),
                    "profile_id" => 1,
                    "user_id" => $_SESSION["user"]["id"],
                    "status_id" => helpers::fieldValidation($_POST["status_id"])
                ];


                if( $data["id"] == null  ){
                    if( $this->permission->can_create ){
                        $execute = $this->testimonial->insert($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("testimonials");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();
                            $data["skillsTypeArray"] = $this->skillType->getAll();

                            $this->view("testimonial/insert", $data);
                        }
                    }else{
                        $this->view("notfound/deneged");
                    }



                }else{
                    if( $this->permission->can_update ){
                        $execute = $this->testimonial->update($data);

                        if( !is_array($execute) ){
                            helpers::redirecction("testimonials");
                        }else{
                            $data["error"] = $execute;
                            $data["statusArray"] = $this->statusModel->getAll();
                            $data["skillsTypeArray"] = $this->skillType->getAll();

                            $this->view("testimonial/insert", $data);
                        }
                    }
                }

            }else if( ($id != null) && ( $_SERVER["REQUEST_METHOD"] != "POST" )){
                /**
                 * Obtener info desde modelo
                 */
                $skill = $this->testimonial->getTestimonial( helpers::decrypt($id) );

                $data = [
                    "id" => $skill->id,
                    "code" => $skill->code,
                    "description" => $skill->description,
                    "author" => $skill->author,
                    "title" => $skill->title,
                    "image_url" => $skill->image_url,
                    "status_id" => $skill->status_id,
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view("testimonial/insert", $data);
            }else{

                $data = [
                    "id" => null,
                    "code" => "",
                    "description" => "",
                    "author" => "",
                    "title" => "",
                    "image_url" => "",
                    "status_id" => "",
                    "statusArray" => $this->statusModel->getAll()
                ];

                $this->view("testimonial/insert", $data);
            }
        }else {
            $this->view("notfound/deneged");
        }


    }
    public function delete($id){
        if( $this->permission->about_menu) {
            if( $this->permission->can_delete ){
                if( $id != null ){
                    $url = $_SERVER['HTTP_REFERER'];
                    $data = [
                        "id" => helpers::decrypt($id),
                        "deleted_by" => $_SESSION["user"]["id"]
                    ];
                    if( $this->testimonial->delete($data)){
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