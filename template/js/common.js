/*
 * camelway.com
 * Author Hito https://www.hitoy.org/
 * Date 2017/7/21
 */
String.prototype.repeat=function(count){
    return new Array(count+1).join(this);
}
var is_mobile=(function(){
    var userAgentInfo = navigator.userAgent;  
    var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod" ,"Mobile");
    for(var index in Agents){
        if(userAgentInfo.match(Agents[index])) return true;
    }
    return false;
})();
//存储第一次进入的页面
var entrypage = (function(expires){
    var now=new Date();
    now.setTime(now.getTime()+expires*86400000);
    if(window.localStorage){
        var entrypage = JSON.parse(localStorage.getItem("entrypage"))||{url:"",expires:""};
        if(entrypage.url && entrypage.expires>new Date().getTime()){
            return entrypage.url;
        }else{
            localStorage.setItem("entrypage",'{"url":"'+window.location.href+'","expires":"'+now.getTime()+'"}');
            return window.location.href;
        }
    }
    var cookies=Array();
    var cookie=document.cookie.split(";");
    for(var i in cookie){
        var tmp = cookie[i].split("=");
        cookies[tmp[0].replace(" ","")]=tmp[1].replace(" ","");
    }
    if(cookies['entrypage']){
        return unescape(cookies['entrypage']);
    }else{
        var entrypage = window.location.href;
        document.cookie="entrypage="+escape(entrypage)+";expires="+now.toGMTString()+";path=/";
        return entrypage;
    }
})(7);
//时间补位
function fill(){
    if(arguments.length==1){
        var d = arguments[0];
        var len = 2;
    }else if(arguments.length==2){
        var d = arguments[0];
        var len = arguments[1];
    }
    var s = String(d);
    if(s.length<len){
        return "0"+fill(d,len-1);   
    }else{
        return s;
    }
}
//转化为东八区时间
function get_time(){
    var n = new Date();
    var UTC8Time = n.getTime()+n.getTimezoneOffset()*60000+28800000;
    var d = new Date(UTC8Time);
    var time = d.getFullYear()+"-"+fill(d.getMonth()+1)+"-"+fill(d.getDate())+" "+fill(d.getHours())+":"+fill(d.getMinutes());
    return time;
}

