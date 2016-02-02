(function(w, $, u){
    $(function(){
        
        $('#search_btn').on('click', function(e){
            e.preventDefault();
            $('#search').trigger('submit');
        });
        
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
        }).on('click tap', '.fa-heart-o.b-like-on', function(e){
            var id      = $(this).data('id');
            if (id!== u){
                $(this).replaceWith('<i id="tmp_spinner" class="fa fa-spinner fa-spin" />');
                $.get('/like/'+$(this).data('id'), {}, function(data){
                    if (data == 'like'){
                        $('#tmp_spinner').replaceWith('<i data-id="'+id+'" class="fa fa-heart b-like b-like-on" />');
                    }
                }).error(function(){w.location.href = '/404'});
            }
        }).on('click tap', '.fa-heart.b-like-on', function(e){
            var id      = $(this).data('id');
            if (id!== u){
                $(this).replaceWith('<i id="tmp_spinner" class="fa fa-spinner fa-spin" />');
                $.get('/dislike/'+$(this).data('id'), {}, function(data){
                    if (data == 'dislike'){
                        $('#tmp_spinner').replaceWith('<i data-id="'+id+'" class="fa fa-heart-o b-like b-like-on" />');
                    }
                }).error(function(){w.location.href = '/404'});
            }
        });
    });    
})(window, jQuery);