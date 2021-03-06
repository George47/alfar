<?php
	require("util.php");
	configSession();
	// ADD loginRequired, return to index if not logged in

	if (isset($_GET['id'])) {
		$sql = "SELECT houseID, address, city, province FROM house_loc WHERE houseID='".$_GET['id']."';";
		$sql2 = "SELECT houseID, description FROM house_info WHERE houseID='".$_GET['id']."'; ";
		$sql3 = "SELECT houseID, phone, wechat, email FROM house_contact WHERE houseID='".$_GET['id']."'; ";

		$result4=mysqli_query($db, "SELECT count(*) as total from usr_likes WHERE house_ID = '".$_GET['id']."';");
		$user_likes=mysqli_fetch_assoc($result4);

		$sql5 = "SELECT * FROM usr_likes WHERE user_id = '".$_SESSION['login_id']."' and house_ID = '".$_GET['id']."' ";

		$result = mysqli_query($db, $sql);
		$result2 = mysqli_query($db, $sql2);
		$result3 = mysqli_query($db, $sql3);
		$result5 = mysqli_query($db, $sql5);

		if ($result) {
			$row = mysqli_fetch_array($result);
		}
		if ($result2) {
			$row2 = mysqli_fetch_array($result2);
		}
		if ($result3) {
			$row3 = mysqli_fetch_array($result3);
		}
		if ($result5) {
			$row5 = mysqli_fetch_array($result5);
		}

		$_SESSION['id'] = $_GET['id'];
	}
?>

<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title> <?php echo (isset($row)? $row['address'] : "") ?> - ALFAR合租平台</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/main.css" id="colors">
<link rel="stylesheet" href="css/tweaks.css">
<link rel="shortcut icon" href="images/favicon-32x32.ico" />

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container">
	<!-- Header -->
	<?php include("header.php") ?>
</header>
<div class="clearfix"></div>
<!-- Header Container / End -->


