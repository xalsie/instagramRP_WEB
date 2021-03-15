<?php
  if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
    $path = "C:/wamp64/www/intagramRP_WEB";
  } else {
    $path = $_SERVER["DOCUMENT_ROOT"];
  }

  include_once($path."/includes/inc.php");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['action']){
      case "getlist":
        // $lmt = $_POST['limit'];
        $start = $_POST['start'];

        $sql="SELECT t1.id, t1.uuid, t1.discord_link, COUNT(t3.id) AS total, t2.discord_name, t1.date_post, t1.commentaire FROM `image_db_storage` AS t1 INNER JOIN discord_users AS t2 ON t1.ref_discord_users = t2.id LEFT JOIN react_discord AS t3 on t1.uuid = t3.uuid ".((!empty(db_escape($_POST["hashtag"])) & ($_POST["hashtag"] != 'false'))? "WHERE t1.commentaire LIKE '%".db_escape($_POST["hashtag"])."%'":"" )." GROUP BY t1.uuid ORDER BY `date_post` DESC LIMIT ".$start.", 15";
          $aDatas=db_query($sql);

        $aRow=array();

        if (empty($aDatas)) {
          echo "false";
          exit;
        }

        foreach ($aDatas as $row) {
          $aRow[]=array("id"=>$row["id"], "uuid"=>$row["uuid"], "discord_link"=>$row["discord_link"], "total"=>$row["total"], "discord_name"=>$row["discord_name"], "date_post"=>$row["date_post"], "commentaire"=>$row["commentaire"]);
        }

        echo json_encode($aRow);
        break;
      case "like":

        echo "OK";

        break;
      case "dislike":
        
        echo "OK";

        break;
      case "getSession":
        echo isConnected();
        break;
      case "recup_list_cpep":
        break;
      case "reloadGroups":
        break;
    }
    exit;
  }

  $includeHeader = "";

  echo Header_HTML("intagramRP - United RP", $includeHeader);
?>
  
<style>
.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 33%;
  left: 43%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  animation: bounce 1.1s ease alternate;
  color: #FFF;
}

