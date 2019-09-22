<?php include 'connection.php';

  class Note extends connection{
    public function getNotes(){
      $sql = "SELECT * FROM vue_tutorial";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    public function findNotes($id){
      $sql = "SELECT * FROM vue_tutorial where id=? limit 1";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($id));
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addNotes($title,$description,$author){
      $sql = "insert into vue_tutorial(title,description,author)VALUES(?,?,?)";
      $stmt = $this->db->prepare($sql);
      if( $stmt->execute(array($title,$description,$author))){
          return true;
      }
      return false;
    }

    public function updateNotes($title,$description,$author,$id){
      $sql = "update vue_tutorial set title=?,description=?,author=? where id=?";
      $stmt = $this->db->prepare($sql);
      if( $stmt->execute(array($title,$description,$author,$id))){
          return true;
      }
      return false;
     }

    public function deleteNote($id){
      $sql = "delete from vue_tutorial where id=?";
      $stmt = $this->db->prepare($sql);
      if( $stmt->execute(array($id))) {
        return true;
      }
      return false;
      }

  }
