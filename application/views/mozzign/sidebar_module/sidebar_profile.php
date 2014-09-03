        
            <?
                if(!empty($homeViewModelContainer['kprofile_list']))
                {
                        $profList = $homeViewModelContainer['kprofile_list'];
                       
                        foreach($profList as $prof)
                        {
            ?>

        <div class="addgreyline_top"></div>
        <div class="addgreyline_top"></div>

        <div class="otherpagelink" style="border-bottom:0px;">
        
		<div style="height:50px; border-bottom:solid 1px #ECECEC">
                <div class="icon_profiles">

                </div>
                      <div class="icon_title_profiles">
                      	<a href="/knittyblog/kprofile"></a>
                      </div>
                 </div>
                 <div style="text-align:center; padding:10px 0px 0px 0px; letter-spacing: 1px; font-style: normal;">
                      <a href="/knittyblog/index.php/kprofile/view/<?=$prof['prof_id'];?>"><?= $prof['profTitle'];?></a>
                 </div>
            
                		
        </div>
          <?
                    break;
                    };
                }
          ?>
