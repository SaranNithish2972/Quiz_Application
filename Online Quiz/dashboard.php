<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:login.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'database.php';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Online Quiz System</title>
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/welcome.css">
    <link  rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
</head>

<body>
    <nav class="navbar navbar-default title1">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Javascript:void(0)"><b>Online Quiz System</b></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dashboard.php?q=0">Home<span class="sr-only">(current)</span></a></li>
                    <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dashboard.php?q=1">Users</a></li>
                    <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dashboard.php?q=2">Ranking</a></li>
                    <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
                    <li><a href="dashboard.php?q=4">Add Quiz</a></li>
                    <li><a href="dashboard.php?q=5">Remove Quiz</a></li>
                    <li><a href="dashboard.php?q=6">Update Quiz</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo''; ?> > <a href="logout1.php?q=dashboard.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(@$_GET['q']==0)
                {
                   echo "<center><h1> WELCOME TO Admin Page!!</h1></center>";

                }

                if(@$_GET['q']== 2) 
                {
                    $q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
                    echo  '<div class="panel title"><div class="table-responsive">
                    <table class="table table-striped title1" >
                    <tr style="color:red"><td><center><b>Rank</b></center></td><td><center><b>Name</b></center></td><td><center><b>Score</b></center></td></tr>';
                    $c=0;
                    while($row=mysqli_fetch_array($q) )
                    {
                        $e=$row['email'];
                        $s=$row['score'];
                        $q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
                        while($row=mysqli_fetch_array($q12) )
                        {
                            $name=$row['name'];
                            $college=$row['college'];
                        }
                        $c++;
                        echo '<tr><td style="color:#99cc32"><center><b>'.$c.'</b></center></td><td><center>'.$e.'</center></td><td><center>'.$s.'</center></td>';
                    }
                    echo '</table></div></div>';
                }
                ?>
                <?php 
                    if(@$_GET['q']==1) 
                    {
                        $result = mysqli_query($con,"SELECT * FROM user") or die('Error');
                        echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr><td><center><b>S.N.</b></center></td><td><center><b>Name</b></center></td><td><center><b>College</b></center></td><td><center><b>Email</b></center></td><td><center><b>Action</b></center></td></tr>';
                        $c=1;
                        while($row = mysqli_fetch_array($result)) 
                        {
                            $name = $row['name'];
                            $email = $row['email'];
                            $college = $row['college'];
                            echo '<tr><td><center>'.$c++.'</center></td><td><center>'.$name.'</center></td><td><center>'.$college.'</center></td><td><center>'.$email.'</center></td><td><center><a title="Delete User" href="update.php?demail='.$email.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></center></td></tr>';
                        }
                        $c=0;
                        echo '</table></div></div>';
                    }
                ?>
                <?php
                    if(@$_GET['q']==4 && !(@$_GET['step']) ) 
                    {
                        echo '<div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Enter Quiz Details</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="Enter Quiz title" class="form-control input-md" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="total"></label>  
                                    <div class="col-md-12">
                                        <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="right"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="wrong"></label>  
                                    <div class="col-md-12">
                                        <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                    }
                ?>

                <?php
                    if(@$_GET['q']==4 && (@$_GET['step'])==2 ) 
                    {
                        echo ' 
                        <div class="row">
                        <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
                        <fieldset>
                        ';
                
                        for($i=1;$i<=@$_GET['n'];$i++)
                        {
                            echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
                                        <div class="col-md-12">
                                            <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'1"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'2"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'3"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'4"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
                                        </div>
                                    </div>
                                    <br />
                                    <b>Correct answer</b>:<br />
                                    <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
                                    <option value="a">Select answer for question '.$i.'</option>
                                    <option value="a"> option a</option>
                                    <option value="b"> option b</option>
                                    <option value="c"> option c</option>
                                    <option value="d"> option d</option> </select><br /><br />'; 
                        }
                        echo '<div class="form-group">
                                <label class="col-md-12 control-label" for=""></label>
                                <div class="col-md-12"> 
                                    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                </div>
                              </div>

                        </fieldset>
                        </form></div>';
                    }
                ?>

                <?php 
                    if(@$_GET['q']==5) 
                    {
                        $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                        echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr><td><center><b>S.N.</b></center></td><td><center><b>Topic</b></center></td><td><center><b>Total question</b></center></td><td><center><b>Marks</b></center></td><td><center><b>Action</b></center></td></tr>';
                        $c=1;
                        while($row = mysqli_fetch_array($result)) {
                            $title = $row['title'];
                            $total = $row['total'];
                            $sahi = $row['sahi'];
                            $eid = $row['eid'];
                            echo '<tr><td><center>'.$c++.'</center></td><td><center>'.$title.'</center></td><td><center>'.$total.'</center></td><td><center>'.$sahi*$total.'</center></td>
                            <td><center><b><a href="update.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:red;color:black"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></center></td></tr>';
                        }
                        $c=0;
                        echo '</table></div></div>';
                    }
                ?>

                <?php
                if (@$_GET['q'] == 6) {
                    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                    echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr><td><center><b>S.N.</b></center></td><td><center><b>Topic</b></center></td><td><center><b>Total question</b></center></td><td><center><b>Marks</b></center></td><td><center><b>Action</b></center></td></tr>';
                    $c = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $title = $row['title'];
                        $total = $row['total'];
                        $sahi = $row['sahi'];
                        $eid = $row['eid'];

                        // Calculate total marks
                        $marks = $sahi * $total;
                        echo '<tr><td><center>' . $c++ . '</center></td><td><center>' . $title . '</center></td><td><center>' . $total . '</center></td><td><center>' . $marks . '</center></td>
                        <td><center><b><a href="dashboard.php?q=6&step=2&eid=' . $eid . '" class="btn btn-primary">Edit</a></b></center></td></tr>';
                        // <a href="dashboard.php?q=6&step=2&eid=' . $eid . '" class="btn btn-primary">Edit</a>
                    }
                    echo '</table></div></div>';
                }
                ?>

                <?php
                if (@$_GET['q'] == 6 && @$_GET['step'] == 2) {
                    $eid = @$_GET['eid'];
                    $questions_query = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid'") or die('Error');

                    echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr><td><center><b>Q.No.</b></center></td><td><center><b>Question</b></center></td><td><center><b>Options</b></center></td><td><center><b>Answer</b></center></td><td><center><b>Action</b></center></td></tr>';
                    $c = 1;

                    while ($row = mysqli_fetch_array($questions_query)) {
                        $qid = $row['qid'];
                        $qns = $row['qns'];

                        // Fetch options for this question from options table
                        $options_query = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid'") or die('Error fetching options');
                        $options = [];
                        while ($option_row = mysqli_fetch_array($options_query)) {
                            $options[$option_row['optionid']] = $option_row['option'];
                        }

                        // Fetch answer for this question from answer table
                        $answer_query = mysqli_query($con, "SELECT * FROM answer WHERE qid='$qid'") or die('Error fetching answer');
                        $answer_row = mysqli_fetch_array($answer_query);
                        $ansid = isset($answer_row['ansid']) ? $answer_row['ansid'] : '';

                        // Decode ansid to get the correct answer option
                        $correct_answer = isset($options[$ansid]) ? $options[$ansid] : '';

                        // Display question, options, answer, and action links
                        echo '<tr><td><center>' . $c++ . '</center></td><td><center>' . $qns . '</center></td><td><center>' . implode(", ", $options) . '</center></td><td><center>' . $correct_answer . '</center></td>
                            <td><center><a href="update.php?q=rmquestion&eid=' . $eid . '&qid=' . $qid . '" class="btn btn-danger">Delete</a></center></td></tr>';
                            // <a href="dashboard.php?q=6&step=2&eid=' . $eid . '&qid=' . $qid . '" class="btn btn-warning">Edit</a>&nbsp;
                    }

                    echo '</table></div><a href="javascript:void(0);" onclick="showAddQuestionForm()" class="btn btn-success">+ New question</a></div>';

                    // Display form to add a new question
                    echo '<div class="panel" id="addQuestionForm" style="display: none;"><h2>Add New Question</h2>
                            <form action="update.php?q=addquestionaction&eid=' . $eid . '" method="POST">
                            <div class="form-group"><label for="qns">Question</label><input type="text" name="qns" class="form-control" required></div>
                            <div class="form-group"><label for="opt1">Option A</label><input type="text" name="opt1" class="form-control" required></div>
                            <div class="form-group"><label for="opt2">Option B</label><input type="text" name="opt2" class="form-control" required></div>
                            <div class="form-group"><label for="opt3">Option C</label><input type="text" name="opt3" class="form-control"></div>
                            <div class="form-group"><label for="opt4">Option D</label><input type="text" name="opt4" class="form-control"></div>
                            <div class="form-group"><label for="ans">Correct Answer</label><input type="text" name="ans" class="form-control" required></div>
                            <button type="submit" class="btn btn-primary">Add Question</button>
                        </form></div>';

                    if (isset($_GET['qid'])) {
                        $edit_qid = $_GET['qid'];
                        $edit_question_query = mysqli_query($con, "SELECT * FROM questions WHERE qid='$edit_qid'");
                        $edit_question_data = mysqli_fetch_array($edit_question_query);

                        if ($edit_question_data) {
                            $edit_qns = $edit_question_data['qns'];
                            echo '<div class="panel" id="editQuestionForm"><h2>Edit Question</h2>
                                    <form action="update.php?q=editquestionaction&eid=' . $eid . '" method="POST">
                                    <input type="hidden" name="qid" value="' . $edit_qid . '">
                                    <div class="form-group"><label for="qns">Question</label><input type="text" name="qns" class="form-control" value="' . $edit_qns . '" required></div>';

                            // Fetch options for the edit question from options table
                            $edit_options_query = mysqli_query($con, "SELECT * FROM options WHERE qid='$edit_qid'");
                            while ($edit_option_row = mysqli_fetch_array($edit_options_query)) {
                                $option_id = $edit_option_row['optionid'];
                                $option_text = $edit_option_row['option'];
                                $option_label = strtoupper(chr(64 + intval($option_id))); // Ensure $option_id is treated as integer
                                echo '<div class="form-group"><label for="opt' . $option_id . '">Option ' . $option_label . '</label><input type="text" name="opt' . $option_id . '" class="form-control" value="' . $option_text . '" required></div>';
                            }

                            // Fetch correct answer for the edit question from answer table
                            $edit_answer_query = mysqli_query($con, "SELECT * FROM answer WHERE qid='$edit_qid'");
                            $edit_answer_row = mysqli_fetch_array($edit_answer_query);
                            $edit_ansid = isset($edit_answer_row['ansid']) ? $edit_answer_row['ansid'] : '';

                            // Display correct answer dropdown
                            echo '<div class="form-group"><label for="ans">Correct Answer</label>';
                            echo '<b>Correct answer</b>:<br />';
                            echo '<select id="ans" name="ans" placeholder="Choose correct answer" class="form-control input-md" required>';
                            echo '<option value="">Select answer for question</option>';
                            echo '<option value="1">Option a</option>';
                            echo '<option value="2">Option b</option>';
                            echo '<option value="3">Option c</option>';
                            echo '<option value="4">Option d</option>';
                            echo '</select><br /><br />';
                            echo '</div>';

                            echo '<button type="submit" class="btn btn-primary">Update Question</button>
                                </form></div>';
                        } else {
                            echo 'Question not found.';
                        }
                    }

                    echo '<script>
                                function showAddQuestionForm() {
                                    document.getElementById("addQuestionForm").style.display = "block";
                                }
                        </script>';
                }
                ?>

            </div>
        </div>
    </div>
</body>
</html>
