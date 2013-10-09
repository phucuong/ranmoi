/* --------------------------------------------------
**
** common.js
** version : 0.1
** datte : 2013/03/10
**
** -------------------------------------------------- */
/* --------------------------------------------------
** html5
** -------------------------------------------------- */
document.createElement('section');
document.createElement('nav');
document.createElement('article');
document.createElement('aside');
document.createElement('hgroup');
document.createElement('header');
document.createElement('footer');


/* --------------------------------------------------
** function
** -------------------------------------------------- */

$(document).ready(function() {

    /*---------------
    hover時画像切り替え
    ----------------*/
    var outImgName = "-off";
    var overImgName = "-hover";
    var preload = new Array();

    if(document.getElementsByTagName){
        var imgTagData = $("img");
        var reOverImg = new RegExp(outImgName + "+(\.[a-z]+)$");
        var reOutImg = new RegExp(overImgName + "+(\.[a-z]+)$");
        for(var i=0; i<imgTagData.length; i++){
            if(imgTagData[i].getAttribute("src") != null){
                if(imgTagData[i].getAttribute("src").match(reOverImg)){
                    preload[i] = new Image();
                    preload[i].src = imgTagData[i].getAttribute("src").replace(reOverImg, overImgName + "$1");
                    imgTagData[i].onmouseover = function() {
                        this.setAttribute("src", this.getAttribute("src").replace(reOverImg, overImgName + "$1"));
                    }
                    imgTagData[i].onmouseout = function() {
                        this.setAttribute("src", this.getAttribute("src").replace(reOutImg, outImgName + "$1"));
                    }
                }
            }
        }
    }

    /*---------------
    tab
    ----------------*/
    $('li.hasMenu').click(function(){
        var tabContent = $(this).attr('data-tab-contents');
        $('div.tabContent').css('display','none');
        $('div#' + tabContent).css('display','block');
    });

    $('.hasMenu').click(function(){
        $('.tabArea li.tab').removeClass('current');
        $(this).toggleClass('current');
    });

	//dropdown
    $(".dParent").live("click", function(){
		$('ul.drop').hide();
		$(this).parents('.dBox').find('ul.drop').slideToggle(100);
	});

    $("ul.drop").live("click", function(){
		$('ul.drop').hide();
		$(this).parents('.dBox').addClass('current');
	});

	//dropdown以外をクリックしたら非表示
    var isMouseHover = false;
	$("ul.drop").live({
		mouseenter:function(){
			isMouseHover = true;
		},
		mouseleave:function(){
			isMouseHover = false;
		}
	});
	$('body').mouseup(function(){
		if(isMouseHover === false){
            $('ul.drop').hide();
        }
	});

    /*---------------
    コメントボタン
    ----------------*/
    $("ul.function .comment").live("click", function(){
		var target = $(this).parents('div.unit').find('.commentArea');
		var img = $(this).children('img');
		var imgCl = '/common/image/icon-tw-cl.png';
		var imgOp = '/common/image/icon-tw-cm.png';

		if($(this).is('.on')) {
			$(this).removeClass('on');
			target.animate({height: "toggle", opacity: "toggle"},"");
			$(this).children('img').attr('src', imgOp);
		}else{
			$(this).addClass('on');
			target.animate({height: "toggle", opacity: "toggle"},"");
			$(this).children('img').attr('src', imgCl);
		}
    });

    /*---------------
    いいねボタン
    ----------------*/
    $("ul.function .gd").live("click", function(){
		var imgOf = '/common/image/icon-tw-gd.png';
		var imgOn = '/common/image/icon-tw-gd-on.png';

		if($(this).is('.on')) {
			$(this).removeClass('on');
			$(this).children('img').attr('src', imgOf);
			$(this).children('.txt').html('いいね！');
		}else{
			$(this).addClass('on');
			$(this).children('img').attr('src', imgOn);
			$(this).children('.txt').html('いいね！の取消');
		}
	});

    /*---------------
    timeLine moreボタン
    ----------------*/
    $("p.more").live("click", function(){
		$(this).parents('.unit').find('.more').slideDown("");
		$(this).hide();
	});

    /*---------------
    ツイート削除ボタン
    ----------------*/
	$(".mine").live({
		mouseenter:function(){
			$(this).find('span.delete').show();
		},
		mouseleave:function(){
			$(this).find('span.delete').hide();
		}
	});

    /*---------------
    削除ボタン
    ----------------*/
	$(".dlParent").live({
		mouseenter:function(){
			$(this).find('span.delete').show();
		},
		mouseleave:function(){
			$(this).find('span.delete').hide();
		}
	});

    /*---------------
    画像投稿ボタン
    ----------------*/
    $("#photoimg").hover(
        function(){
            $(this).next(".icon").css("background-color","#f2f2f2");
        },
        function(){
            $(this).next(".icon").css("background-color","#fafafa");
        }
    );


    /*---------------
    linkBox
    ----------------*/
	jQuery.each(["ul.linkBox li", "div.linkBox p:not(.mine)"], function(index, value){
		jQuery(value).live({
			mouseenter:function(){
				$(this).prepend('<img class="hover" src="/common/image/icon-arrow-linkBox.png" height="13" width="11">');
			},
			mouseleave:function(){
				$(this).find('.hover').remove();
			}
		});
	});


    /*---------------
    selectBox
    ----------------*/
	$('.selectBox').customSelect();


    /*---------------
    一覧ページ機能ボタンホバー制御
    ----------------*/
    $('table.list .functionArea li').live({
		mouseenter:function(){
			$(this).children('span').show();
		},
		mouseleave:function(){
			$(this).children('span').hide();
		}
	});


    /*---------------
    一覧ページ グループを作成選択機能
    ----------------*/
    var choiceTarget = $(".choice").find("td");
    choiceTarget.live("click",function () {
        if($(this).attr("class") != "current"){
            $(this).addClass("current");
            $(this).find(".check").fadeIn("100");
        }else{
            $(this).removeClass("current");
            $(this).find(".check").fadeOut("100");
        }
    });

    /*---------------
    会員登録フォーム
    ----------------*/
    //会員属性 ラジオボタンのセル切り替え
    $( 'input[name="memberType"]:radio' ).change( function() {
        switch ($(this).val()){
            case '01':
                $('#jobCell').hide();
                $('#relationCell').hide();
            break;
            case '02':
                $('#jobCell').hide();
                $('#relationCell').hide();
            break;
            case '03':
                $('#jobCell').show();
                $('#relationCell').hide();
            break;
            case '04':
                $('#jobCell').hide();
                $('#relationCell').show();
            break;
        }
    });
/*
    //加入患者会ボタン押下でセルを増やします
    $('#addKanjakai').click( function() {
        var no     = $("#kanjakai_no").val();
        var int_no = parseInt(no) +1;
        if (int_no == 11) return;
        $("#kanjakai_no").val(int_no.toString());
        $("#kanajakaiP"+int_no.toString()).show();
        
    });
*/

    /*---------------
    オーバーレイ表示
    ----------------*/
    var arr = [ "1", "2", "3", "4", "5", "6", "7","8","9","10","11","12","13","14","15"];
    jQuery.each(arr, function(num) {
        $(".modal" + this).live("click", function(){
            $.colorbox({inline:true, width:"auto", href:"#alertOverlay" + (num + 1), rel : "popup", transition:"none", scrolling: false, arrowKey: false});
            return false;
        });
    });

    $(".imgModal").live("click", function(){
        $.colorbox({href:$(this).attr("href"), width:'700px', height:'500px', transition:"none", rel:"nofollow", arrowKey:"false"});
        return false;
    });

    if ($(".albumModal").length){
        $(".albumModal").live("click", function(){
            $("a.albumModal").colorbox({width:'700px', height:'500px', transition:"none", arrowKey:"false"});
            return false;
        });
    }
    if ($(".albumModal2").length){
        $(".albumModal2").live("click", function(){
            $("a.albumModal2").colorbox({width:'700px', height:'500px', transition:"none", arrowKey:"false"});
            return false;
        });
    }

    /*---------------
    フレンド申請ステータスボタン
    ----------------*/
	$("ul.function .toMe").live({
		mouseenter:function(){
			$(this).html("許可しますか？");
		},
		mouseleave:function(){
			$(this).html("フレンド申請されています");
		}
	});
	$("ul.function .done").live({
		mouseenter:function(){
			$(this).html("フレンドから外す");
		},
		mouseleave:function(){
			$(this).html("フレンド登録済です");
		}
	});

	/*---------------
	overlay フレンドのグループ編集削除ボタン
	----------------*/
	$(".usrGroup li").live({
		mouseenter:function(){
			$(this).find(".delete").show();
		},
		mouseleave:function(){
			$(this).find(".delete").hide();
		}
	});

	/*---------------
	コミュニティ作成管理者設定ボタン
	----------------*/
    $('input[name="administrator"]').change( function() {
        if($(this).val() == "2"){
            $('.adminSearchArea').show();
        }else{
            $('.adminSearchArea').hide();
        }
    });

	$("#btnSearch").click( function(){
		var word = $("#search_w").val();
		if(word != ""){
			window.location = "/search/" + word;
		}
	});
	$("#search_w").keypress( function( event ) {
		if( event.which === 13 ){
			var word = $("#search_w").val();
			if(word != ""){
				window.location = "/search/" + word;
			}
		}
	});

    /*---------------
    placeholder風表示
    ----------------*/
    var pBox = $(".placeBox");
    var pForm = $(".placeBox .form");
    var pHolder = $(".placeholder");

    pForm.focus(function() {
        if($(this).prev(pHolder).is(":visible")){
            $(this).prev(pHolder).fadeOut(200);
        }
    }).blur(function() {
        if($(this).val() == ""){
            $(this).prev(pHolder).fadeIn(200);
        }
    });

    //検索結果でinputに値があったら初期非表示
    if(pForm.val() != "") {
        pHolder.hide();
    }

    /*---------------
    通知エリアの削除ボタン
    ----------------*/
    $("#alertArea .delete").click(function(){
    	$("#alertArea").hide();
    });


});

/*---------------
グローバルナビゲーションon/off切替
----------------*/
function activeGNavMenu(menu, value){
	$("#gnav_mypage").attr('src','/common/image/gnav/btn-gnav-mypage-off.png');
	$("#gnav_network").attr('src','/common/image/gnav/btn-gnav-network-off.png');
	$("#gnav_friend").attr('src','/common/image/gnav/btn-gnav-friend-off.png');
	$("#gnav_community").attr('src','/common/image/gnav/btn-gnav-community-off.png');
	$("#gnav_message").attr('src','/common/image/gnav/btn-gnav-message-off.png');
	$("#gnav_album").attr('src','/common/image/gnav/btn-gnav-album-off.png');
	$("#gnav_setting").attr('src','/common/image/gnav/btn-gnav-setting-off.png');
	
	$("#"+menu).attr('src',value);
}
