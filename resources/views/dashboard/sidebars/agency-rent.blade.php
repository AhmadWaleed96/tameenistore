<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="#">لوحة التحكم </a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">

            <div class="user-info">
                <span class="user-name">
                    <strong>{{auth()->user()->name}}</strong>
                </span>
                <span class="user-role">وكالة  تأجير </span>
                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>متصل</span>
                </span>
            </div>
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="{{url('/')}}/uploads/user.jpg"
                    alt="User picture">
            </div>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>متطلبات</span>
                </li>
                
                <li>
                    <a href="{{route('dashboard')}}">
                        <span
                            class="badge badge-pill badge-primary"></span>
                        <i class="fa fa-handshake"></i>
                        <span>  الرئيسية  </span>
  
                    </a>
                </li>
               
                <li>
                    <a href="{{route('account-info')}}">
                        <span
                            class="badge badge-pill badge-primary"></span>
                        <i class="fa fa-handshake"></i>
                        <span>  معلومات الحساب  </span>
  
                    </a>
                </li>

                <li>
                  <a href="{{route('dash.items')}}">
                      <span
                          class="badge badge-pill badge-primary">{{App\items::where(getItemsConditions())->count()}}</span>
                      <i class="fa fa-handshake"></i>
                      <span>  الإعلانات التجارية </span>

                  </a>
              </li>
              <li>
                <a href="{{route('my-ads')}}">
                    @php  $conditions = [['user_id','=',auth()->user()->id]]; @endphp

                    <span
                        class="badge badge-pill badge-primary">{{App\Cars::where('sell',0)->where($conditions)->count()}}</span>
                    <i class="fa fa-handshake"></i>
                    <span>   مركبات للإيجار </span>

                </a>
            </li>
            <li>
            <a href="{{route('my_orders')}}">
                    <span
                        class="badge badge-pill badge-primary">{{App\Booking::where('owner_id',auth()->user()->id)->count()}}</span>
                    <i class="fa fa-handshake"></i>
                    <span>    طلبات التأجير </span>

                </a>
            </li>
          
              
                <li>
                    <a href="{{url('dashboard/modules')}}">
                        <i class="fa fa-flag"></i>
                        <span>إعلانات الأقسام الفرعية </span>
                        <span  class="badge badge-pill badge-primary">{{App\NewServices::where(getNewServicesConditions())->count()}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all_banners',app()->getLocale())}}">
                        <i class="fa fa-flag"></i>
                        <span>إعلانات  البنرات </span>
                        <span class="badge badge-pill badge-primary">{{App\UserBanner::where(userBannersConditions())->count()}}</span>

                    </a>
                </li>

             
              
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-flag"></i>
                        <span>التأمين</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a class="mx-2" href="{{route('insurancerequestsuser')}}">
                                طلبات التأمين ضد الغير     
                                </a>
                            </li>
                            <li>
                                <a class="mx-2" href="{{route('insurancerequestscomplete')}}">
                                طلبات التأنين الشامل   
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{route('promotion')}}">
                        <i class="fa fa-flag"></i>
                        الإشعارات الترويجية
                    </a>
                  </li>

                <li>
                    <a href="{{route('payment_report_user')}}">
                        <i class="fa fa-flag"></i>
                        <span>تقارير المدفوعات</span>
      
                    </a>
                </li>

            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    @include('dashboard.sidebars.sidebar-footer')

</nav>