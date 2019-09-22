<?php include('../note.php');?>
<?php 
    if(isset($_POST['title'])&& isset($_POST['description'])&& isset($_POST['author'])&& isset($_POST['id'])){
        $note = new Note();
        if($note->updateNotes($_POST['title'],$_POST['description'],$_POST['author'],$_POST['id'])){
            echo json_encode(['status'=>'success']);
        }else{
            echo json_encode(['status'=>'error']);
        }
        
        }else{
            echo json_encode(['status'=>'error']);
        }

?>