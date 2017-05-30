/*
 * Playlist Object for the jPlayer Plugin
 * http://www.jplayer.org
 *
 * Copyright (c) 2009 - 2014 Happyworm Ltd
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/MIT
 *
 * Author: Mark J Panaghiston
 * Version: 2.4.1
 * Date: 19th November 2014
 *
 * Requires:
 *  - jQuery 1.7.0+
 *  - jPlayer 2.8.2+
 */
/*global jPlayerPlaylist:true */
(function($, undefined) {

	jPlayerPlaylist = function(cssSelector, playlist, options) {
		var self = this;

		this.current = 0;
		this.loop = false; // Flag used with the jPlayer repeat event
		this.shuffled = false;
		this.removing = false; // Flag is true during remove animation, disabling the remove() method until complete.

		this.cssSelector = $.extend({}, this._cssSelector, cssSelector); // Object: Containing the css selectors for jPlayer and its cssSelectorAncestor
		//console.log(this.cssSelector.jPlayer);
        $(this.cssSelector.cssSelectorAncestor).append(self._createhtml());
        this.options = $.extend(true, {
			keyBindings: {
				next: {
					key: 221, // ]
					fn: function() {
						self.next();
					}
				},
				previous: {
					key: 219, // [
					fn: function() {
						self.previous();
					}
				},
				shuffle: {
					key: 83, // s
					fn: function() {
						self.shuffle();
					}
				}
			},
			stateClass: {
				shuffled: "jp-state-shuffled"
			}
		}, this._options, options); // Object: The jPlayer constructor options for this playlist and the playlist options

		this.playlist = []; // Array of Objects: The current playlist displayed (Un-shuffled or Shuffled)
		this.original = []; // Array of Objects: The original playlist

		this._initPlaylist(playlist); // Copies playlist to this.original. Then mirrors this.original to this.playlist. Creating two arrays, where the element pointers match. (Enables pointer comparison.)

		// Setup the css selectors for the extra interface items used by the playlist.
		this.cssSelector.details = this.cssSelector.cssSelectorAncestor + " .jp-details"; // Note that jPlayer controls the text in the title element.
		this.cssSelector.playlist = this.cssSelector.cssSelectorAncestor + " .playlist_current_menu";
		this.cssSelector.next = this.cssSelector.cssSelectorAncestor + " .jp-next";
		this.cssSelector.previous = this.cssSelector.cssSelectorAncestor + " .jp-previous";
		this.cssSelector.shuffle = this.cssSelector.cssSelectorAncestor + " .jp-shuffle";
		this.cssSelector.shuffleOff = this.cssSelector.cssSelectorAncestor + " .jp-shuffle-off";

		// Override the cssSelectorAncestor given in options
		this.options.cssSelectorAncestor = this.cssSelector.cssSelectorAncestor;
        
		// Override the default repeat event handler
		this.options.repeat = function(event) {
			self.loop = event.jPlayer.options.loop;
		};
		// Create a ready event handler to initialize the playlist
		$(this.cssSelector.jPlayer).bind($.jPlayer.event.ready, function() {
			self._init();
		}); 
		// Create an ended event handler to move to the next item
		$(this.cssSelector.jPlayer).bind($.jPlayer.event.ended, function() {
			self.next();
		});

		// Create a play event handler to pause other instances
		$(this.cssSelector.jPlayer).bind($.jPlayer.event.play, function() {
			$(this).jPlayer("pauseOthers");
		});

		// Create a resize event handler to show the title in full screen mode.
		$(this.cssSelector.jPlayer).bind($.jPlayer.event.resize, function(event) {
			if(event.jPlayer.options.fullScreen) {
				$(self.cssSelector.details).show();
			} else {
				$(self.cssSelector.details).hide();
			}
		});

		// Create click handlers for the extra buttons that do playlist functions.
		$(this.cssSelector.previous).click(function(e) {
			e.preventDefault();
			self.previous();
			self.blur(this);
		});

		$(this.cssSelector.next).click(function(e) {
			e.preventDefault();
			self.next();
			self.blur(this);
		});

		$(this.cssSelector.shuffle).click(function(e) {
			e.preventDefault();
			if(self.shuffled && $(self.cssSelector.jPlayer).jPlayer("option", "useStateClassSkin")) {
				self.shuffle(false);
			} else {
				self.shuffle(true);
			}
			self.blur(this);
		});
		$(this.cssSelector.shuffleOff).click(function(e) {
			e.preventDefault();
			self.shuffle(false);
			self.blur(this);
		}).hide();

		// Put the title in its initial display state
		if(!this.options.fullScreen) {
			$(this.cssSelector.details).hide();
		}

		// Remove the empty <li> from the page HTML. Allows page to be valid HTML, while not interfereing with display animations
		$(this.cssSelector.playlist + " ul").empty();

		// Create .on() handlers for the playlist items along with the free media and remove controls.
		this._createItemHandlers();

		// Instance jPlayer
		$(this.cssSelector.jPlayer).jPlayer(this.options);
	};

	jPlayerPlaylist.prototype = {
		_cssSelector: { // static object, instanced in constructor
			jPlayer: "#jquery_jplayer_1",
			cssSelectorAncestor: "#jp_container_1"
		},
		_options: { // static object, instanced in constructor
			playlistOptions: {
				autoPlay: false,
				loopOnPrevious: false,
				shuffleOnLoop: true,
				enableRemoveControls: false,
				displayTime: 'slow',
				addTime: 'fast',
				removeTime: 'fast',
				shuffleTime: 'slow',
				itemClass: "jp-playlist-item",
				freeGroupClass: "jp-free-media",
				freeItemClass: "jp-playlist-item-free",
				removeItemClass: "jp-playlist-item-remove"
			}
		},
		option: function(option, value) { // For changing playlist options only
			if(value === undefined) {
				return this.options.playlistOptions[option];
			}

			this.options.playlistOptions[option] = value;

			switch(option) {
				case "enableRemoveControls":
					this._updateControls();
					break;
				case "itemClass":
				case "freeGroupClass":
				case "freeItemClass":
				case "removeItemClass":
					this._refresh(true); // Instant
					this._createItemHandlers();
					break;
			}
			return this;
		},
        _createhtml: function() {
            
            for (var i = 0; i < window.playlists.length; i++) {
                            

                 if (window.playlists[i].albumId==window.playlistCurrent) {
                     var playlistCurrent = window.playlists[i].albums[0];
                   
                     break;
                 }
            }
            $('#jp_container_2').empty();
        
            //console.log(this.cssSelector.jPlayer);
            var Html_amp= 
            '<div class="bgCont">'+
                '<div class="bg" style="background-image: url(&quot;'+playlistCurrent.img_cover+'&quot;)">'+
                '</div>'+
            ' </div>';
            amp_playlist = this.create_html_playlist();
            Html_amp += 
            '<div align="center" class="jp-type-playlist" >'+
                '<div class="menu_header_amp">'+
                    '<div class="menu-ico fa fa-bars" onclick="show_hide_Playlist()">'+
                        '<span></span>'+
                        '<span></span>'+
                    '</div>'+
                    '<div  id="" class=" btn btn-default aff-btn" onclick="click_become_affiliate()" >'+
                       
                             window.affiliatetext +'</div>'+
                        
                  
                    '<div class="menu-ico-list_song fa fa-play-circle-o " onclick="show_hide_list_song()">'+
                        '<span></span>'+
                        '<span></span>'+
                    '</div>'+
                    
                '</div>'+
                '<div class="menu ">'+
                    '<ul class="menu-list">'+
                        amp_playlist +
                    '</ul>'+
                '</div>'+  
                '<div class="playlist_current_menu ">'+
                    '<ul class="playlist-ul">'+
                    '</ul>'+
                    '<div class="amp-controler">'+
                        '<div class="amp-width-6">'+
                            '<div class="buybtn" onclick="click_all_cart()">'+
                                '<span class="buybtn-text">Select All Songs</span>'+
                                '<span class="buybtn-hidden-text">$'+playlistCurrent.price+'</span>'+
                                '<span class="buybtn-image"><span></span></span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="amp-width-6">'+
                            '<div class="buybtn" onclick="click_cart_songs()">'+
                                '<span class="buybtn-text">'+window.orderText+'</span>'+
                                '<span class="price-hidden-text buybtn-hidden-text">$ 0.00</span>'+
                                '<span class="buybtn-image order_btn"><span></span></span>'+
                            '</div>'+
                        '</div>'+
                     '</div>'+
                '</div>'+
                '<div class="jp-playlist">'+
                    '<div class="album-large">'+
                        '<div id="jquery_jplayer_2" class="jp-jplayer"></div>'+
                        '<div class="art" style="background-image: url(&quot;'+playlistCurrent.img_cover+'&quot;);"></div>'+
                        '<div class="content-album"> '+
                            '<h4>'+playlistCurrent.playlist+'</h4>'+
                        '</div>'+    
                    '</div>'+
        		'</div>'+
                '<div class="jp-gui jp-interface">'+
        			'<div class="jp-controls">'+
        				'<button class="jp-previous" role="button" tabindex="0">previous</button>'+
        				'<button class="jp-play" role="button" tabindex="0">play</button>'+
        				'<button class="jp-next" role="button" tabindex="0">next</button>'+
        				//'<button class="jp-stop" role="button" tabindex="0">stop</button>'+
        			'</div>'+
        			'<div class="jp-volume-controls">'+
        				'<button class="jp-mute" role="button" tabindex="0">mute</button>'+
        				'<button class="jp-volume-max" role="button" tabindex="0">max volume</button>'+
        				'<div class="jp-volume-bar">'+
        					'<div class="jp-volume-bar-value"></div>'+
        				'</div>'+
        			'</div>'+
        			'<div class="jp-time-holder">'+
        				'<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>'+
        				'<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>'+
        			'</div>'+
        			'<div class="jp-toggles">'+
        				'<button class="jp-repeat" role="button" tabindex="0">repeat</button>'+
        				'<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>'+
                        '<button class="jp-full-screen" role="button" tabindex="0">full screen</button>'+
        			'</div>'+
                    '<div class="jp-progress">'+
        				'<div class="jp-seek-bar">'+
        					'<div class="jp-play-bar"></div>'+
        				'</div>'+
        			'</div>'+
                                '<div class="copy" style="font-size:10px; margin-top:10px;"><ul>'+
                                '<li style="display:inline; margin-left:-40px;font-size:10px;"><a style="text-decoration:none;color:red;" href="'+base_url+'">'+'99SOUND.COM</a>'+'</li>'+
                                '<li style="display:inline; margin-left:35px;"><a style="text-decoration:none;" href="'+base_url+'footer/terms">'+'Terms & Conditions</a>'+'</li>'+
                                '<li style="display:inline; margin-left:5px;"><a style="text-decoration:none;" href="'+base_url+'footer/copyright">'+' | Copyright</a>'+'</li>'+
                                '<li style="display:inline; margin-left:5px;"><a  style="text-decoration:none;" href="'+base_url+'footer/abuse-policy">'+'| Abuse Policy</a>'+'</li>'+
                                
                    '</ul></div>'+
                '</div>'+
        	'</div>';
            Html_amp += '</div>';
            return Html_amp;
            
        },
        create_html_playlist: function() {
            var li_playlist = '';
            $.each(window.playlists, function(i) {
                if (window.playlists[i].showPlaylist=='yes'){
                    albumId = window.playlists[i].albumId;
                    albumName = window.playlists[i].albums[0].playlist;
                    img_cover =   window.playlists[i].albums[0].img_cover;
                    li_playlist += 
                    '<div class="container-album" data-playlist-id ="'+albumId+'" onclick="selected_playlist(this)">'+
                        '<div class="cover-album" > '+
                            '<img class="alt_img" src="'+img_cover+'" />'+
                        '</div>'+
                        '<div class="content-album"> '+
                            '<span>'+albumName+'</span>'+
                        '</div>'+    
                    '</div>';
                }
            });
            return li_playlist;
        },
		_init: function() {
			var self = this;
			this._refresh(function() {
				if(self.options.playlistOptions.autoPlay) {
					self.play(self.current);
				} else {
					self.select(self.current);
				}
			});
		},
		_initPlaylist: function(playlist) {
			this.current = 0;
			this.shuffled = false;
			this.removing = false;
			this.original = $.extend(true, [], playlist); // Copy the Array of Objects
			this._originalPlaylist();
		},
		_originalPlaylist: function() {
			var self = this;
			this.playlist = [];
			// Make both arrays point to the same object elements. Gives us 2 different arrays, each pointing to the same actual object. ie., Not copies of the object.
			$.each(this.original, function(i) {
				self.playlist[i] = self.original[i];
			});
		},
		_refresh: function(instant) {
			/* instant: Can be undefined, true or a function.
			 *	undefined -> use animation timings
			 *	true -> no animation
			 *	function -> use animation timings and excute function at half way point.
			 */
			var self = this;
			if(instant && !$.isFunction(instant)) {
				$(this.cssSelector.playlist + " ul").empty();
				$.each(this.playlist, function(i) {
					$(self.cssSelector.playlist + " ul").append(self._createListItem(self.playlist[i]));
				});
				this._updateControls();
			} else {
				var displayTime = $(this.cssSelector.playlist + " ul").children().length ? this.options.playlistOptions.displayTime : 0;

				$(this.cssSelector.playlist + " ul").slideUp(displayTime, function() {
					var $this = $(this);
					$(this).empty();
					
					$.each(self.playlist, function(i) {
						$this.append(self._createListItem(self.playlist[i]));
					});
					self._updateControls();
					if($.isFunction(instant)) {
						instant();
					}
					if(self.playlist.length) {
						$(this).slideDown(self.options.playlistOptions.displayTime);
					} else {
						$(this).show();
					}
				});
			}
		},
		_createListItem: function(media) {
			var self = this;

			// Wrap the <li> contents in a <div>
			var listItem = "<li><div data-song-id='"+ media.songId+"' >";

			// Create remove control
			listItem += "<a href='javascript:;' class='" + this.options.playlistOptions.removeItemClass + "'>&times;</a>";

			// Create links to free media
			if(media.free) {
				var first = true;
				listItem += "<span class='" + this.options.playlistOptions.freeGroupClass + "'>(";
				$.each(media, function(property,value) {
					if($.jPlayer.prototype.format[property]) { // Check property is a media format.
						if(first) {
							first = false;
						} else {
							listItem += " | ";
						}
						listItem += "<a class='" + self.options.playlistOptions.freeItemClass + "' href='" + value + "' tabindex='-1'>" + property + "</a>";
					}
				});
				listItem += ")</span>";
			}
            //price
            listItem += "<span class='jp-free-media'  >";
            listItem += "<input type='checkbox' onchange='checkox_buy(this)'/>"
            listItem += "<a class='jp-playlist-item-free' href='#' tabindex='-1' style='color:"+window.colorFont+"'>" + (media.price ? "<span>" + media.price+" "+ media.currency + "</span>" : "") + "</a>";
            listItem += "</span>";
			// The title is given next in the HTML otherwise the float:right on the free media corrupts in IE6/7
			listItem += "<a href='javascript:;' class='" + this.options.playlistOptions.itemClass + "' style='color:"+window.colorFont+"' tabindex='0'><p title="+ media.title+">" + media.title + (media.artist ? " <span class='jp-artist'>by " + media.artist + "</span>" : "") + "</p></a>";
                        //Lyrics button
                        listItem += "<a href='javascript:;' class='" +  " btn btn-primary btn-xs' style='color:"+window.colorFont+"' tabindex='0' id='lyric"+ media.songId+"'>Load Lyrics</a>";
			listItem +="<div id='dialog"+ media.songId+"' title='"+media.title+"'>";
listItem +=media.lyrics;
listItem +="</div>";

listItem += "</div></li>";
listItem +='<script> $( function() {  $( "#dialog'+ media.songId+'" ).dialog({ autoOpen: false,  width: "90%",maxWidth: "768px"}); $( "#lyric'+ media.songId+'" ).on( "click", function() {   $( "#dialog'+ media.songId+'" ).dialog( "open" ); }); } );   </script>';
            self.set_style_color();
			return listItem;
            
		},
        set_style_color: function() {
			 var rowColor = window.colorTrackFront;
             var backgroundColor = window.color_time_loaded;
             var fontColor = window.colorFont;
             var backgroundMedia = window.background_color;
             $(".jp-type-playlist").css("background-color", backgroundMedia);
             $(".jp-volume-bar-value").css("background-color", backgroundColor);
             $(".jp-play-bar").css("background-color", backgroundColor);
             $(".jp-audio").css("color", fontColor);
             $("div.jp-type-playlist div.jp-playlist a").css("color", fontColor);
             
		},
		_createItemHandlers: function() {
			var self = this;
			// Create live handlers for the playlist items
			$(this.cssSelector.playlist).off("click", "a." + this.options.playlistOptions.itemClass).on("click", "a." + this.options.playlistOptions.itemClass, function(e) {
				e.preventDefault();
				var index = $(this).parent().parent().index();
				if(self.current !== index) {
					self.play(index);
				} else {
					$(self.cssSelector.jPlayer).jPlayer("play");
				}
				self.blur(this);
			});

			// Create live handlers that disable free media links to force access via right click
			$(this.cssSelector.playlist).off("click", "a." + this.options.playlistOptions.freeItemClass).on("click", "a." + this.options.playlistOptions.freeItemClass, function(e) {
				e.preventDefault();
				$(this).parent().parent().find("." + self.options.playlistOptions.itemClass).click();
				self.blur(this);
			});

			// Create live handlers for the remove controls
			$(this.cssSelector.playlist).off("click", "a." + this.options.playlistOptions.removeItemClass).on("click", "a." + this.options.playlistOptions.removeItemClass, function(e) {
				e.preventDefault();
				var index = $(this).parent().parent().index();
				self.remove(index);
				self.blur(this);
			});
		},
		_updateControls: function() {
			if(this.options.playlistOptions.enableRemoveControls) {
				$(this.cssSelector.playlist + " ." + this.options.playlistOptions.removeItemClass).show();
			} else {
				$(this.cssSelector.playlist + " ." + this.options.playlistOptions.removeItemClass).hide();
			}

			if(this.shuffled) {
				$(this.cssSelector.jPlayer).jPlayer("addStateClass", "shuffled");
			} else {
				$(this.cssSelector.jPlayer).jPlayer("removeStateClass", "shuffled");
			}
			if($(this.cssSelector.shuffle).length && $(this.cssSelector.shuffleOff).length) {
				if(this.shuffled) {
					$(this.cssSelector.shuffleOff).show();
					$(this.cssSelector.shuffle).hide();
				} else {
					$(this.cssSelector.shuffleOff).hide();
					$(this.cssSelector.shuffle).show();
				}
			}
		},
		_highlight: function(index) {
			if(this.playlist.length && index !== undefined) {
			    $(this.cssSelector.playlist + " .jp-playlist-current").css('color',window.colorFont);
				$(this.cssSelector.playlist + " .jp-playlist-current").removeClass("jp-playlist-current");
				$(this.cssSelector.playlist + " li:nth-child(" + (index + 1) + ")").addClass("jp-playlist-current").find(".jp-playlist-item").addClass("jp-playlist-current");
				// $(this.cssSelector.details + " li").html("<span class='jp-title'>" + this.playlist[index].title + "</span>" + (this.playlist[index].artist ? " <span class='jp-artist'>by " + this.playlist[index].artist + "</span>" : ""));
			}
		},
		setPlaylist: function(playlist) {
			this._initPlaylist(playlist);
			this._init();
		},
		add: function(media, playNow) {
			$(this.cssSelector.playlist + " ul").append(this._createListItem(media)).find("li:last-child").hide().slideDown(this.options.playlistOptions.addTime);
			this._updateControls();
			this.original.push(media);
			this.playlist.push(media); // Both array elements share the same object pointer. Comforms with _initPlaylist(p) system.

			if(playNow) {
				this.play(this.playlist.length - 1);
			} else {
				if(this.original.length === 1) {
					this.select(0);
				}
			}
		},
		remove: function(index) {
			var self = this;

			if(index === undefined) {
				this._initPlaylist([]);
				this._refresh(function() {
					$(self.cssSelector.jPlayer).jPlayer("clearMedia");
				});
				return true;
			} else {

				if(this.removing) {
					return false;
				} else {
					index = (index < 0) ? self.original.length + index : index; // Negative index relates to end of array.
					if(0 <= index && index < this.playlist.length) {
						this.removing = true;

						$(this.cssSelector.playlist + " li:nth-child(" + (index + 1) + ")").slideUp(this.options.playlistOptions.removeTime, function() {
							$(this).remove();

							if(self.shuffled) {
								var item = self.playlist[index];
								$.each(self.original, function(i) {
									if(self.original[i] === item) {
										self.original.splice(i, 1);
										return false; // Exit $.each
									}
								});
								self.playlist.splice(index, 1);
							} else {
								self.original.splice(index, 1);
								self.playlist.splice(index, 1);
							}

							if(self.original.length) {
								if(index === self.current) {
									self.current = (index < self.original.length) ? self.current : self.original.length - 1; // To cope when last element being selected when it was removed
									self.select(self.current);
								} else if(index < self.current) {
									self.current--;
								}
							} else {
								$(self.cssSelector.jPlayer).jPlayer("clearMedia");
								self.current = 0;
								self.shuffled = false;
								self._updateControls();
							}

							self.removing = false;
						});
					}
					return true;
				}
			}
		},
		select: function(index) {
			index = (index < 0) ? this.original.length + index : index; // Negative index relates to end of array.
			if(0 <= index && index < this.playlist.length) {
				this.current = index;
				this._highlight(index);
				$(this.cssSelector.jPlayer).jPlayer("setMedia", this.playlist[this.current]);
			} else {
				this.current = 0;
			}
		},
		play: function(index) {
		  
			index = (index < 0) ? this.original.length + index : index; // Negative index relates to end of array.
			if(0 <= index && index < this.playlist.length) {
				if(this.playlist.length) {
					this.select(index);
					$(this.cssSelector.jPlayer).jPlayer("play");
				}
			} else if(index === undefined) {
				$(this.cssSelector.jPlayer).jPlayer("play");
			}
            
		},
		pause: function() {
			$(this.cssSelector.jPlayer).jPlayer("pause");
		},
		next: function() {
			var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;

			if(this.loop) {
				// See if we need to shuffle before looping to start, and only shuffle if more than 1 item.
				if(index === 0 && this.shuffled && this.options.playlistOptions.shuffleOnLoop && this.playlist.length > 1) {
					this.shuffle(true, true); // playNow
				} else {
					this.play(index);
				}
			} else {
				// The index will be zero if it just looped round
				if(index > 0) {
					this.play(index);
				}
			}
		},
		previous: function() {
			var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;

			if(this.loop && this.options.playlistOptions.loopOnPrevious || index < this.playlist.length - 1) {
				this.play(index);
			}
		},
		shuffle: function(shuffled, playNow) {
			var self = this;

			if(shuffled === undefined) {
				shuffled = !this.shuffled;
			}

			if(shuffled || shuffled !== this.shuffled) {

				$(this.cssSelector.playlist + " ul").slideUp(this.options.playlistOptions.shuffleTime, function() {
					self.shuffled = shuffled;
					if(shuffled) {
						self.playlist.sort(function() {
							return 0.5 - Math.random();
						});
					} else {
						self._originalPlaylist();
					}
					self._refresh(true); // Instant

					if(playNow || !$(self.cssSelector.jPlayer).data("jPlayer").status.paused) {
						self.play(0);
					} else {
						self.select(0);
					}

					$(this).slideDown(self.options.playlistOptions.shuffleTime);
				});
			}
		},
		blur: function(that) {
			if($(this.cssSelector.jPlayer).jPlayer("option", "autoBlur")) {
				$(that).blur();
			}
		}
	};
})(jQuery);
