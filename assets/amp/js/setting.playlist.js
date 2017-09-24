Loaded_script = false;
DOMAIN=base_url;
if (window.jQuery) {
    if (parseFloat(jQuery.fn.jquery) < 1.5) {
         var jq = document.createElement('script');
         jq.type = 'text/javascript';
         jq.src = DOMAIN+ 'assets/amp/js/jquery.min.js';
         jq.onload = function() {
             Loaded_script = true;
         }
         document.getElementsByTagName('head')[0].appendChild(jq);
    } 
} else {
    var jq = document.createElement('script');
    jq.type = 'text/javascript';
    jq.src = DOMAIN+ 'assets/amp/js/jquery.min.js';
    jq.onload = function() {
         Loaded_script = true;
     }
    document.getElementsByTagName('head')[0].appendChild(jq);
    
}
function AMP_Load_script() {
    $('head').append('<link href="'+DOMAIN +'assets/amp/css/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />');
    $.getScript(DOMAIN + "assets/amp/js/jquery.jplayer.js", function() {});
    $.getScript(DOMAIN + "assets/amp/js/jplayer.playlist.js", function() {});
    $.getScript(DOMAIN + "assets/amp/js/jquery.redirect.js", function() {});
}
function load_data_options(playlistAlbumIds ,playlistUserId ,affiliateId ,background_color ,color_track_front ,color_font ,color_time_loaded ,orderText ,affiliatetext) {
    
    window.playlistAlbumIds = playlistAlbumIds;
    window.playlistUserId = playlistUserId;
    window.affiliateId = affiliateId;
    window.background_color = background_color;
    window.colorTrackFront = color_track_front;
    window.colorFont = color_font;
    window.color_time_loaded = color_time_loaded;
    window.orderText = orderText;
    window.affiliatetext = affiliatetext;
    load_AMP_player();
}
function AMP_Load_data(affiliateId) {
    
    if (Loaded_script) {
        //AMP_Load_script();     
        $.ajax({
         type: "GET",
         url: DOMAIN + "map/get_option_widget?affiliateid="+affiliateId ,
         dataType: "text",
         success: function(datatest) {
                var  obj_data = JSON.parse(datatest);
                window.background_color = obj_data.background_color;
                window.colorTrackFront = obj_data.color_track_front;
                window.colorFont = obj_data.color_font;
                window.color_time_loaded = obj_data.color_time_loaded;
                window.orderText = obj_data.ordertext;
                window.affiliatetext = obj_data.affiliatetext;
                window.playlistAlbumIds = obj_data.playlistAlbumIds;
                window.autostart = obj_data.autostart;
                window.playlistUserId = obj_data.playlistUserId;
                window.affiliateId = affiliateId;
                load_AMP_player();
             }
         });    
    }else{
        setTimeout("AMP_Load_data('"+affiliateId+"')", 50);
    }
          
}
function load_AMP_player() {
     window.playlistArray = window.playlistAlbumIds.split(",");
     window.playlistCurrent = window.playlistArray[0];
     window.playlists = [];
     window.songsInCart = [];
     for (var i = 0; i < window.playlistArray.length; i++) {
         var playlist = {};
         playlist.userId = window.playlistUserId;
         playlist.albumId = window.playlistArray[i];
         playlist.loaded = false;
         window.playlists.push(playlist);
     }
     for(var i = 0; i < window.playlists.length; i++) {
         var playlist = window.playlists[i];
         
         load_AMP_Playlist(playlist.albumId);
     }
     
}
function load_AMP_Playlist(albumId) {
    $.ajax({
     type: "GET",
     url: DOMAIN + "map/get_audio",
     dataType: "text",
     data: {
        'affiliateId': window.affiliateId,
        'albumId': albumId
     },
     success: function(xml) { 
         
         var data = {};
         data.player = {};
         albums = [];
         var player = $(xml).filter(":first");
         data.player.showPlaylist = $(player).attr('showPlaylist');
         data.player.autoStart = $(player).attr('autoStart');
         var album = {};
         album.playlist = $(player).attr('playlist');
        
         album.price = $(player).attr('albumprice');
         album.img_cover = $(player).attr('img_cover');
         album.totalListened = -1;
         if ($(player).attr('total_listened')) {
             album.totalListened = $(player).attr('total_listened');
         }
         album.songs = [];      
         $(xml).find('song').each(function() {
             var song = {};
             
             song.title = $(this).attr('title');
             song.songId = $(this).attr('song_id');
            
             song.userId = 69;
             var path1 = $(this).attr('path1');
             var path2 = $(this).attr('path2');
             var path3 = $(this).attr('path3');
             var path4 = $(this).attr('path4');
             var path5 = $(this).attr('path5');

// For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
if (typeof path1 !== typeof undefined && path1 !== false) {
  var info_file1 = $(this).attr('path1').replace(/\\/g, '/').replace(/.*\//, '').split(".");
             type_file1 = info_file1[info_file1.length-1];
             switch(type_file1) {
                case 'mp3':
                case 'm4a':
                case 'wav':
                case 'aac':
                case 'oga':
                song.mp3 = $(this).attr('path1');
                
                    break;
                case 'mp4':
                case 'm4v':
                case 'wav':
                case 'mov':
                case '3gp':
                case 'webm':
                case 'ogv':    
                    song.m4v = $(this).attr('path1');
                    
                    break;
             }
}

if (typeof path2 !== typeof undefined && path2 !== false) {
  var info_file2 = $(this).attr('path2').replace(/\\/g, '/').replace(/.*\//, '').split(".");
             type_file2 = info_file2[info_file2.length-1];
             switch(type_file2) {
                case 'mp3':
                case 'm4a':
                case 'wav':
                case 'aac':
                case 'oga':
                song.mp3 = $(this).attr('path2');
                
                    break;
                case 'mp4':
                case 'm4v':
                case 'wav':
                case 'mov':
                case '3gp':
                case 'webm':
                case 'ogv':    
                    song.m4v = $(this).attr('path2');
                    
                    break;
             }
}
             
  if (typeof path3 !== typeof undefined && path3 !== false) {
  var info_file3 = $(this).attr('path3').replace(/\\/g, '/').replace(/.*\//, '').split(".");
             type_file3 = info_file3[info_file3.length-1];
              switch(type_file3) {
                case 'mp3':
                case 'm4a':
                case 'wav':
                case 'aac':
                case 'oga':
                song.mp3 = $(this).attr('path3');
                
                    break;
                case 'mp4':
                case 'm4v':
                case 'wav':
                case 'mov':
                case '3gp':
                case 'webm':
                case 'ogv':    
                    song.m4v = $(this).attr('path3');
                    
                    break;
             }
}

if (typeof path4 !== typeof undefined && path4 !== false) {
  var info_file4 = $(this).attr('path4').replace(/\\/g, '/').replace(/.*\//, '').split(".");
             type_file4 = info_file4[info_file4.length-1];
              switch(type_file4) {
                case 'mp3':
                case 'm4a':
                case 'wav':
                case 'aac':
                case 'oga':
                song.mp3 = $(this).attr('path4');
                
                    break;
                case 'mp4':
                case 'm4v':
                case 'wav':
                case 'mov':
                case '3gp':
                case 'webm':
                case 'ogv':    
                    song.m4v = $(this).attr('path4');
                    
                    break;
             }
             
}
if (typeof path5 !== typeof undefined && path5 !== false) {
  var info_file5 = $(this).attr('path5').replace(/\\/g, '/').replace(/.*\//, '').split(".");
             type_file5 = info_file5[info_file5.length-1];
               switch(type_file5) {
                case 'mp3':
                case 'm4a':
                case 'wav':
                case 'aac':
                case 'oga':
                song.mp3 = $(this).attr('path5');
                
                    break;
                case 'mp4':
                case 'm4v':
                case 'wav':
                case 'mov':
                case '3gp':
                case 'webm':
                case 'ogv':    
                    song.m4v = $(this).attr('path5');
                    
                    break;
             }
}

             //type_file = 'm4v';
            
             
             
            
             
            
            //alert($(this).attr('path'));
            //alert(type_file);
             song.price = $(this).attr('price');
             song.artist = $(this).attr('artist');
             song.currency = $(this).attr('currency');
             song.albumId = albumId;
             song.albumName = $(this).attr('album');
             song.lyrics=$(this).attr('lyrics');
             album.songs.push(song);
         });
         //console.log(song);
         albums.push(album);
         $.each(window.playlists, function(i) {
             if (window.playlists[i].albumId == albumId) {
                 window.playlists[i].albums = albums;
                 window.playlists[i].showPlaylist = data.player.showPlaylist;
                 window.playlists[i].autoStart = data.player.autoStart;
                 window.playlists[i].loaded = true; 
             }
         });
         if (window.playlists[0].loaded == true ) {
            load_AMP_jPlayerPlaylist(window.playlistCurrent);
         }
     },
     error: function() {
         window.load_AMP_Error = true;
     }
    });
}
function load_AMP_jPlayerPlaylist(albumId) {
    for (var i = 0; i < window.playlists.length; i++) {
         if (window.playlists[i].albumId==albumId) {
             var album = window.playlists[i].albums[0];
             var data_Playlist = album.songs;
             window.playlistCurrent = albumId;
         }
    }
    window.Jplayer = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_2",
		cssSelectorAncestor: "#jp_container_2"
	}, data_Playlist, {
		swfPath: "../../dist/jplayer",
		supplied: "webmv,ogv,m4v,mp3,mp4,wav,aac",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: true,
		smoothPlayBar: true,
		keyEnabled: true
        
	});
 }
 function show_hide_Playlist() {
     var containerDiv = $(".amp-playlist-picker");
     $('.menu-ico').toggleClass('active');
     $('.menu-ico-list_song').removeClass('active');
     $('.menu').toggleClass('active');
     $('.playlist_current_menu').removeClass('active');

 }
  function show_hide_list_song() {
     var containerDiv = $(".amp-playlist-picker");
     $('.menu-ico').removeClass('active');
     $('.menu-ico-list_song').toggleClass('active');
     $('.playlist_current_menu').toggleClass('active');
     $('.menu').removeClass('active');

 }
 function selected_playlist(item_playlist) {
     var albumId = $(item_playlist).attr("data-playlist-id");
     //alert(albumId);
     for (var i = 0; i < window.playlists.length; i++) {
         if (window.playlists[i].albumId == albumId) {
             var album = window.playlists[i].albums[0];
             window.playlistCurrent = albumId;
             window.Jplayer.setPlaylist(album.songs);
             $("ul.menu-list .container-album").each(function(index, value) {
                $(this).find('.content-album').removeClass('active');
             });
             $('.content-album h4').text(album.playlist);
             $('.bgCont .bg').css('background-image', 'url("'+album.img_cover+'")');
             $('.album-large .art').css('background-image', 'url("'+album.img_cover+'")');
             $(item_playlist).find('.content-album').addClass('active');
             $(".amp-info-playlist .amp-name-album").text(window.playlists[i].albums[0].playlist);
             $(".price_album").text(window.playlists[i].price);
             show_hide_Playlist();
             break;
         }
     }
 }
 function checkox_buy(element) {
     var Item_element = $(element).parent().parent();
     var songId = $(Item_element).attr("data-song-id");
     // get song from playlist
     var playlist;
     var song;
     for (var i = 0; i < window.playlists.length; i++) {
         if (window.playlistCurrent == window.playlists[i].albumId) {
             playlist = window.playlists[i];
             for (var j = 0; j < window.playlists[i].albums[0].songs.length; j++) {
                 if (songId == window.playlists[i].albums[0].songs[j].songId) {
                     song = window.playlists[i].albums[0].songs[j];
                 }
             }
         }
     }
     if (element.checked) {
        Add_cart(song);
     } else {
        Del_cart(song);
     }
 }
 function Add_cart(song) {
     var songInCart = false;
     for (var i = 0; i < window.songsInCart.length; i++) {
         var thisSong = window.songsInCart[i];
         if (thisSong.songId == song.songId) {
             songInCart = true;
             break;
         }
     }
     if (!songInCart) {
         window.songsInCart.push(song);
     }
    updatePrice();

 }

 function Del_cart(song) {

     var songInCart = false;
     for (var i = 0; i < window.songsInCart.length; i++) {
         var thisSong = window.songsInCart[i];
         if (thisSong.songId == song.songId) {
             songInCart = true;
             window.songsInCart.splice(i, 1);
             break;
         }
     }
     updatePrice();

 }
 function updatePrice() {
     var cartTotalPrice = 0;
     for (var i = 0; i < window.songsInCart.length; i++) {
         cartTotalPrice += parseFloat(window.songsInCart[i].price);
     }
     var playlist;
     for (var i = 0; i < window.playlists.length; i++) {
         if (window.playlistCurrent == window.playlists[i].albumId) {
             playlist = window.playlists[i];
             break;
         }
     }
     if (playlist && playlist.albums[0].price > 0) {

         // check if whole list selected - for "album" price
         if (window.songsInCart.length == playlist.albums[0].songs.length) {
             cartTotalPrice = parseFloat(playlist.albums[0].price);
         }
     }
     $(".buybtn .price-hidden-text").text("$" + cartTotalPrice.toFixed(2));
 }

 function click_cart_songs(){
    var songIdList = "";
    var userIdList = "";
    var albumId = "";
    for (var i = 0; i < window.songsInCart.length; i++) {
        if (i > 0) {
            songIdList = songIdList + ",";
            userIdList = userIdList + ",";
        }
        songIdList = songIdList + window.songsInCart[i].songId;
        userIdList = userIdList + window.songsInCart[i].userId;
        albumId = window.songsInCart[i].albumId;
    }
    if (songIdList.length > 0) {
        if (window.affiliateId && window.affiliateId > 0) {
            redirect(DOMAIN + "map/buycart", {
                affiliateid: window.affiliateId,
                buy_uid: userIdList,
                album_id: albumId,
                buy_song_id: songIdList
            }, "POST", "_blank");
        }else {
            redirect(DOMAIN + "map/buycart", {
                buy_uid: userIdList,
                album_id: albumId,
                buy_song_id: songIdList,
                affiliateId: window.affiliateId
            }, "POST", "_blank");
        }

    }
 }
 function click_all_cart(){
    $(".playlist_current_menu  ul li input:checkbox").each(function(index, value) {
        $(value).prop("checked", true);
        checkox_buy($(value).get(0));
        click_cart_songs();
    });
 }
 function click_become_affiliate(){
    var list = [];
    for (var i = 0; i < window.playlists.length; i++) {
         list.push(window.playlists[i].albumId);
    }
    redirect(DOMAIN + "account/register/affliate", {
        affiliateId: window.affiliateId,
        playlits: list
    }, "POST", "_blank");
 }
 function redirect(url, values, method, target) {
    method = (method && method.toUpperCase() === 'GET') ? 'GET' : 'POST';

    if (!values) {
        var obj = parseUrl(url);
        url = obj.url;
        values = obj.params;
    }

    var form = $('<form>')
      .attr("method", method)
      .attr("action", url);

    if (target) {
      form.attr("target", target);
    }

    iterateValues(values, [], form);
    $('body').append(form);
    form[0].submit();
}
function parseUrl(url) {
    if (url.indexOf('?') === -1) {
        return {
            url: url,
            params: {}
        };
    }
    var parts = url.split('?'),
        query_string = parts[1],
        elems = query_string.split('&');
    url = parts[0];

    var i, pair, obj = {};
    for (i = 0; i < elems.length; i+= 1) {
        pair = elems[i].split('=');
        obj[pair[0]] = pair[1];
    }

    return {
        url: url,
        params: obj
    };
}
//Private Functions
function getInput(name, value, parent, array) {
    var parentString;
    if (parent.length > 0) {
        parentString = parent[0];
        var i;
        for (i = 1; i < parent.length; i += 1) {
            parentString += "[" + parent[i] + "]";
        }
        if (array) {
          name = parentString + "[]";
        } else {
          name = parentString + "[" + name + "]";
        }
    }
    return $("<input>").attr("type", "hidden")
        .attr("name", name)
        .attr("value", value);
}
function iterateValues(values, parent, form, array) {
    var i, iterateParent = [];
    for (i in values) {
        if (typeof values[i] === "object") {
            iterateParent = parent.slice();
            if (array) {
              iterateParent.push('');
            } else {
              iterateParent.push(i);
            }
            iterateValues(values[i], iterateParent, form, Array.isArray(values[i]));
        } else {
            form.append(getInput(i, values[i], parent, array));
        }
    }
}
