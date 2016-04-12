<!-- WRAP START -->
<div id="o3-cms-wrapper">
	
	<header>
		<div class="container">
	  		<div class="row">
	  			<div class="col-sm-3 logo-holder anchors">

	  				<a href="/#"><img src="/res/header-logo.png" alt="snafer" /></a>

	  			</div>	
	  			<div class="col-sm-9 header-menu">
	  				
	  				<nav class="nav anchors">
						<ul data-type="navbar">
							<?php

							//show main menu items list
							$this->parent->menu_group_items_html_list( 1 );

							?>
		  					<li class="o3-cms-dropdown">
		  						<a href="/#sign-in" onclick="show_sign_in_form()" class="btn" data-bind="visible: !logged_user.is_logged()">Sign in</a>

								<a href="javascript:{}" data-o3-cms-target="#logged_user_drop" data-o3-cms-toggle="open" class="btn" data-bind="visible: logged_user.is_logged()"><i class="fa fa-user"></i> <span data-bind="text: logged_user.username()"></span></a>

								<div class="o3-cms-dropdown-list" id="logged_user_drop">
									<div>
										<p>Logged in as <span data-bind="text: logged_user.username()"></span></p>

										<ul>
											<li>
												<a href="<?php echo $this->o3_cms()->page_url( ACCOUNT_PAGE_ID ); ?>"><span>Account</span></a>
											</li>
											<li>
												<a href="/index.php?snafer-sign-out" data-bind="click: logged_user.signout"><i class="fa fa-sign-out"></i> <span>Sign out</span></a>
											</li>						
										</ul>

										<div></div>
									</div>
								</div>

		  					</li>	

		  					<li class="visible-xs-block">
								<a href="<?php echo $this->o3_cms()->page_url( ACCOUNT_PAGE_ID ); ?>" class="logged-user-item" data-bind="visible: logged_user.is_logged()"><span>Account</span></a>
							</li>
							<li class="visible-xs-block">
								<a href="/index.php?snafer-sign-out" class="logged-user-item" data-bind="click: logged_user.signout, visible: logged_user.is_logged()"><i class="fa fa-sign-out"></i> <span>Sign out</span></a>
							</li>
		  				</ul>
		  			</nav>

	  			</div>	
	  		</div>
		</div>
	</header>