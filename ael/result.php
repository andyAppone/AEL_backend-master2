<?php include_once("include/config.php"); ?>

<?php

session_start();
if($_SESSION["student_id"]=="")
{

	header("Location:index.php");
	exit();

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<title>Result::</title>
<script src="js/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>

<table width="80%" align="center" border="1">



<tr valign="top" bgcolor="#FFFFCC"> 

    <td colspan="6"><div align="center"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 

     <?php $query = mysql_query("select setting_value from setting where setting_id=1");

							        	  $data = mysql_fetch_array($query);

										   $site_logo = $data['setting_value'];

										   

							    	 

									?>

        <img src="image/<?php echo $site_logo; ?>" alt="Logo" name="Logoschool"  height="70" id="Logoschool"><font color="#FFFFFF"></font></font>

        <?php $stud_info_q=mysql_query("select student_image from student where student_id=". $_SESSION["student_id"]);

					if(mysql_num_rows($stud_info_q)>0)	

					{

						$stud_info_data=mysql_fetch_array($stud_info_q); 

						if($stud_info_data['student_image']!=""){$stud_img=$stud_info_data['student_image'];}else{$stud_img="no_image.jpg";} 

						?>

       					<img src="student_image/<?php echo $stud_img; ?>" alt="Logo" name="Logoschool" id="Logoschool" style="float:right;" width="70" height="89">

        			<?php } ?>

        

        </div>

      <div align="center"> 

        <p><strong><font size="4"><?php $query = mysql_query("select setting_value from setting where setting_id=2");

							        	  $data = mysql_fetch_array($query);

										   $school_name = $data['setting_value'];

										   

							    	 echo $school_name;

									?></font></strong><br>

          <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php $query = mysql_query("select setting_value from setting where setting_id=3");

							        	  $data = mysql_fetch_array($query);

										   $address = $data['setting_value'];

										   

							    	 echo $address;

									?></font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
School Affiliated 

          to:: CBSE Board New Delhi
          </font> <br>

          <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Telephone : 01336-221700 </font><br>

          <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Session 

          -2016-17 </font> </div></td>

  </tr>

  

  



  

  <?php
				$name="";
				$roll_no="";
				$std="";
				$gr_no="";
				$stud_info_q=mysql_query("select student_first_name,class_id,student_middle_name,student_last_name,student_father_name,student_mother_name,student_birth_date,student_address,student_rollno,student_id,student_enrollno from student where student_id=". $_SESSION["student_id"]);
					if(mysql_num_rows($stud_info_q)>0)	
					{
						$stud_info_data=mysql_fetch_array($stud_info_q);
						$class_id=$stud_info_data["class_id"];
						$name=$stud_info_data["student_first_name"]." ".$stud_info_data["student_middle_name"]." ".$stud_info_data["student_last_name"];
						$father_name=$stud_info_data['student_father_name'];
						$mother_name=$stud_info_data['student_mother_name'];
						$dob=$stud_info_data['student_birth_date']; 
						$student_address=$stud_info_data['student_address'];	
						$roll_no=$stud_info_data["student_rollno"];
						$class_q=mysql_query("select class_name from class where class_id=".$stud_info_data["class_id"]);
						if(mysql_num_rows($class_q)>0)
						{
							$class_data=mysql_fetch_array($class_q);	
							$std=$class_data['class_name'];
						}
						$gr_no=$stud_info_data["student_enrollno"];
						$class_sq=mysql_query("select class_section_name from class_section where class_section_id=".$stud_info_data["class_section_id"]);
						if(mysql_num_rows($class_sq)>0)
						{
							$class_sdata=mysql_fetch_array($class_sq);	

							$section=$class_sdata['class_section_name'];
						}
					}
		?>			

  

  <tr bgcolor="#BFDFFF"> 
<td>

<table width="100%" border="1">
  <tr bgcolor="#006699"> 

    <td width="16%"><div align="center"><font color="#FFFFFF"><strong>Student 

        Name</strong></font></div></td>

    <td width="20%"><div align="center"><font color="#FFFFFF"><strong>Father Name</strong></font></div></td>

    <td width="22%"><div align="center"><font color="#FFFFFF"><strong>Mother Name</strong></font></div></td>

    <td width="19%"><div align="center"><font color="#FFFFFF"><strong>DOB</strong></font></div></td>

    <td width="11%"><div align="center"><font color="#FFFFFF"><strong>Address</strong></font></div></td>

    <td width="12%"><div align="center"><font color="#FFFFFF"><strong>Class</strong></font></div></td>

  </tr>


<tr>
    <td height="52"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $name; ?></font></strong></div></td>

    <td height="52"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $father_name; ?></font></strong></div></td>

    <td height="52"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $mother_name; ?></font></strong></div></td>

    <td height="52"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $dob; ?> </font></strong></div></td>

    <td height="52"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $student_address; ?></font></strong></div></td>

    <td height="52"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $std; if($section!="") { echo "(".$section.")"; } ?></font></strong></div></td>

</tr>
</table>

</td>
  </tr>

  <tr valign="top" bgcolor="#E7F7F8"> 

    <td align="center"><strong>Academic Evaluation (Scholastic Area Evaluation)</strong></td>

  </tr>



<tr>
 <?php 
 $pass_score="0";

 $fail_flag= "true";
 $subject_flag ="0";
 //echo "select *from terms where term_id in(select term_id from exam where exam_id in(select distinct(exam_id) from student_result where student_id=". $_SESSION["student_id"].")) order by term_id asc";

//Final Result Column Calulation=====================

 $FCol_ExamT1_q=mysql_query("select count(*) from exam where exam_id in(select distinct(exam_id) from student_result where  student_id=". $_SESSION["student_id"].") and term_id=1 order by exam_name asc");
 $FCol_ExamT1_C = mysql_num_rows($FCol_ExamT1_q);
 
  $FCol_ExamT2_q=mysql_query("select count(*) from exam where exam_id in(select distinct(exam_id) from student_result where  student_id=". $_SESSION["student_id"].") and term_id=2 order by exam_name asc");
 $FCol_ExamT2_C = mysql_num_rows($FCol_ExamT2_q);

//Final Result Column Calulation End=====================
 
 
 //Term Calculation================================================
 $vTerm_q = "0";
 $vExam_q = "0";
 $term_q=mysql_query("select caption,term_id from terms where term_id in(select term_id from exam where exam_id in(select distinct(exam_id) from student_result where student_id=". $_SESSION["student_id"].")) order by term_id asc");
 if(mysql_num_rows($term_q)>0)
 {
	 $vTerm_q = mysql_num_rows($term_q);
	 while($term_data=mysql_fetch_array($term_q))
	 {
		  $pass_score_total="0";
		 ?>
		 <td width="100%">
         	<?php 
			 //Exam Calculation================================================
			 $exam_final ="";
			 $vTExam_q ="0";
			// echo "select * from exam where exam_id in(select distinct(exam_id) from student_result where  student_id=". $_SESSION["student_id"].") and term_id=".$term_data["term_id"];
			 
			 $exam_q=mysql_query("select exam_name,exam_sname,max_marks,exam_id from exam where exam_id in(select distinct(exam_id) from student_result where  student_id=". $_SESSION["student_id"].") and term_id=".$term_data["term_id"]." order by exam_name asc");
			 if(mysql_num_rows($exam_q)>0)
			 {
				 $vExam_q =	mysql_num_rows($exam_q);
				 if($vExam_q=="3")
				  $vTExam_q = $vExam_q + 1;
				  else
				  $vTExam_q = $vExam_q;
				 ?>
                  <table width="100%" border="1">
                  <tr>
                 <td style="text-align:center;background-color:#006699;font-size:20px;font-weight:bold;color:#FFFFFF" height="50px" colspan="<?php echo $vTExam_q; ?>">
                 <?php echo $term_data["caption"]; ?>
                 </td>
                 </tr>
                  <tr>
                 <?php
				
				 while($exam_data=mysql_fetch_array($exam_q))
	 			 {
					 ?>
                     <td style="text-align:center;background-color:#FFFF99">
                     <?php 
					$pass_score = $exam_data["passing_marks"];
					
					 $pass_score_total = ($exam_data["passing_marks"] + $pass_score_total);
					 
					 //echo $pass_score_total;
					
					//Subject print==========================
					if($subject_flag =="0") 
					{
						?>
						<table border="1">
                        <tr>
                        <td colspan="3">
                        <?php echo $exam_data["exam_name"]; $exam_final = $exam_final."+". $exam_data["exam_sname"];  ?>
                        </td>
                        </tr>
                        
						<tr>
                        <td width="100%">Subject</td>
                        <td width="100%">M.M.</td>
                        <td width="100%">M.O./Grade</td>
                        </tr>
						<?php
						$subject_flag ="1";
						$obtain_total="0";
						$subject_q=mysql_query("select subject_name,subject_id from subject where class_id in(select class_id from student where student_id=". $_SESSION["student_id"].") and is_marks=1 order by subject_name asc");
						$vMSubject_M = ($exam_data["max_marks"] / mysql_num_rows($subject_q));
						while($subject_data=mysql_fetch_array($subject_q))
						{
							?>
                            <tr>
                            <td><?php echo $subject_data['subject_name']; ?></td>
                            <td><?php echo $vMSubject_M; ?></td>
                            
                            <?php 
							
							$subject_o=mysql_query("select obtain_marks from student_result where exam_id=".$exam_data['exam_id']." and subject_id=".$subject_data['subject_id']." and student_id=". $_SESSION["student_id"]);
							$subject_marks = mysql_fetch_array($subject_o);
							?>
                            
                            <td <?php echo ($pass_score > ($subject_marks['obtain_marks']=="" ? "0" : $subject_marks['obtain_marks']) ? "style='color:red'" : "style='color:green'"); ?>>
                            
                            <?php
							
							
							$obtain_total = $obtain_total + $subject_marks["obtain_marks"];
							echo ($subject_marks['obtain_marks']=="" ? "0" : $subject_marks['obtain_marks']);
							
							
							?>
                            </td>
					<?php }
						?>
                        <tr>
                        <td>Total</td>
                        <td><?php echo $exam_data["max_marks"]; ?></td>
                        <td><?php echo $obtain_total; ?> </td>
                        </tr>
                        <tr>
                        <td colspan="3">
                        
                        <?php 
			
			
$rank_status = mysql_query("SELECT count(*) as vCount FROM `student_result` WHERE exam_id = ".$exam_data['exam_id']." and student_id=".$_SESSION["student_id"]. " and obtain_marks < (select passing_marks from exam where exam_id = ".$exam_data['exam_id'].") and subject_id in(select subject_id FROM `subject` WHERE class_id = (select class_id from student where student_id=".$_SESSION["student_id"]. ") and is_marks=1)");			

$RCount = mysql_fetch_array($rank_status);
//echo $RCount["vCount"];
					if($RCount["vCount"]>0)
					{
						//echo "Fail";
						$fail_flag="false";
						echo "Fail";
					}else
					{
						?>
                        
                        Rank In class -
                        <?php 
						
						$rank_q=mysql_query("SELECT rank FROM ( SELECT student_id, TMarks, @curRank := @curRank +1 AS rank FROM 

											   (SELECT student_id, sum( obtain_marks ) AS TMarks

											   FROM student_result

											   where exam_id=".$exam_data["exam_id"]." 
 and student_id in(select student_id from student where class_id=(select class_id from student where student_id=".$_SESSION["student_id"]."))

											   GROUP BY student_id)Marks, (SELECT @curRank :=0)q ORDER BY TMarks DESC) AS Final where student_id=".$_SESSION["student_id"]); 

								$rank_info=mysql_fetch_array($rank_q);

								echo $rank_info['rank'];
						}		
								
						?>
                        
                        </td>
                        </tr>
						</table>
						<?php
					}else
					{
						?>
						<table border="1">
                        <tr>
                        <td colspan="2">
							<?php echo $exam_data["exam_name"]; $exam_final = $exam_final."+". $exam_data["exam_sname"]; ?>
                        </td>
                        </tr>
                        
						<tr>
                        <td width="100%">M.M.</td>
                        <td width="100%">M.O./Grade</td>
                        </tr>
						<?php
						$subject_flag ="1";
						$obtain_total="0";
						$subject_q=mysql_query("select subject_id,subject_name from subject where class_id in(select class_id from student where student_id=". $_SESSION["student_id"].") and is_marks=1 order by subject_name asc");
						$vMSubject_M = ($exam_data["max_marks"] / mysql_num_rows($subject_q));
						while($subject_data=mysql_fetch_array($subject_q))
						{
							?>
                            <tr>
                            <td><?php echo $vMSubject_M; ?></td>
                            
                            <?php 
							$subject_o=mysql_query("select obtain_marks from student_result where exam_id=".$exam_data['exam_id']." and subject_id=".$subject_data['subject_id']." and student_id=". $_SESSION["student_id"]);
							
							$subject_marks = mysql_fetch_array($subject_o);
							
							?>
                            
                            <td <?php echo ($pass_score > ($subject_marks['obtain_marks']=="" ? "0" : $subject_marks['obtain_marks']) ? "style='color:red'" : "style='color:green'") ?>>
                            <?php 
							
							
							$obtain_total = $obtain_total + $subject_marks["obtain_marks"];
							echo ($subject_marks['obtain_marks']=="" ? "0" : $subject_marks['obtain_marks']);
							
							?>
                            </td>
					<?php }
						?>
                        <tr>
                        
                        <td><?php echo $exam_data["max_marks"]; ?></td>
                        <td><?php echo $obtain_total; ?> </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                        <?php 
                        //echo "SELECT count(*) FROM `student_result` WHERE exam_id = ".$exam_data['exam_id']." and student_id=".$_SESSION["student_id"]. " and obtain_marks < (select passing_marks from exam where exam_id = ".$exam_data['exam_id'].") and subject_id in(select subject_id FROM `subject` WHERE class_id = (select class_id from student where student_id=".$_SESSION["student_id"]. ") and is_marks=1)";
						
$rank_status = mysql_query("SELECT count(*) as vCount FROM `student_result` WHERE exam_id = ".$exam_data['exam_id']." and student_id=".$_SESSION["student_id"]. " and obtain_marks < (select passing_marks from exam where exam_id = ".$exam_data['exam_id'].") and subject_id in(select subject_id FROM `subject` WHERE class_id = (select class_id from student where student_id=".$_SESSION["student_id"]. ") and is_marks=1)");					

$RCount = mysql_fetch_array($rank_status);
//echo 'hello'. $RCount["vCount"];
					if($RCount["vCount"]>0)
					//if(mysql_num_rows($rank_status)>0)
					{
						$fail_flag="false";
						echo "Fail";
					}else	
					{
                        ?>
                        
                        Rank In class -
                        <?php 
						
						$rank_q=mysql_query("SELECT rank FROM ( SELECT student_id, TMarks, @curRank := @curRank +1 AS rank FROM 

											   (SELECT student_id, sum( obtain_marks ) AS TMarks

											   FROM student_result

											   where exam_id=".$exam_data["exam_id"]." 
 and student_id in(select student_id from student where class_id=(select class_id from student where student_id=".$_SESSION["student_id"]."))

											   GROUP BY student_id)Marks, (SELECT @curRank :=0)q ORDER BY TMarks DESC) AS Final where student_id=".$_SESSION["student_id"]); 

								$rank_info=mysql_fetch_array($rank_q);

								echo $rank_info['rank'];
								
					}
						?>
                        
                        </td>
                        </tr>
						</table>
						<?php
					}
					//Subject print End==========================
					 ?>
                     </td>
					 <?php
			     }
				 ?>

                  <?php 
				  //Term Summary Report==============================================
				  if($vExam_q=="3")
				  { ?>
					   <td style="text-align:center;background-color:#FFFF99">
                       <table border="1" width="100%">
                       <tr>
                       <td colspan="2">Summary &nbsp; <?php echo trim($exam_final,'+'); ?></td>
                       </tr>
                     <tr>
                     	<td>M.M.</td>
                        <td>M.O./Grade</td>
                       </tr>
                     <?php
						$obtain_total="0";
						
						$exam_t=mysql_query("select SUM(max_marks) as max_marks from exam where class_id in(select class_id from student where student_id=". $_SESSION["student_id"]." and term_id=".$term_data["term_id"].")");
						$exam_term_marks = mysql_fetch_array($exam_t);
						
						$subject_t=mysql_query("select subject_id,subject_name from subject where class_id in(select class_id from student where student_id=". $_SESSION["student_id"].") and is_marks=1 order by subject_name asc");
						$vMSubject_M = ($exam_term_marks["max_marks"] / mysql_num_rows($subject_t));
						while($subject_term_data=mysql_fetch_array($subject_t))
						{
							?>
                            <tr>
                            <td><?php echo $vMSubject_M; ?></td>
                            
                            <?php 
							
							$subject_term_o=mysql_query("SELECT SUM( obtain_marks ) as obtain_marks  FROM student_result WHERE exam_id IN (SELECT exam_id FROM exam WHERE  exam_id IN ( SELECT DISTINCT ( exam_id) FROM student_result WHERE student_id =". $_SESSION["student_id"]." AND term_id=".$term_data["term_id"].")) AND student_id =". $_SESSION["student_id"]." and subject_id=".$subject_term_data["subject_id"]);
							
							$subject_term_marks = mysql_fetch_array($subject_term_o);
							
							?>
                            <td>
                            <?php 
														
										
							
							$obtain_total = $obtain_total + $subject_term_marks["obtain_marks"];
							echo ($subject_term_marks['obtain_marks']=="" ? "0" : $subject_term_marks['obtain_marks']);
							?>
                            </td>
					<?php }
						?>
                     	<tr>
                       
                        <td><?php echo $exam_term_marks["max_marks"] ?></td>
                        <td><?php echo $obtain_total; ?> </td>
                        </tr>
                         <tr>
                        <td colspan="2">
                        
                        <?php 
						
						if($fail_flag=="true")
						{
						?>
                        
                        Rank In class -
                        <?php 
										
						$rank_q=mysql_query("SELECT rank FROM ( SELECT student_id, TMarks, @curRank := @curRank +1 AS rank FROM 

											   (SELECT student_id, sum( obtain_marks ) AS TMarks

											   FROM student_result

											   where exam_id in(select exam_id from exam where class_id in(select class_id from student where student_id=". $_SESSION["student_id"]."))
 and student_id in(select student_id from student where class_id=(select class_id from student where student_id=".$_SESSION["student_id"]."))

											   GROUP BY student_id)Marks, (SELECT @curRank :=0)q ORDER BY TMarks DESC) AS Final where student_id=".$_SESSION["student_id"]); 

								$rank_info=mysql_fetch_array($rank_q);

								echo $rank_info['rank'];
						}else
						{
							echo 'Fail';	
						}
						?>
                        
                        </td>
                        </tr>
                        
                     </table>
                     </td>
				 <?php }
				 
				 //Final Calculation=================================
				  if($FCol_ExamT1_C == FCol_ExamT2_C)
				  {
					   ?>
					   <td style="text-align:center;background-color:#FFFF99">
							
                            <table border="1">
                            <tr>
                            <td width="100%">Term 1+Term 2</td>
                        	<td width="100%"><span style="width:50%">M.M.</span><span style="width:50%">M.O./Grade</span></td>
                            </tr>
                            <?php
						$obtain_total="0";
						
						$exam_t=mysql_query("select SUM(max_marks) as max_marks from exam where class_id in(select class_id from student where student_id=". $_SESSION["student_id"].")");
						$exam_term_marks = mysql_fetch_array($exam_t);
						
						$subject_t=mysql_query("select rank,subject_name from subject where class_id in(select class_id from student where student_id=". $_SESSION["student_id"].") and is_marks=1 order by subject_name asc");
						$vMSubject_M = ($exam_term_marks["max_marks"] / mysql_num_rows($subject_t));
						while($subject_term_data=mysql_fetch_array($subject_t))
						{
							?>
                            <tr>
                            <td><?php echo $vMSubject_M; ?></td>
                            <td <?php echo ($pass_score > ($subject_term_marks['obtain_marks']=="" ? "0" : $subject_term_marks['obtain_marks']) ? "style='color:red'" : "style='color:green'") ?>>
                            <?php 
														
							$subject_term_o=mysql_query("SELECT SUM( obtain_marks ) as obtain_marks  FROM student_result WHERE exam_id IN (SELECT exam_id FROM exam WHERE  exam_id IN ( SELECT DISTINCT ( exam_id) FROM student_result WHERE student_id =". $_SESSION["student_id"].")) AND student_id =". $_SESSION["student_id"]." and subject_id=".$subject_term_data["subject_id"]);
							
							$subject_term_marks = mysql_fetch_array($subject_term_o);
							$obtain_total = $obtain_total + $subject_term_marks["obtain_marks"];
							echo ($subject_term_marks['obtain_marks']=="" ? "0" : $subject_term_marks['obtain_marks']);
							?>
                            </td>
					<?php }
						?>
                     	<tr>
                       
                        <td><?php echo $exam_term_marks["max_marks"] ?></td>
                        <td><?php echo $obtain_total; ?> </td>
                        </tr>
                         <tr>
                        <td colspan="2">
                        
                         <?php 
						
						if($fail_flag=="true")
						{
						?>
                        Rank In class -
                        <?php 
										
						$rank_q=mysql_query("SELECT rank FROM ( SELECT student_id, TMarks, @curRank := @curRank +1 AS rank FROM 

											   (SELECT student_id, sum( obtain_marks ) AS TMarks

											   FROM student_result

											   where exam_id in(select exam_id from exam where class_id in(select class_id from student where student_id=". $_SESSION["student_id"]."))
 and student_id in(select student_id from student where class_id=(select class_id from student where student_id=".$_SESSION["student_id"]."))

											   GROUP BY student_id)Marks, (SELECT @curRank :=0)q ORDER BY TMarks DESC) AS Final where student_id=".$_SESSION["student_id"]); 

							 $rank_info=mysql_fetch_array($rank_q);
							 echo $rank_info['rank'];
						}
						else
						{
							echo "Fail";								
						}	
						?>
                        
                        </td>
                        </tr>
                            
                            
                            </table>
                     </td>
				 <?php
				  }
				 
				 
				  ?>
                 </tr>
				 </table>
				 <?php
			 }
			 //Exam Calculation End================================================
			 ?>
            <!--Term Calculation End================================================-->
         </td>
         </tr>
		 <?php
	 }
 }
?> 

<!-- Marks Calculation end===========================================================================-->

<!-- Skill Calculation start===========================================================================-->
<tr bgcolor="#C1ADF5">
<td>
<strong>Co Scholastic Evaluation (5 Point Grading scale 

            A+,A B, C, D, )</strong>
</td>
</tr>
<tr>
<td>
<table width="100%">
<tr>
<?php

$vTExam_q ="1";
$exam_q=mysql_query("select * from exam where exam_id in(select distinct(exam_id) from student_result where  student_id=". $_SESSION["student_id"].")  order by term_id,exam_name asc");
 if(mysql_num_rows($exam_q)>0)
 {
	 while($exam_data=mysql_fetch_array($exam_q))
	 {
		 if($vTExam_q=="3")
		 {
			$vTExam_q ="1";	
			?>
            <td style="font-size:16px;background-color:#ff9;">
				 <?php 
				 
				$result_q=mysql_query("SELECT exam_id,exam_name FROM skill WHERE skill_id IN (SELECT skill_id FROM subject WHERE subject_id IN (SELECT subject_id FROM student_result WHERE exam_id =".$exam_data["exam_id"]." AND student_id =". $_SESSION["student_id"].")
AND is_marks =0)");
				if(mysql_num_rows($result_q)>0)
 				{
					?>
                    <table width="100%">
                    <tr>
                    <td>
                    	<?php echo $exam_data["exam_name"]; ?>
                    </td>
                    </tr>
                    
                    <?php
					while($result_data=mysql_fetch_array($result_q))
	 				{
						?>	 </tr>
							<td colspan="2" style="background-color:#E1C4F4;"><strong><?php echo $result_data["name"]; ?></strong></td>	
                            </tr>
						<?php
												
						$result_skill=mysql_query("select obtain_marks,(select subject_name from subject where subject_id=student_result.subject_id) as subject_name from student_result where exam_id=".$exam_data["exam_id"]." and student_id=". $_SESSION["student_id"]." and subject_id in(select subject_id from subject where is_marks=0 and skill_id=".$result_data["skill_id"].")");
						if(mysql_num_rows($result_skill)>0)
						{
							while($vSkill=mysql_fetch_array($result_skill))
							{
								?>	 
                               <tr bgcolor="#DEDAF8"> 
                               <td width="50%"><font size="2"><?php echo $vSkill["subject_name"] ?></font> </td>
                               <td width="50%"><font size="2"><?php echo ($vSkill["obtain_marks"]=="" ? "-" : $vSkill["obtain_marks"])  ?></font></td>
                               </tr>                                
                               <?php

							}
						}
					}
					?>
                    </tr>
                    </table>
                    <?php
				}
			  ?>
        	 </td>
             
             <?php
			 if(mysql_num_rows($exam_q) > 3)
			 {
				 ?>
				 </tr>
				<tr>
				<?php
			 }
		 }
		 else 
		 {
			?>
           <td style="font-size:16px;background-color:#ff9;">
				 <?php 
				 
				$result_q=mysql_query("SELECT name,skill_id FROM skill WHERE skill_id IN (SELECT skill_id FROM subject WHERE subject_id IN (SELECT subject_id FROM student_result WHERE exam_id =".$exam_data["exam_id"]." AND student_id =". $_SESSION["student_id"].")
AND is_marks =0)");
				if(mysql_num_rows($result_q)>0)
 				{
					?>
                    <table width="100%">
                    <tr>
                    <td>
                    	<?php echo $exam_data["exam_name"]; ?>
                    </td>
                    </tr>
                    
                    <?php
					while($result_data=mysql_fetch_array($result_q))
	 				{
						?>	 </tr>
							<td colspan="2" style="background-color:#E1C4F4;"><strong><?php echo $result_data["name"]; ?></strong></td>	
                            </tr>
						<?php							
						$result_skill=mysql_query("select obtain_marks,(select subject_name from subject where subject_id=student_result.subject_id) as subject_name from student_result where exam_id=".$exam_data["exam_id"]." and student_id=". $_SESSION["student_id"]." and subject_id in(select subject_id from subject where is_marks=0 and skill_id=".$result_data["skill_id"].")");
						if(mysql_num_rows($result_skill)>0)
						{
							while($vSkill=mysql_fetch_array($result_skill))
							{
								?>	 
                           <tr bgcolor="#DEDAF8"> 
                           <td width="50%"><font size="2"><?php echo $vSkill["subject_name"] ?></font> </td>
                           <td width="50%"><font size="2"><?php echo ($vSkill["obtain_marks"]=="" ? "-" : $vSkill["obtain_marks"])  ?></font></td>
                           </tr>   
                                    <?php
							}
						}
					}
					?>
                    </tr>
                    </table>
                    <?php
				}
			  ?>
        	 </td>
			<?php
		 }
		 $vTExam_q = $vTExam_q + 1;
	 }
 }
?> 
</tr>
</table>

</td>
</tr>

<tr>
<td>
<table width="100%">
              <tbody><tr bgcolor="#CCCCFF">
                <td valign="top" ><p>9 Points grading 
                  Scale (Scholastic Area)<br>
                  <font size="2">91-100 A1 -10.0<br>
                    81-90 -- A2 --9.0<br>
                    71-80 -- B1 --8.0<br>
                    61-70 -- B2 --7.0<br>
                    51-60 -- C1 --6.0<br>
                    41-50 -- C2 --5.0<br>
                    33-40 -- D --- 4.0<br>
                    21-32 -- E1 --<br>
                    20 and below----E2.</font>
                  </p>
                  <p></p></td>
                  <td valign="top">
                        <p> Grade Range (%) 
                    (Co Scholastic Area)
                    <font size="2"><br>
                    A+ 90-100<br>
                    A 75-89<br>
                    B 56-74<br>
                    C 35-55<br>
                    D Below 35</font>
</p>
                  </td>

                  
              </tr>
             
                  
                  <?php 
				  
				  
                  if($FCol_ExamT1_C == FCol_ExamT2_C)
				  {
					   ?>
                       <tr bgcolor="#E1C4F4">
                <td valign="top" bgcolor="#CCCCFF" height="95" colspan="2">
                      <?php
					  if($fail_flag=="true")
					  {
					 
					  $exam_t=mysql_query("select SUM(max_marks) as max_marks from exam where class_id in(select class_id from student where student_id=". $_SESSION["student_id"].")");
						$exam_term_marks = mysql_fetch_array($exam_t);
					  
					  $subject_term_o=mysql_query("SELECT SUM( obtain_marks ) as obtain_marks  FROM student_result WHERE exam_id IN (SELECT exam_id FROM exam WHERE  exam_id IN ( SELECT DISTINCT ( exam_id) FROM student_result WHERE student_id =". $_SESSION["student_id"].")) AND student_id =". $_SESSION["student_id"]." and subject_id in(select subject_id from subject where class_id=(select class_id from student where student_id=". $_SESSION["student_id"]." and is_marks=1))");
					  
					  $subject_term_marks = mysql_fetch_array($subject_term_o);
					  
					  ?>
                      	Result  :: Congratulations promoted to next class <br>
                      
                  		Agrergate %=<?php echo  round((($subject_term_marks['obtain_marks']/$exam_term_marks["max_marks"]) * 100), 2) ?>
                        </br>
                        Final rank in the class=
                      <?php
					  				
						$rank_q=mysql_query("SELECT rank FROM ( SELECT student_id, TMarks, @curRank := @curRank +1 AS rank FROM 
											   (SELECT student_id, sum( obtain_marks ) AS TMarks
											   FROM student_result where exam_id in(select exam_id from exam where class_id in(select class_id from student where student_id=". $_SESSION["student_id"].")) and student_id in(select student_id from student where class_id=(select class_id from student where student_id=".$_SESSION["student_id"].")) GROUP BY student_id)Marks, (SELECT @curRank :=0)q ORDER BY TMarks DESC) AS Final where student_id=".$_SESSION["student_id"]); 

								$rank_info=mysql_fetch_array($rank_q);
			
								echo $rank_info['rank'];
								
								
					  }else
					  {
							echo "Fail";  
					  }
					  ?></td></tr>
                                <?php
				  }
				  ?>
				  
                  
                 <!--</br> Rank in overall school=-->
              
            </tbody></table>
</td>
</tr>

<tr>
<td height="150px">
<p>Class Teacher Signature ...........................................................Examination 
              Incharge Signature.................................................Principal 
              Stamp &amp; Signature</p>
</td>
</tr>
<tr>
<td align="center"><button id="printpagebutton" onClick="myFunction()">Print this page</button></td>
</tr>
</table>

<script>



function myFunction() {

var printButton = document.getElementById("printpagebutton");

    printButton.style.visibility = 'hidden';

    window.print();

printButton.style.visibility = 'visible';



}



</script>


</body>
</html>

