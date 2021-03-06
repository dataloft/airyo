	<div id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://lorempixel.com/1600/400');"></div>
                <div class="carousel-caption">
                    <h1>A Full-Width Image Slider Template</h1>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://lorempixel.com/1601/400');"></div>
                <div class="carousel-caption">
                    <h1>Caption 2</h1>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://lorempixel.com/1602/400');"></div>
                <div class="carousel-caption">
                    <h1>Caption 3</h1>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>

    <div class="container section">
        <div class="row">
            <div class="col-lg-12">
                <?=$page['content']?>
            </div>
        </div>
    </div>