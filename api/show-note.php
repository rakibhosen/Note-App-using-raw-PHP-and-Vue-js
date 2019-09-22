<?php include('../note.php');?>
<?php 
 if(isset($_REQUEST['id'])){
     $id = $_REQUEST['id'];
     $note = new Note();
     $noteData = $note->findNotes($id);
     echo json_encode(['success'=>true,'data'=>$noteData]);
 }

?>