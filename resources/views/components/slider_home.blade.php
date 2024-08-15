<div class="hmslider">
    <ul class="navigation">
        <li><a href="#" id="hm_slider_nav_prew"><i class="fa-solid fa-chevron-left"></i></a></li>
        <li><a href="#" id="hm_slider_nav_next"><i class="fa-solid fa-chevron-right"></i></a></li>
    </ul>
    @foreach ($sliders as $slider)
        <div class="hm-slider-item">
            <div class="row">
                <div class="col-md-4 col-12 tx">
                    <div class="content">
                        <div class="cinside">
                            {!! html_entity_decode($slider->content) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}">
                </div>
            </div>
        </div>
    @endforeach
</div>