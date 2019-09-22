<?php include('../note.php');?>
<?php 
 if(isset($_POST['title'])&& isset($_POST['description'])&& isset($_POST['author'])){
     $note = new Note();
    if($note->addNotes($_POST['title'],$_POST['description'],$_POST['author'])){
        echo json_encode(['status'=>'success']);
    }else{
        echo json_encode(['status'=>'error','message'=>'query not working']);
    }
     
    }else{
        echo json_encode(['status'=>'error','message'=>'not isset everything']);
    }

?>