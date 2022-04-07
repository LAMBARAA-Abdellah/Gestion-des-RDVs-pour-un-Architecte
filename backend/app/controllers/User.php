<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:*');
class User extends Controller
{
  public $valide = "false";
  public function __construct()
  {
  }

  public function index()
  {
    $user = $this->model('UserModel');
    $users = $user->SelectAll();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $json = file_get_contents('php://input');
      // $data = json_decode($json);
      foreach ($users as $user) {
        if ($user['psseudo_client'] == $json) {
          $this->valide = $user;
          break;
        } else {
          $this->valide = false;
        }
      }
    }
    echo json_encode($this->valide);
    // echo "hslfhids";
  }

  public function register()
  {

    $model = $this->model('UserModel');
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $json = file_get_contents('php://input');
      $data = json_decode($json);
      $data = array_values((array)$data);
      $data[4] = uniqid();
      $created = $model->insert($data);
      if ($created) {
        echo json_encode($data);
      }
      // header( "Location: http://localhost:8080/" );
    }
  }

  public function getAllRDV()
  {
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
      $RDV = $this->model('RDVModel');
      $RDVs = $RDV->selectAll($_GET['id']);
      echo json_encode($RDVs);
    }
  }

  public function getUser()
  {
    $select = $this->model('UserModel');
    $selected = $select->select($_GET["id"]);
    echo json_encode($selected);
  }

  public function getOne()
  {
    $select = $this->model('UserModel');
    $selected = $select->selectAll();
    echo json_encode($selected);
  }

  public function addRDV()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $addApp = $this->model('RDVModel');
      $json = file_get_contents('php://input');
      $data = json_decode($json);
      $data = array_values((array)$data);
      $addApp->insertRDV($data);
      // var_dump($data);
      echo json_encode($data);
      // if ($created) {
      //   echo json_encode($data);
      // }
    }
  }
  public function getcreDate()
  {
    $addApp = $this->model('UserModel');
    $allcreneau = $addApp->getcreDate($_GET['date']);
    echo json_decode($allcreneau);
  }
}
