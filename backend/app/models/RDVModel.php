<?php
require_once APPROOT . '/config/config.php';
class RDVModel
{
    protected $db;
    public function __construct()
    {
        $con = new Database();
        $this->db = $con->dbh;
    }
    public function selectAllRdv()
    {
        $conn = $this->db;
        $requete = "select * from client INNER JOIN rdv ON client.id=rdv.id_client ";
        // $requete="select * from rdv";
        $stm = $conn->prepare($requete);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function selectAll($id)
    {
        $conn = $this->db;
        $requete  = "SELECT * FROM `rdv` where id_client=$id";
        $stm = $conn->prepare($requete);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function remove($id)
    {
        $conn = $this->db;
        $requete  = "DELETE FROM `rdv` WHERE id_r=$id";
        $stm = $conn->prepare($requete);
        $stm->execute();
    }

    public function insertRDV($data)
    {
        $conn = $this->db;
        $requete  = "INSERT INTO `rdv`( `id_client`,`sujet`,`date_r`, id_creneau) VALUES (?,?,?,?)";
        $stm = $conn->prepare($requete);
        $result = $stm->execute($data);
        return $result;
    }
}
