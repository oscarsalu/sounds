/**
 * @file MediaElement Playlist Feature (plugin).
 * @author Andrew Berezovsky <andrew.berezovsky@gmail.com>
 * Twitter handle: duozersk
 * @author Original author: Junaid Qadir Baloch <shekhanzai.baloch@gmail.com>
 * Twitter handle: jeykeu
 * Dual licensed under the MIT or GPL Version 2 licenses.
 */
(function($) {

    $.extend(mejs.MepDefaults, {
        loopText: 'Repeat On/Off',
        shuffleText: 'Shuffle On/Off',
        nextText: 'Next Track',
        prevText: 'Previous Track',
        playlistText: 'Show/Hide Playlist'
    });

    $.extend(MediaElementPlayer.prototype, {
        // LOOP TOGGLE
        buildloop: function(player, controls, layers, media) {
            var t = this;

            var loop = $('<div class="mejs-button mejs-loop-button ' + ((player.options.loop) ? 'mejs-loop-on' : 'mejs-loop-off') + '">' +
                    '<button type="button" aria-controls="' + player.id + '" title="' + player.options.loopText + '"></button>' +
                    '</div>')
                // append it to the toolbar
                .appendTo(controls)
                // add a click toggle event
                .click(function(e) {
                    player.options.loop = !player.options.loop;
                    $(media).trigger('mep-looptoggle', [player.options.loop]);
                    if (player.options.loop) {
                        loop.removeClass('mejs-loop-off').addClass('mejs-loop-on');
                        //media.setAttribute('loop', 'loop');
                    } else {
                        loop.removeClass('mejs-loop-on').addClass('mejs-loop-off');
                        //media.removeAttribute('loop');
                    }
                });

            t.loopToggle = t.controls.find('.mejs-loop-button');
        },
        loopToggleClick: function() {
            var t = this;
            t.loopToggle.trigger('click');
        },
        // SHUFFLE TOGGLE
        buildshuffle: function(player, controls, layers, media) {
            var t = this;

            var shuffle = $('<div class="mejs-button mejs-shuffle-button ' + ((player.options.shuffle) ? 'mejs-shuffle-on' : 'mejs-shuffle-off') + '">' +
                    '<button type="button" aria-controls="' + player.id + '" title="' + player.options.shuffleText + '"></button>' +
                    '</div>')
                // append it to the toolbar
                .appendTo(controls)
                // add a click toggle event
                .click(function(e) {
                    player.options.shuffle = !player.options.shuffle;
                    $(media).trigger('mep-shuffletoggle', [player.options.shuffle]);
                    if (player.options.shuffle) {
                        shuffle.removeClass('mejs-shuffle-off').addClass('mejs-shuffle-on');
                    } else {
                        shuffle.removeClass('mejs-shuffle-on').addClass('mejs-shuffle-off');
                    }
                });

            t.shuffleToggle = t.controls.find('.mejs-shuffle-button');
        },
        shuffleToggleClick: function() {
            var t = this;
            t.shuffleToggle.trigger('click');
        },
        // PREVIOUS TRACK BUTTON
        buildprevtrack: function(player, controls, layers, media) {
            var t = this;

            var prevTrack = $('<div class="mejs-button mejs-prevtrack-button mejs-prevtrack">' +
                    '<button type="button" aria-controls="' + player.id + '" title="' + player.options.prevText + '"></button>' +
                    '</div>')
                .appendTo(controls)
                .click(function(e) {
                    $(media).trigger('mep-playprevtrack');
                    player.playPrevTrack();
                });

            t.prevTrack = t.controls.find('.mejs-prevtrack-button');
        },
        prevTrackClick: function() {
            var t = this;
            t.prevTrack.trigger('click');
        },
        // NEXT TRACK BUTTON
        buildnexttrack: function(player, controls, layers, media) {
            var t = this;
            var nextTrack = $('<div class="mejs-button mejs-nexttrack-button mejs-nexttrack">' +
                    '<button type="button" aria-controls="' + player.id + '" title="' + player.options.nextText + '"></button>' +
                    '</div>')
                .appendTo(controls)
                .click(function(e) {
                    $(media).trigger('mep-playnexttrack');
                    player.playNextTrack();
                });
            t.nextTrack = t.controls.find('.mejs-nexttrack-button');
        },
        nextTrackClick: function() {;
            var t = this;
            t.nextTrack.trigger('click');
        },
        // PLAYLIST TOGGLE
        buildplaylist: function(player, controls, layers, media) {
            var t = this;


            var playlistToggle = $('<div class="mejs-button mejs-playlist-button ' + ((player.options.playlist) ? 'mejs-hide-playlist' : 'mejs-show-playlist') + '">' +
                    '<button type="button" aria-controls="' + player.id + '" title="' + player.options.playlistText + '"></button>' +
                    '</div>')
                .appendTo(controls)
                .click(function(e) {
                    player.options.playlist = !player.options.playlist;
                    $(media).trigger('mep-playlisttoggle', [player.options.playlist]);
                    if (player.options.playlist) {
                        layers.children('.mejs-playlist').show();
                        playlistToggle.removeClass('mejs-show-playlist').addClass('mejs-hide-playlist');
                    } else {
                        layers.children('.mejs-playlist').hide();
                        playlistToggle.removeClass('mejs-hide-playlist').addClass('mejs-show-playlist');
                    }
                });

            t.playlistToggle = t.controls.find('.mejs-playlist-button');

        },
        playlistToggleClick: function() {
            var t = this;
            t.playlistToggle.trigger('click');
        },
        // PLAYLIST WINDOW
        buildplaylistfeature: function(player, controls, layers, media) {

            // get album price
            var albumPrice = 0;
            var playlist;
            for (var i = 0; i < document.playlists.length; i++) {
                if (document.playlists[i].albums) {

                    if (document.playlists[i].albumId == document.currentAlbumId) {
                        albumPrice = parseFloat(document.playlists[i].albums[0].price);
                        playlist = document.playlists[i];
                    }
                }
            }

            var totalPlaysHtml = "";
            if (playlist.albums[0].totalListened > 0) {
                totalPlaysHtml += ' <span class = "mejs-playlist-total-listened"> Total Plays: ' + playlist.albums[0].totalListened + '</span>';
            }

            var playlistTitleText = playlist.albums[0].playlist.toUpperCase();
            if (playlistTitleText == "DEFAULT") {
                playlistTitleText = "&nbsp;";
            }

            var albumCartRowDisplay = "";
            if (albumPrice == 0) {
                albumCartRowDisplay = "none";
            }



            var playlist =
                $('<div id="playlistContainer" class="mejs-playlist mejs-layer">' +
                    '<div class = "track-info"></div>' +
                    '<div id = "playlist">' +
                    '<div class = "playlist-title">' + playlistTitleText + totalPlaysHtml + '</div>' +
                    '<div class = "playlist-heading">' +
                    '<div style = "float: left; padding-top: 4px; padding-left: 8px">Track Name</div>' +
                    '<div style = "float: right;  text-align: right; padding-top: 4px; padding-right: 8px">Price</div>' +
                    '</div>' +
                    '<br style = "clear: both" />' +
                    '<ul class="mejs"></ul>' +
                    '<div class="mejs-button-action">' +
                    '<div class="mejs-action" id = "albumCartRow" >' +
                    '<div class = "album-order-button" value = "" style="display:' + albumCartRowDisplay + '">' +
                    'Buy This Album for $' + albumPrice.toFixed(2) +
                    '</div>' +
                    '</div>' +
                    '<div class="mejs-action" id = "cartRow" ">' +
                    '<div class = "cart-order-button">' + document.orderText +
                    '<span class = "cart-price">$0.00</span></div>' +
                    '</div>' +
                    '<div class="mejs-action" id = "affialie" >' +
                    '<div class = "affialie-button"> ' + document.affiliateText +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>')
                .appendTo(layers);
            if (!player.options.playlist) {
                playlist.hide();
            }
            if (player.options.playlistposition == 'bottom') {
                //playlist.css('top', player.options.audioHeight + 'px');
            } else {
                //playlist.css('bottom', player.options.audioHeight + 'px');
            }
            /*
            if (player.options.playlistselector) {
      
                $("#playlist").css("margin-top", "20px");
                $("ul.mejs", playlist).css("margin-top", "0px");
            }
            */
            var getTrackName = function(trackUrl) {
                var trackUrlParts = trackUrl.split("/");
                if (trackUrlParts.length > 0) {
                    return decodeURIComponent(trackUrlParts[trackUrlParts.length - 1]);
                } else {
                    return '';
                }
            };

            // calculate tracks and build playlist
            var tracks = [];
            //$(media).children('source').each(function(index, element) { // doesn't work in Opera 12.12
            $('#' + player.id).find('.mejs-mediaelement source').each(function(index, element) {
                if ($.trim(this.src) != '') {
                    var track = {};
                    track.songId = $.trim($(this).attr("data-id"));
                    track.source = $.trim(this.src);
                    if ($.trim(this.title) != '') {
                        track.name = $.trim(this.title);
                    } else {
                        track.name = getTrackName(track.source);
                    }
                    tracks.push(track);
                }
            });
            for (var track in tracks) {

                // get song from playlist
                var playlist;
                var song;
                for (var i = 0; i < document.playlists.length; i++) {
                    if (document.currentAlbumId == document.playlists[i].albumId) {
                        playlist = document.playlists[i];
                        for (var j = 0; j < document.playlists[i].albums[0].songs.length; j++) {
                            if (tracks[track].songId == document.playlists[i].albums[0].songs[j].songId) {
                                song = document.playlists[i].albums[0].songs[j];
                            }
                        }
                    }
                }

                var checkedAttr = "";

                // determine if song is in cart
                for (var i = 0; i < document.songsInCart.length; i++) {
                    if (document.songsInCart[i].songId == song.songId) {
                        checkedAttr = "checked";
                        break;
                    }
                }


                //data-album-id = '" + document.currentAlbumId + "


                var trackHtml = "<li data-id=" + tracks[track].songId + " data-url='" + tracks[track].source + "' title='" + tracks[track].name + "'>";

                trackHtml = trackHtml + "<div style = 'clear: both'>";
                trackHtml = trackHtml + "<div style = 'float: left; width: 27px'><input type = 'checkbox' " + checkedAttr + " onchange = 'toggleSong(this)' /></div>";
                trackHtml = trackHtml + "<div class = 'mejs-track-name' style = 'float: left; padding-top: 4px; width: 78% '>" + tracks[track].name + "</div>";
                trackHtml = trackHtml + "<div style = 'text-align: right; padding-top: 4px;'>" + song.currency + song.price + "</div>";
                trackHtml = trackHtml + "</div>";
                trackHtml = trackHtml + "</li>";

                layers.find('#playlist > ul').append(trackHtml);

                //layers.find('.mejs-playlist > ul').append('<li data-url="' + tracks[track].source + '" title="' + tracks[track].name + '">' + tracks[track].name + '</li>');
            }

            // set the first track as current
            layers.find('li:first').addClass('current played');
            // play track from playlist when clicking it
            layers.find('#playlist > ul li').click(function(e) {
                if (e.target.type != "checkbox") {
                    if (!$(this).hasClass('current')) {
                        $(this).addClass('played');
                        player.playTrack($(this));
                    } else {
                        player.play();
                    }
                }
            });



            $('.cart-order-button').click(function(e) {

                var songIdList = "";
                var userIdList = "";
                var albumId = "";

                for (var i = 0; i < document.songsInCart.length; i++) {
                    if (i > 0) {
                        songIdList = songIdList + ",";
                        userIdList = userIdList + ",";
                    }
                    songIdList = songIdList + document.songsInCart[i].songId;

                    // NOTE: user ids in list will not be unique using this method
                    userIdList = userIdList + document.songsInCart[i].userId;

                    // NOTE: unsure how multiple albums withing same playlist would function, if possible
                    albumId = document.songsInCart[i].albumId;
                }


                if (songIdList.length > 0) {

                    if (document.affiliateId && document.affiliateId > 0) {
                        $.redirect("http://localhost/99project/map/buycart", {
                            affiliateid: document.affiliateId,
                            buy_uid: userIdList,
                            album_id: albumId,
                            buy_song_id: songIdList
                        }, "POST", "_blank");
                    } else {
                        $.redirect("http://localhost/99project/map/buycart", {
                            buy_uid: userIdList,
                            album_id: albumId,
                            buy_song_id: songIdList
                        }, "POST", "_blank");
                    }

                }

            });

            $('.album-order-button').click(function(e) {

                // actually functions as a full playlist selector, not a click-through to the cart

                $("#playlist ul li input:checkbox").each(function(index, value) {
                    $(value).prop("checked", true);
                    toggleSong($(value).get(0));
                });
            });
            $('.affialie-button').click(function(e) {
               
                $.redirect("http://localhost/99project/map/register-affiliate", {
                        affiliateId: document.affiliateId
                    }, "GET", "_blank");

            });

            // when current track ends - play the next one
            media.addEventListener('ended', function(e) {
                player.playNextTrack();
            }, false);
        },
        // PLAYLIST SELECTOR/DROPDOWN
        buildplaylistselector: function(player, controls, layers, media) {

            // get current playlist
            var playlist;
            for (var i = 0; i < document.playlists.length; i++) {
                if (document.playlists[i].albumId == document.currentAlbumId) {
                    playlist = document.playlists[i];
                    break;
                }
            }

            var totalPlaysHtml = "";
            if (playlist.albums[0].totalListened > 0) {
                //totalPlaysHtml += '<div class = "mejs-playlist-total-listened">Total Plays: ' + playlist.albums[0].totalListened + '</div>';
            }

            var playlistSelector = $('<div id = "playlist-selector" class="mejs-playlist-selector mejs-layer">' +
                    '<div class = "playlist-selector">' +
                    '<a href = "JavaScript://" class = "" onclick = "toggleSelectPlaylist(\'mejs-playlist-selector-picker\')">Select Playlist / CDs</a>' +
                    '</div>' +
                    '' +
                    totalPlaysHtml +
                    '<br style = "clear: both" />' +
                    '<div class = "mejs-playlist-selector-picker"></div>' +
                    '</div>')
                .appendTo(layers);
            if (!player.options.playlistselector) {
                playlistSelector.hide();
            }
            $(".mejs-playlist-selector-picker").hide();

            // create playlist selection list
            var playlistSelectionListHtml = "<h4>Available Playlists / CDs</h4><ul class = ''>";


            playlistSelectionListHtml = playlistSelectionListHtml + "</ul>";

            $(".mejs-playlist-selector-picker").append(playlistSelectionListHtml);

            addPlaylistsToSelector();

            /*
        layers.find('.mejs-playlist-selector-picker > ul li').click(function (e) {
				player.openPlaylist(this);
	      });
	     */


        },
        playNextTrack: function() {
            var t = this;
            var tracks = t.layers.find('.mejs-playlist ul li');
            var current = tracks.filter('.current');
            var notplayed = tracks.not('.played');
            if (notplayed.length < 1) {
                current.removeClass('played').siblings().removeClass('played');
                notplayed = tracks.not('.current');
            }
            if (t.options.shuffle) {
                var random = Math.floor(Math.random() * notplayed.length);
                var nxt = notplayed.eq(random);
            } else {
                var nxt = current.next();
                if (nxt.length < 1 && t.options.loop) {
                    nxt = current.siblings().first();
                }
            }
            if (nxt.length == 1) {
                nxt.addClass('played');
                t.playTrack(nxt);
            }
        },
        playPrevTrack: function() {
            var t = this;
            var tracks = t.layers.find('.mejs-playlist ul li');
            var current = tracks.filter('.current');
            var played = tracks.filter('.played').not('.current');
            if (played.length < 1) {
                current.removeClass('played');
                played = tracks.not('.current');
            }
            if (t.options.shuffle) {
                var random = Math.floor(Math.random() * played.length);
                var prev = played.eq(random);
            } else {
                var prev = current.prev();
                if (prev.length < 1 && t.options.loop) {
                    prev = current.siblings().last();
                }
            }
            if (prev.length == 1) {
                current.removeClass('played');
                t.playTrack(prev);
            }
        },
        playTrack: function(track) {

            // loop through album to get actual song
            //document.currentSong = song;

            // get song from playlist
            var playlist;
            for (var i = 0; i < document.playlists.length; i++) {
                if (document.currentAlbumId == document.playlists[i].albumId) {
                    playlist = document.playlists[i];
                    for (var j = 0; j < document.playlists[i].albums[0].songs.length; j++) {
                        if (track.attr('data-id') == document.playlists[i].albums[0].songs[j].songId) {
                            document.currentSong = document.playlists[i].albums[0].songs[j];
                            break;
                        }
                    }
                }
            }

            var t = this;
            t.pause();
            t.setSrc(track.attr('data-url'));
            t.load();
            t.play();
            track.addClass('current').siblings().removeClass('current');
            track.css('color',document.colorTrackFront).siblings().css('color',document.colorFont);
            /*
              // track name ticker
              var trackInfoHtml = "<div class = 'marquee'>" + track[0].title + "</div>";
              $(".track-info").html(trackInfoHtml);
              $(".marquee").marquee();
            */

        },
        playTrackURL: function(url) {
            var t = this;
            var tracks = t.layers.find('.mejs-playlist > ul > li');
            var track = tracks.filter('[data-url="' + url + '"]');
            t.playTrack(track);

        }
    });

})(mejs.$);