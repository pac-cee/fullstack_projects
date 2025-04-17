<?php
// Custom PHP Session Handler
class DbSessionHandler implements SessionHandlerInterface {
    private $db;
    public function open($savePath, $sessionName) {
        $this->db = new PDO('sqlite:sessions.db');
        $this->db->exec('CREATE TABLE IF NOT EXISTS sessions (id TEXT PRIMARY KEY, data TEXT, ts INTEGER)');
        return true;
    }
    public function close() { return true; }
    public function read($id) {
        $st = $this->db->prepare('SELECT data FROM sessions WHERE id=?');
        $st->execute([$id]);
        return $st->fetchColumn() ?: '';
    }
    public function write($id, $data) {
        $ts = time();
        $st = $this->db->prepare('REPLACE INTO sessions (id, data, ts) VALUES (?,?,?)');
        return $st->execute([$id, $data, $ts]);
    }
    public function destroy($id) {
        $st = $this->db->prepare('DELETE FROM sessions WHERE id=?');
        return $st->execute([$id]);
    }
    public function gc($maxlifetime) {
        $st = $this->db->prepare('DELETE FROM sessions WHERE ts < ?');
        return $st->execute([time()-$maxlifetime]);
    }
}
session_set_save_handler(new DbSessionHandler(), true);
session_start();
$_SESSION['test'] = ($_SESSION['test'] ?? 0) + 1;
echo 'Session test value: '.$_SESSION['test'];
