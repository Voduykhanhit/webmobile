<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{url('/admin/trangchu')}}" class="logo">
      ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
      
        <!-- user login dropdown start-->
      
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="far fa-user"></i>
           
                <span class="username">
                   @php 
                   $name = Auth::user()->admin_name;
                  @endphp
                  {{$name}}
                    
                </span>
            
             
                <b class="caret"></b>
            </a>
            
            <ul class="dropdown-menu extended logout">
                <li><a href="#" data-toggle="modal" data-target="#ModalSua"><i class=" fa fa-suitcase"></i>Thông tin cá nhân</a></li>
                <li><a href="LogoutAdmin"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
           
        </li>
       
        <!-- user login dropdown end -->
       
    </ul>
    
    <!--search & user info end-->
</div>
</header>
@include('admin.user.modalsua')
<script>
    $(document).ready(function(){
        $("#changePassword").change(function(){
            if($(this).is(":checked"))
            {
                $(".password").removeAttr('disabled');

            }else
            {
                $(".password").attr('disabled','');
            }
        });
    });


</script>