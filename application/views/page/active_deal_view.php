<?php defined('BASEPATH') OR exit('No direct script access allowed');?>



                <div class="container infinite-scroll">
				<h1 style="margin-top:20px">Active Deals</h1>
					<?php if($activeProducts):?>
					<?php foreach($activeProducts as $product):?>
					<?php 
						$data["Product"]=$product;						;
					?>
					<div class="col-lg-3 col-md-4 post" style="width:350px">
					<?php $this->load->view("template/product_dealpage",$data); ?>
					</div>
					<?php endforeach;?>
					<?php endif;?>
					

					<div class="pull-right pagination">
                    <?php echo $this->pagination->create_links()  ?>                    
                </div>
				
				<div class="page-load-status">
  <p class="infinite-scroll-request" style="font-size:54px;text-align:center">Loading...</p>  
</div>
				</div>
