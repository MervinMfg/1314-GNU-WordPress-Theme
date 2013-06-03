<?php
/*
Template Name: Store Locator Template
*/

// Begin shop list
$companiesArr = array();
$companiesArr[0]['name'] = 'Buysnow';
$companiesArr[0]['img_path'] = 'buysnow.jpg';
$companiesArr[0]['link'] = 'http://www.buysnow.com/catalog/shopbybrand/gnu';

$companiesArr[1]['name'] = 'PitCrew';
$companiesArr[1]['img_path'] = 'pitCrew.jpg';
$companiesArr[1]['link'] = 'http://www.pitcrewskateboards.com/shop/c-80-snowboards.aspx?ManufacturerFilterId=87';

$companiesArr[2]['name'] = 'Darkside';
$companiesArr[2]['img_path'] = 'darkside.jpg';
$companiesArr[2]['link'] = 'http://www.darksidesnowboards.com/store/gnu-m_9.html';

$companiesArr[3]['name'] = 'Dog Funk';
$companiesArr[3]['img_path'] = 'dogFunk.jpg';
$companiesArr[3]['link'] = 'http://www.dogfunk.com/gnu?CMP_ID=PM_VL0054';

$companiesArr[4]['name'] = 'Eastern Boarder';
$companiesArr[4]['img_path'] = 'easternBoarder.jpg';
$companiesArr[4]['link'] = 'http://www.easternboarder.com/brands.cfm?Brand=Gnu';

$companiesArr[5]['name'] = 'Eternal Snow';
$companiesArr[5]['img_path'] = 'eternal.jpg';
$companiesArr[5]['link'] = 'http://www.eternalsnow.com/brands/gnu.html';

$companiesArr[6]['name'] = 'Exit Real World';
$companiesArr[6]['img_path'] = 'exitRealWorld.jpg';
$companiesArr[6]['link'] = 'http://www.exitrealworld.com/Brand/GNU';

$companiesArr[7]['name'] = 'REI';
$companiesArr[7]['img_path'] = 'rei.jpg';
$companiesArr[7]['link'] = 'http://www.rei.com/brand/GNU';

$companiesArr[8]['name'] = 'Remember Delaware';
$companiesArr[8]['img_path'] = 'rememberDelaware.jpg';
$companiesArr[8]['link'] = 'http://www.rememberdelaware.com/m-26-gnu.aspx';

$companiesArr[9]['name'] = 'Salty Peaks';
$companiesArr[9]['img_path'] = 'saltyPeaks.jpg';
$companiesArr[9]['link'] = 'http://www.saltypeaks.com/gnu';

$companiesArr[10]['name'] = 'Shoreline';
$companiesArr[10]['img_path'] = 'shoreline.jpg';
$companiesArr[10]['link'] = 'http://www.shorelineoftahoe.com/store/home.php?cat=1560';

$companiesArr[11]['name'] = 'Sno Con';
$companiesArr[11]['img_path'] = 'snowboardConnection.jpg';
$companiesArr[11]['link'] = 'http://www.snowboardconnection.com/brands.cfm?brand=Gnu';

$companiesArr[12]['name'] = 'Tactics';
$companiesArr[12]['img_path'] = 'tactics.jpg';
$companiesArr[12]['link'] = 'http://www.tactics.com/gnu';

$companiesArr[13]['name'] = 'US Outdoor';
$companiesArr[13]['img_path'] = 'usoutdoor.jpg';
$companiesArr[13]['link'] = 'http://www.usoutdoor.com/gnu/';

$companiesArr[14]['name'] = 'Vertical Urge';
$companiesArr[14]['img_path'] = 'verticalurge.jpg';
$companiesArr[14]['link'] = 'http://store.verticalurge.com/gnu-snowboards.aspx';

$companiesArr[15]['name'] = 'Wave Rave';
$companiesArr[15]['img_path'] = 'waveRave.jpg';
$companiesArr[15]['link'] = 'http://www.waveravesnowboardshop.com/iStar.asp?a=3&manufacturer=2580&dept=1';

$companiesArr[16]['name'] = 'Zumiez';
$companiesArr[16]['img_path'] = 'zumiez.jpg';
$companiesArr[16]['link'] = 'http://www.zumiez.com/brands/gnu.html/';

$companiesArr[17]['name'] = 'evo';
$companiesArr[17]['img_path'] = 'evo.jpg';
$companiesArr[17]['link'] = 'http://www.evo.com/shop/gnu.aspx';

$companiesArr[18]['name'] = 'The House';
$companiesArr[18]['img_path'] = 'theHouse.jpg';
$companiesArr[18]['link'] = 'http://www.the-house.com/vendor-gnustore.html';

$companiesArr[19]['name'] = 'Surfside';
$companiesArr[19]['img_path'] = 'surfside.jpg';
$companiesArr[19]['link'] = 'http://www.surfsidesports.com/ls-b-gnusnowboards.aspx';

$companiesArr[20]['name'] = 'Leroys';
$companiesArr[20]['img_path'] = 'leroys.jpg';
$companiesArr[20]['link'] = 'http://www.leroysboardshops.com/store/home.php?cat=1961 ';

