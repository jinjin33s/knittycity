<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of knittytest
 *
 * @author Administrator
 */
class knittytest extends Controller {
    //put your code here

    function __construct()
	{
		parent::__construct();
        }

        public function index(){

            echo "<a href=\"http://dev.mozzign.com/knittyblog/admin/kclass\" >Test class</a>";

            //redirect('post/overview');


        }
}
?>
