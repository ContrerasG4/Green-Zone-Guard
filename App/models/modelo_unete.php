<?php
require_once __DIR__ . '/./conexion.php';
class unete
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }
    public function obtenerevento()
    {
        $sql = "SELECT Codigo_Evento, Nombre_Evento, Puntos, Descripcion_Evento FROM eventos";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function Usuariop($documento)
    {
        $sql = "SELECT * FROM participacion WHERE documento =?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->num_rows > 0;
    }

    public function inscribirse($documento, $usuario, $codigoEvento)
    {
        if ($this->Usuariop($documento)) {
            return "Usted ya esta participando en un evento";
            header('Location: App/view/viewsexion/indexsesion.php');
        }
        $sql = "INSERT INTO participacion (Documento, Nombre_Usuario,Codigo_Evento) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $documento, $usuario, $codigoEvento);
        return $stmt->execute() ? "Se ha inscrito con exito al evento" : "Error al inscribirse";
        header('Location: App/view/viewsesion/indexsesion.php');
    }
}
