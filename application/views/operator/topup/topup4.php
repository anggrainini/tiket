<!DOCTYPE html>
<html lang="en">
	<head>
		
	</head>
	
									<h4 class="lighter">
									<i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
									<a href="#modal-wizard" data-toggle="modal" class="pink"> Wizard Inside a Modal Box </a>
								</h4>

								<div class="hr hr-18 hr-double dotted"></div>

								<div class="widget-box">
									<div class="widget-header widget-header-blue widget-header-flat">
										<h4 class="widget-title lighter">New Item Wizard</h4>

										

									<div class="widget-body">
										<div class="widget-main">
											<div id="fuelux-wizard-container">
												<div>
													<ul class="steps">
														<li data-step="1" class="active">
															<span class="step">1</span>
															<span class="title">Validation states</span>
														</li>

														<li data-step="2">
															<span class="step">2</span>
															<span class="title">Alerts</span>
														</li>

														<li data-step="3">
															<span class="step">3</span>
															<span class="title">Payment Info</span>
														</li>

														<li data-step="4">
															<span class="step">4</span>
															<span class="title">Other Info</span>
														</li>
													</ul>
												</div>

												<hr />

												

													<div class="step-pane" data-step="4">
														<div class="center">
															<h4 class="blue">Step 4</h4>
														</div>
													</div>
												</div>
											</div>

												<div>
												<button class="btn btn-prev">
												<a href="<?php echo base_url(); ?>operator/topup3">
												<i class="ace-icon fa fa-arrow-left"></i>
												<span class="menu-text"> Prev </span>
												</a>
												</button>

												<button class="btn btn-success btn-next" data-last="Finish">
												<a href="<?php echo base_url(); ?>operator/topup4">
												<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												<span class="menu-text"> Next </span>
												</a>
												</button>
												
												<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
												<a href="<?php echo base_url(); ?>operator/topup">
												<i class="ace-icon fa fa-times"></i>
												<span class="menu-text"> Cancel </span>
												</a>
												</button>
												<li class="">
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->


		</script>
	</body>
</html>
