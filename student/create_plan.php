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
    <script src="/assets/js/student_create_plan.js"></script>
  </head>

  <body>
    <!--NAVIGATION BAR (implemented with Bootstrap) -->
    <?php include('student_navbar.php'); ?>

    <section class="plan-header">
      <h2 id="plan-name"><a>&starf;</a>PLAN NAME</h2>
      <button id="toggle-config-button" class="btn btn-outline-primary">Show Config</button>
    </section>
    <!-- TODO: discuss how to make fields editable nicely -->
    <section class="schedule">
      <div class="container">
        <div class="row">
            <div class="col">
              <div id="semester-row" class="row">
                <div class="col-md-6">
                  <div class="semester">
                    <div class="row semester-title">
                      <h3>Fall 2019</h3>
                    </div> 
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                      <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row course-add">
                      <button class="btn btn-primary add-course-button">Add Course</button>
                      <button class="btn btn-primary add-course-group-button" href="#" role="button" disabled=true>Add Course Group</button>
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
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                      <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row course-add">
                      <button class="btn btn-primary add-course-button">Add Course</button>
                      <button class="btn btn-primary add-course-group-button" href="#" role="button" disabled=true>Add Course Group</button>
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
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                      <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row course-add">
                      <button class="btn btn-primary add-course-button">Add Course</button>
                      <button class="btn btn-primary add-course-group-button" href="#" role="button" disabled=true>Add Course Group</button>
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
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                      <!-- <div class="col-md-1 course-config"><button class="btn btn-link course-config-button">&#9881;</button></div> -->
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row semester-course">
                      <div class="col-md-1 course-status"><span class="dot"></span></div>
                      <div class="col-md-5 course-editable course-title" contenteditable=true>Example</div>
                      <div class="col-md-3 course-editable course-code" contenteditable=true>EXPL-1000</div>
                      <div class="col-md-1 course-editable course-credits" contenteditable=true>4</div>
                      <div class="col-md-2 course-trash"><button class="btn btn-link course-trash-button">&#x1f5d1;</button></div>
                    </div>
                    <div class="row course-add">
                      <button class="btn btn-primary add-course-button">Add Course</button>
                      <button class="btn btn-primary add-course-group-button" href="#" role="button" disabled=true>Add Course Group</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
            <div id="schedule-config" class="col-md-6">
              <div id="schedule-config-container">
                <ul id="schedule-config-nav" class="nav nav-tabs">
                  <li class="nav-item">
                    <button class="nav-link active" href="#">Validation</button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" href="#">Groups</button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" href="#">Notes</button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" href="#">Settings</button>
                  </li>
                </ul>
                <div id="plan-config-validation">
                  Validation page
                </div>
                <div id="plan-config-groups">
                  Groups page
                </div>
                <div id="plan-config-notes">
                  Notes page
                </div>
                <div id="plan-config-settings">
                  Settings page
                </div>
              </div>
            </div>
        </div>

      </div>
    </section>

  </body>
</html>