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

        $sql="SELECT t1.id, t1.uuid, t1.discord_link, COUNT(t3.id) AS totalLike, t2.discord_name, t1.date_post, t1.commentaire FROM `image_db_storage` AS t1 INNER JOIN discord_users AS t2 ON t1.ref_discord_users = t2.id LEFT JOIN react_discord AS t3 on t1.uuid = t3.uuid ".((!empty(db_escape($_POST["hashtag"])) & ($_POST["hashtag"] != 'false'))? "WHERE t1.commentaire LIKE '%".db_escape($_POST["hashtag"])."%'":"" )." GROUP BY t1.uuid ORDER BY `date_post` DESC LIMIT ".$start.", 15";
          $aDatas=db_query($sql);

        $aRow=array();

        if (empty($aDatas)) {
          echo "false";
          exit;
        }

        foreach ($aDatas as $row) {
          $aRow[]=array("id"=>$row["id"], "uuid"=>$row["uuid"], "discord_link"=>$row["discord_link"], "totalLike"=>$row["totalLike"], "discord_name"=>$row["discord_name"], "date_post"=>$row["date_post"], "commentaire"=>$row["commentaire"]);
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
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 logo-webfont" ng-class="{ headerLogo: isSet(2) }" href="javascript:void(0)">Instagram RP</a>
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
      <a class="nav-link" href="javascript:void(0)">Sign out</a>
      <a class="nav-link account" href="javascript:void(0)">Account</a>
    </li>
  </ul> -->
</header>

<div class="container-fluid" ng-controller="appCommon">
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
            <p class="h5">{{::discord_name}}</p>
            <p class="h7 text-muted">@{{::compteName}}</p>
          </div>
          <hr>
        </ul>
        
        <ul class="nav flex-column">
          <li class="nav-item" ng-class="{ active: isSet(1) }" ng-click="setTab(1)">
            <a class="nav-link active" href="javascript:void(0)">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-ui-radios-grid" viewBox="0 0 16 16">
                <path d="M 3.5 15 a 2.5 2.5 0 1 0 0 -5 a 2.5 2.5 0 0 0 0 5 z m 9 -9 a 2.5 2.5 0 1 0 0 -5 a 2.5 2.5 0 0 0 0 5 z m 0 9 a 2.5 2.5 0 1 1 0 -5 a 2.5 2.5 0 0 1 0 5 z M 16 3.5 A 3.5 3.5 0 1 1 9 3.5 a 3.5 3.5 0 0 1 7 0 z m -9 9 a 3.5 3.5 0 1 1 -7 0 a 3.5 3.5 0 0 1 7 0 z m 5.5 3.5 a 3.5 3.5 0 1 0 0 -7 a 3.5 3.5 0 0 0 0 7 z m -9 -9 a 3.5 3.5 0 1 0 0 -7 a 3.5 3.5 0 0 0 0 7 z m 0 -1 a 2.5 2.5 0 1 1 0 -5 a 2.5 2.5 0 0 1 0 5 z"/>
              </svg>
              <span data-feather="home">Feed</span>
            </a>
          </li>
          <li class="nav-item" ng-class="{ active: isSet(2) }" ng-click="setTab(2)">
            <a class="nav-link" href="javascript:void(0)">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
              </svg>
              <span data-feather="file">Explore</span>
            </a>
          </li>
          <li class="nav-item" ng-if="getAuth" ng-class="{ active: isSet(3) }" ng-click="setTab(3)">
            <a class="nav-link" href="javascript:void(0)">
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
            <li class="nav-item" ng-class="{ active: isSet(5) }" ng-click="setTab(5)">
              <a class="nav-link" href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                </svg>
                <span data-feather="file-text">Add Photo</span>
              </a>
            </li>
          </ul>
        </div>

        <hr ng-if="getAuth">
        
        <div class="" ng-if="getAuth">
          <ul class="nav flex-column mb-2">
            <li class="nav-item" ng-class="{ active: isSet(4) }" ng-click="setTab(4)">
              <a class="nav-link" href="javascript:void(0)">
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

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-0" style="overflow: hidden;">


      <div class="tab-content px-5" id="nav-tabContent">
        <div ng-if="isSet(1)" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
              <h1 class="h2">Stories</h1>
              <!-- photo profile & + -->
              <!-- stories des abonnées -->
            </div>

            <br>

            <h1 class="h2">Feed</h1>
            <!-- photo des abonnées -->
        </div>
        
        
        
        <div ng-show="isSet(2)" role="tabpanel" aria-labelledby="nav-profile-tab">
          <br>

          <h1 class="h2">Explore</h1>
          <div id="exploreListCart" class="row">
            <div class="grid-sizer"></div>
            <div class="grid"></div>
          </div>
        </div>



        <div ng-if="isSet(3)" role="tabpanel" aria-labelledby="nav-contact-tab">
          <h3>Page Profile!</h3>
          <hr>
          <a href="/Profile/index.php?userid=">Go to page profile</a>
        </div>

        <div ng-if="isSet(4)" role="tabpanel" aria-labelledby="nav-contact-tab" infinite-scroll-container>
          <section class="py-5 text-center container" ng-if="getAuth">
            <div class="row py-lg-5">
              <div class="col-lg-6 col-md-8 mx-auto">

                <div class="row featurette">
                    
                  <div class="col-md-5 order-md-1">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
                      <title>Placeholder</title>
                      <rect width="100%" height="100%" fill="#777"></rect>
                      <text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                    </svg>
                  </div>


                  <div class="col-md-7 order-md-2">
                    <div style="display: -webkit-inline-box;">
                      <p class="h5">{{discord_name}}</p>
                      <p class="h7 text-muted" style="position: relative; top: 4px;padding-left: 5px;">@{{compteName}}</p>
                    </div>

                    <div class="spaceDiv">
                      <div style="display: -webkit-inline-box;">
                        <p class="h5">0</p>
                        <p class="h7 text-muted" style="position: relative; top: 4px;">posts</p>
                      </div>
                      <div style="display: -webkit-inline-box;">
                        <p class="h5">0</p>
                        <p class="h7 text-muted" style="position: relative; top: 4px;">followers</p>
                      </div>
                      <div style="display: -webkit-inline-box;">
                        <p class="h5">0</p>
                        <p class="h7 text-muted" style="position: relative; top: 4px;">following</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <div class="album py-5 bg-light">
            <div class="container" infinite-scroll="loadMoreProfile()" infinite-scroll-distance="1">

              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="grid-item" id="90" data-search="" ng-repeat="i in responseMap | limitTo: limit">
                  <div class="card border-light">
                    <img src="{{i.discord_link}}" class="card-img-top" alt="Image Discord bot">
                    <div class="card-footer bg-transparent">
                      <div class="row">
                        <div class="col">{{i.discord_name}}</div>
                        <div class="col-auto" style="text-align: end;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16"><path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path></svg>
                        </div>
                        <div class="col-auto" style="text-align: end;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"></path></svg>
                          <small class="text-muted" ng-if="i.totalLike">{{i.totalLike}}</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div ng-if="isSet(5)" role="tabpanel" aria-labelledby="nav-contact-tab">
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