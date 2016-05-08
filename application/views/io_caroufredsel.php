<!--############################################Caroufredsel php start######################################################################################-->
<div class="caroufredsel">

<div class="home_top_tab" style="background-color:white;">
<div id="tabs">
		<ul id="ul_cs_tab">
					<li class=" refreshCarousel">
				<a href="#tabs-1"  onclick="return updateCarousel(1);" >Popüler Ürünler</a>
			</li>
					<li class="last refreshCarousel">
				<a href="#tabs-2"  onclick="return updateCarousel(2);" >Yeni Ürünler</a>
			</li>
			<!--
					<li class=" refreshCarousel">
				<a href="#tabs-3"  onclick="return updateCarousel(3);" >EN ÇOK SATANLAR</a>
			</li>
					<li class="last refreshCarousel">
				<a href="#tabs-4"  onclick="return updateCarousel(4);" >İNDİRİMLİ ÜRÜNLER</a>
			</li>-->
			</ul>
						<div class="title_tab_hide_show" style="display:none">
			POPÜLER ÜRÜNLER
			<input type='hidden' value='1' />
		</div>
	<div class="tabs-carousel" id="tabs-1">
		<div class="cycleElementsContainer" id="cycle-1">
			
			<div id="elements-1">
								<div class="list_carousel responsive">
					<div class="view_more_link"><a href=""><span>Daha Fazla</span></a></div>
					<ul id="carousel1" class="product-list">
											<?php echo $productpopular;?>
										</ul>
					<div class="cclearfix"></div>
										<a id="prev1" class="prev" href="#">&lt;</a>
					<a id="next1" class="next" href="#">&gt;</a>
									</div>
							</div>
		</div>
	</div>
					<div class="title_tab_hide_show" style="display:none">
			YENİ ÜRÜNLER
			<input type='hidden' value='2' />
		</div>
	<div class="tabs-carousel" id="tabs-2">
		<div class="cycleElementsContainer" id="cycle-2">
			
			<div id="elements-2">
								<div class="list_carousel responsive">
					<div class="view_more_link"><a href=""><span>Daha Fazla</span></a></div>
					<ul id="carousel2" class="product-list">
										<?php echo $productnew;?>
										</ul>
					<div class="cclearfix"></div>
										<a id="prev2" class="prev" href="#">&lt;</a>
					<a id="next2" class="next" href="#">&gt;</a>
									</div>
							</div>
		</div>
	</div>
				
	
	
	</div>
	
	
<script type="text/javascript">
	$(document).ready(function() {
		cs_resize();
		if(!isMobile())
		{
			initCarousel();
		}
		if(getWidthBrowser() < 767)
		{
			$('#tabs').on('click', '.title_tab_hide_show', function() {
				var id = $(this).find('input').val();
				
				if($(this).hasClass('selected')) {
					$(this).removeClass('selected');
					$('#tabs-'+id).hide();
				} else {
					
					$('#tabs .title_tab_hide_show').removeClass('selected');
					$('#tabs .tabs-carousel').hide();
					
					$(this).addClass('selected');	
					$('#tabs-'+id).show();
					initCarouselMobile();
				}
			});
		}
	});

	$(window).resize(function() {
		if(!isMobile())
		{
			cs_resize();
		}
	});
	function cs_resize()	{
		if(getWidthBrowser() < 767){ 
					$('#tabs').tabs('destroy');
			initCarousel();
								$('.tabs-carousel').hide();
			$('#ul_cs_tab').hide();
			$('#tabs div.title_tab_hide_show').show();
		} else {
							$('#tabs').tabs();
									$('.tabs-carousel').show();
			
			$('#ul_cs_tab').show();
			$('#tabs div.title_tab_hide_show').hide();
			
		}
	}
	
	function initCarousel() {
								//	Responsive layout, resizing the items
			$('#carousel1').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev1',
				next: '#next1',
				auto: false,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max: 7
					}
				},
				scroll: {
					items:3,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						//	Responsive layout, resizing the items
			$('#carousel2').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev2',
				next: '#next2',
				auto: false,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max: 7
					}
				},
				scroll: {
					items:3,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						//	Responsive layout, resizing the items
			$('#carousel3').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev3',
				next: '#next3',
				auto: false,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max: 7
					}
				},
				scroll: {
					items:3,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						//	Responsive layout, resizing the items
			$('#carousel4').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev4',
				next: '#next4',
				auto: false,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max: 7
					}
				},
				scroll: {
					items:3,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						}
	
	function initCarouselMobile() {
								//	Responsive layout, resizing the items
			$('#carousel1').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev1',
				next: '#next1',
				auto: true,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max:7
					}
				},
				scroll: {
					items:1,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						//	Responsive layout, resizing the items
			$('#carousel2').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev2',
				next: '#next2',
				auto: true,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max:7
					}
				},
				scroll: {
					items:1,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						//	Responsive layout, resizing the items
			$('#carousel3').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev3',
				next: '#next3',
				auto: true,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max:7
					}
				},
				scroll: {
					items:1,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						//	Responsive layout, resizing the items
			$('#carousel4').carouFredSel({
				responsive: true,
				width: '100%',
				prev: '#prev4',
				next: '#next4',
				auto: true,
				swipe: {
					onTouch : true
				},
				items: {
					width: 155,
					height: 280,	//	optionally resize item-height
					visible: {
						min: 1,
						max:7
					}
				},
				scroll: {
					items:1,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
			});
						}
	
	function updateNotCarousel(idx){
		jQuery(".tabs-carousel").hide();
		jQuery("#tabs-"+idx).show();
	}

	function updateCarousel(idx){
		$('#carousel'+idx).trigger("destroy", true);
		jQuery(".tabs-carousel").hide();
		jQuery("#tabs-"+idx).show();
		
		$('#carousel'+idx).carouFredSel({
			responsive: true,
			width: '100%',
			prev: '#prev'+idx,
			next: '#next'+idx,
			auto: false,
			swipe: {
				onTouch : true
			},
			items: {
				width: 155,
				height: 280,	//	optionally resize item-height
				visible: {
					min: 1,
					max: 7
				}
			},
			scroll: {
					items:3,
					direction : 'left',    //  The direction of the transition.
					duration  : 300   //  The duration of the transition.
				}
		});
	}
	
	function isMobile() {
		if(navigator.userAgent.match(/iPod/i)){
				return true;
		}
		return false;
	}


	$(window).load(function(){
		$("#list_pecial").carouFredSel({
			auto: false,
			responsive: true,
				width: '100%',
				height : 'variable',
				prev: '#prev_cs_spec',
				next: '#next_cs_spec',
				swipe: {
					onTouch : true
				},
				items: {
					width: 200,
					height: 'variable',
					visible: {
						min: 1,
						max: 1
					}
				},
				scroll: {
					direction : 'left',    //  The direction of the transition.
					duration  : 400   //  The duration of the transition.
				}

		});
	});
</script>
                   </div> 
</div>


<!--#######################################################Caroufredsel php stop##############################################################################################-->

