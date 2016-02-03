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
                    $('#tmp_spinner').replaceWith('<i data-id="'+id+'" class="fa fa-heart b-like b-like-on" />');
                }).error(function(){w.location.href = '/404'});
            }
        }).on('click tap', '.fa-heart.b-like-on', function(e){
            var id      = $(this).data('id');
            if (id!== u){
                $(this).replaceWith('<i id="tmp_spinner" class="fa fa-spinner fa-spin" />');
                $.get('/dislike/'+$(this).data('id'), {}, function(data){
                    $('#tmp_spinner').replaceWith('<i data-id="'+id+'" class="fa fa-heart-o b-like b-like-on" />');
                }).error(function(){w.location.href = '/404'});
            }
        }).on('click tap', '.nav.tabs_js > li > a', function(e){
            e.preventDefault();
            var jqParent    = $(this).closest('.nav').children('li').removeClass('active').end();
            $('#'+jqParent.data('target')).children('div').addClass('hide');
            $(this).parent('li').addClass('active');
            $($(this).attr('href')).removeClass('hide');
        }).on('click tap', '.b-likedel', function(e){
            e.preventDefault();
            var id      = $(this).data('id');
            if (id!== u){
                $(this).closest('.b-likepost').remove();
                if ($('#likes .b-likepost').length == 0){
                    $('#likes').html('<p>Вы еще не поставили ни одного "лайка"</p>');
                }
                $.get('/dislike/'+$(this).data('id'), {}, function(data){});
            }
        })
        
    });    
})(window, jQuery);