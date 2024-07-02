<?php
  include_once 'database.php';
  session_start();
  $email=$_SESSION['email'];

  if(isset($_SESSION['key']))
  {
    if(@$_GET['demail'] && $_SESSION['key']=='admin') 
    {
      $demail=@$_GET['demail'];
      $r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
      $r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
      $result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
      header("location:dashboard.php?q=1");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='admin') 
    {
      $eid=@$_GET['eid'];
      $result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
      while($row = mysqli_fetch_array($result)) 
      {
        $qid = $row['qid'];
        $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
        $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
      }
      $r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
      header("location:dashboard.php?q=5");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='admin') 
    {
      $name = $_POST['name'];
      $name= ucwords(strtolower($name));
      $total = $_POST['total'];
      $sahi = $_POST['right'];
      $wrong = $_POST['wrong'];
      $id=uniqid();
      $q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total', NOW())");
      header("location:dashboard.php?q=4&step=2&eid=$id&n=$total");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'addqns' && $_SESSION['key']=='admin') 
    {
      $n=@$_GET['n'];
      $eid=@$_GET['eid'];
      $ch=@$_GET['ch'];
      for($i=1;$i<=$n;$i++)
      {
        $qid=uniqid();
        $qns=$_POST['qns'.$i];
        $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
        $oaid=uniqid();
        $obid=uniqid();
        $ocid=uniqid();
        $odid=uniqid();
        $a=$_POST[$i.'1'];
        $b=$_POST[$i.'2'];
        $c=$_POST[$i.'3'];
        $d=$_POST[$i.'4'];
        $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
        $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
        $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
        $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
        $e=$_POST['ans'.$i];
        switch($e)
        {
          case 'a': $ansid=$oaid; break;
          case 'b': $ansid=$obid; break;
          case 'c': $ansid=$ocid; break;
          case 'd': $ansid=$odid; break;
          default: $ansid=$oaid;
        }
        $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
      }
      header("location:dashboard.php?q=0");
    }
  }

  if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) 
  {
    $eid=@$_GET['eid'];
    $sn=@$_GET['n'];
    $total=@$_GET['t'];
    $ans=$_POST['ans'];
    $qid=@$_GET['qid'];
    $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
    while($row=mysqli_fetch_array($q) )
    {  $ansid=$row['ansid']; }
    if($ans == $ansid)
    {
      $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
      while($row=mysqli_fetch_array($q) )
      {
        $sahi=$row['sahi'];
      }
      if($sn == 1)
      {
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
      }
      $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
        $r=$row['sahi'];
      }
      $r++;
      $s=$s+$sahi;
      $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
    } 
    else
    {
      $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
      while($row=mysqli_fetch_array($q) )
      {
        $wrong=$row['wrong'];
      }
      if($sn == 1)
      {
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
      }
      $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
        $w=$row['wrong'];
      }
      $w++;
      $s=$s-$wrong;
      $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
    }
    if($sn != $total)
    {
      $sn++;
      header("location:welcome.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
    }
    else if( $_SESSION['key']!='suryapinky')
    {
      $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
      }
      $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
      $rowcount=mysqli_num_rows($q);
      if($rowcount == 0)
      {
        $q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
      }
      else
      {
        while($row=mysqli_fetch_array($q) )
        {
          $sun=$row['score'];
        }
        $sun=$s+$sun;
        $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
      }
      header("location:welcome.php?q=result&eid=$eid");
    }
    else
    {
      header("location:welcome.php?q=result&eid=$eid");
    }
  }

  if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) 
  {
    $eid=@$_GET['eid'];
    $n=@$_GET['n'];
    $t=@$_GET['t'];
    $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
    while($row=mysqli_fetch_array($q) )
    {
      $s=$row['score'];
    }
    $q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
    $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
    while($row=mysqli_fetch_array($q) )
    {
      $sun=$row['score'];
    }
    $sun=$sun-$s;
    $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
    header("location:welcome.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
  }

  // Remove quiz and associated questions
  if (isset($_GET['q']) && $_GET['q'] == 'rmquiz') {
    $eid = $_GET['eid'];
    
    // Fetch all questions associated with the quiz
    $result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
    while($row = mysqli_fetch_array($result)) {
        $qid = $row['qid'];
        
        // Delete options for the question
        $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
        
        // Delete answer for the question
        $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
    }
    
    // Delete questions for the quiz
    $r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
    
    // Delete quiz itself
    $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
    
    // Delete quiz history
    $r5 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
    
    header("location:dashboard.php?q=5");
}

// Handling question update
if (isset($_GET['q']) && $_GET['q'] == 'updatequestion') {
    $qid = $_POST['qid'];
    $qns = $_POST['qns'];
    
    // Update the question text
    $update_question = mysqli_query($con,"UPDATE questions SET qns='$qns' WHERE qid='$qid' ") or die('Error');
    
    // Update options
    for ($i = 1; $i <= 4; $i++) {
        $option = $_POST['option_' . $i];
        $option_id = $i;
        $update_option = mysqli_query($con,"UPDATE options SET option='$option' WHERE qid='$qid' AND option_id='$option_id' ") or die('Error');
    }
    
    // Update correct answer
    $correct_answer = $_POST['correct_answer'];
    $update_answer = mysqli_query($con,"UPDATE answer SET ansid='$correct_answer' WHERE qid='$qid' ") or die('Error');
    
    header("location:dashboard.php?q=5");
}

// Fetch all questions to display in the dashboard
$fetch_questions = mysqli_query($con, "SELECT * FROM questions");
?>

<?php
if(isset($_GET['q']) && $_GET['q'] == 'editquestion') {
    $eid = $_GET['eid'];
    $qid = $_GET['qid'];

    // Fetch question details from database based on $qid

    // Populate form with current question details for editing
    echo '<form method="post" action="update.php?q=updatequestion&eid='.$eid.'&qid='.$qid.'">';
    echo '<input type="text" name="qns" value="'.$qns.'">'; // Example input for question text
    // Additional inputs for options and correct answer if needed

    echo '<button type="submit" name="update_question">Update Question</button>';
    echo '</form>';
}
?>

<?php
if (isset($_GET['q']) && $_GET['q'] == 'rmquestion') {
    $eid = $_GET['eid'];
    $qid = $_GET['qid'];

    // Execute DELETE query to remove question from the questions table
    $delete_query = "DELETE FROM questions WHERE qid='$qid' AND eid='$eid'";
    mysqli_query($con, $delete_query) or die('Error deleting question');

    // Adjust the serial numbers (sn) for the remaining questions under the same eid
    $update_sn_query = "
        SET @rank := 0;
        UPDATE questions
        SET sn = (@rank := @rank + 1)
        WHERE eid='$eid'
        ORDER BY sn ASC;
    ";
    mysqli_multi_query($con, $update_sn_query) or die('Error updating serial numbers');

    // Redirect back to dashboard or display success message
    header("Location: dashboard.php?q=6&step=2&eid=$eid"); // Redirect to quiz management page
    exit();
}
?>

<?php
if (@$_GET['q'] == 'addquestionaction') {
    $eid = @$_GET['eid'];
    $qns = $_POST['qns'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $ans = $_POST['ans'];

    // Get the current highest serial number for the given eid
    $result = mysqli_query($con, "SELECT MAX(sn) AS max_sn FROM questions WHERE eid='$eid'");
    if (!$result) {
        die('Error fetching max serial number: ' . mysqli_error($con));
    }
    $row = mysqli_fetch_array($result);
    $sn = $row['max_sn'] + 1;

    // Add the question to the questions table
    $qid = uniqid();
    $ch = 4; // Assuming the number of choices is 4
    $query = "INSERT INTO questions (eid, qid, qns, choice, sn) VALUES ('$eid', '$qid', '$qns', '$ch', '$sn')";
    if (!mysqli_query($con, $query)) {
        die('Error adding question: ' . mysqli_error($con));
    } else {
        echo "<script><alert>Question added successfully.</script><br>";
    }

    // Add the options to the options table
    $oaid = uniqid();
    $obid = uniqid();
    $ocid = uniqid();
    $odid = uniqid();
    $query = "INSERT INTO options (qid, `option`, optionid) VALUES ('$qid', '$opt1', '$oaid'), ('$qid', '$opt2', '$obid'), ('$qid', '$opt3', '$ocid'), ('$qid', '$opt4', '$odid')";
    
    if (!mysqli_query($con, $query)) {
        die('Error adding options: ' . mysqli_error($con));
    } else {
        echo "<script><alert>Options added successfully.</script><br>";
    }

    // Determine the correct answer id based on the selected answer
    switch ($ans) {
        case $opt1: $ansid = $oaid; break;
        case $opt2: $ansid = $obid; break;
        case $opt3: $ansid = $ocid; break;
        case $opt4: $ansid = $odid; break;
        default: die('Invalid answer selected: ' . $ans);
    }

    // Add the answer to the answer table
    $query = "INSERT INTO answer (qid, ansid) VALUES ('$qid', '$ansid')";
    if (!mysqli_query($con, $query)) {
        die('Error adding answer: ' . mysqli_error($con));
    } else {
        echo "<script><alert>Answer added successfully.</script><br>";
    }

    // Redirect back to the add question page
    header("location:dashboard.php?q=6&step=2&eid=$eid");
}
?>

<?php
// if (@$_GET['q'] == 'editquestionaction') {
//     // Ensure necessary data is received
//     // if (!isset($_POST['qid'], $_POST['qns'], $_POST['opt1'], $_POST['opt2'], $_POST['opt3'], $_POST['opt4'], $_POST['ans'])) {
//     //     die('Incomplete form submission');
//     // }

//     // Print all POST data for debugging
//     echo '<pre>';
//     print_r($_POST);
//     echo '</pre>';
    
//     // Retrieve data from $_POST
//     $eid = @$_GET['eid'];
//     $qid = $_POST['qid'];
//     $qns = $_POST['qns'];
//     $opt1 = $_POST['opt1'];
//     $opt2 = $_POST['opt2'];
//     $opt3 = $_POST['opt3'];
//     $opt4 = $_POST['opt4'];
//     $ans = $_POST['ans'];

//     // Update question text in questions table
//     $query = "UPDATE questions SET qns='$qns' WHERE qid='$qid'";
//     if (!mysqli_query($con, $query)) {
//         die('Error updating question: ' . mysqli_error($con));
//     }

//     // Update options in options table
//     $update_option_queries = [
//         "UPDATE options SET `option`='$opt1' WHERE qid='$qid' AND optionid='1'",
//         "UPDATE options SET `option`='$opt2' WHERE qid='$qid' AND optionid='2'",
//         "UPDATE options SET `option`='$opt3' WHERE qid='$qid' AND optionid='3'",
//         "UPDATE options SET `option`='$opt4' WHERE qid='$qid' AND optionid='4'"
//     ];

//     foreach ($update_option_queries as $query) {
//         if (!mysqli_query($con, $query)) {
//             die('Error updating options: ' . mysqli_error($con));
//         }
//     }

//     // Update answer in answer table
//     $ansid = '';
//     if ($ans === $opt1) {
//         $ansid = '1';
//     } elseif ($ans === $opt2) {
//         $ansid = '2';
//     } elseif ($ans === $opt3) {
//         $ansid = '3';
//     } elseif ($ans === $opt4) {
//         $ansid = '4';
//     } else {
//         die('Invalid answer selected: ' . $ans);
//     }

//     $query = "UPDATE answer SET ansid='$ansid' WHERE qid='$qid'";
//     if (!mysqli_query($con, $query)) {
//         die('Error updating answer: ' . mysqli_error($con));
//     }

//     // Redirect back to dashboard or appropriate page
//     header("location:dashboard.php?q=6&step=2&eid=$eid");
//     exit();
// }
?>