$companiesArr[21]['name'] = 'Val Surf';
$companiesArr[21]['img_path'] = 'valSurf.jpg';
$companiesArr[21]['link'] = 'http://www.valsurf.com/manufacturers.php?manufacturerid=127';

$companiesArr[22]['name'] = 'Surf The Earth';
$companiesArr[22]['img_path'] = 'surfTheEarth.jpg';
$companiesArr[22]['link'] = 'http://shop.surftheearthsnowboards.com/browse.cfm/2,12.html';

$companiesArr[23]['name'] = 'Backcountry';
$companiesArr[23]['img_path'] = 'backcountry.jpg';
$companiesArr[23]['link'] = 'http://www.backcountry.com/gnu?CMP_ID=PM_VL0054';

$companiesArr[24]['name'] = 'Norse Snowboarding';
$companiesArr[24]['img_path'] = 'norse.jpg';
$companiesArr[24]['link'] = 'http://www.norseboards.com/gnu.html';

$companiesArr[25]['name'] = 'SHRD';
$companiesArr[25]['img_path'] = 'shrd.jpg';
$companiesArr[25]['link'] = 'http://www.shrd.com/gnu';

//Code to shuffle the companies starts here
$arrayKeysArr = array_keys($companiesArr);
shuffle($arrayKeysArr);
?>
<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<section class="store-locator-header content-header">
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</section>

				<?php endwhile; endif; ?>

				<section class="store-locator-map">
					<iframe src="http://hosted.where2getit.com/mervin/?GNU=1" frameborder="0" height="700" width="920" scrolling="no" allowTransparency="true">You need a Frames Capable browser to view this content.</iframe>
				</section>

				<?php
				$randomizedCompaniesArr = array();
				foreach($arrayKeysArr as $keyInt)
					$randomizedCompaniesArr[] = $companiesArr[$keyInt];
					// End shuffled code.  Outputted shuffled companies are in $randomizeCompaniesArr;
				?>

				<div id="online-dealers" class="deeplink-top-fix">
					<div class="dealer-group">	 
						<h2>Authorized Online Dealers USA</h2>
						<ul>

							<?php $iInt = 1; foreach($randomizedCompaniesArr as $companyInfo): ?>
						
							<li>
								<a href="<?php echo $companyInfo['link']; ?>" title="Buy GNU Snow Products from <?php echo $companyInfo['name']; ?>" target="_blank" >
								<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/<?php echo $companyInfo['img_path']; ?>" alt="<?php echo $companyInfo['name']; ?>" width="160" height="80" /></a>				
							</li>

							<?php $iInt++; endforeach; ?>

						</ul>
						<div class="clear"></div>
					</div><!-- end .dealer-group -->
					<div class="dealer-group">
						<h2>Authorized Online Dealers CANADA</h2>
						<ul>
							<li>
								<a href="http://www.sourceboards.com/store/index.php?main_page=index&filter_id=13&cPath=31_85&sort=20a" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/source.jpg" alt="Buy GNU Products from The Source" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://store.thinkempire.com/en/featured_brand.php?brandprefix=GNU" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/empire.jpg" alt="Buy GNU Products from Empire" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://shopnomads.com/gnu" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/nomads.jpg" alt="Buy GNU Products from Nomads" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://www.xtreme-adrenaline.com/Gnu/" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/xtreme.jpg" alt="Buy GNU Products from Xtreme Adrenaline Boardshop" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://boardroomshop.com/brand/Gnu/" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/the-boardroom.jpg" alt="Buy GNU Products from The Boardroom" width="160" height="80" border="0" />
								</a>
							</li>
						</ul>
						<div class="clear"></div>
					</div><!-- end .dealer-group -->
					<div class="dealer-group">
						<h2>Authorized Online Dealers EUROPE</h2>
						<ul>
							<li>
								<a href="http://www.hot-zone.tv/en_GB/index.php?screen=dstore.shop.productsofbrand&amp;57=Gnu" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/hotzone.jpg" alt="Buy GNU Products from Hot Zone" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://www.blue-tomato.com/de/Gnu/brand.bto?brand=680" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/blueTomatoe.jpg" alt="Buy GNU Products from Blue Tomatoe" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://www.surfinsel.eu/index.php?cPath=3_26&sort=&XTCsid=1aa92587293200cc6a70dd812f4da192&filter_id=78" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/surfinsel.jpg" alt="Buy GNU Products from Surfinsel" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://www.ridersheaven.com/gnu" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/ridersHeaven.jpg" alt="Buy GNU Products from Rider's Heaven" width="160" height="80" border="0" />
								</a>
							</li>
							<li>
								<a href="http://www.revert.nl/brand/262x0x0x0x0/gnu-snowboards.html" target="_blank">
									<img src="<?php bloginfo('template_directory'); ?>/_/img/online-dealers/revert-95.jpg" alt="Buy GNU Products from Revert '95" width="160" height="80" border="0" />
								</a>
							</li>
						</ul>
						<div class="clear"></div>
					</div><!-- end .dealer-group -->
				</div> <!-- end shop wrapper -->
				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>