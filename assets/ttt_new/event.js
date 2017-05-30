$(document).on('change', '.selecteventlocation', function()
{
    location_id = $(this).val();
    get_manager_event_view_tour_location(tour_id, location_id);
});
console.log("Event.js");