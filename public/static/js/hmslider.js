class HMSlider{
    constructor(){
        this.init();
        this.slider_active = 0;
        this.elements = 0;
        this.items = document.getElementsByClassName('hm-slider-item');
        this.elements = this.items.length - 1;
    }

    init(){
        var hm_slider_nav_prew = document.getElementById('hm_slider_nav_prew');
        var hm_slider_nav_next = document.getElementById('hm_slider_nav_next');
        hm_slider_nav_prew ? hm_slider_nav_prew.addEventListener('click', function(){this.navigation('prew')}.bind(this)) : null;
        hm_slider_nav_next ? hm_slider_nav_next.addEventListener('click', function(){this.navigation('next')}.bind(this)) : null;
    }

    show() {
        var pos, i;
        for(i=0; i < this.items.length; i++){
            pos = i * 100;
            this.items[i].style.left = pos+'%';
            this.items[i].style.display = 'flex';
        }
    }

    navigation(action){
        if(action == "prew"){
            if(this.slider_active > "0"){
                this.slider_active = this.slider_active - 1;
                var pos, i;
                for(i=0; i < this.items.length; i++){
                    pos = parseInt(this.items[i].style.left) + 100;
                    this.items[i].style.left = pos+'%';
                }
            }
        }
        if(action == "next"){
            if(this.slider_active < this.elements){
                this.slider_active = this.slider_active + 1;
                var pos, i;
                for(i=0; i < this.items.length; i++){
                    pos = parseInt(this.items[i].style.left) - 100;
                    this.items[i].style.left = pos+'%';
                }
            }
        }
        //this.active();
    }
}