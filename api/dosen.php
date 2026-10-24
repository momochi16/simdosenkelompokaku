<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../config/db.php';

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch($method) {
    case 'GET':
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM dosen WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();
        } else {
            $stmt = $pdo->query("SELECT * FROM dosen ORDER BY nama ASC");
            $data = $stmt->fetchAll();
        }
        echo json_encode(["status" => "success", "data" => $data]);
        break;

    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
            break;
        }
        try {
            $stmt = $pdo->prepare("INSERT INTO dosen (nomor_registrasi, nuptk, nama, nip, jabatan_fungsional, kepangkatan, pendidikan_terakhir, rumpun_ilmu, status_serdos, status_pegawai, ikatan_kerja, status_aktivitas, penempatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $input['nomor_registrasi'] ?? null,
                $input['nuptk'] ?? null,
                $input['nama'] ?? '',
                $input['nip'] ?? null,
                $input['jabatan_fungsional'] ?? null,
                $input['kepangkatan'] ?? null,
                $input['pendidikan_terakhir'] ?? null,
                $input['rumpun_ilmu'] ?? null,
                $input['status_serdos'] ?? null,
                $input['status_pegawai'] ?? null,
                $input['ikatan_kerja'] ?? null,
                $input['status_aktivitas'] ?? null,
                $input['penempatan'] ?? null
            ]);
            echo json_encode(["status" => "success", "message" => "Dosen added successfully", "id" => $pdo->lastInsertId()]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'PUT':
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID is required"]);
            break;
        }
        $input = json_decode(file_get_contents("php://input"), true);
        try {
            $stmt = $pdo->prepare("UPDATE dosen SET nomor_registrasi=?, nuptk=?, nama=?, nip=?, jabatan_fungsional=?, kepangkatan=?, pendidikan_terakhir=?, rumpun_ilmu=?, status_serdos=?, status_pegawai=?, ikatan_kerja=?, status_aktivitas=?, penempatan=? WHERE id=?");
            $stmt->execute([
                $input['nomor_registrasi'] ?? null,
                $input['nuptk'] ?? null,
                $input['nama'] ?? '',
                $input['nip'] ?? null,
                $input['jabatan_fungsional'] ?? null,
                $input['kepangkatan'] ?? null,
                $input['pendidikan_terakhir'] ?? null,
                $input['rumpun_ilmu'] ?? null,
                $input['status_serdos'] ?? null,
                $input['status_pegawai'] ?? null,
                $input['ikatan_kerja'] ?? null,
                $input['status_aktivitas'] ?? null,
                $input['penempatan'] ?? null,
                $id
            ]);
            echo json_encode(["status" => "success", "message" => "Dosen updated successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID is required"]);
            break;
        }
        try {
            $stmt = $pdo->prepare("DELETE FROM dosen WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(["status" => "success", "message" => "Dosen deleted successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Method not allowed"]);
        break;
}
?>
