<?php
  if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
    $path = "C:/wamp64/www/intagramRP_WEB";
  } else {
    $path = $_SERVER["DOCUMENT_ROOT"];
  }

  include_once($path."/includes/inc.php");

  
  // if (!isConnected()) {
  //   header('Location: /');
  //   return false;
  // }

  $includeHeader = "";

  echo Header_HTML("intagramRP - United RP", $includeHeader);
?>

<style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .spaceDiv div {
      padding-left: 10px;
    }

    .spaceDiv p.h5 {
      padding-right: 5px;
    }

    header.navbar.sticky-top.flex-md-nowrap.p-0 {
      position: relative;
    }

    a.navbar-brand.logo-webfont {
      display: block;
      background-color: #ffffff;
    }

    .grid-sizer, .grid-item {
      width: 31%;
      margin: 1.1%;
    }
</style>

<header class="navbar sticky-top flex-md-nowrap p-0">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 logo-webfont" href="#">Instagram RP</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>

<main ng-controller="appProfile">

  <section class="py-5 text-center container">
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
                <p class="h7 text-muted" ng-if="registerCompte" style="position: relative; top: 4px;padding-left: 5px;">@{{compteName}}</p>
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

</main>

<?php
  echo Footer_HTML();
?>