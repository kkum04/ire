$(document).ready(function(){
    window.ww=$(window).width();
    window.wh=$(window).height();
    
    function main_layout(){
        
        $('#wrap').css({
            width:ww
        });
        
        
        //main_visual
        $('#main_visual_wrap').css({
            width:ww,
        });

        $('#main_visual').css({
            width:ww*3
        });

        $('.visual_bg').css({
            width:ww,
        });
               
        $('.but').each(function(index){
                   $(this).attr('data-index',index); 
                });
        
        
    };//end
    main_layout();
    
     $(window).resize(function(){
                    ww=$(window).width();
                    wh=$(window).height();
                    main_layout();
         
         if(ww>=960){
            $('#m_gnb_wrap').css('display','none');
         };
         
         
     });
    
    
    
    
    //메인 슬라이드
    $('.but').click(function(){
        var but_num=$(this).attr('data-index');
        $('#main_visual').animate({
            left: -but_num*ww
        });
        $('.but[data-index='+but_num+']').addClass('on');
        $('.but[data-index!='+but_num+']').removeClass('on');
    });

    
    
    var click_num=0;
    $('#all_btn').click( function () {
        if( ww >= 960 ) {
            $('.pc_site_map').fadeIn(300);
        } else {
            if(click_num==0){
                $('#m_gnb_wrap').css('display','block');
                click_num++;
                       }
            else if(click_num==1){
                $('#m_gnb_wrap').css('display','none');
                        click_num--;
                      }
        }

    });
    
    
    //사이트맵 닫기btn
    $('.pu,.close_btn').click(function(){
        $('.pc_site_map').fadeOut(300);
        
    });
    
    //사이트맵 wrap
    $('.pu_con').css({
            height: wh*0.8
        });
    
    
    //qprod
    var getSlideInfo = function () {
        var ww = $("body").prop("scrollWidth");
        console.log(window.ww);
        console.log(ww);

        if (ww >= 1300)  {
            return {
                slideWidth: -1164,
                slideLength: 3
            }

        }
        else if (ww < 1300 && ww >= 960) return {
            slideWidth: -771,
            slideLength: 2
        };

        return {
            slideWidth: -280,
            slideLength: 1
        };
    }

    $('.next').click(function () {
        var slideInfo = getSlideInfo();
        console.dir(slideInfo);

        $('.qprod_row').animate({
            left: slideInfo.slideWidth
        }, function () {
            $('.qprod_row').css('left', 0);
            for( i=0; i < slideInfo.slideLength; i++) {
                $('.qprod_row').find('.qprod_col').first().appendTo('.qprod_row');
            }
        });
    });

    $('.prev').click(function () {
        var slideInfo = getSlideInfo();
        $('.qprod_row').animate({
            left: 0
        }, function () {
            $('.qprod_row').css('left', slideInfo.slideWidth);
            for( i=0; i < slideInfo.slideLength; i++) {
                $('.qprod_row').find('.qprod_col').last().prependTo('.qprod_row');
            }

        });
    });
    
    
    
    //메인 회사소개 인터렉션
   $('#nav_list>li:nth-child(2)').on("click",function(){
		$("#company_list").stop().slideUp(200);
		$(this).parent().find("#company_list").stop().slideDown(200);
		//return false;
	});
   $("#nav_list>li:nth-child(2)").on("mouseleave",function(){
		$("#company_list").stop().slideUp(200);
		$("#company_list a").removeClass("on");
	});
    
    
    
    
    //서브 내비 인터렉션
	$(".sub_nav_dp1 > a").on("click",function(){
		$(".sub_nav_dp2").stop().slideUp(200);
		$(this).parent().find(".sub_nav_dp2").stop().slideDown(200);
		return false;
	});
	$(".sub_nav_dp1").on("mouseleave",function(){
		$(".sub_nav_dp2").stop().slideUp(200);
		$(".sub_nav_dp2 a").removeClass("on");
	});
	$(".sub_nav_dp2").each(function(index){
		$(this).find("li").eq(-1).find("a").on("focusout",function(){
			$(".sub_nav_dp2").stop().slideUp(200);
		})
	});
    

	$('#top_menu li').on("mouseover", function() {
	    $('.sub_menu_box').css('display', 'none');
	    $('.sub_menu_box', this).css('display', 'block');
    });

	$('.sub_menu_box').on('mouseleave', function () {
        $(this).css('display', 'none');
    });
    
    
    
    
    
});/*end*/