 $(document).ready(function() {
 	$(".search").keyup(function() {
 		var searchTerm = $(".search").val();
 		var listItem = $('.results tbody').children('tr');
 		var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
 		$.extend($.expr[':'], {
 			'containsi': function(elem, i, match, array) {
 				return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
 			}
 		});
 		$(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
 			$(this).css('visibility', 'hidden');
 		});
 		$(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
 			$(this).css('visibility', 'visible');
 		});
 		var jobCount = $('.results tbody tr[style="visibility: visible;"]').length;
 		$('.counter').text(jobCount + ' item');
 		if (jobCount == '0') {
 			$('.no-result').show();
 		} else {
 			$('.no-result').hide();
 		}
 	});
 	$('#event_mn').on('click', '.btn-edit', function() {
 		var id = $(this).find('.event_id').val();
 		var title = $(this).find('.event_title').val();
 		var des = $(this).find('div').html();
 		var post = $(this).find('.posted_by').val();
 		var start_date = $(this).find('.event_start_date').val();
 		var end_date = $(this).find('.event_end_date').val();
 		var location = $(this).find('.location').val();
 		var banner = $(this).find('.banner').val();
 		var cates = $(this).find('.cats').val();
 		$('#editEvents').attr('action', 'gigs_events/update/' + id);
 		$('#id').val(id);
 		$('select>option:eq(' + cates + ')').prop('selected', true);
 		$('#title').val(title);
 		$(".nicEdit-main").html(des);
 		$("#post_by").val(post);
 		$("#event_start_date").val(start_date);
 		$("#event_end_date").val(end_date);
 		$("#loca").val(location);
 	});
 	$('#event_mn').on('click', '.btn-danger', function() {
 		if (confirm("Are you sure you want to delete this record?")) {
 			var id = $(this).find('#id_delete').val();
 			$.ajax({
 				url: page_url + 'artist/gigs_events/delete',
 				type: "post",
 				data: {
 					"id": id,
 					"csrf_test_name": $records_per_page
 				},
 				dataType: "text",
 				success: function(response) {
 					location.reload();
 				}
 			});
 		}
 	});
    $('#update_event').click(function() {
     	var des = $('.nicEdit-main').text();
     	$('#er-des').hide();
     	if (des == "") {
     		$('#er-des').css('color', 'red').text('Field required');
     		$('#er-des').show();
     	}
     });
 });
 bkLib.onDomLoaded(function() {
 	new nicEditor({
 		fullPanel: true,
 		iconsPath: page_url + 'assets/js/editor/nicEditorIcons.gif'
 	}).panelInstance('description');
 	$('.nicEdit-panelContain').parent().width('380px');
 	$('.nicEdit-panelContain').parent().next().width('380px');
 	$('.nicEdit-main').parent().width('378px');
 	$('.nicEdit-main').css('width', '370px');
 });
 $('#event_start_date').datepicker({
    format: "yyyy-mm-dd "+getHora()
}); 
$('#event_end_date').datepicker({
    format: "yyyy-mm-dd "+getHora()
}); 
function getHora() {
    date = new Date();
    return date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
};    