<!-- Slider
================================================== -->
<div class="listing-slider mfp-gallery-container margin-bottom-0">
	<a href="images/single-listing-01.jpg" data-background-image="images/single-listing-01.jpg" class="item mfp-gallery" title="Title 1"></a>
	<a href="images/single-listing-02.jpg" data-background-image="images/single-listing-02.jpg" class="item mfp-gallery" title="Title 3"></a>
	<a href="images/single-listing-03.jpg" data-background-image="images/single-listing-03.jpg" class="item mfp-gallery" title="Title 2"></a>
	<a href="images/single-listing-04.jpg" data-background-image="images/single-listing-04.jpg" class="item mfp-gallery" title="Title 4"></a>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row sticky-wrapper">
		<div class="col-lg-8 col-md-8 padding-right-30">

			<!-- Titlebar -->
			<div id="titlebar" class="listing-titlebar">
				<div class="listing-titlebar-title">
					<span>
						<a href="#listing-location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							地址 <?php echo (isset($row)? $row['address'] : "") ?>
						</a>
					</span>
				</div>
			</div>

			<div id="testing-grab">Success!</div>

			<!-- Listing Nav -->
			<div id="listing-nav" class="listing-nav-container">
				<ul class="listing-nav">
					<li><a href="#listing-overview" class="active">介绍</a></li>
					<li><a href="#listing-pricing-list">价格</a></li>
					<li><a href="#listing-location">地图</a></li>
					<li><a href="#listing-reviews">评分</a></li>
					<li><a href="#add-review"></a></li>
				</ul>
			</div>

			<!-- Overview -->
			<div id="listing-overview" class="listing-section">

				<!-- Description
				<p>这是一个介绍</p>

				<p>第二行</p> -->
				<?php echo (isset($row2)? $row2['description'] : "") ?>

				<!-- Amenities -->
				<h3 class="listing-desc-headline">设施</h3>
				<!-- <ul class="listing-features checkboxes margin-top-0">-->
				<ul class="listing-features margin-top-0">
					<li><i class="im im-icon-Knife"></i> 厨房</li>
					<li><i class="im im-icon-Wifi"></i> 网络</li>
					<li>Instant Book</li>
				</ul>
			</div>


			<!-- Food Menu -->
			<div id="listing-pricing-list" class="listing-section">
				<h3 class="listing-desc-headline margin-top-70 margin-bottom-30">价格</h3>

				<div class="show-more">
					<div class="pricing-list-container">

						<!-- Food List -->
						<h4>房间列表</h4>
						<ul>
							<li>
								<h5>单人房间</h5>
								<p>床，桌</p>
								<span>$500.00/月</span>
							</li>
						</ul>

					</div>
				</div>
				<!-- show-more:after COMMENTED OUT, style.css line 3087 -->
				<!--<a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a>-->
			</div>
			<!-- Food Menu / End -->


			<!-- Location -->
			<div id="listing-location" class="listing-section">
				<h3 class="listing-desc-headline margin-top-60 margin-bottom-30">地图</h3>

				<div id="singleListingMap-container">
					<div id="singleListingMap" data-latitude="43.8341172" data-longitude="-79.3044496" data-map-icon="im im-icon-Green-House"></div>
					<a href="#" id="streetView">Street View</a>
				</div>
			</div>

			<!-- Reviews -->
			<!-- Re-enable later
			<div id="listing-reviews" class="listing-section">
				<h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(12)</span></h3>

				<div class="clearfix"></div>


				<section class="comments listing-reviews">

					<ul>
						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">Kathy Brown<span class="date">June 2017</span>
									<div class="star-rating" data-rating="5"></div>
								</div>
								<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>

								<div class="review-images mfp-gallery-container">
									<a href="images/review-image-01.jpg" class="mfp-gallery"><img src="images/review-image-01.jpg" alt=""></a>
								</div>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>12</span></a>
							</div>
						</li>

						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">John Doe<span class="date">May 2017</span>
									<div class="star-rating" data-rating="4"></div>
								</div>
								<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>2</span></a>
							</div>
						</li>

						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">Kathy Brown<span class="date">June 2017</span>
									<div class="star-rating" data-rating="5"></div>
								</div>
								<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>

								<div class="review-images mfp-gallery-container">
									<a href="images/review-image-02.jpg" class="mfp-gallery"><img src="images/review-image-02.jpg" alt=""></a>
									<a href="images/review-image-03.jpg" class="mfp-gallery"><img src="images/review-image-03.jpg" alt=""></a>
								</div>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>4</span></a>
							</div>
						</li>

						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">John Doe<span class="date">May 2017</span>
									<div class="star-rating" data-rating="5"></div>
								</div>
								<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review</a>
							</div>

						</li>
					 </ul>
				</section> -->

				<!-- Pagination -->
				<!-- Re-enable later
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">

						<div class="pagination-container margin-top-30">
							<nav class="pagination">
								<ul>
									<li><a href="#" class="current-page">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>-->
			<!-- Pagination / End -->


			<!-- Add Review Box -->
			<!-- Pagination / End
			<div id="add-review" class="add-review-box">


				<h3 class="listing-desc-headline margin-bottom-20">Add Review</h3>

				<span class="leave-rating-title">Your rating for this listing</span>


				<div class="row">
					<div class="col-md-6">

						<div class="clearfix"></div>
						<div class="leave-rating margin-bottom-30">
							<input type="radio" name="rating" id="rating-1" value="1"/>
							<label for="rating-1" class="fa fa-star"></label>
							<input type="radio" name="rating" id="rating-2" value="2"/>
							<label for="rating-2" class="fa fa-star"></label>
							<input type="radio" name="rating" id="rating-3" value="3"/>
							<label for="rating-3" class="fa fa-star"></label>
							<input type="radio" name="rating" id="rating-4" value="4"/>
							<label for="rating-4" class="fa fa-star"></label>
							<input type="radio" name="rating" id="rating-5" value="5"/>
							<label for="rating-5" class="fa fa-star"></label>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="col-md-6">

						<div class="add-review-photos margin-bottom-30">
							<div class="photoUpload">
							    <span><i class="sl sl-icon-arrow-up-circle"></i> Upload Photos</span>
							    <input type="file" class="upload" />
							</div>
						</div>
					</div>
				</div>


				<form id="add-comment" class="add-comment">
					<fieldset>

						<div class="row">
							<div class="col-md-6">
								<label>Name:</label>
								<input type="text" value=""/>
							</div>

							<div class="col-md-6">
								<label>Email:</label>
								<input type="text" value=""/>
							</div>
						</div>

						<div>
							<label>Review:</label>
							<textarea cols="40" rows="3"></textarea>
						</div>

					</fieldset>

					<button class="button">Submit Review</button>
					<div class="clearfix"></div>
				</form>

			</div>-->
			<!-- Add Review Box / End -->


		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-4 col-md-4 margin-top-75 sticky">

			<!-- Book Now -->
			<div class="boxed-widget">
				<h3><i class="fa fa-calendar-check-o "></i> 入住时间</h3>
				<div class="row with-forms  margin-top-0">

					<!-- Date Picker - docs: http://www.vasterad.com/docs/listeo/#!/date_picker -->
					<div class="col-lg-6 col-md-12">
						<input type="text" id="booking-date" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020">
					</div>

					<!-- Time Picker - docs: http://www.vasterad.com/docs/listeo/#!/time_picker -->
					<div class="col-lg-6 col-md-12">
						<input type="text" id="booking-time" value="9:00 am">
					</div>

				</div>

				<!-- progress button animation handled via custom.js -->
				<button class="progress-button button fullwidth margin-top-5"><span>联系预约</span></button>
			</div>
			<!-- Book Now / End -->


			<!-- Contact -->
			<!-- ONLY SHOW WHEN LOGGED IN -->
			<div class="boxed-widget margin-top-35">
				<h3><i class="sl sl-icon-pin"></i> 联系方式</h3>
				<ul class="listing-details-sidebar">
					<li><i class="sl sl-icon-phone"></i>
						<a href="#">
						<?php echo (isset($row3)? "(" . substr($row3['phone'], 0, 3) . ")" .
						" " . substr($row3['phone'], 3, 3) .
						"-" . substr($row3['phone'], 6, 6) : "") ?>
						</a>
					</li>
					<li>
						<i class="fa fa-wechat"></i>
						<?php echo (isset($row3)? $row3['wechat'] : "") ?>
					</li>
					<li>
						<i class="fa fa-envelope-o"></i> <a href="#">
						<?php echo (isset($row3)? $row3['email'] : "") ?>
						</a>
					</li>
				</ul>



				<!-- Reply to review popup -->
				<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
					<div class="small-dialog-header">
						<h3>发送信息</h3>
					</div>
					<div class="message-reply margin-top-0">
						<!--<form action="../server/usr_message.php" method="post">
						<form id="usrMessage">-->
						<!--<textarea cols="40" rows="3" id="" placeholder="请输入您的信息 .."></textarea>-->
						<!--<textarea cols="40" rows="3" id="" placeholder="请输入您的信息 .."></textarea>
						<button class="button" id="send-message">发送信息</button>-->
						<form action="server/usr_message_new.php" method="post" id="usrMessage">
							<textarea cols="40" rows="3" name="sentMessage" id="sentMessage" form="usrMessage" placeholder="请输入您的信息 .."></textarea>
							<button type="submit" class="button">发送信息</button>
						</form>

					</div>

				</div>
				<a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> 发送信息</a>
			</div>
			<!-- Contact / End-->

			<!-- Roommate Finder -->
			<div id="find-roommate" class="boxed-widget margin-top-35">
				<h3><i class="sl sl-icon-people"></i> 寻找室友
					<span>
						<a class="popup-with-zoom-anim" href="#regisRoommate">
						<i class="fa fa-plus"></i>我也要找</a>
					</span>
				</h3>

				<div class="roommate-finder-avatar">
					<a href="user/profile.php?id=1"><img src="images/dashboard-avatar.jpg" alt=""></a>
					<a href="user/profile.php?id=28"><img src="images/dashboard-avatar2.jpg" alt=""></a>
				</div>


				<div id="roommate-dialog" class="zoom-anim-dialog mfp-hide">
					<div class="small-dialog-header">
						<h3>正在寻找室友 ..<h3>
					</div>


					<div class="panel-dropdown">
						<a href="#">性别</a>
						<div class="panel-dropdown-content checkboxes categories">

							<!-- Checkboxes -->
							<div class="row">
								<div class="col-md-6">
									<input id="check-1" type="checkbox" name="check" checked class="all">
									<label for="check-1">所有</label>
									<input id="check-2" type="checkbox" name="check">
									<label for="check-2">女</label>
								</div>
								<div class="col-md-6">
									<input id="check-3" type="checkbox" name="check" >
									<label for="check-3">男</label>
								</div>
							</div>

							<!-- Buttons -->
							<div class="panel-buttons">
								<button class="panel-cancel">取消</button>
								<button class="panel-apply">搜索</button>
							</div>

						</div>
					</div>








					<div class="roommate-finder margin-top-0">
						<div class="roommate-single">
							<a href="user/profile.php?id=1">
								<img src="images/dashboard-avatar.jpg" alt="">
								Tom Perrin
							</a>
							<a id="open-message" class="button medium"><i class="sl sl-icon-envelope-open"></i>联系</a>
						</div>

						<div class="roommate-finder-message margin-top-0" id="roommate-message">
							<textarea cols="40" rows="1" name="roommateMessage" id="roommateMessage" placeholder="请输入您的信息 .."></textarea>
							<button type="submit" class="button">发送信息</button>
							<div class="clearfix" style="padding-bottom:1em; border-bottom:1px solid #dbdbdb; margin-bottom:1em;"></div>
						</div>





						<div class="roommate-single">
							<a href="user/profile.php?id=28">
								<img src="images/dashboard-avatar2.jpg" alt="">
								George
							</a>
							<a href="#" class="button medium"><i class="sl sl-icon-envelope-open"></i>联系</a>
						</div>
					</div>
				</div>
				<!-- else -> 目前没有人在找室友 -->


				<a href="#roommate-dialog" class="send-message-to-owner button popup-with-zoom-anim">
					<i class="fa fa-plus"></i> 更多</a>
			</div>

			<!-- REGISTER ROOMMATE POPUP -->
			<div id="regisRoommate" class="zoom-anim-dialog mfp-hide">
          <h2>Title</h2>
          <p>Content Here</p>
			</div>



			<!-- Roommate Finder / End -->



			<!-- Share / Like -->
			<div class="listing-share margin-top-40 margin-bottom-40 no-border">
				<button class="like-button" id="like-button" value="<?php echo $_GET['id']; ?>">
					<span class="like-icon <?php echo (mysqli_num_rows($result5) == 1 ? 'liked' : "") ?>"></span> 加入收藏
			</button>
				<span><?php echo $user_likes['total']; ?> 人收藏了这个房屋</span>

					<!-- Share Buttons -->
					<ul class="share-buttons margin-top-40 margin-bottom-0">
						<li><a class="fb-share" href="#"><i class="fa fa-facebook"></i> 分享</a></li>
						<li><a class="twitter-share" href="#"><i class="fa fa-twitter"></i> 分享</a></li>
						<li><a class="gplus-share" href="#"><i class="fa fa-google-plus"></i> 分享</a></li>
					</ul>
					<div class="clearfix"></div>
			</div>

		</div>
		<!-- Sidebar / End -->

	</div>