@keyframes bounce {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(0.8);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.middle:hover {
  opacity: 1;
}

.test {
  background-color: red;
}
</style>

<header class="navbar sticky-top flex-md-nowrap p-0">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 logo-webfont" ng-class="{ headerLogo: isSet(2) }" href="#">Instagram RP</a>
  <!-- <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> -->
  <div class="w-100" ng-class="{ headerSearch: !isSet(2) }">
    <input class="form-control w-100" id="searchInput" type="text" placeholder="Search" aria-label="Search" style="padding-left: 40px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="position: relative; top: -36px; left: 16px; color: #5F5F5F;">
      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
    </svg>
  </div>
  <!-- <ul class="navbar-nav px-3" style="margin-top: -22px;">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
      <a class="nav-link account" href="#">Account</a>
    </li>
  </ul> -->
</header>

<div class="container-fluid">
  <!-- <div class="row" ng-controller="TabController"> -->
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar removeForAlign collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column" ng-if="getAuth" ng-class="{ profileImg: getAuth }" style="display: none;">
          <div class="col" style="text-align: center;">
            <svg class="bd-placeholder-img rounded-circle" width="90" height="90" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#777"></rect>
              <text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
            </svg>
            <p class="h5">{{::firstName}}</p>
            <p class="h7 text-muted">{{::lastName}}</p>
          </div>
          <hr>
        </ul>
        
        <ul class="nav flex-column">
          <li class="nav-item" ng-class="{ active: isSet(1) }" ng-click="setTab(1)">
            <a class="nav-link active" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-ui-radios-grid" viewBox="0 0 16 16">
                <path d="M 3.5 15 a 2.5 2.5 0 1 0 0 -5 a 2.5 2.5 0 0 0 0 5 z m 9 -9 a 2.5 2.5 0 1 0 0 -5 a 2.5 2.5 0 0 0 0 5 z m 0 9 a 2.5 2.5 0 1 1 0 -5 a 2.5 2.5 0 0 1 0 5 z M 16 3.5 A 3.5 3.5 0 1 1 9 3.5 a 3.5 3.5 0 0 1 7 0 z m -9 9 a 3.5 3.5 0 1 1 -7 0 a 3.5 3.5 0 0 1 7 0 z m 5.5 3.5 a 3.5 3.5 0 1 0 0 -7 a 3.5 3.5 0 0 0 0 7 z m -9 -9 a 3.5 3.5 0 1 0 0 -7 a 3.5 3.5 0 0 0 0 7 z m 0 -1 a 2.5 2.5 0 1 1 0 -5 a 2.5 2.5 0 0 1 0 5 z"/>
              </svg>
              <span data-feather="home">Feed</span>
            </a>
          </li>
          <li class="nav-item" ng-class="{ active: isSet(2) }" ng-click="setTab(2)">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
              </svg>
              <span data-feather="file">Explore</span>
            </a>
          </li>
          <li class="nav-item" ng-class="{ active: isSet(3) }" ng-click="setTab(3)">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-app-indicator" viewBox="0 0 16 16">
                <path d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"/>
                <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              </svg>
              <span data-feather="shopping-cart">Notification</span>
            </a>
          </li>
        </ul>

        <hr>
        
        <div class="" ng-if="getAuth">
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="/Profile/index.php?userid=">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="-1 -1 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
                <span data-feather="file-text">Profile</span>
              </a>
            </li>
          </ul>

          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="Administration/logout.php?logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16" transform="rotate(90)">
                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                </svg>
                <span data-feather="file-text">Logout</span>
              </a>
            </li>
          </ul>
        </div>
       
        <div class="" ng-if="!getAuth">
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="Administration/login.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                  <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                </svg>
                <span data-feather="file-text">Sign in</span>
              </a>
            </li>
          </ul>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="./Administration/register.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <span data-feather="file-text">Register</span>
              </a>
            </li>
          </ul>
        </div>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="overflow: hidden;">


      <div class="tab-content" id="nav-tabContent">
        <div ng-show="isSet(1)" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
              <h1 class="h2">Stories</h1>
            </div>

            <br>

            <h1 class="h2">Feed</h1>
        </div>
        
        
        
        <div ng-show="isSet(2)" role="tabpanel" aria-labelledby="nav-profile-tab">
          <br>

          <h1 class="h2">Explore</h1>
          <div id="exploreListCart" class="row">
            <div class="grid-sizer"></div>
            <div class="grid"></div>
          </div>
        </div>



        <div ng-show="isSet(3)" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>

        <div ng-show="isSet(4)" role="tabpanel" aria-labelledby="nav-contact-tab">
          <h3>Page Profile!</h3>
          <hr>
          <a href="/Profile/index.php?userid=">Go to page profile</a>
        </div>
      </div>

    </main>
  </div>


  <div id="nav-menu">
    <div class="row align-items-center">
      <div class="col" ng-class="{ active: isSet(1) }" ng-click="setTab(1)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-radios-grid" viewBox="-1 -1 18 18">
          <path d="M 3.5 15 a 2.5 2.5 0 1 0 0 -5 a 2.5 2.5 0 0 0 0 5 z m 9 -9 a 2.5 2.5 0 1 0 0 -5 a 2.5 2.5 0 0 0 0 5 z m 0 9 a 2.5 2.5 0 1 1 0 -5 a 2.5 2.5 0 0 1 0 5 z M 16 3.5 A 3.5 3.5 0 1 1 9 3.5 a 3.5 3.5 0 0 1 7 0 z m -9 9 a 3.5 3.5 0 1 1 -7 0 a 3.5 3.5 0 0 1 7 0 z m 5.5 3.5 a 3.5 3.5 0 1 0 0 -7 a 3.5 3.5 0 0 0 0 7 z m -9 -9 a 3.5 3.5 0 1 0 0 -7 a 3.5 3.5 0 0 0 0 7 z m 0 -1 a 2.5 2.5 0 1 1 0 -5 a 2.5 2.5 0 0 1 0 5 z"/>
        </svg>
      </div>
      <div class="col" ng-class="{ active: isSet(2) }" ng-click="setTab(2)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="-1 -1 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
        </svg>
      </div>

      <div class="col" ng-if="!getAuth">
        <a class="nav-link" href="Administration/login.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          </svg>
        </a>
      </div>

      <div class="col" ng-if="getAuth" ng-class="{ active: isSet(4) }" ng-click="setTab(4)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="-1 -1 16 16">
          <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        </svg>
      </div>

    </div>
  </div>
</div>
<script src="./assets/js/app.js?v=1.1"></script>

<script>
$(function() {
  console.log("Script launch !!");

  // $("#exploreListCart > .grid")

  // var $grid = $('.grid').isotope({
  //     percentPosition: true,
  //     itemSelector: '.grid-item'
  // });
})
</script>

<?php
  echo Footer_HTML();
?>