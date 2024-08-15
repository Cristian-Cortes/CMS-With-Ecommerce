var base = location.protocol+'//'+location.host;
document.addEventListener('DOMContentLoaded', function(){
    var cc_alert_dom = document.getElementById('cc_alert_dom');
    var ccalert_inside = document.getElementById('ccalert_inside');
    var ccalert_content = document.getElementById('ccalert_content');
    var ccalert_btn_close = document.getElementById('ccalert_btn_close');
    var ccalert_footer_other_btns = document.getElementById('ccalert_footer_other_btns');

    if(ccalert_btn_close){
        ccalert_btn_close.addEventListener('click', function(e){
            e.preventDefault();
            cc_alert_status('hide');
        })
    }
});

function ccalert(data){
     ccalert_content.innerHTML = "";
     if(data){
        if(data.title){
            title = data.title;
        }else{
            title = 'CC Alert'
        }
        content = '';
        content += '<h2>'+title+'<\h2>';
        if(data.type){
            content += '<div class="icon"><img src="/Personal_projects/hm/public/static/img/'+data.type+'.png"> <\div>';
        }
        if(data.msg){
            msg = data.msg;
        }else{
            msg = 'Error desconocido';
        }
        content += '<h5>'+msg+'</h5>';

        if(data.msgs){
            messages = JSON.parse(data.msgs);
            if(messages.length > 0){
                content += '<ul>';
                messages.forEach(function(element, index){
                    content += '<li><i class="bi bi-bullseye"></i> '+element+'</li>';
                });
                content += '</ul>';
            }
        }

        actions_btns = '';
        if(data.actions){
            actions = JSON.parse(data.actions);
            if(actions.length > 0){
                actions.forEach(function(element, index){
                    if(element.url){
                        actions_btns += '<a href="'+element.url+'" class="btn btn-'+element.type+'">'+element.name+'</a>';
                    }
                });
            }
        }

        if(data.additional){
            additionals = JSON.parse(data.additional);
            if(additionals.hideclose){
                document.getElementById('ccalert_btn_close').style.display = 'none';
            }else{
                document.getElementById('ccalert_btn_close').style.display = 'block';
            }
        }

        ccalert_footer_other_btns.innerHTML = actions_btns;
        ccalert_content.innerHTML = content;
        cc_alert_status('show');
     }
}

function cc_alert_status(status){
    if(status == "show"){
        document.getElementsByTagName('body')[0].style.overflow = 'hidden';
        document.getElementsByClassName('wrapper')[0].classList.add('blur');
        cc_alert_dom.style.display = "flex";
        cc_alert_dom.classList.remove('ccalert_animation_hide');
        cc_alert_dom.classList.add('ccalert_animation_show');
        ccalert_inside.classList.add('scale_animation');
    }
    if(status == "hide"){
        document.getElementsByTagName('body')[0].style.removeProperty("overflow");
        document.getElementsByClassName('wrapper')[0].classList.remove('blur');
        cc_alert_dom.style.display = "none";
        cc_alert_dom.classList.add('ccalert_animation_hide');
        cc_alert_dom.classList.remove('ccalert_animation_show');
        ccalert_inside.classList.remove('scale_animation');
    }
}