</div>


<!-- Footer
================================================== -->
<div id="footer" class="margin-top-15">
	<?php include("footer.php"); ?>>
</div>
<!-- Footer / End -->


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="scripts/jpanelmenu.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/waypoints.min.js"></script>
<script type="text/javascript" src="scripts/counterup.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

<!-- Maps -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAnsr-uSrhCSfnLXOrADz9cv9ATXiLazKU"></script>
<script type="text/javascript" src="scripts/infobox.min.js"></script>
<script type="text/javascript" src="scripts/markerclusterer.js"></script>
<script type="text/javascript" src="scripts/maps.js"></script>
<script type="text/javascript" src="scripts/scripts.js"></script>

<script>
	$(document).ready(function(){
			$("#open-message").click(function(){
					$("#roommate-message").toggle(300);
			});
	});
</script>

<!-- <script>
	$("#send-message").click(function(){sendMessage()});
</script> -->

<!-- <script>
	$("#like_button").click(function(){
		$(this).click = toggle();
	});
</script> -->


<!-- HANDLED IN SCRIPTS.JS -->
<!-- <script>
$(".like-button").click(function(){
		var houseid = document.getElementById("like-button").value;

    if(! $(this).parent().data('bookmark')){
        $(this).parent().data('bookmark', 1);
				$.ajax({url: 'server/add_bookmark.php?id=' + houseid});
    }
    else {
        $(this).parent().data('bookmark', null);
				$.ajax({url: 'server/delete_bookmark.php?id=' + houseid});
    }
});
</script> -->



