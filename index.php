<?php
  include_once("./includes/inc.php");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['action']){
      case "getlist":
        // $lmt = $_POST['limit'];
        $start = $_POST['start'];

        $sql="SELECT t1.id, t1.uuid, t1.discord_link, COUNT(t3.id) AS total, t2.discord_name, t1.date_post, t1.commentaire FROM `image_db_storage` AS t1 INNER JOIN discord_users AS t2 ON t1.ref_discord_users = t2.id LEFT JOIN react_discord AS t3 on t1.uuid = t3.uuid GROUP BY t1.uuid ORDER BY `date_post` DESC LIMIT ".$start.", 13";
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
      case "deleteuser":
        break;
      case "recup_list_cpep":
        break;
      case "reloadGroups":
        break;
    }
    exit;
  }

  $includeHeader = "";

  echo Header_HTML("InstaRP - United RP", $includeHeader);
?>
    
<header class="navbar sticky-top flex-md-nowrap p-0">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 logo-webfont" href="#">Instagram RP</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="w-100">
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
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active border-end border-3" aria-current="page" href="#">
              <span data-feather="home"></span>
              Feed
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Explore
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Notification
            </a>
          </li>
        </ul>

        <hr>

        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="Administration/login.php">
              <span data-feather="file-text"></span>
                Sign in
            </a>
          </li>
        </ul>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="./Administration/register.php">
              <span data-feather="file-text"></span>
                Register
            </a>
          </li>
        </ul>
      </div>
    </nav>

<style>
/* CSS for nav bar */
.form-control:focus {
  box-shadow: 0 0 0 0 !important;
}

.navbar-nav.px-3 {
  margin-top: -22px;
  background-color: #fff;
  height: 48px;
}

.nav-item.text-nowrap {
  margin-top: 4px;
}
/* --------------- */

* { box-sizing: border-box; }

/* force scrollbar, prevents initial gap */
html { overflow-y: scroll; }

/* ---- .grid ---- */
 
#feedListCart .grid {
  padding-left: 0;
  padding-right: 0;
} 

/* ---- .grid-item ---- */

.grid-sizer, .grid-item { 
  width: 32%;
  margin: 0.6%;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}
</style>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Stories</h1>
      </div> -->

      <br>

      <h1 class="h2">Feed</h1>
        <div id="feedListCart" class="row">
          <div class="grid-sizer"></div>
          <div class="grid"></div>
        </div>
    </main>
  </div>
</div>


<script>
$(function() {
  console.log("Script launch !!");

  var _start = 0;
  // var _lmt = 13;

  var send = $.ajax({
    method: 'POST',
    url:'',
    async: false,
    data: {
      autofunc: true,
      action: 'getlist',
      start: _start
    }
  }).done(function(html){
    if (html != 'false') {
      createlist(JSON.parse(html))
    }
  }).fail(function(){
    console.log("Error: 0");
  });

  $("img").on('load', function() {console.log("reload grid on load img"); reloadGridMasonry($('.grid'))})
  $('html, body').stop().animate({scrollTop:0}, 'slow');

  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
      _start += 13;
      nextGetListGrid(_start);
    }
  });
})

var $grid = $('.grid').isotope({
  percentPosition: true,
  itemSelector: '.grid-item'
});


// function search by HashTag
$('input#searchInput').keyup(function() {
  $grid.isotope({
    filter: function() {
      let $return = true;

      if ($('input#searchInput').val() == '') {
        $return = true;
      } else {
        $return = $(this).attr('data-search').search($('input#searchInput').val());
      }

      return (($return !== -1 | $return == true)? true:false);
    }
  });
});


function createlist(data) {
  console.log(data);

  $.each(data, function(key, value) {
    let $templateCard = '<div class="grid-item" id="'+value.uuid+'" data-search="'+value.id+'">'+
        '  <div class="card border-light">'+
        '    <img src="'+value.discord_link+'" class="card-img-top" alt="Image Discord bot">'+
        '    <div class="card-footer bg-transparent">'+
        '      <div class="row">'+
        '        <div class="col-md-auto" style="text-align: start;">'+
        '          <svg class="bd-placeholder-img rounded-circle" width="23" height="23" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#DB98AC"></rect></svg>'+
        '        </div>'+
        '        <div class="col">'+value.discord_name+
        '        </div>'+

        '        <div class="col-md-auto" style="text-align: end;">'+
        '          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16"><path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/></svg>'+
        '          <small class="text-muted">38</small>'+
        '        </div>'+

        '        <div class="col-md-auto" style="text-align: end;">'+
        '          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg>';
        
      if (value.total > 0) {
        $templateCard += '          <small class="text-muted">'+value.total+'</small>';
      }


      $templateCard += '        </div>'+

        '      </div>'+
        '    </div>'+
        '  </div>'+
        '</div>';

      var createCart = $($templateCard);

      $('.grid').append( createCart )
        .isotope( 'appended', createCart );

      // $('.grid').prepend( createCart )
      // .isotope( 'prepended', createCart );
  });

  $('img')
    .off()
    .dblclick(function() {
      console.log("Double click !");
      console.log($(this).parent());
      if ($(this).parent().parent().is('.selected')) {
        liked(this);
      } else {
        disLiked(this);
      }

    })
    .on('load', function() {
      // console.log("reload grid on load img");
      reloadGridMasonry($('.grid'))
    })
  
}

function reloadGridMasonry($this = false) {
  if (!$this) {
    console.log("Not grid select !");
    return 0;
  }

  $($this).isotope({
    percentPosition: true,
    itemSelector: '.grid-item'
  });

  // console.log("Reload grid!");
}


function nextGetListGrid(_start) {
  var send = $.ajax({
    method: 'POST',
    url:'',
    async: false,
    data: {
      autofunc: true,
      action: 'getlist',
      start: _start
    }
  }).done(function(html){
    if (html != false) {
      createlist(JSON.parse(html))
    }
  }).fail(function(){
    console.log("Error: 1");
  });
}

function liked(e) {
  let idElem = $(e).parent().parent().attr("id");
  let send = $.ajax({
    method: 'POST',
    url:'',
    async: false,
    data: {
      autofunc: true,
      action: 'like',
      id: idElem
    }
  }).done(function(html){

    if (html == "OK") {
      // verifier compte en php
        // si compte valide coeur rouge
        // si compte non valide message error
      animeLike(idElem, false);
    }

  }).fail(function(){
    console.log("Error: 2");
  });
}

function disLiked(e) {
  let idElem = $(e).parent().parent().attr("id");
  let send = $.ajax({
    method: 'POST',
    url:'',
    async: false,
    data: {
      autofunc: true,
      action: 'like',
      id: idElem
    }
  }).done(function(html){

    if (html == "OK") {
      // verifier compte en php
        // si compte valide coeur rouge
        // si compte non valide message error
      animeLike(idElem, true);
    }

  }).fail(function(){
    console.log("Error: 2");
  });
}

function animeLike(id, test) {
    let elem = $("#"+id);

    let emptyHeat = "M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z";
    let filledHeat = "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z";
    // fill-rule="evenodd"
    console.log(elem);

    if (test) {
      elem.find(".bi.bi-heart path").attr("d", filledHeat).attr("fill-rule", "evenodd");
      elem.addClass('selected');
    } else {
      elem.find(".bi.bi-heart path").attr("d", emptyHeat).attr("fill-rule", "evenodd");
      elem.removeClass('selected');
    }
  }
</script>


<?php
  echo Footer_HTML();
?>