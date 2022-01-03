(function($) {
    var _start = 0;

    nextGetListGrid(_start);
  
    $('html, body').stop().animate({scrollTop:0}, 'slow');
  
    $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        _start += 15;
        console.log(_start);
        nextGetListGrid(_start);
      }
    });

    var $grid = $('.grid').isotope({
        percentPosition: true,
        itemSelector: '.grid-item'
    });

    // function search by HashTag
    var m = 0;
    $('input#searchInput').keyup(function() {
        clearTimeout(m)
        m = setTimeout(function() {
            let $return = true;
            let str = $('input#searchInput').val();

            if (str == '') {
                $return = true;
                $grid.html('');
                $('.grid').isotope('destroy');
                nextGetListGrid(0);

            } else if (str.indexOf("#") >= "0" & str.length > 1) {
                $grid.html('');
                nextGetListGrid(0, $('input#searchInput').val().toLowerCase());
            }
        }, 500)
    })
  
    function createlist(data) {
        console.log(data);
  
        $.each(data, function(key, value) {
            const regex = /(?:#[a-z0-9](?:(?:[a-z0-9]|(?:\.(?!\.)))*(?:[a-z0-9]))?)/ig;
            let m;
            let $result = "";
    
            while ((m = regex.exec(value.commentaire)) !== null) {
                if (m.index === regex.lastIndex) {
                    regex.lastIndex++;
                }
        
                m.forEach((match, groupIndex) => {
                    console.log(`Found match, group ${groupIndex}: ${match}`);
                    $result += match+" ";
                });
            }
    
            var templateCard = '<div class="grid-item" id="'+value.id+'" data-search="'+$result+'">'+
            '  <div class="card border-light">'+
            '    <img src="'+value.discord_link+'" class="card-img-top" alt="Image Discord bot">'+
            '    <div class="card-footer bg-transparent">'+
            '      <div class="row">'+
            // '        <div class="col-md-auto" style="text-align: start;">'+
            // '          <svg class="bd-placeholder-img rounded-circle" width="23" height="23" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#DB98AC"></rect></svg>'+
            // '        </div>'+
            '        <div class="col">'+value.discord_name+
            '        </div>'+
    
            '        <div class="col-auto" style="text-align: end;">'+
            '          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16"><path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/></svg>'+
            // '          <small class="text-muted">38</small>'+
            '        </div>'+
    
            '        <div class="col-auto" style="text-align: end;">'+
            '          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg>';
    
            if (value.totalLike > 0) {
                templateCard += '          <small class="text-muted">'+value.totalLike+'</small>';
            }
    
            templateCard += '        </div>'+
    
            '      </div>'+
            '    </div>'+
            '  </div>'+
            '</div>';
    
            var createCart = $(templateCard);
    
            $('.grid').append(createCart)
            .isotope( 'appended', createCart);
        });
  
        $('img')
        .off()
        .dblclick(function() {
            console.log("Double click !");
            console.log($(this).parent());
            if ($(this).parent().parent().is('.selected')) {
                liked($(this).parent().parent());
            } else {
                disLiked($(this).parent().parent());
            }
        })
        .on('load', function() {
            reloadGridMasonry($('.grid'));
        });

        $('svg.bi.bi-heart')
        .click(function() {
            if ($(this).parent().parent().parent().parent().parent().is('.selected')) {
                liked($(this).parent().parent().parent().parent().parent(), false);
            } else {
                disLiked($(this).parent().parent().parent().parent().parent(), false);
            }
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
    }
  
    function nextGetListGrid(_start, research = false) {
        console.log("Hashtag -> "+research);
    
        var send = $.ajax({
            method: 'POST',
            url:'',
            async: true,
            data: {
                autofunc: true,
                action: 'getlist',
                start: _start,
                hashtag: research
            }
        }).done(function(html){
            if (html != false) {
                createlist(JSON.parse(html))
            }
        }).fail(function(){
            console.log("Error: 1");
        });
    }
  
    function liked(e, anime = true) {
        let idElem = $(e).attr("id");
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
            animeLike(idElem, false, anime);
        }
    
        }).fail(function(){
            console.log("Error: 2");
        });
    }
  
    function disLiked(e, anime = true) {
        let idElem = $(e).attr("id");
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
            animeLike(idElem, true, anime);
        }
    
        }).fail(function(){
            console.log("Error: 2");
        });
    }
  
    function animeLike(id, test, anime = true) {
        let elem = $("#"+id);
  
        let emptyHeat = "M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z";
        let filledHeat = "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z";
        // fill-rule="evenodd"
        console.log(elem);
  
        if (test) {
            if (anime) {
                elem.append('<div class="middle"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" fill-rule="evenodd"></path></svg></div>')
                    setTimeout(function() {$(".middle").remove()}, 1100);
            }
            elem.find(".card-footer .bi.bi-heart path").attr("d", filledHeat).attr("fill-rule", "evenodd").css("color", "#dc3545");
            elem.addClass('selected');
        } else {
            $(".middle").remove();
            elem.find(".card-footer .bi.bi-heart path").attr("d", emptyHeat).attr("fill-rule", "evenodd").css("color", "#000");
            elem.removeClass('selected');
        }
    }
})(jQuery)