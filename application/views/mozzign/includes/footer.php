                                    

				</div>

			<div class="knitty_footer">
                <div class="knitty_footerWrapper">
                     <div class="knitty_footer_top">

                         <div class="socialnetwork">

							<div class="knitty_footer_intro">Follow Us :</div>

						    <div class="block_tools">
                                                    <ul class="knitty_tools">
                                                        <li><a title="Raverly" target="_blank" class="raverly" href="http://www.ravelry.com/groups/knitty-city"></a><div class="tools_title">Ravelry</div></li>
                                                        <li><a title="Share on youtube" target="_blank" class="youtube" href="http://www.youtube.com/watch?v=I-nPmH2JewI"></a><div class="tools_title">YouTube</div></li>
                                                        <li><a target="_blank" title="Post to blog" class="blog" href=""></a><div class="tools_title">Blog</div></li>                                                        
                                                    </ul>
						    </div>

						    <div class="block_tools">
						    <ul class="knitty_tools">
                                                        <li><a target="_blank" title="Facebook" class="facebook" href="http://www.facebook.com/knittycity"></a><div class="tools_title">Facebook</div></li>
                                                        <li><a title="twitter" class="twitter" target="_blank" href="http://twitter.com/knittycity"></a><div class="tools_title">Twitter</div></li>
                                                    </ul>
						    </div>

                        </div>

						<div class="footer_devider"></div>

                         <div class="newsletter">                                                    
                                                    <div class="knitty_footer_intro">or we'll follow you <br>with our newsletter!</div>
                                                      <div class="footer_text">Once you subscribe to our group, you'll receive
                                                      <li>Event & Class Updates</li>
                                                      <li>products updates</li>
                                                      <li>Yarns on sale</li>
                                                    </div>
						</div>
						<div class="joinWapper">
                                                    <div class="join">
                                                    <div class="subscriber_added"><div id="checksubscriberadd"></div></div>
                                                        <form id="joinNewsletter" method="post" >
                                                            <div class="join_input">
                                                                <div class="input_label">FIRST NAME</div><input width="200px" type="text" class="join_input_box" name="firstName" id="join_firstName">
                                                            </div>
                                                            <div class="join_input">
                                                                <div class="input_label">LAST NAME</div><input width="200px" type="text" class="join_input_box" name="lastName" id="join_lastName">
                                                            </div>
                                                            <div class="join_input">
                                                                <div class="input_label">E-MAIL</div><input width="200px" type="text" class="join_input_box" name="email" id="join_email">
                                                            </div>
							    <div style="float: left; margin-left: 119px; margin-top: 2px; ">
                                                                <a href="#" class="button_join" id="button_join">
								 <span>JOIN NOW</span>
							         </a>
                                     
							       </div>
                                                        </form>
                                </div>
                         </div>
                                                
						<div class="knitty_footer_bottom">                                                
                                <div id="knitty_copyright_left">&copy;2010 Knitty City. All rights reserved.</div>
								<div id="knitty_copyright_right">SITE POWERED BY MOZZIGN</div>
                        </div>

					</div>
				</div>
			</div>

			<?
				if($this->config->item('config_google_tracker_id') != '')
				{
					$this->view->show_simple('google_tracker');
				}
			?>
		    <script type="text/javascript">
		        SyntaxHighlighter.all();
		    </script>

</body></html>
<script type="text/javascript">
$(document).ready(function() {

    //if submit button is clicked
    $('#button_join').click(function () {

        //Get the data from all the fields
        var firstName = $('input[name=firstName]');
        var lastName = $('input[name=lastName]');
        var email = $('input[name=email]');

        //Simple validation to make sure user entered something
        //If error found, add hightlight class to the text field
        if (email.val()=='') {
            email.addClass('hightlight');
            return false;
        } else email.removeClass('hightlight');

        //organize the data properly
        var data = 'email=' + email.val() + '&lastName=' + lastName.val() + '&firstName=' + firstName.val();

        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "/knittyblog/index.php/home/addajax",

            //GET method is used
            type: "POST",

            //pass the data
            data: data,

            //Do not cache the page
            cache: false,

            //success
            success: function (html) {
                //if process.php returned 1/true (send mail success)
                 document.getElementById('checksubscriberadd').innerHTML = html;
				 document.getElementById('join_firstName').value = '';
				 document.getElementById('join_lastName').value = '';
				 document.getElementById('join_email').value = '';
            }
        });
        
        //cancel the submit button default behaviours
        return false;
    });
});
</script>
