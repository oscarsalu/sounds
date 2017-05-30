var jQueryScriptLoaded = false;
var redirectScriptLoaded = false;
var marqueeScriptLoaded = false;
var mediaElementScriptsLoaded = false;
if (window.jQuery) {
    if (parseFloat(jQuery.fn.jquery) < 1.5) {

<<<<<<< .mine
||||||| .r1164
 if (window.jQuery) {
     if (parseFloat(jQuery.fn.jquery) < 1.5) {

         var jq = document.createElement('script');
         jq.type = 'text/javascript';
         jq.onload = function() {
             jQueryScriptLoaded = true;
         }
         jq.src = 'http://lebel.club/assets/map/js/jquery1.9.js';
         document.getElementsByTagName('head')[0].appendChild(jq);
     } else {
         jQueryScriptLoaded = true;
     }
 } else {
=======
 if (window.jQuery) {
     if (parseFloat(jQuery.fn.jquery) < 1.5) {

         var jq = document.createElement('script');
         jq.type = 'text/javascript';
         jq.onload = function() {
             jQueryScriptLoaded = true;
         }
         jq.src = 'http://99sound.com/assets/map/js/jquery1.9.js';
         document.getElementsByTagName('head')[0].appendChild(jq);
     } else {
         jQueryScriptLoaded = true;
     }
 } else {
>>>>>>> .r1183
     var jq = document.createElement('script');
     jq.type = 'text/javascript';
     jq.onload = function() {
         jQueryScriptLoaded = true;
     }
<<<<<<< .mine
     jq.src = 'http://localhost/99project/assets/map/js/jquery1.9.js';
||||||| .r1164
     jq.src = 'http://lebel.club/assets/map/js/jquery1.9.js';
=======
     jq.src = 'http://99sound.com/assets/map/js/jquery1.9.js';
>>>>>>> .r1183
     document.getElementsByTagName('head')[0].appendChild(jq);
 } else {
     jQueryScriptLoaded = true;
 }
} else {
 var jq = document.createElement('script');
 jq.type = 'text/javascript';
 jq.onload = function() {
     jQueryScriptLoaded = true;
 }
 jq.src = 'http://localhost/99project/assets/map/js/jquery1.9.js';
 document.getElementsByTagName('head')[0].appendChild(jq);
}
 runPlayer();
 function runPlayer() {
     if (jQueryScriptLoaded) {
         $wmplayer = jQuery.noConflict();
<<<<<<< .mine
         $wmplayer('head').append('<link type="text/css" rel="stylesheet" href="http://localhost/99project/assets/map/css/map.css" />');
         $wmplayer('head').append('<link href="http://localhost/99project/assets/map/css/map_playlist.css" rel="stylesheet" type="text/css" />');
         $wmplayer.getScript("http://localhost/99project/assets/map/js/jquery.redirect.js", function() {
||||||| .r1164
         $wmplayer('head').append('<link type="text/css" rel="stylesheet" href="http://lebel.club/assets/map/css/map.css" />');
         $wmplayer('head').append('<link href="http://lebel.club/assets/map/css/map_playlist.css" rel="stylesheet" type="text/css" />');
         $wmplayer.getScript("http://lebel.club/assets/map/js/jquery.redirect.js", function() {
=======
         $wmplayer('head').append('<link type="text/css" rel="stylesheet" href="http://99sound.com/assets/map/css/map.css" />');
         $wmplayer('head').append('<link href="http://99sound.com/assets/map/css/map_playlist.css" rel="stylesheet" type="text/css" />');
         $wmplayer.getScript("http://99sound.com/assets/map/js/jquery.redirect.js", function() {
>>>>>>> .r1183
             redirectScriptLoaded = true;
         });
<<<<<<< .mine
         $wmplayer.getScript("http://localhost/99project/assets/map/js/jquery.marquee.min.js", function() {
||||||| .r1164
         $wmplayer.getScript("http://lebel.club/assets/map/js/jquery.marquee.min.js", function() {
=======
         $wmplayer.getScript("http://99sound.com/assets/map/js/jquery.marquee.min.js", function() {
>>>>>>> .r1183
             marqueeScriptLoaded = true;
         });
<<<<<<< .mine
         $wmplayer.getScript("http://localhost/99project/assets/map/js/mediaelement-and-player.js", function() {
             $wmplayer.getScript("http://localhost/99project/assets/map/js/mep-feature-playlist-0.91.js", function() {
||||||| .r1164
         $wmplayer.getScript("http://lebel.club/assets/map/js/mediaelement-and-player.js", function() {
             $wmplayer.getScript("http://lebel.club/assets/map/js/mep-feature-playlist-0.91.js", function() {
=======
         $wmplayer.getScript("http://99sound.com/assets/map/js/mediaelement-and-player.js", function() {
             $wmplayer.getScript("http://99sound.com/assets/map/js/mep-feature-playlist-0.91.js", function() {
>>>>>>> .r1183
                 mediaElementScriptsLoaded = true;
             });
         });
     } else {
         setTimeout("runPlayer()", 50);
     }
 }



 /** PLAYER SETTINGS - HTML5 and Flash **/

 document.buyColorOff = "FFFFFF";
 document.buyColorOver = "FF0000";
 document.buyColorDown = "FFFFFF";
 document.buyColorHit = "000000";

 document.orderText = "CLICK HERE TO ORDER";
 document.affiliateText = "To Become An Affiliate";
 
 document.background_color = "9E0000";
 document.colorPlayerButtons = "9E0000";
 document.color_tordertextime_loaded = "fff";
 document.colorTrackFront = "9E0000";
 document.colorVolFront = "FFFFFF";
 document.colorFont = "FFFFFF";
 document.colorTimeText = "FFFFFF";
 document.colorTitleText = "FFFFFF";
 document.colorEqualizer = "FF0000";

 document.autostart = false;
 document.fadeSound = false;

 document.playlistUserId = 36;
 document.playlistAlbumIds = "2";

 document.playerWidth = 400;
 document.playerHeight = 300;

 document.playerLoopCount = 0;
 document.playlistLoopCount = 0;
 

 function setDocumentVariables(affiliateId) {
     if (jQueryScriptLoaded) {
        $wmplayer = jQuery.noConflict();
        $wmplayer.ajax({
         type: "GET",
<<<<<<< .mine
         url: "http://localhost/99project/map/get_option_widget?affiliateid="+affiliateId ,
||||||| .r1164
         url: "http://lebel.club/map/get_option_widget?affiliateid="+affiliateId ,
=======
         url: "http://99sound.com/map/get_option_widget?affiliateid="+affiliateId ,
>>>>>>> .r1183
         dataType: "text",
         success: function(datatest) {
                var  obj_data = JSON.parse(datatest);
                console.log(obj_data);
                document.background_color = obj_data.background_color;
                document.colorTrackFront = obj_data.color_track_front;
                document.colorFont = obj_data.color_font;
                document.orderText = obj_data.ordertext;
                document.affiliatetext = obj_data.affiliatetext;
                document.playlistAlbumIds = obj_data.playlistAlbumIds;
                document.autostart = obj_data.autostart;
                document.playlistUserId = obj_data.playlistUserId;
                document.affiliateId = affiliateId;
                loadMusicPlayer();
             }
         }); 
         
    }else{
        setTimeout("setDocumentVariables('"+affiliateId+"')", 50);
    }
    
 }
 function toggleSelectPlaylist(playlistListClass) {
     var selectPlaylist = $wmplayer("." + playlistListClass);
     if (selectPlaylist.is(":visible")) {
         $wmplayer("." + playlistListClass).hide();
         $wmplayer(".mejs-playlist-selector").css("height", "42px");
         $wmplayer(".mejs-playlist-selector a.button-link").text("Select Playlist");
     } else {
         $wmplayer("." + playlistListClass).show();
         $wmplayer(".mejs-playlist-selector").css("height", "42px");
         $wmplayer(".mejs-playlist-selector a.button-link").text("Cancel");
     }

 }
function load_data_options(autostart ,playlistAlbumIds ,playlistUserId ,affiliateId ,background_color ,color_track_front ,color_font ,color_time_loaded ,orderText ,affiliatetext) {
     
    document.autostart = autostart;
    document.playlistAlbumIds = playlistAlbumIds;
    document.playlistUserId = playlistUserId;
    document.affiliateId = affiliateId;
    document.background_color = background_color;
    document.colorTrackFront = color_track_front;
    document.colorFont = color_font;
    document.color_time_loaded = color_time_loaded;
    document.orderText = orderText;
    document.affiliateText = affiliatetext;
    loadMusicPlayer();
}
function loadMusicPlayer() {
    if (jQueryScriptLoaded) {
        $wmplayer = jQuery.noConflict();
        if ($wmplayer("#musicplayer_loading").get(0) == undefined) {
<<<<<<< .mine
             $wmplayer("#musicplayer").after("<div id='musicplayer_loading'><img src='http://localhost/99project/assets/map/img/loading-gif.gif'></div>");
||||||| .r1164
             $wmplayer("#musicplayer").after("<div id='musicplayer_loading'><img src='http://lebel.club/assets/map/img/loading-gif.gif'></div>");
=======
             $wmplayer("#musicplayer").after("<div id='musicplayer_loading'><img src='http://99sound.com/assets/map/img/loading-gif.gif'></div>");
>>>>>>> .r1183
         }
         document.playlistArray = document.playlistAlbumIds.split(",");
         document.playlistToLoad = document.playlistArray[0];
         document.playlists = [];
         for (var i = 0; i < document.playlistArray.length; i++) {
             var playlist = {};
             playlist.userId = document.playlistUserId;
             playlist.albumId = document.playlistArray[i];
             playlist.loaded = false;
             document.playlists.push(playlist);
         }
         document.flashPlaylist = "";
         for (var i = 0; i < document.playlists.length; i++) {
             if (i > 0) {
                 document.flashPlaylist = document.flashPlaylist + ",";
             }
             document.flashPlaylist = document.flashPlaylist + document.playlists[i].userId + "_" + document.playlists[i].albumId;
         }
         document.songsInCart = [];
         loadPlaylists();
    }else{
        setTimeout("loadMusicPlayer()", 50);
    }
     
 }
 function loadPlaylists() {
     for (var i = 0; i < document.playlists.length; i++) {
         var playlist = document.playlists[i];
         loadPlaylistSongs(playlist.userId, playlist.albumId);
     }

     /*
     var playlistLoadLoopCounter = 0;
     document.playlistsAllLoaded = false;
     document.playlistLoadError = false;
     */


 }

 function createCORSRequest(method, url) {
     var xhr = new XMLHttpRequest();
     if ("withCredentials" in xhr) {

         // Check if the XMLHttpRequest object has a "withCredentials" property.
         // "withCredentials" only exists on XMLHTTPRequest2 objects.
         xhr.open(method, url, true);

     } else if (typeof XDomainRequest != "undefined") {

         // Otherwise, check if XDomainRequest.
         // XDomainRequest only exists in IE, and is IE's way of making CORS requests.
         xhr = new XDomainRequest();
         xhr.open(method, url);

     } else {

         // Otherwise, CORS is not supported by the browser.
         xhr = null;

     }
     return xhr;
 }

 function loadPlaylistSongs(userId, albumId) {


     $wmplayer.ajax({
         type: "GET",
<<<<<<< .mine
         url: "http://localhost/99project/map/get_audio/"+userId+"/"+albumId,
||||||| .r1164
         url: "http://lebel.club/map/get_audio/"+userId+"/"+albumId,
=======
         url: "http://99sound.com/map/get_audio/"+userId+"/"+albumId,
>>>>>>> .r1183
         dataType: "text",
         success: function(xml) {
             var data = {};
             data.player = {};
             albums = [];
             var player = $wmplayer(xml).filter(":first");

             data.player.showPlaylist = $wmplayer(player).attr('showPlaylist');
             data.player.autoStart = $wmplayer(player).attr('autoStart');

             var album = {};

             album.playlist = $wmplayer(player).attr('playlist');
             album.price = $wmplayer(player).attr('albumprice');
             album.img_cover = $wmplayer(player).attr('img_cover');
             album.totalListened = -1;
             if ($wmplayer(player).attr('total_listened')) {
                 album.totalListened = $wmplayer(player).attr('total_listened');
                
             }
             album.songs = [];             
             $wmplayer(xml).find('song').each(function() {

                 var song = {};
                 song.title = $wmplayer(this).attr('title');
                 song.songId = $wmplayer(this).attr('song_id');
                 song.userId = userId;
                 song.path = $wmplayer(this).attr('path');
                 song.listened = $wmplayer(this).attr('song_listened');
                 song.price = $wmplayer(this).attr('price');
                 song.composer = $wmplayer(this).attr('composer');
                 song.artist = $wmplayer(this).attr('artist');
                 song.currency = $wmplayer(this).attr('currency');
                 song.albumId = albumId;
                 song.albumName = $wmplayer(this).attr('album');
                 album.songs.push(song);

             });

             albums.push(album);


             for (var i = 0; i < document.playlists.length; i++) {

                 if (document.playlists[i].albumId == albumId) {
                     document.playlists[i].albums = albums;
                     document.playlists[i].showPlaylist = data.player.showPlaylist;
                     document.playlists[i].autoStart = data.player.autoStart;
                     document.playlists[i].loaded = true;
                     if (albumId == document.playlistToLoad) {

                         drawPlaylist(document.playlists[i]);
                         loadPlayer(albumId);

                     }
                     break;
                 }
             }


             addPlaylistsToSelector();

             /*
                var changePlaylistsToLoaded = true;
                for (var i = 0; i < document.playlists.length; i++) {
                    if (document.playlists[i].loaded == false) {                            
                        changePlaylistsToLoaded = false;
                        console.log("playlist not loaded");
                        break;
                    }
                }
    
                if (changePlaylistsToLoaded) {
                    document.playlistsAllLoaded = true;
                }
                */


         },
         error: function() {
             document.playlistLoadError = true;
         }
     });

 }

 function addPlaylistsToSelector() {


     if (document.player) {

         var playlistSelectorList = $wmplayer(".mejs-playlist-selector-picker ul");

         $wmplayer(playlistSelectorList).empty();


         var playlistSelectionListHtml = "";

         for (var i = 0; i < document.playlists.length; i++) {

             if (document.playlists[i].albums) {
                 var album = document.playlists[i].albums[0];
                 if (album.songs.length > 0) {
                     playlistSelectionListHtml = playlistSelectionListHtml + "<li data-playlist-id = '" + document.playlists[i].albumId + "'>" + document.playlists[i].albums[0].playlist + "</li>";
                 }
             }

         }

         $wmplayer(playlistSelectorList).append(playlistSelectionListHtml);

         $wmplayer("li", playlistSelectorList).click(function(e) {
             var player = $wmplayer("#mep_0");
             openPlaylist(this);
         });

     } else if (document.playlistLoopCount > 200) {

         // problem with player
         alert("error loading playlists");

     } else {

         document.playlistLoopCount++;
         setTimeout(function() {

             addPlaylistsToSelector();

         }, 500);
     }

 }

 function drawPlaylist(playlist) {

     var audioSourceList = $wmplayer("#musicplayer");
     $wmplayer("#musicplayer").empty();$wmplayer("#mep_0").empty();
     $wmplayer("#musicplayer").css("padding-bottom", "0px");
     $wmplayer("#musicplayer").css("display", "none");

     var song;

     var autoplayAttr = "";
     if (document.autostart) {
         autoplayAttr = "autoplay";
     }

     var playlistHtml = "<audio controls='controls' " + autoplayAttr + ">";

     for (var i = 0; i < playlist.albums[0].songs.length; i++) {
        
         song = playlist.albums[0].songs[i];
         if (i == 0) {
             document.currentSong = song;
         }
         if (song) {
             var escapedTitle = song.title.replace("\"", "\'");
             playlistHtml = playlistHtml + "<source data-id = '" + song.songId + "' src='" + song.path + "' title=\"" + song.title + "\" type='audio/mp3' />";
         }
     }
     playlistHtml = playlistHtml + "</audio>";
     $wmplayer("#musicplayer").append(playlistHtml);
     //console.log( );

 }

 function loadPlayer(albumId) {


     if (redirectScriptLoaded && marqueeScriptLoaded && mediaElementScriptsLoaded) {

         document.currentAlbumId = albumId;

         var playerWidth = document.playerWidth;
         if ($wmplayer(window).width() < (document.playerWidth + 80)) {

             if ($wmplayer(window).width() < 480) {
                 playerWidth = 340;
             } else {
                 playerWidth = 400;
             }
         }
         var playerHeight = document.playerHeight;
         document.player = $wmplayer('audio,video').mediaelementplayer({
             shuffle: false,
             playlist: true,
             playlistselector: true,
             audioWidth: playerWidth,
             playerHeight: playerHeight,
             playlistposition: 'bottom',
             features: [
                 'playlistfeature',
                 'playlistselector',
                 'prevtrack',
                 'playpause',
                 'nexttrack',
                 'shuffle',
                 'loop',
                 'current',
                 'progress',
                 'duration',
                 'volume'
                 
             ]
         });



         updatePrice();


         // chrome (webkit that's not Safari) transformation of checkboxes
         if (navigator.userAgent.toLowerCase().indexOf("chrome") > -1) {
             $wmplayer("#playlist input:checkbox").css("-webkit-transform", "scale(1.4)");
         } else if (navigator.userAgent.toLowerCase().indexOf("webkit") > -1) {
             $wmplayer("#playlist input:checkbox").css("-webkit-transform", "scale(0.9)");
             $wmplayer("#playlist input:checkbox").css("margin-top", "-1px");
         }

         // color customization


         //var rowColor = incrementColor(document.colorTrackFront, 4);

         var rowColor = document.colorTrackFront;
         var backgroundColor = document.color_time_loaded;
         var fontColor = document.colorFont;
         var backgroundMedia = document.background_color;
         //var highlightColor = incrementColor(document.colorTrackFront, -4);
         $wmplayer(".mejs-playlist ul").css("background", "rgba(0, 0, 0, 0.2)");
         $wmplayer(".mejs-mediaelement").css("background-color", backgroundMedia);
         //$wmplayer(".mejs-playlist li").css("background", "#" + rowColor);

         $wmplayer(".mejs-container").css("color", fontColor);
         $wmplayer(".mejs-container").css("color",fontColor);
         $wmplayer("#playlist-selector .playlist-selector a").css("color",fontColor);
         
         $wmplayer(".mejs-playlist li.current").css("color", rowColor);
         
         
         
         $wmplayer("#musicplayer_loading").css("display", "none");
         $wmplayer("#musicplayer").css("display", "");

         // player width / track names
         $wmplayer(".mejs-track-name").css("width", (playerWidth - 140) + "px");

         // player height

         var playerHeight = document.playerHeight;

         $wmplayer("#playlist").css("height", (playerHeight - 130) + "px");
         $wmplayer("#musicplayer").css("height", (playerHeight + 20) + "px");


     } else if (document.playerLoopCount > 200) {

         // problem with player
         alert("error loading player");

     } else {

         document.playerLoopCount++;

         setTimeout(function() {

             loadPlayer(albumId);

         }, 50);
     }

 }

 function incrementColor(color, step) {
     var colorToInt = parseInt(color.substr(1), 16), // Convert HEX color to integer
         nstep = parseInt(step); // Convert step to integer
     if (!isNaN(colorToInt) && !isNaN(nstep)) { // Make sure that color has been converted to integer
         colorToInt += nstep; // Increment integer with step
         var ncolor = colorToInt.toString(16); // Convert back integer to HEX
         ncolor = '#' + (new Array(7 - ncolor.length).join(0)) + ncolor; // Left pad "0" to make HEX look like a color
         if (/^#[0-9a-f]{6}$/i.test(ncolor)) { // Make sure that HEX is a valid color
             return ncolor;
         }
     }
     return color;
 }

 function openPlaylist(playlistListElement) {
     // get playlist
     var albumId = $wmplayer(playlistListElement).attr("data-playlist-id");

     for (var i = 0; i < document.playlists.length; i++) {
         if (document.playlists[i].albumId == albumId) {
             drawPlaylist(document.playlists[i]);
             loadPlayer(albumId);
         }
     }
 }

 function toggleSong(checkbox) {

     var songListItem = $wmplayer(checkbox).parent().parent().parent();
     var songId = $wmplayer(songListItem).attr("data-id");

     // get song from playlist
     var playlist;
     var song;
     for (var i = 0; i < document.playlists.length; i++) {
         if (document.currentAlbumId == document.playlists[i].albumId) {
             playlist = document.playlists[i];
             for (var j = 0; j < document.playlists[i].albums[0].songs.length; j++) {
                 if (songId == document.playlists[i].albums[0].songs[j].songId) {
                     song = document.playlists[i].albums[0].songs[j];
                 }
             }
         }
     }

     if (checkbox.checked) {
         addSongToCart(song);
     } else {
         removeSongFromCart(song);
     }

 }

 function addSongToCart(song) {
     var songInCart = false;
     for (var i = 0; i < document.songsInCart.length; i++) {
         var thisSong = document.songsInCart[i];
         if (thisSong.songId == song.songId) {
             songInCart = true;
             break;
         }
     }
     if (!songInCart) {
         document.songsInCart.push(song);
     }
     updatePrice();

 }

 function removeSongFromCart(song) {

     var songInCart = false;
     for (var i = 0; i < document.songsInCart.length; i++) {
         var thisSong = document.songsInCart[i];
         if (thisSong.songId == song.songId) {
             songInCart = true;
             document.songsInCart.splice(i, 1);
             break;
         }
     }
     updatePrice();

 }

 function updatePrice() {
     var cartTotalPrice = 0;
     for (var i = 0; i < document.songsInCart.length; i++) {
         cartTotalPrice += parseFloat(document.songsInCart[i].price);
     }

     var playlist;
     for (var i = 0; i < document.playlists.length; i++) {
         if (document.currentAlbumId == document.playlists[i].albumId) {
             playlist = document.playlists[i];
             break;
         }
     }

     if (playlist && playlist.albums[0].price > 0) {

         // check if whole list selected - for "album" price
         if (document.songsInCart.length == playlist.albums[0].songs.length) {

             cartTotalPrice = parseFloat(playlist.albums[0].price);

         }
     }

     $wmplayer("#cartRow .cart-price").text("$" + cartTotalPrice.toFixed(2));

 }