<!-- Date Picker - docs: http://www.vasterad.com/docs/listeo/#!/date_picker -->
<link href="css/plugins/datedropper.css" rel="stylesheet" type="text/css">
<script src="scripts/datedropper.js"></script>
<script>$('#booking-date').dateDropper();</script>

<!-- Time Picker - docs: http://www.vasterad.com/docs/listeo/#!/time_picker -->
<script src="scripts/timedropper.js"></script>
<link rel="stylesheet" type="text/css" href="css/plugins/timedropper.css">
<script>
this.$('#booking-time').timeDropper({
	setCurrentTime: false,
	meridians: true,
	primaryColor: "#f91942",
	borderColor: "#f91942",
	minutesInterval: '15'
});

var $clocks = $('.td-input');
	_.each($clocks, function(clock){
	clock.value = null;
});
</script>



<!-- Style Switcher
================================================== -->
<script src="scripts/switcher.js"></script>

<div id="style-switcher">
	<h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>

	<div>
		<ul class="colors" id="color1">
			<li><a href="#" class="main" title="Main"></a></li>
			<li><a href="#" class="blue" title="Blue"></a></li>
			<li><a href="#" class="green" title="Green"></a></li>
			<li><a href="#" class="orange" title="Orange"></a></li>
			<li><a href="#" class="navy" title="Navy"></a></li>
			<li><a href="#" class="yellow" title="Yellow"></a></li>
			<li><a href="#" class="peach" title="Peach"></a></li>
			<li><a href="#" class="beige" title="Beige"></a></li>
			<li><a href="#" class="purple" title="Purple"></a></li>
			<li><a href="#" class="celadon" title="Celadon"></a></li>
			<li><a href="#" class="red" title="Red"></a></li>
			<li><a href="#" class="brown" title="Brown"></a></li>
			<li><a href="#" class="cherry" title="Cherry"></a></li>
			<li><a href="#" class="cyan" title="Cyan"></a></li>
			<li><a href="#" class="gray" title="Gray"></a></li>
			<li><a href="#" class="olive" title="Olive"></a></li>
		</ul>
	</div>

</div>
<!-- Style Switcher / End -->


</body>
</html>
