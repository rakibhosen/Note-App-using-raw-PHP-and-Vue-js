<?php include('../note.php');?>
<?php 
 if(isset($_POST['id'])){
     $note = new Note();
    if($note->deleteNote($_POST['id'])){
        echo json_encode(['status'=>'success']);
    }else{
        echo json_encode(['status'=>'error','message'=>'query not working']);
    }
     
    }else{
        echo json_encode(['status'=>'error','message'=>'query not isset']);
    }

?>
