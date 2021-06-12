<?php
   // This entire php file was updated on 6/9/2021 at 5pm at Bay Terrace Starbucks

   session_start();

   include "includes/UserActivity.php";
   include "includes/ThreadHandler.php";

   // For displaying the number of threads for a particular subject
   $numOfThreads = new ThreadHandler();

   //if user is logged in, set their log_status to active in the activeaccounts table
   $useractivity = new UserActivity();

   $userid = $_SESSION['userid'];
   $username = $_SESSION['username'];
   $useractivity -> setLoggedUsers($userid, $username);
?>
<html lang = "en">
    <head>
         <title> Welcome to IntelliChat </title>
         <meta charset = "utf-8"/>
         <meta name = "viewport" content = "width=device-width, initial-scale=1"/>

         <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
         <link rel = "stylesheet" href = "css/main.css"/>

         <!-- Link the Bootstrap 4 CDN CSS files (this is mainly for the navbar) -->
         <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>

         <!-- For changing the background color of navbar elements when hovering cursor on them -->
         <style>
             .nav-item:hover
             {
                background-color: blue;
             }
         </style>
    </head>

    <body>
          <!-- Navbar -->
          <nav class = "navbar navbar-expand-sm bg-dark navbar-dark" style = 'border-radius: 10px; font-family: serif;'>
               <ul class = "navbar-nav mr-auto">
                   <li class = "nav-item">
                       <a href = "#" class = "nav-link text-white"> Home </a>
                   </li>
                   <li class = "nav-item">
                       <a href = "members.php" class = "nav-link text-white"> Members </a>
                   </li>
                   <li class = "nav-item">
                       <a href = "activities.php" class = "nav-link text-white"> Activity </a>
                   </li>
               </ul>
               <ul class = "navbar-nav ml-auto">
                   <li class = "nav-item dropdown">
                       <a href = "#" class = "nav-link dropdown-toggle text-white" data-toggle = "dropdown"> Hello: <?php echo $_SESSION['username']; ?> </a>
                       <div class = "dropdown-menu" style = "padding: 10px;">
                            <span class = "dropdown-link d-flex justify-content-center" style = "padding: 10px;"> <?php echo "<img src = '" . $_SESSION['pic'] . "' height='70' width='70'/>"; ?> </span>
                            <span class = "dropdown-link d-flex justify-content-center"> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> </span>
                            <span class = "dropdown-link d-flex justify-content-center"> <?php echo $_SESSION['useremail']; ?> </span>
                            <span class = "dropdown-link d-flex justify-content-center"> <?php echo $_SESSION['status']; ?> </span>
                            <span class = "dropdown-link d-flex justify-content-center"> <?php echo $_SESSION['regdate']; ?> </span>
                            <a href = "userprofile.php" class = "dropdown-link btn btn-primary d-flex justify-content-center"> Go to account settings </a>
                       </div>
                   </li>
                   <li class = "nav-item">
                       <a href = "includes/logout.php" class = "nav-link text-white"> Logout </a>
                   </li>
               </ul>
          </nav>

         <!-- Search for forums -->
         <div id="searchwindow" class="container">
             <h4> Search for your favorite topic thread </h4>

             <form method = "POST" action = "forumhome.php">
                  <div class="form-group">
                       <input type = "text" name = "threadname" placeholder = "Enter thread name" class = "form-control">
                  </div>
                  <div class="form-group">
                       <input type = "text" name = "subjectname" placeholder = "Enter subject (Culture, Social Science, etc)" class = "form-control">
                  </div>

                  <input type = "submit" name = "submit-search" value = "Search" class="btn btn-primary">
             </form>
             <?php
                 if(isset($_POST['submit-search']))
                 {
                    $ThreadName = $_POST['threadname'];
                    $SubjectName = $_POST['subjectname'];

                    $searchThread = new ThreadHandler();
                    $searchThread -> searchThreads($ThreadName, $SubjectName);
                 }
             ?>
         </div>

         <!-- New forum window -->
         <div id="culture_window" class="container">
              <div id="culture_section_titles" class="row">
                   <div class="col">Culture</div>
                   <div class="col">Number of posts</div>
              </div>

              <div class="row culture_topic_posts">
                   <div class="col"><a href = "Subjects/Culture/Philosophy.php">Philosophy</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Culture", "Philosophy"); ?></div>
              </div>
              <div class="row culture_topic_posts">
                   <div class="col"><a href = "Subjects/Culture/Religion.php">Religion</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Culture", "Religion"); ?></div>
              </div>
              <div class="row culture_topic_posts">
                   <div class="col"><a href = "Subjects/Culture/Art.php">Art</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Culture", "Art"); ?></div>
              </div>
         </div>

         <div id="sosci_window" class="container">
              <div id="sosci_section_titles" class="row">
                   <div class="col">Social Science</div>
                   <div class="col">Number of posts</div>
              </div>

              <div class="row sosci_topic_posts">
                   <div class="col"><a href = "Subjects/Social Science/Anthropology.php">Anthropology</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Social Science", "Anthropology"); ?></div>
              </div>
              <div class="row sosci_topic_posts">
                   <div class="col"><a href = "Subjects/Social Science/Archeology.php">Archeology</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Social Science", "Archeology"); ?></div>
              </div>
              <div class="row sosci_topic_posts">
                   <div class="col"><a href = "Subjects/Social Science/Sociology.php">Sociology</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Social Science", "Sociology"); ?></div>
              </div>
              <div class="row sosci_topic_posts">
                   <div class="col"><a href = "Subjects/Social Science/Psychology.php">Psychology</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Social Science", "Psychology"); ?></div>
              </div>
              <div class="row sosci_topic_posts">
                   <div class="col"><a href = "Subjects/Social Science/Linguistics.php">Linguistics</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Social Science", "Linguistics"); ?></div>
              </div>
         </div>

         <div id="natsci_window" class="container">
              <div id="natsci_section_titles" class="row">
                   <div class="col">Natural Science</div>
                   <div class="col">Number of posts</div>
              </div>

              <div class="row natsci_topic_posts">
                   <div class="col"><a href = "Subjects/Natural Science and Mathematics/Biology.php">Biology</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Natural Science and Mathematics", "Biology"); ?></div>
              </div>
              <div class="row natsci_topic_posts">
                   <div class="col"> <a href = "Subjects/Natural Science and Mathematics/Chemistry.php">Chemistry</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Natural Science and Mathematics", "Chemistry"); ?></div>
              </div>
              <div class="row natsci_topic_posts">
                   <div class="col"><a href = "Subjects/Natural Science and Mathematics/Physics.php">Physics</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Natural Science and Mathematics", "Physics"); ?></div>
              </div>
              <div class="row natsci_topic_posts">
                   <div class="col"><a href = "Subjects/Natural Science and Mathematics/EarthScience.php">Earth Science</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Natural Science and Mathematics", "Earth Science"); ?></div>
              </div>
              <div class="row natsci_topic_posts">
                   <div class="col"><a href = "Subjects/Natural Science and Mathematics/Astronomy.php">Astronomy</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Natural Science and Mathematics", "Astronomy"); ?></div>
              </div>
              <div class="row natsci_topic_posts">
                   <div class="col"><a href = "Subjects/Natural Science and Mathematics/Mathematics.php">Mathematics</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Natural Science and Mathematics", "Mathematics"); ?></div>
              </div>
         </div>

         <div id="intnews_window" class="container">
              <div id="intnews_section_titles" class="row">
                   <div class="col">Things happening in the world</div>
                   <div class="col">Number of posts</div>
              </div>

              <div class="row intnews_topic_posts">
                   <div class="col"><a href = "Subjects/World News/News.php">International News</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("World News", "International News"); ?></div>
              </div>
         </div>

         <div id="tech_window" class="container">
              <div id="tech_section_titles" class="row">
                   <div class="col">What's going on now in Tech</div>
                   <div class="col">Number of posts</div>
              </div>

              <div class="row tech_topic_posts">
                   <div class="col"><a href = "Subjects/Technology/CompSoft.php">Latest Computer Software</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Technology", "Computer Software"); ?></div>
              </div>
              <div class="row tech_topic_posts">
                   <div class="col"><a href = "Subjects/Technology/CompHard.php">Latest Computer Hardware</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Technology", "Computer Hardware"); ?></div>
              </div>
              <div class="row tech_topic_posts">
                   <div class="col"><a href = "Subjects/Technology/VidGm.php">Latest Video Games</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Technology", "Video Games"); ?></div>
              </div>
              <div class="row tech_topic_posts">
                   <div class="col"><a href = "Subjects/Technology/Phones.php">Latest smartphones and tablets</a></div>
                   <div class="col"><?php $numOfThreads -> countThreads("Technology", "Smartphones"); ?></div>
              </div>
         </div>

         <!-- Link the Bootstrap 4 CDN JS and jQuery files (must be in this order: jQuery, Popper, Bootstrap.js) -->
         <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
         <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
         <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    </body>
</html>
