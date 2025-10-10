<?php

use function PHPUnit\Framework\throwException;

class Database
{
    private $host = "localhost";
    private $db_name = "aula_php_pdo";
    private $username = "root";
    private $password = "root123";
    private $conn;

    public function __construct()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    public function create($table, $arr)
    {
        try {
            if (!$this->tableExists($table)) {
                throw new Exception("Tabela $table não existe!");
            }

            $fields = array_keys($arr);
            $values = array_values($arr);
            $placeholders = str_repeat("?,", count($fields) - 1) . "?";
            $valuesPlaceholders = implode(", ", $fields);

            $sql = "INSERT INTO $table ($valuesPlaceholders) VALUES ($placeholders)";

            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($values);

            if ($result) {
                return [
                    'success' => true,
                    'id' => $this->conn->lastInsertId(),
                    'message' => 'Registro criado com sucesso!'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Erro ao criar o registro'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erro no banco: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public function read($table, $conditions = [], $limit = null, $offset = null)
    {
        try {
            if (!$this->tableExists($table)) {
                throw new Exception("Tabela $table não existe!");
            }

            $sql = "SELECT * FROM $table";
            $params = [];

            if (!empty($conditions)) {
                $where_conditions = [];
                foreach ($conditions as $field => $value) {
                    $where_conditions[] = "$field = ?";
                    $params[] = $value;
                }
                $sql .= " WHERE " . implode(" AND ", $where_conditions);
            }

            if ($limit !== null) {
                $sql .= " LIMIT $limit";
                if ($offset !== null) {
                    $sql .= " OFFSET $offset";
                }
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);

            return [
                'success' => true,
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
                'count' => $stmt->rowCount()
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erro no banco: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public function update($table, $data, $conditions = [])
    {
        try {
            if (!$this->tableExists($table)) {
                throw new Exception("Tabela $table não existe!");
            }

            $sql = "UPDATE $table SET ";
            $params = [];

            $set_fields = [];
            foreach ($data as $field => $value) {
                $set_fields[] = "$field = ?";
                $params[] = $value;
            }
            $sql .= implode(", ", $set_fields);


            if (!empty($conditions)) {
                $where_conditions = [];
                foreach ($conditions as $field => $value) {
                    $where_conditions[] = "$field = ?";
                    $params[] = $value;
                }
                $sql .= " WHERE " . implode(" AND ", $where_conditions);
            }

            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($params);

            return [
                'success' => true,
                'affected_rows' => $stmt->rowCount(),
                'message' => $stmt->rowCount() > 0 ? 'Registro(s) alterados(s) com sucesso!' : 'Nenhum registro foi alterado'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erro no banco: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public function delete($table, $conditions = [])
    {
        try {
            if (!$this->tableExists($table)) {
                throw new Exception("Tabela $table não existe!");
            }

            $sql = "DELETE FROM $table";
            $params = [];

            if (!empty($conditions)) {
                $where_conditions = [];
                foreach ($conditions as $field => $value) {
                    $where_conditions[] = "$field = ?";
                    $params[] = $value;
                }
                $sql .= " WHERE " . implode(" AND ", $where_conditions);
            }

            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($params);

            return [
                'success' => true,
                'affected_rows' => $stmt->rowCount(),
                'message' => $stmt->rowCount() > 0 ? 'Registro(s) deletado(s) com sucesso!' : 'Nenhum registro foi deletado'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erro no banco: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    public function tableExists($table)
    {
        try {
            $stmt = $this->conn->prepare("SHOW TABLES LIKE ?");
            $stmt->execute([$table]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}