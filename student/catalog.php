<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
  $dbconn = Database::getDatabase();

  $concentration_ids = $dbconn->query("SELECT id, name FROM concentrations");
        
  // COURSE_SINGLES
  // query to get course-singles
  $catalog_course_singles = $dbconn->query("SELECT concentration_data.concentration_id, courses.id FROM `courses`, `concentration_data`, `course_single` WHERE courses.id=concentration_data.course_id AND course_single.course_single_id = courses.id");

  $course_singles = array(); // [concentration_id=>(course_id, course_id)]
  foreach($catalog_course_singles as $catalog_course_single) {
    if(!array_key_exists($catalog_course_single["concentration_id"], $course_singles)) {
      $course_singles[$catalog_course_single["concentration_id"]] = array();
    }
    $course_singles[$catalog_course_single["concentration_id"]][] = $catalog_course_single["id"];
  }


  // COURSE_GROUPS
  // query to get course_groups
  $catalog_course_groups = $dbconn->query("SELECT concentration_data.concentration_id, courses.id FROM `courses`, `concentration_data`, `course_groups` WHERE courses.id=concentration_data.course_id AND course_groups.course_group_id = courses.id");

  $course_groups = array(); // [concentration_id=>(course_group_id, course_group_id)]
  foreach($catalog_course_groups as $catalog_course_group) {
    if(!array_key_exists($catalog_course_group["concentration_id"], $course_groups)) {
      $course_groups[$catalog_course_group["concentration_id"]] = array();
    }
    $course_groups[$catalog_course_group["concentration_id"]][] = $catalog_course_group["id"];
  }


  // CATALOG_COURSE_GROUP_SINGLES
  // query to get course-singles that are inside course_groups
  $catalog_course_group_singles = $dbconn->query("SELECT courses.id, courses.name, course_group_catalog_data.course_group_id FROM `course_group_catalog_data`, `courses`, `course_single` WHERE courses.id=course_group_catalog_data.course_id AND course_group_catalog_data.course_id=course_single.course_single_id");

  $course_group_singles = array(); // [course_group_id =>(course_id, course_id)]
  foreach($catalog_course_group_singles as $course_group_single) {
    if(!array_key_exists($course_group_single["course_group_id"], $course_group_singles)) {
      $course_group_singles[$course_group_single["course_group_id"]] = array();
    }
    $course_group_singles[$course_group_single["course_group_id"]][] = $course_group_single["name"];
  }
?>
<!-- Integrate with HTML -->
<?php
  // foreach($concentration_ids as $con_query) {
  //   //print name of concentration here
  //   echo $con_query["name"] . "<br>";

  //   if (array_key_exists($con_query["id"], $course_singles)) {
  //     foreach($course_singles[$con_query["id"]] as $course) {
  //       //print each course
  //       $course_single_name = $dbconn->query("SELECT courses.name FROM `courses` WHERE courses.id=$course");

  //       foreach ($course_single_name as $name) {
  //         echo "---" . $name["name"] . "<br>";
  //       }
  //     }
  //   }
    
  //   if (array_key_exists($con_query["id"], $course_groups)) {
  //     foreach($course_groups[$con_query["id"]] as $group) {

  //       //print each course
  //       $course_group_name = $dbconn->query("SELECT courses.name FROM `courses` WHERE courses.id=$group");
  //       foreach ($course_group_name as $name) {
  //         echo "---" . $name["name"] . "<br>";
  //       }
  //       // check if its a course_group
  //       if (array_key_exists($group, $course_group_singles)) {
  //         //iterate through $course_group_singles[$group] (same as $course_group_singles[$group_id])
  //         $this_arr = $course_group_singles[$group];
  //         for ($i=0; $i<sizeof($this_arr); $i++) {
  //           echo "--------" . $this_arr[$i] . "<br>";
  //         }
  //       }
  //       // print out courses in the group
  //     }
  //   }
  //   echo "<br>";
  // }
