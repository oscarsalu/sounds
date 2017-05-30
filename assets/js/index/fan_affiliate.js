 function playTrailer(index) {
        if(index == jwplayer().getPlaylistIndex()){
            if(jwplayer().getState()=='PAUSED'||jwplayer().getState()=='IDLE'){
                jwplayer("mp3").play();
            }
            if(jwplayer().getState()=='PLAYING'){
                jwplayer("mp3").pause();
            }    
        }else{
            jwplayer().playlistItem(index);
        }
    }
    $(document).ready(function() {
        $('.song-player').on('click','.btn-addlyrics', function (){
            var parent = $(this).parent().parent();
            var id = parent.find('.id').val();
            $('#addlyrics .id_song').val(id); 
        });
        $('.song-player').on('click','.btn-viewlyrics', function (){
            var parent = $(this).parent().parent();
            var lyrics = parent.find('.lyrics').val();
            var song_name = parent.find('.song_name').val();
            $('#viewlyrics .lyrics-view').text(lyrics); 
            $('#viewlyrics .song_name').text(song_name); 
        });
    }) 