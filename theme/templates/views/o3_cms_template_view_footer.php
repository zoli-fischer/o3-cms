	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-2">
					<ul>
						<?php
							
						//show social menu items list
						$this->parent->menu_group_items_html_list( 3 );

						?>
		            </ul>
				</div>
				<div class="col-sm-8 col-1 text-right">
					snapfer &copy; 2016 
					<ul>
						<?php

						//show footer menu items list
						$this->parent->menu_group_items_html_list( 2 );
								
						?>
					</ul>
				</div>	
			</div>
		</div>
	</footer>

<!-- WRAP END -->
</div>