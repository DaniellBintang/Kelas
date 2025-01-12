<?php

class Barang
{
    private $conn;
    private $table = "barang";

    public function __construct($host, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function create($nama_barang, $harga, $stok, $gambar)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (nama_barang, harga, stok, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdis", $nama_barang, $harga, $stok, $gambar);
        return $stmt->execute();
    }

    public function read()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    public function update($id, $nama_barang, $harga, $stok, $gambar)
    {
        if ($gambar) {
            $stmt = $this->conn->prepare("UPDATE $this->table SET nama_barang = ?, harga = ?, stok = ?, gambar = ? WHERE id = ?");
            $stmt->bind_param("sdisi", $nama_barang, $harga, $stok, $gambar, $id);
        } else {
            $stmt = $this->conn->prepare("UPDATE $this->table SET nama_barang = ?, harga = ?, stok = ? WHERE id = ?");
            $stmt->bind_param("sdii", $nama_barang, $harga, $stok, $id);
        }
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

// Contoh Penggunaan
$barang = new Barang("localhost", "root", "", "dbgpt");

// Create Barang

// Read Barang
$data = $barang->read();

// Update Barang

// Delete Barang

$barang->closeConnection();
