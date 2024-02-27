@include('front.components.head')
@include('front.components.menu')
            <!---Recently Played Music--->
            <div class="ms_rcnt_slider">
                <div class="ms_heading">
                    <h1>Recently Played</h1>
                    <span class="veiw_all"><a href="#">view more</a></span>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="ms_rcnt_box">
                                <div class="ms_rcnt_box_img">
                                    <img src="images/music/r_music1.jpg" alt="">
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_more_icon">
                                            <img src="images/svg/more.svg" alt="">
                                        </div>
                                        <ul class="more_option">
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                                        </ul>
                                         <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="" class="play-icon"
                                                data-mp3="AUD-20230701-WA0005.mp3" data-image="images/music/r_music1.jpg"
                                                data-title="Dream Your Moments (Duet)" data-artist="Ava Cornish & Brian Hill">
                                        </div>
                                    </div>
                                </div>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href="#">Dream Your Moments (Duet)</a></h3>
                                    <p>Ava Cornish & Brian Hill</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next slider_nav_next"></div>
                <div class="swiper-button-prev slider_nav_prev"></div>
            </div>
            <!---Weekly Top 15--->
            <div class="ms_weekly_wrapper">
                <div class="ms_weekly_inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>weekly top 15</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">
                            <div class="ms_weekly_box">
                                <div class="weekly_left">
                                    <span class="w_top_no">
										01
									</span>
                                    <div class="w_top_song">
                                        <div class="w_tp_song_img">
                                            <img src="images/weekly/song1.jpg" alt="" class="img-fluid">
                                            <div class="ms_song_overlay">
                                            </div>
                                             <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="" class="play-icon"
                                                data-mp3="AUD-20230701-WA0005.mp3" data-image="images/weekly/song2.jpg"
                                                data-title="Cro Magnon Man" data-artist="Mushroom Records">
                                        </div>
                                        </div>
                                        <div class="w_tp_song_name">
                                            <h3><a href="#">Until I Met You</a></h3>
                                            <p>Ava Cornish</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="weekly_right">
                                    <span class="w_song_time">5:10</span>
                                    <span class="ms_more_icon" data-other="1">
										<img src="images/svg/more.svg" alt="">									
									</span>
                                </div>
                                <ul class="more_option">
                                    <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                                    <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                                    <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                                    <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                    <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                                </ul>
                            </div>
                            <div class="ms_divider"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <!----Footer Start---->
        @include('front.components.footer')
    </div>
    @include('front.components.modal')
    
			
    <!--Main js file Style-->
@include('front.components.js')