//扩展
jQuery.fn.extend({
    //滚动效果:支持左滚和右滚
    scroll:function(){
        var direction;
        var waittime;
        var transitiontime;
        var callback;
        if(arguments.length==0){
            direction = "left";
            waittime = 3000;
            transitiontime = 1000;
        }else if(arguments.length == 1){
            direction = arguments[0];
            waittime = 3000;
            transitiontime = 1000;
        }else if(arguments.length == 2){
            direction = arguments[0];
            waittime = arguments[1];
            transitiontime = 1000;
        }else if(arguments.length == 3){
            direction = arguments[0];
            waittime = arguments[1];
            transitiontime = arguments[2];
        }else if(arguments.length == 4){
            direction = arguments[0];
            waittime = arguments[1];
            transitiontime = arguments[2];
            callback = arguments[3];
        }

        if(typeof(direction) == 'function'){
            callback = direction;
            direction="left";
        }
        if(typeof(waittime) == 'function'){
            callback = waittime;
            waittime=3000;
        }
        if(typeof(transitiontime) == 'function'){
            callback = transitiontime;
            transitiontime =  1000;
        }
        //获取子元素，宽度和个数
        var $childnotes = $(this).children();
        var childrenwidth =$childnotes.width();
        var childrenheight = $childnotes.height();
        var childcount = $childnotes.length+2;
        //初始化marginleft;
        var initmarginleft = -childrenwidth;
        //初始化子元素相关属性
        $childnotes.css({"display":"block","float":"left","width":childrenwidth+"px"});
        //给子元素增加一层父元素
        var $wrap = $(this).children().wrapAll("<div></div>").parent();
        //初始化父元素相关属性，并动态插入
        var $lastchild = $childnotes.last().clone();
        var $firstchild = $childnotes.first().clone();
        $wrap.css({"position":"relative","float":"left","width":childrenwidth*childcount,"margin-left":initmarginleft+"px"});
        $wrap.append($firstchild).prepend($lastchild);

        //步进marginleft
        var marginleftstep = childrenwidth;
        //最大右滚left,负值
        var maxmarginleft = -childrenwidth*(childcount-1);
        //最大左滚left, 正值
        var maxmarginright = 0;//childrenwidth;

        //当前滚动的元素索引:从0开始
        var index=0;
        //移动, 往右是正值，往左是负值
        function transform(){
            if(arguments.length<1){
                console.erro("transfrom except at least two one arguments but there is no arguments!");
            }else if(arguments.length == 1){
                var distance = arguments[0];
                var time =  transitiontime;
                var callback = null;
            }else if(arguments.length == 2){
                var distance = arguments[0];
                var argu2 =  arguments[1];
                if(typeof(argu2) == 'function'){
                    var time =  transitiontime;
                    var callback = argu2;
                }else{
                    var time =  argu2;
                    var callback = null;
                }
            }else{
                var distance = arguments[0];
                var time =  arguments[1];
                var callback = arguments[2];
            }
            //对距离作出计算
            var thismarginleft = parseFloat($wrap.css("margin-left"));
            if(distance < 0 && thismarginleft <= maxmarginleft){
                thismarginleft = initmarginleft;
                $wrap.css('margin-left',thismarginleft);
            }else if(distance > 0 && thismarginleft >= maxmarginright){
                thismarginleft = -(childcount-2)*childrenwidth;
                $wrap.css('margin-left',thismarginleft);
            }
            //回调参数调用index，一般为带动图标显示，把自动运行的状态传到用户态
            $wrap.animate({"margin-left":thismarginleft+distance+"px"},time,function(){
                //计算移动之后的index值
                var absmarginleft = Math.abs(parseFloat($wrap.css("margin-left")));
                var offsetcount = Math.floor(absmarginleft/childrenwidth) - 1;
                index = (offsetcount+childcount-2)%(childcount-2);
                if(callback) callback(index);
            });
        }

        //右切换
        function scrollright(){
            transform(childrenwidth,transitiontime,callback);
        }
        //左切换
        function scrollleft(){
            transform(-childrenwidth,transitiontime,callback);
        }
        //获取运行到元素列表索引
        function getindex(){
            return index;
        }
        //开始运行
        var interval;
        function run(){
            interval = setTimeout(function(){
                if(direction=='right'){
                    scrollright();
                }else if(direction=="left"){
                    scrollleft();
                }
                run();
            },waittime);
        }
        //暂停运行
        function pause(){
            clearInterval(interval);
        }
        //继续运行
        function start(){
            run();
        }
        run();
        return new ScrollAction(direction,start,pause,transform,$wrap,$(this),getindex,callback);
    },
    //正文图像放大查看器
    imagezoom:function(){
        var windowwidth = $(window).width();
        var windowheight = $(window).height();
        $(this).find("img").each(function(){
            var width = $(this).width();
            var height = $(this).height();
            var naturalWidth = $(this).get(0).naturalWidth || 0;
            var naturalHeight = $(this).get(0).naturalHeight || 0;
            if(naturalWidth > width*1.2 && windowwidth > width*1.2){
                var posleft=$(this).offset().left;
                var postop=$(this).offset().top;
                $(this).css("cursor","zoom-in");
                $(this).bind("click",function(){
                    var thisleft=posleft;
                    var thistop=postop;
                    var radio = naturalWidth/windowwidth > naturalHeight/windowheight ? naturalWidth/windowwidth : naturalHeight/windowheight;
                    radio= radio>1 ? radio : 1;
                    naturalWidth = naturalWidth/radio;
                    naturalHeight = naturalHeight/radio;
                    thisleft=(windowwidth-naturalWidth)/2;
                    thistop=$(window).scrollTop()+(windowheight-naturalHeight)/2;
                    $("<div class='ImageView' style='position:absolute;0;top:0;left:0;z-index:99998;width:100%;height:"+$(document).height()+"px;float:left;background:rgba(0,0,0,.3)'></div>").appendTo("body");
                    $(this).clone().appendTo(".ImageView").css({"position":"absolute","z-index":"99999","left":posleft+"px","top":postop+"px","cursor":"zoom-out"}).animate({"width":naturalWidth,"height":naturalHeight,"left":thisleft,"top":thistop},300).parent().bind("click",function(){
                        $(this).children("img").animate({"width":width,"height":height,"left":posleft+"px","top":postop+"px"},300,function(){
                            $(this).parent().remove();
                            $(this).remove();
                        });    
                    })
                })
            }
        });
    } 
});
//由scroll的手机控制动作
//参数为scroll动作返回的对象
function ScrollAction(direction,start,pause,transform,wrap,caller,getindexfunc,transformcallback){
    //获取当前索引
    function getindex(){
        return getindexfunc();
    }
    //传递过来的自动回调函数，手动也需要调用
    //如过函数参数，则为回调函数
    function touchscroll(){
        var stepdistance=wrap.children().width();
        var startX, endX;
        wrap.bind("touchstart",function(e){
            pause();
            var _touch = e.originalEvent.targetTouches[0];
            startX =  Math.ceil(_touch.pageX);
            endX = startX;
            //movedistance = 0;
            //movesteps = 0;
        });
        wrap.bind("touchmove",function(e){
            var _touch = e.originalEvent.targetTouches[0];
            movesteps = Math.ceil(_touch.clientX) - endX;
            endX = Math.ceil(_touch.clientX);
            transform(movesteps,0);
        });
        wrap.bind("touchend",function(e){
            var remaindistance;
            var marginleft = parseFloat(wrap.css('margin-left'));
            var movedistance = Math.abs(marginleft%stepdistance);
            if(endX > startX){
                //右移动
                remaindistance =  movedistance;
            }else{
                //左移动
                remaindistance =   - (stepdistance - movedistance);
            }
            transform(remaindistance,300,transformcallback);
            start();
        });   
    }
    //把图标和动画关联，可以:
    //点击图标，切换动画
    //参数为jquery对象
    function scroll($iconwrap,addclass){
        if($iconwrap.children().length+2!=wrap.children().length){
            console.error("the linked number as not same as animate number!");
        }
        //鼠标在link对象和动画对象时，动画停止   
        $iconwrap.hover(function(){
            pause();
        },function(){
            start();
        });
        wrap.hover(function(){
            pause();
        },function(){
            start();
        });
        //点击图标切换动画
        $iconwrap.children().bind('click',function(){
            pause();
            var clickindex = $(this).index();
            var currentindex = getindex();
            if(clickindex == currentindex) return ;
            if(clickindex > currentindex){
                transform(-wrap.children().width()*(clickindex-currentindex),transformcallback);
            }else if(clickindex < currentindex){
                transform(wrap.children().width()*(currentindex - clickindex),transformcallback);
            }
        }); 
    }
    //鼠标点击切换,传入两个参数，第一个是右滚按钮，第二个是左滚按钮
    function mousescroll(){
        wrap.hover(function(){
            pause();
        },function(){
            start();
        });
        if(arguments.length>1){
            arguments[0].bind("click",function(){
                transfrom(wrap.children().width());
            });
            arguments[1].bind("click",function(){
                transfrom(-wrap.children().width());
            })
        }
    }
    //end函数，返回调用者
    function end(){
        return caller;
    }
    return {
        'start':start,
        'pause':pause,
        'wrap':wrap,
        'touchscroll':touchscroll,
        'mousescroll':mousescroll,
        'getindex':getindex,
        'scroll':scroll,
        'end':end
    }
}
/*
 *页面公共脚本
 */
