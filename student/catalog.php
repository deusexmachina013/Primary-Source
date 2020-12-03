<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . "/db.php";
  $dbconn = Database::getDatabase();

  $conc = $dbconn->query("SELECT * from `concentrations`");
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
      
      <div class="container">
        <h2>ITWS Core Requirements</h2>
          <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-1100 Introduction to Information Technology and Web Science
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-2110 Web Systems Development
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-4500 Web Science Systems Development
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0" style="padding-left:33px;">
            ITWS-4310 Managing IT Resources
          </div>
        </div>
        <div class="accordion" id="accordion-senior-elective">
          <div class="card" >
            <div class="card-header" id="heading-senior-elective">
              <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-senior-elective" aria-expanded="false" aria-controls="collapse-senior-elective">
                  ITWS Senior Elective
                </button>
              </h2>
            </div>

            <div id="collapse-senior-elective" class="collapse" aria-labelledby="heading-senior-elective" data-parent="#accordion-senior-elective">
              <div class="card-body">
                ITWS-4100 Information Technology and Web Science Capstone (Professional Track) <br>
                ITWS-4990 Senior Thesis (Research Track – Two Semesters) 
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container">
        <h2>ITWS Technical Tracks</h2>
          <div class="accordion" id="comp-engineer-track">
            <div class="card" >
              <div class="card-header" id="comp-engineer-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCETrack" aria-expanded="false" aria-controls="collapseCETrack">
                    Computer Engineer Track
                  </button>
                </h2>
              </div>

              <div id="collapseCETrack" class="collapse" aria-labelledby="comp-engineer-track-heading" data-parent="#comp-engineer-track">
                <div class="card-body">
                  <div class="card" >
                    <div class="card-header border-0" style="padding-left:33px;">
                      ECSE-2610 Computer Components and Operations
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      ENGR-2350 Embedded Control
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      ECSE-2660 Computer Architecture, Networking and Operating Systems
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="accordion" id="comp-science-track">
            <div class="card">
              <div class="card-header" id="comp-science-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCSTrack" aria-expanded="false" aria-controls="collapseCSTrack">
                    Computer Science Track
                  </button>
                </h2>
              </div>

              <div id="collapseCSTrack" class="collapse" aria-labelledby="comp-science-track-heading" data-parent="#comp-science-track">
                <div class="card-body">
                  <div class="card" >
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2200 Foundations of Computer Science
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2300 Introduction to Algorithms
                    </div>
                  </div>
                  <div class="card" >
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2500 Computer Organization
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="info-sys-track">
            <div class="card" >
              <div class="card-header" id="info-sys-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseISTrack" aria-expanded="false" aria-controls="collapseISTrack">
                    Information Systems Track
                  </button>
                </h2>
              </div>

              <div id="collapseISTrack" class="collapse" aria-labelledby="info-sys-track-heading" data-parent="#info-sys-track">
                <div class="card-body">
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2200 Foundations of Computer Science
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2500 Computer Organization
                    </div>
                  </div>
                  
                  <div class="accordion" id="accordion-infosys-track">
                    <div class="card">
                      <div class="card-header" id="heading-infosys-track">
                        <h2 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-infosys-track" aria-expanded="false" aria-controls="collapse-infosys-track">
                            Information Systems Options (Choose One)
                          </button>
                        </h2>
                      </div>

                      <div id="collapse-infosys-track" class="collapse" aria-labelledby="heading-infosys-track" data-parent="#accordion-infosys-track">
                        <div class="card-body">
                          MGMT-2100 Statistical Methods <br>
                          BIOL-4200 Biostatistics <br>
                          CSCI-2300 Introduction to Algorithms <br>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="accordion" id="web-science-track">
            <div class="card">
              <div class="card-header" id="web-science-track-heading">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseWSTrack" aria-expanded="false" aria-controls="collapseWSTrack">
                    Web Science Track
                  </button>
                </h2>
              </div>

              <div id="collapseWSTrack" class="collapse" aria-labelledby="web-science-track-heading" data-parent="#web-science-track">
                <div class="card-body">
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2200 Foundations of Computer Science
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2300 Introduction to Algorithms
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header border-0" style="padding-left:33px;">
                      CSCI-2500 Computer Organization
                    </div>
                  </div>
                </div>
              </div>
            </div>       
          </div>
        </div>
      </div>

      <?php 
        $catalog = $dbconn->query("SELECT courses.id, courses.name, concentrations.id, concentrations.name, concentration_data.concentration_id, concentration_data.course_id FROM `courses`, `concentrations`, `concentration_data` WHERE courses.id=concentration_data.course_id AND concentrations.id = concentration_data.concentration_id")
      
      ?>

    </section>
  </body>
</html>