                <div class="sangreycap">
                     <div style=" width:158px;height:20px; margin-right:auto; margin-left:auto; float:left;">
                        <div class="staricon" style="float:left;"></div>
                     <a href="/knittyblog/kevent" class="sangreycap_big" style="float:left; margin-left:6px; margin-top:3px;">events</a>
                        <div class="staricon" style="float:right;"></div>
                     </div>
                </div>
                <div class="addgreyline_below">
                </div>

              <?foreach($homeViewModelContainer['event_list'] as $evt) {?>
                <div class="jumper">
                    <div class="titlelink">
                        <a href="/knittyblog/index.php/kevent/view/<?=$evt['event_id'];?>"><?= $evt['eventTitle'];?></a>
                    </div>
                    <div class="date">
                        <?= date("m/d/Y", strtotime($evt['eventDate']));?>
                    </div>
                </div>
              <?}?>