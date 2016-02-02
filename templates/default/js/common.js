$(function(){
    $('#search').on('submit', function(e){
        if ($('#search_query').val() === '') {
            e.preventDefault();
        } else if ($('#search_query').val().length < 3) {
            e.preventDefault();
        } else {
            $(this).attr('action', '/search/'+$('#search_query').val());
        }
    });
    
    $(document).on('click tap', '.b-like-off', function(e){
        e.preventDefault();
        $('#sign_in_btn').trigger('click');
    });
});