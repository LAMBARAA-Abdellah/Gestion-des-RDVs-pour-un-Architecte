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
        $requete  = "INSERT INTO `rdv`(`date_r`,`sujet`, id_creneau, `id_client`) VALUES (?,?,?,?)";
        $stm = $conn->prepare($requete);
        // $stm->bindParam(':Sujet', $data['Sujet']);
        // $stm->bindParam(':date', $data['date']);
        // $stm->bindParam(':creneau', $data['creneau']);
        // $stm->bindParam(':id_utilisateur', $data['id_utilisateur']);
        $result = $stm->execute($data);
        return $result;
    }
}
