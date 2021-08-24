@section('title')

Trang liên hệ

@endsection





@extends('home.layout.index')

@section('content')

	 
	 <div id="contact-page" class="container">
		@if(Session('thongbao'))
		<div class="alert alert-success" id="alert">
			{{Session('thongbao')}} <br>
		</div>
		@endif
    	<div class="bg">
			<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Liên hệ <strong>Chúng tôi</strong></h2>    			    				    				
					<div id="gmap" class="contact-map">
					<iframe class="text-center" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7849.251415160507!2d105.42648095259162!3d10.371782434983208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a731e7546fd7b%3A0x953539cd7673d9e5!2zxJDhuqFpIGjhu41jIEFuIEdpYW5n!5e0!3m2!1svi!2s!4v1605360143181!5m2!1svi!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
					</iframe>
					</div>
				</div>			 		
			</div>    
	    	<div class="row"> 
			@if(Session::get('customer_id'))
			<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">LIÊN HỆ</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" action="{{url('/home/lienhe')}}" method="post">
				            <input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group col-md-6">
				                <input type="hidden" name="Ten" class="form-control" required="required" value="{{Session::get('customer_name')}}" placeholder="Nhập họ và tên">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="hidden" name="Email" class="form-control" required="required" value="{{Session::get('customer_email')}}" placeholder="Nhập Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="TieuDe" class="form-control" required="required" placeholder="Nhập tiêu đề">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="NoiDung" id="message" required="required" class="form-control" rows="8" placeholder="Nhập nội dung"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">    			   			
                    <div class="contact-info">
	    				<h2 class="title text-center">Thông tin liên hệ</h2>
	    				<address>
	    					<p>HTK SHOPMOBILE</p>
							<p>Địa chỉ: 18 Ung Văn Khiêm, Phường Đông Xuyên, Thành phố Long Xuyên, An Giang, Việt Nam</p>
							<p>Quốc gia: Việt Nam</p>
							<p>Điện thoại:085.925.8045</p>
							<p>Fax:085.925.8045 </p>
							<p>Email: voduykhanh03092016@gmail.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Cộng đồng</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
				</div>			 		
			</div>
			@else
			<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">LIÊN HỆ</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" action="{{url('/home/lienhe')}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						    <div class="form-group col-md-6">
				                <input type="text" name="Ten" class="form-control" required="required" placeholder="Nhập họ và tên">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="Email" class="form-control" required="required" placeholder="Nhập Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="TieuDe" class="form-control" required="required" placeholder="Nhập tiêu đề">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="NoiDung" id="message" required="required" class="form-control" rows="8" placeholder="Nhập nội dung"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">    			   			
                    <div class="contact-info">
	    				<h2 class="title text-center">Thông tin liên hệ</h2>
	    				<address>
	    					<p>HTK SHOPMOBILE</p>
							<p>Địa chỉ: 18 Ung Văn Khiêm, Phường Đông Xuyên, Thành phố Long Xuyên, An Giang, Việt Nam</p>
							<p>Quốc gia: Việt Nam</p>
							<p>Điện thoại:085.925.8045</p>
							<p>Fax:085.925.8045 </p>
							<p>Email: voduykhanh03092016@gmail.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Cộng đồng</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
				</div>			 		
			</div>
			@endif    	
    	</div>	
    </div><!--/#contact-page-->
	
@endsection
@section('script')
<script>
$(document).ready (function(){
    window.setTimeout(function () { 
         $("#alert").alert('close'); 
      }, 2000);  
});
</script>
@endsection
	

  
   
