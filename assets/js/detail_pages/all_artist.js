
$('#all_artist').click(function() {
	window.location.href = $url + 'artists';
});
$current_page = 0;
load_data(0);
function load_data(page) {
	$.ajax({
		url: $url + "artists/ajax_data",
		type: "get",
		data: {
			"page": page,
			'csrf_test_name': get_csrf_hash
		},
		dataType: "text",
		beforeSend: function() {
			$("#load_ajax").append("<span class='col-md-12 load' style='position:fixed;text-align: center;bottom:240px;z-index:3;'><img width='60' src=" + $url + 'assets/images/loading3.gif' + " style='margin-top:-25px;min-height:60px;' /></span>");
			$(".load").show();
		},
		complete: function() {
			$(".load").hide();
		},
		success: function(response) {
		      $("#load_ajax").append(response);
              $current_page++;
		}
	});
}

$a = 0;
$(window).scroll(function() {
	var scrolling = $(window).scrollTop() + window.innerHeight;
	if (scrolling >= $(document).height()) {
		if ($("#check_homepage").val() == 1) {
			load_data($current_page);
		} 
	}
});
$('#load_ajax').delegate('.event2', 'mouseenter mouseleave', function(e) {
	if (e.type == 'mouseenter') {
		$height = $(this).height() - 112;
		$width = $(this).width() - 2;
		if ($(window).width() < 995) {
			$height = $height;
		}
		$song_user = $(this).find('.song').val();
		$son = '"' + $song_user + '"';
		$song_playing = $('#mp3_media').find('video').attr('src');
		if ($(this).find('.ps-pause').length > 0) {
		} else {
		  if($song_user){
		      $(this).append("<span class='display_sp' style='height:" + $height + "px;width:" + $width + "px;z-index:9999; position:absolute;top:0;left:0;'><a onclick='javascript:playTrailer(" + $son + ",$(this))' id='play_cover' class='ps-img ps-play' style='cursor: pointer;position:absolute;bottom:-110px;left:47%;height:40px;width:40px;min-height:40px;'><p style='display:none;'>" + $son + "</p></a></div>");
		  } 
		}
		//$(this).find('.about-artist').css('border-bottom','2px solid #fff');    
	} else if (e.type == 'mouseleave') {
		//$(this).find($(".display_sp")).remove();
		if ($(this).find('.ps-pause').length > 0) {
		} else {
			$(this).find($(".display_sp")).fadeOut("slow");
		}
		$(this).find('.about-artist').css('border-bottom', 'none');
	}
});
$('.nav-genre').delegate('#dropdownMenu1', 'mouseenter mouseleave', function(e) {
	if (e.type == 'mouseenter') {
		$('.dropdown-menu').css('background', '#fff');
		$('.dropdown-menu').css('color', '#000');
		$(this).css('background', '#fff');
		$(this).css('color', 'black');
		$(this).css('font-weight', 'bold');
	} else if (e.type == 'mouseleave') {
		$(this).css('background', 'none');
		$(this).css('color', '#fff');
	}
});
$('.nav-genre').delegate('.dropdown-menu', 'mouseenter mouseleave', function(e) {
	if (e.type == 'mouseenter') {
		$('#dropdownMenu1').css('background', '#fff');
		$('#dropdownMenu1').css('color', '#000');
		$('.dropdown-menu li a').css('font-weight', 'bold');
	} else if (e.type == 'mouseleave') {
		$('#dropdownMenu1').css('background', 'none');
		$('#dropdownMenu1').css('color', '#fff');
	}
});
$('#search').click(function() {
    $("#load_ajax").empty();
	$name = $("#name").val();
	$genre = $('#genre').val();
	$location = $('#location').val();
	$instrument = $('#instrument').val();
	//$('.player-fixed').css('display','none'));
	$('#check_homepage').val(0);
	if ($('#load_ajax .rm-found').html() != null) {
		$("#load_ajax .event").remove();
		$("#load_ajax .rm-found").remove();
	}
	$("#load_ajax .event").remove();
	if ($name == "" && $genre == "" && $location == "" && $instrument == "") {
		$("#load_ajax").append("<div class='col-md-12 rm-found n-padding text-center' style='z-index:1;color:#fff;margin-top: 21px;'><h1>Not Have Artist Of This Genre!<h1></div>");
	} else {
		$.ajax({
			url: $url + "artists/get_total_rows",
			type: "get",
			data: {
				"genre": $genre,
				"home_page": $name,
				"countries": $location,
				"instrument": $instrument,
				"csrf_test_name": get_csrf_hash
			},
			dataType: "text",
			success: function(response) {
				$current_pages = 0;
				load_data_renge($current_pages, $genre, $name, $location, $instrument);
				function load_data_renge(page, $genre, $name, $location, $instrument) {
					$.ajax({
						url: base_url + "artists/search_artists",
						type: "get",
						data: {
							"page": page,
							"genre": $genre,
							"home_page": $name,
							"countries": $location,
							"instrument": $instrument,
							'csrf_test_name': get_csrf_hash
						},
						dataType: "text",
						beforeSend: function() {
							$("#load_ajax").append("<span class='col-md-12 load' style='position:fixed;text-align: center;bottom:240px;z-index:3;'><img width='60' src=" + $url + 'assets/images/loading3.gif' + " style='margin-top:-25px;min-height:60px;' /></span>");
							$(".load").show();
						},
						complete: function() {
							$(".load").hide();
                            
						},
						success: function(response) {
						    $("#load_ajax").append(response);  
                            $current_pages++;
						}
					});
				}
				$(window).scroll(function() {
					var scrolling = $(window).scrollTop() + window.innerHeight;
					if (scrolling >= $(document).height()) {
						load_data_renge($current_pages, $genre, $name, $location, $instrument);
					}
				});
			}
		});
	}
});

function playTrailer(link, o) {
	$link = link;
	o.removeClass("ps-play");
	if ($('.ps-pause').length > 0) {
		//alert($('.ps-pause').length);
		$('#load_ajax').find(".ps-pause").remove();
	}
	o.addClass("ps-pause");
	jwplayer("mp3").setup({
		stretching: 'fill',
		file: $link,
		height: 40,
		width: "100%",
		events: {
			onPause: function(event) {
				o.removeClass("ps-pause");
				o.addClass("ps-play");
			},
			onPlay: function(event) {                                      
				if (jwplayer().getState() == 'paused' || jwplayer().getState() == 'idle') {
					jwplayer("mp3").pause();
				}
			}
		}
	});
	if ($('.ps-pause').length == 0) {
		jwplayer("mp3").stop();
	} else {
		jwplayer("mp3").play();
	}
	$('.close-mp3').css('display', 'block');
	$('.player-fixed').fadeIn('slow');
}
$('.close-mp3').click(function(e) {
	jwplayer("mp3").stop();
	$('.player-fixed').fadeOut('slow');
	e.preventDefault();
});
$('.player-fixed').fadeOut('slow');