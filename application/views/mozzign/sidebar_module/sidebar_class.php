        <div class="sangreycap" style="padding-top: 0px;" >
                     <div style="width:158px;height:20px; margin-right:auto; margin-left:auto; float:left;">
                        <div class="staricon" style="float:left;"></div>
                     <a href="/knittyblog/kclass" class="sangreycap_big" style="float:left; margin-left:1px; margin-top:3px;">classes</a>
                        <div class="staricon" style="float:right;"></div>
                     </div>
                </div>
                <div class="addgreyline_below">
                </div>
              
              <?foreach($homeViewModelContainer['kclass_list'] as $cls) {
                
                  ?>
                <div class="jumper">
                    <div class="titlelink">
                        <a href="/knittyblog/index.php/kclass/view/<?=$cls['class_id'];?>"><?= $cls['classTitle'];?></a>
                    </div>
                    <div class="date">
                        <?= date("m/d/Y", strtotime($cls['classDate']));?>
                    </div>
                </div>
              <?}?>