<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Student Create Plan</title>

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

    <section class="plan-header">
      <h2 id="plan-name"><a>&starf;</a>PLAN NAME</h2>
      <a id="toggle-config-button" class="btn btn-outline-primary" href="#" role="button">Show Config</a>
    </section>

    <section class="schedule">
      <div class="container">
        <div class="row">
            <div class="col">
              <div class="row">
                <div class="col-md-6">
                  <div class="semester">
                    <div class="row semester-title">
                      <h3>Fall 2019</h3>
                    </div> 
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Exampleaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row course-add">
                      <a class="btn btn-primary add-course" href="#" role="button">Add Course</a>
                      <a class="btn btn-primary add-course-group" href="#" role="button">Add Course Group</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="semester">
                    <div class="row semester-title">
                      <h3>Spring 2020</h3>
                    </div> 
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Exampleaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row course-add">
                      <a class="btn btn-primary add-course" href="#" role="button">Add Course</a>
                      <a class="btn btn-primary add-course-group" href="#" role="button">Add Course Group</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="semester">
                    <div class="row semester-title">
                      <h3>Fall 2020</h3>
                    </div> 
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Exampleaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row course-add">
                      <a class="btn btn-primary add-course" href="#" role="button">Add Course</a>
                      <a class="btn btn-primary add-course-group" href="#" role="button">Add Course Group</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="semester">
                    <div class="row semester-title">
                      <h3>Spring 2021</h3>
                    </div> 
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Exampleaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-title">Example</div>
                      <div class="col-md-4 course-code">EXPL-1000</div>
                      <div class="col-md-1">4</div>
                      <div class="col-md-1">&#x1f5d1;</div>
                    </div>
                    <div class="row course-add">
                      <a class="btn btn-primary add-course" href="#" role="button">Add Course</a>
                      <a class="btn btn-primary add-course-group" href="#" role="button">Add Course Group</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
            <div id="schedule-config" class="col-md-6">
              <div>
                config
              </div>
            </div>
        </div>

      </div>
    </section>

    <section class="config">
    </section>

  </body>
</html>