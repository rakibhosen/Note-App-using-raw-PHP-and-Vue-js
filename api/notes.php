<?php include('../note.php'); ?>

<?php
    $note = new Note();
    $notes = $note->getNotes();
    echo json_encode(['success'=>true,'data'=>$notes]);
?>