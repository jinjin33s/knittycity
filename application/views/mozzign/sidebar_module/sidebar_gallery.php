       <div class="addgreyline_top" style="width: 160px;">
        </div>
        <div class="addgreyline_top" style="width: 160px;">
        </div>
        <div class="otherpagelink">
                  <div style="height:50px;">
                        <div class="icon_community"></div>
                        <div class="icon_title_community">
                            <a href="/knittyblog/gallery"></a>
                        </div>
                 </div>
                 <div>
                        <div id="slideshow">
                            <?php
                                $setActive = false;
                                foreach($homeViewModelContainer['random_list'] as $photo)
                                {
                                    if($setActive)
                                    {
                                        echo "<img width='139px' src='/knittyblog/uploads/".$photo->thumbnail."'>";
                                    }
                                  else
                                    {
                                        echo "<img width='139px' src='/knittyblog/uploads/".$photo->thumbnail."' class='activeSlide'>";
                                       $setActive = true;
                                    }
                                }?>
                        </div>
                 </div>				
        </div>

<style type="text/css" rel="stylesheet">
        #slideshow {
        position:relative;
        height:158px;
        width: 158px;
        border: 1px solid #ececec;
    }

    #slideshow img {
        position:absolute;
        top:0;
        left:0;
        z-index:8;
        border: 10px white solid;
    }

    #slideshow img.activeSlide {
        z-index:10;
    }

    #slideshow img.last-activeSlide {
        z-index:9;
    }
</style>
<script type="text/javascript">
    function slideSwitch() {
    var $active = $('#slideshow IMG.activeSlide');

    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

    var $next =  $active.next().length ? $active.next()
        : $('#slideshow IMG:first');

    $active.addClass('last-activeSlide');

    $next.css({opacity: 0.0})
        .addClass('activeSlide')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('activeSlide last-activeSlide');
        });
}

$(document).ready(function(){
    setInterval( "slideSwitch()", 5000 );
});


</script>