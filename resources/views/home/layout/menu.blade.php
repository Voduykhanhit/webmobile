<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
                      
                        <div class="panel panel-default">
                           
                        @foreach($danhmuc as $dm)
								@if($dm->category_status ==1)
									<div class="panel-heading">
										<h4 class="panel-title"><a href="home/loaisanpham/{{$dm->category_id}}">{{$dm->category_name}}</a></h4>
									</div>
								@endif
							@endforeach
                                <!--endsport-->
                            </div>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
                                   
                                    @foreach($thuonghieu as $th)
										@if($th->brand_status ==1)
                                    <li><a href="home/thuonghieu/{{$th->brand_id}}"> <span class="pull-right"></span>{{$th->brand_name}}</a></li>
										@endif
                                    @endforeach
								</ul>
							</div>
						</div><!--/brands_products-->
	</div>
</div>