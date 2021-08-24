<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
                            @php $i=0; @endphp
                            @foreach($slide as $sl)
                            	<li data-target="#slider-carousel" data-slide-to="{{$i}}" class="@if($i==0){{'active'}}@endif"></li>
                            @php $i++; @endphp
                            @endforeach
						</ol>
						
						<div class="carousel-inner">
                            @php $i=0; @endphp
                            @foreach($slide as $sl)
							<div class="@if($i==0){{'item active'}}@else{{'item'}}@endif">
								<div class="col-sm-12">
									<img src="upload/slide/{{$sl->slide_image}}" class="girl img-responsive" alt="" />
								</div>
                            </div>
                            @php $i++; @endphp
                            @endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section>