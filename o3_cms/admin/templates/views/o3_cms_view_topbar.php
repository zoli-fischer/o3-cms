<div class="o3-cms-bg-black">
	
	<!--
	<a href="" class="o3-cms-module-btn">
		<i class="fa fa-bars"></i>
	</a>
	-->

	<span class="o3-cms-logo">
		O3 CMS
	</span>

	<ul class="o3-cms-global-tools"><?php
		/*if ( $this->o3_cms->logged_user()->is_logged() ) {
		?>		
		<li class="hidden-lg hidden-md hidden-sm hidden-xs o3-cms-dropdown">
			<a href="#ids" data-o3-cms-toggle="open"><i class="fa fa-mobile"></i></a>

			<div class="o3-cms-dropdown-list" id="ids">
				<div>
					<p>Select device</p>

					<ul>
						<li>
							<a href="#"><i class="fa fa-desktop"></i> PC / Mac</a>
							<a href="#"><i class="fa fa-tablet"></i> Tablet</a>
							<a href="#"><i class="fa fa-mobile"></i> Phone</a>						
						</li>						
					</ul>

					<p>Orientation</p>

					<ul>
						<li>
							<a href="#"><i class="fa fa-tablet"></i> Portrait</a>
							<a href="#"><i class="fa fa-tablet"></i> Landscape</a>
						</li>						
					</ul>
				</div>
			</div>


		</li><li>
			<a href="javascript:{}"><i class="fa fa-cog"></i></a>
		</li><?php
		}
		*/
		?><li class="o3-cms-dropdown">
			<a href="#o3-cms-dropdown-languages" data-o3-cms-toggle="open"><i class="fa fa-language"></i></a>

			<div class="o3-cms-dropdown-list" id="o3-cms-dropdown-languages">
				<div>
					<p>Select language</p>

					<ul>
					<?php
					//print language list								
					foreach ( $this->languages() as $key => $value ) {
						?>									
						<li>
							<a href="<?php echo o3_html($value['url']); ?>"><?php echo o3_html($value['name']); ?></a>
						</li>
						<?php
					}
					?>
					</ul>
				</div>
			</div>
		</li><?php
		if ( $this->o3_cms->logged_user()->is_logged() ) {
		?><li class="o3-cms-dropdown">
			<a href="#o3-cms-dropdown-user" data-o3-cms-toggle="open"><i class="fa fa-user"></i> <span class="hidden-md hidden-sm hidden-xs"><?php echo o3_html($this->o3_cms->logged_user()->get('name')); ?></span></a>

			<div class="o3-cms-dropdown-list" id="o3-cms-dropdown-user">
				<div>
					<p>Logged in as <?php echo o3_html($this->o3_cms->logged_user()->get('name')); ?></p>

					<ul>
						<li>
							<a href="<?php echo O3_CMS_ADMIN_URL.'?o3-cms-admin-logout'; ?>"><i class="fa fa-sign-out "></i> <span>{o3_lang:o3-cms-sign-out}</span></a>
						</li>						
					</ul>
				</div>
			</div>

		</li><!--<li class="hidden-md hidden-sm hidden-xs">
			<a href="<?php echo O3_CMS_ADMIN_URL.'?o3-cms-admin-logout'; ?>"><i class="fa fa-sign-out "></i> <span>{o3_lang:o3-cms-sign-out}</span></a>
		</li>--><?php
		}
		?><li>
			<a href="javascript:{}" onclick="alert('Todo: Write help message');"><i class="fa fa-question "></i></a>
		</li>
	</ul>

</div>
<div class="o3-cms-bg-light-color">
	
	<?php
	if ( $this->o3_cms->logged_user()->is_logged() ) {
	?>
	<ul class="o3-cms-secondary-tools">
		<li>
			<a href="#" data-bind="click: function(){ leftmenu( !leftmenu() ) }" class="btn-module"><i class="fa fa-bars"></i><i class="fa fa-arrow-left"></i> <span>Modules</span></a>
		</li><li>
			<a href=""><i class="fa fa-users"></i> <span class="hidden-xs">Users</span></a>
		</li><li>
			<a href=""><i class="fa fa-sitemap"></i> <span class="hidden-xs">Sitemap</span></a>
		</li><li>
			<a href=""><i class="fa fa-file"></i> <span class="hidden-xs">Page info</span></a>
		</li>
	</ul>
	<?php
	}
	?>

	<ul class="o3-cms-secondary-tools">
		<li>
			<a href="/"><i class="fa fa-globe"></i> <span class="hidden-md hidden-sm hidden-xs">{o3_lang:o3-cms-frontpage}</span></a>
		</li><?php
		if ( $this->o3_cms->logged_user()->is_logged() ) {
		?><li>
			<a href=""><i class="fa fa-lightbulb-o"></i> <span class="hidden-md hidden-sm hidden-xs">Highlight</span></a>
		</li><!--<li>
			<a href=""><i class="fa fa-trash-o"></i> <span class="hidden-md hidden-sm hidden-xs">Trash</span></a>
		</li>-->
		<?php
		}
		?>
	</ul>

</div>