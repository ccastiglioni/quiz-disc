<?php 
session_start();
include 'connection.php';
if (isset($_SESSION['id'])) {

	if(!isset($_SESSION['score'])) 
		$_SESSION['score'] = '';
    
	if ($_POST) {
        $newtime = time();
      
		$qno = $_POST['number'];
        $_SESSION['quiz'] = $_SESSION['quiz'] + 1;
		$selected_choice = $_POST['choice'];
		$nextqno = $qno+1;
 
        switch ($selected_choice) {
            case 'ans1':
                 $_SESSION['score'] .= "C"; 
                break;
            case 'ans2':
                 $_SESSION['score'] .="I"; 
                break;
            case 'ans3':
                 $_SESSION['score'] .="A"; 
                break;
            
            case 'ans4':
                 $_SESSION['score'] .="O"; 
                break;
            
            default:
                break;
        }

        $query1 = "SELECT * FROM questions WHERE  status=1 AND  coach_id=".$_SESSION['coach_id'] ;
        $run = mysqli_query($dbh , $query1) or die(mysqli_error($dbh));
        $totalqn = mysqli_num_rows($run);

        if ($qno == $totalqn) {
        	header("location: results");
        }
        else {
        	header("location: question?n=".$nextqno);
        }   
   }
} else {
    header("location: home");
}

?>
