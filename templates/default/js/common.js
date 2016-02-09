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
        
        $(document).on('click tap', '.b-like-off', function(e){ // like on 
            e.preventDefault();
            $('#sign_in_btn').trigger('click');
        }).on('click tap', '.fa-heart-o.b-like-on', function(e){ // like
            var id      = $(this).data('id');
            if (id!== u){
                $(this).replaceWith('<i id="tmp_spinner" class="fa fa-spinner fa-spin" />');
                $.get('/like/'+$(this).data('id'), {}, function(data){
                    var jqSup = $('#tmp_spinner').next('.b-likes__count');
                    if (jqSup.length) {
                        jqSup.text(data);
                    } else {
                        $('#tmp_spinner').after(' <sup class="b-likes__count">'+data+'</sup>');
                    }
                    $('#tmp_spinner').replaceWith('<i data-id="'+id+'" class="fa fa-heart b-like b-like-on" />');
                }).error(function(){w.location.href = '/404'});
            }
        }).on('click tap', '.fa-heart.b-like-on', function(e){ // dislike
            var id      = $(this).data('id');

            if (id!== u){
                $(this).replaceWith('<i id="tmp_spinner" class="fa fa-spinner fa-spin" />');
                $.get('/dislike/'+$(this).data('id'), {}, function(data){
                    if (data > 0) {
                        $('#tmp_spinner').next('.b-likes__count').text(data);
                    } else {
                        $('#tmp_spinner').next('.b-likes__count').remove();
                    }
                    $('#tmp_spinner').replaceWith('<i data-id="'+id+'" class="fa fa-heart-o b-like b-like-on" />');
                }).error(function(){w.location.href = '/404'});
                
                if ($('#likes > .b-btn__ajaxpage').length){ // for home page
                    $('#likes > .b-btn__ajaxpage').html('<i class="fa fa-refresh"></i>&nbsp; Обновить список').on('tap click', function(e){
                        e.stopPropagation();
                        w.location.href = '/home';
                    });
                }
            }
        }).on('click tap', '.nav.tabs_js > li > a', function(e){ //  tabs click
            e.preventDefault();
            var jqParent    = $(this).closest('.nav').children('li').removeClass('active').end();
            $('#'+jqParent.data('target')).children('div').addClass('hide');
            $(this).parent('li').addClass('active');
            $($(this).attr('href')).removeClass('hide');
            sessionStorage.setItem('lastTab', $(this).attr('href'));
        
        }).on('click tap', '.b-likedel', function(e){ //  delete like on homepage
            e.preventDefault();
            var id      = $(this).data('id');
            if (id!== u){
                $.get('/dislike/'+$(this).data('id'), {}, function(data){});
                
                $(this).closest('.b-post__data').remove();
                if ($('#likes > .b-btn__ajaxpage').length){
                    $('#likes > .b-btn__ajaxpage').html('<i class="fa fa-refresh"></i>&nbsp; Обновить список').on('tap click', function(e){
                        e.stopPropagation();
                        w.location.href = '/home';
                    });
                } else if ( $('#likes > .b-post__data').length === 0){
                    $('#likes').append('<p class="panel panel-body h-shadow">Вы еще не поставили ни одного лайка</p>');
                }
            }
        }).on('click tap', '.b-comment__logout', function(e){ //  show login text
            e.preventDefault();
            $(this).next('p').removeClass('hidden').end().remove();
        }).on('click tap', '.b-comment__login', function(e){ //  show comment form
            e.preventDefault();
            $(this).next('.b-commentform').removeClass('hidden').end().remove();
        }).on('click tap', '.b-btn__ajaxpage', function(e){ // load page via ajax
            var iPage       = $(this).data('page'),
                sUrl        = $(this).data('url'),
                jqThis      = $(this).prop('disabled', true).find('.fa').addClass('fa-spin').end();

            $.post(sUrl+'/'+iPage, {}, function(data){
                jqThis.replaceWith(data);
            });
        }).on('click tap', '.btn-radio > .btn', function(e){ // btn group => radio btns
            var jqParent    = $(this).parent('.btn-radio');
            $(jqParent.data('target')).val($(this).data('value'));
            jqParent.find('.btn.btn-primary').toggleClass('btn-primary btn-default');
            $(this).toggleClass('btn-primary btn-default');
        }).on('keypress', 'form', function(e){ // submit all forms on ctrl+enter
            if (e.ctrlKey && e.keyCode === 13){
                $(this).submit();
            }
        }).on('keydown', 'body', function(e){
            if (e.ctrlKey && e.keyCode === 37){ // larr
                $('.pagination:first > .active').prev('li').find('a')[0].click();
            }
            if (e.ctrlKey && e.keyCode === 39){ // rarr
                $('.pagination:first > .active').next('li').find('a')[0].click();
            }
        });
    });    
})(window, jQuery);