?>

<html lang="en">
  <head>
    <title>Student Catalog</title>
    <!-- CSS ONLY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>
  <body>
    <!--NAVIGATION BAR (implemented with Bootstrap) -->
    <?php include('student_navbar.php'); ?>

    <section class="content">
      <!-- Catalog -->
      <h1>Catalog</h1>
      
      
      <?php foreach($concentration_ids as $con_query) { ?>
      
      <div class="container">
        <h2><?php echo $con_query["name"]?></h2>

        <?php     
        if (array_key_exists($con_query["id"], $course_singles)) {
          
            foreach($course_singles[$con_query["id"]] as $course) {
            //print each course
            $course_single_name = $dbconn->query("SELECT courses.name FROM `courses` WHERE courses.id=$course");
            $course_single_prefix = $dbconn->query("SELECT course_single_catalog.prefix FROM `course_single_catalog` WHERE course_single_catalog.course_single_id=$course");
            
            foreach ($course_single_prefix as $row) {
              $prefix = $row["prefix"];
            }
            
            $course_single_number = $dbconn->query("SELECT course_single_catalog.number FROM `course_single_catalog` WHERE course_single_catalog.course_single_id=$course");
                   
            foreach ($course_single_number as $row) {
              $number = $row["number"];
            }

            foreach ($course_single_name as $name) { ?>
              <div class="card">
                <div class="card-header border-0" style="padding-left:33px;">
                  <?php echo $prefix . "-" . $number . " " . $name["name"] ?>
                  
                </div>
              </div>
        <?php }
          }
        }

       if (array_key_exists($con_query["id"], $course_groups)) {
          foreach($course_groups[$con_query["id"]] as $group) {
    
            //print each course
            $course_group_name = $dbconn->query("SELECT courses.name FROM `courses` WHERE courses.id=$group");
            
            foreach ($course_group_name as $name) { ?>
              
           <?php

            // check if its a course_group
            if (array_key_exists($group, $course_group_singles)) {


              //iterate through $course_group_singles[$group] (same as $course_group_singles[$group_id])
              $this_arr = $course_group_singles[$group]; 
              ?>

              <div class="accordion" id="accordion-<?php echo $group?>">
              <div class="card" >
                <div class="card-header" id="heading-<?php echo $group?>">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $group?>" aria-expanded="false" aria-controls="collapse-<?php echo $group?>">
                      <?php echo  $name["name"]?>
                    </button>
                  </h2>
                </div>
    
                <div id="collapse-<?php echo $group?>" class="collapse" aria-labelledby="heading-<?php echo $group?>" data-parent="#accordion-<?php echo $group?>">
                  <div class="card-body">
                  <?php
                    for ($i=0; $i<sizeof($this_arr); $i++) {
                      // $my_course_id = $this_arr[$i];
                      // $course_single_name = $dbconn->query("SELECT courses.name FROM `courses` WHERE courses.id=$my_course_id");
                      // $course_single_prefix = $dbconn->query("SELECT course_single_catalog.prefix FROM `course_single_catalog` WHERE course_single_catalog.course_single_id=$my_course_id");
                      
                      // foreach ($course_single_prefix as $row) {
                      //   $prefix = $row["prefix"];
                      // }
                      
                      // $course_single_number = $dbconn->query("SELECT course_single_catalog.number FROM `course_single_catalog` WHERE course_single_catalog.course_single_id=$my_course_id");
                             
                      // foreach ($course_single_number as $row) {
                      //   $number = $row["number"];
                      // }
                      
                    ?>
                    <div class="card">
                      <div class="card-header border-0" style="padding-left:33px;">

                        
                        <?php echo $prefix . "-" . $number . " " .$this_arr[$i] ?>
                      </div>
                    </div>   
                    
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            
          <?php }
              }
            }
          }         
        ?>

      </div>
      <?php } ?>
      
      
      
    </section>
  </body>
</html>