$(function(){
    if(is_mobile){
        //手机菜单
        $(".mobile-nav-button").bind("click",function(){
            $(".menu").height($(document).height());
            $(".menu .nav").css('width','0');
            $(".menu").fadeIn(100);
            $(".menu .nav").animate({"width":"250px"})
        });
        $(".menu").bind("click",function(){
            $(".menu .nav").animate({"width":"0"},function(){
                $(".menu").fadeOut(100);
            })
        });
    }else{
        //lanauge select
        $(".topnav a").eq(2).hover(
            function(){
                $(".lang").stop().slideDown(100);
            },
            function(){
                setTimeout(function(){
                    if(!$(".lang").hasClass("hovered")) $(".lang").stop().slideUp(100);

                },100)

            });
        $(".lang").hover(
                function(){
                    $(this).addClass("hovered");
                },
                function(){
                    $(this).removeClass("hovered");
                    $(this).slideUp(100);
                });
        //search
        $(".ico-search").bind("click",function(){
            if($(".navsearch").css("display")=="none"){
                $(".navsearch").css("display","block");
                $(".navsearchinput").animate({"width":"280px"},300);
            }else{
                $(".navsearch").css("display","none");
                $(".navsearchinput").removeAttr("style");
            }
        });
        $(".navsearch").bind("submit",function(){
            window.location.href="/search/"+$(".navsearchinput").val().replace(/\s+/g,"-").toLowerCase();
            return false;
        });
        //鼠标划过菜单
        var menuhovertimeout;
        $(".menu .nav li").hover(
                function(){
                    $this=$(this);
                    menuhovertimeout = setTimeout(function(){
                        $this.children("ul").stop().slideDown(200)
                    },200);
                },
                function(){
                    clearTimeout( menuhovertimeout);
                    $(this).children("ul").stop().slideUp(200)
                });
    }
    //表单提交
    if($(".inquiry-form form").length>0){
        new Image().src="/media/images/loading.gif";
    }
    $(".inquiry-form form").bind("submit",function(){
        var name = $(this).find('#name').val();
        var email = $(this).find('#email').val();
        var tel = $(this).find('#tel').val();
        var area = $(this).find('#area').val();
        var messenger = $(this).find("#messenger").val()==""?"":$(this).find("select option:selected").val()+$(this).find("#messenger").val();
        var tmp = $(this).find(".product input[type='checkbox']:checked").not(".otherproducts");
        var products = '';
        for(var i = 0; i<tmp.length; i++){
            products += $(tmp[i]).val()+",";
        }
        products += $(".otherproducts").next().val();
        var message = $(this).find("textarea").val()||"Please send me the Price List!";
        $wrap = $("<div style='float:left;position:absolute;z-index:999;top:"+$(this).offset().top+"px;left:"+$(this).offset().left+"px;width:"+$(this).width()+"px;height:"+$(this).height()+"px;background:rgba(255,255,255,.9);text-align:center;vertical;'><img src='/media/images/loading.gif' style='margin-top:30px'></div>");
        $wrap.click(function(){
            $wrap.remove();
        })
        $('body').append($wrap);
        $.ajax({
            url:$(this).attr('action'),
            type:"post",
            data:{
                "format":"json",
            "name":name,
            "email":email,
            "tel":tel+messenger,
            "country_name":area,
            "product":products,
            "message":message,
            "url":entrypage
            },
            success: function(result){
                $wrap.html("<h1 style='margin-top:40px;font-size:30px'>"+result.body+"</h1>");
                //adwords conversion
                if(result.title==='Submit successfully!'&&typeof(gtag)==='function'){
                  gtag('event', 'conversion', {'send_to': 'AW-918898170/qNZgCIL0kXQQ-ouVtgM'});
                }
                //tracker User Submit
                if(typeof(gtag)==="function"){
                    //ga('send', 'event', 'Inquiry', 'Message',name+"|"+email+"|"+tel+messenger+products+message+"|"+result.title+"|"+get_time());
                    gtag('event','message',{'send_to':'UA-75819314-1','event_category':'Inquiry','event_label':result.title+"|"+name+"|"+email});
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //Tracker user Faild Submit
                if(typeof(gtag)==="function"){
                    gtag('event','message',{'send_to':'UA-75819314-1','event_category':'Inquiry','event_label':errorThrown+"|"+name+"|"+email});
                }
            },
            complete:function(){
                setTimeout(function(){
                    $wrap.remove();
                },5000);
            },
            dataType:'json'
        });
        return false;
    });
    //Google Analytics Event Send
    //tracker User click Email
    if(typeof(gtag)==="function"){
        if(window.location.pathname==="/about/"){
            //ga('send', 'event', 'Visit', 'About',"name:unknow|"+get_time());
            gtag('event','About',{'send_to':'UA-75819314-1','event_category':'Visit','event_label':get_time()});
        }
        $("[href^='mailto']").blur("click",function(){
            //ga('send', 'event', 'Inquiry', 'SendEmail',"name:unknow|"+get_time());
	    gtag('event','Email',{'send_to':'UA-75819314-1','event_category':'Inquiry','event_label':get_time()});
        });
        $("[href$='.pdf']").blur("click",function(){
            //ga('send', 'event', 'Visit', 'DownPDF',"name:unknow|"+get_time());
            gtag('event','DownPDF',{'send_to':'UA-75819314-1','event_category':'Visit','event_label':get_time()});
        });
        $(".liveinquiry").blur("click",function(){
            //ga('send', 'event', 'Inquiry', 'Conversation',"name:unknow|"+get_time());
	    gtag('event','conversation',{'send_to':'UA-75819314-1','event_category':'Inquiry','event_label':get_time()});
        });
    }
});
