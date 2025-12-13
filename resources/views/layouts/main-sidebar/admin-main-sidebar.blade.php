<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url('/')}}">{{ trans('main_trans.Main') }}</a> </li>

                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main_trans.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Grades.index')}}">{{trans('main_trans.Grades_list')}}</a></li>
                            <li><a href="">{{trans('main_trans.Grades_list')}}</a></li>
{{--                            <li><a href="button.html">Button</a></li>--}}
{{--                            <li><a href="colorpicker.html">Colorpicker</a></li>--}}
{{--                            <li><a href="dropdown.html">Dropdown</a></li>--}}
{{--                            <li><a href="lists.html">lists</a></li>--}}
{{--                            <li><a href="modal.html">modal</a></li>--}}
{{--                            <li><a href="nav.html">nav</a></li>--}}
{{--                            <li><a href="nicescroll.html">nicescroll</a></li>--}}
{{--                            <li><a href="pricing-table.html">pricing table</a></li>--}}
{{--                            <li><a href="ratings.html">ratings</a></li>--}}
{{--                            <li><a href="date-picker.html">date picker</a></li>--}}
{{--                            <li><a href="tabs.html">tabs</a></li>--}}
{{--                            <li><a href="typography.html">typography</a></li>--}}
{{--                            <li><a href="popover-tooltips.html">Popover tooltips</a></li>--}}
{{--                            <li><a href="progress.html">progress</a></li>--}}
{{--                            <li><a href="switch.html">switch</a></li>--}}
{{--                            <li><a href="sweetalert2.html">sweetalert2</a></li>--}}
{{--                            <li><a href="touchspin.html">touchspin</a></li>--}}
                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('my_Classes_trans.title_page')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Classrooms.index')}}">{{trans('my_Classes_trans.List_Classes')}} </a> </li>
                            <!-- <li> <a href="calendar-list.html">List Calendar</a> </li> -->
                        </ul>
                    </li>
                    <!-- menu item -->
                    <li>
                      <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
                          <div class="pull-left"><i class="ti-calendar"></i><span
                                  class="right-nav-text">{{trans('main_trans.sections')}}</span></div>
                          <div class="pull-right"><i class="ti-plus"></i></div>
                          <div class="clearfix"></div>
                      </a>
                      <ul id="sections" class="collapse" data-parent="#sidebarnav">
                          <li> <a href="{{route('sections.index')}}">{{trans('main_trans.sections_list')}} </a> </li>
                          <!-- <li> <a href="calendar-list.html">List Calendar</a> </li> -->
                      </ul>
                    </li>
                    <!-- menu item chat-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents"><i class="ti-comments"></i>
                             <span class="right-nav-text">  {{trans('main_trans.parents')}}  </span>
                             <div class="pull-right"><i class="ti-plus"></i></div>
                             <div class="clearfix"></div>
                        </a>
                        <ul id="parents" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url('add_parent')}}">{{trans('main_trans.parents_list')}} </a> </li>
                            <li> <a href="{{url('add_parent')}}">{{trans('main_trans.add_parent')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item mailbox-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers"><i class="ti-email"></i>
                            <span class="right-nav-text">{{trans('main_trans.Teachers')}}</span>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="teachers" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Teachers.index')}}">{{trans('main_trans.Teachers_list')}} </a> </li>
                        </ul>
                    </li>
                    <!-- menu item Charts-->
                    <!-- students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user"></i>{{trans('main_trans.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="students-menu" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('main_trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Student_information" class="collapse">
                                    <li> <a href="{{route('students.create')}}">{{trans('main_trans.add_student')}}</a></li>
                                    <li> <a href="{{route('students.index')}}">{{trans('main_trans.students_list')}}</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('main_trans.students_promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Students_upgrade" class="collapse">
                                    <li> <a href="{{route('promotions.index')}}">{{trans('main_trans.add_Promotion')}}</a></li>
                                    <li> <a href="{{route('promotions.create')}}">{{trans('main_trans.students_promotions_management')}}</a> </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('main_trans.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Graduate students" class="collapse">
                                    <li> <a href="{{route('Graduated.create')}}">{{trans('main_trans.add_Graduate')}}</a> </li>
                                    <li> <a href="{{route('Graduated.index')}}">{{trans('main_trans.list_Graduate')}}</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- menu font icon-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">
                                    {{trans('main_trans.Accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('fees.index')}}"> {{trans('main_trans.study fees')}}</a> </li>
                            <li> <a href="{{route('FeesInvoices.index')}}">{{trans('main_trans.fees_invoices')}}</a> </li>
                            <li> <a href="{{route('processingFee.index')}}">{{trans('main_trans.Processing_fees')}}</a> </li>
                            <li> <a href="{{route('Payment_students.index')}}">{{trans('main_trans.Payment_students')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu title -->
{{--                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Widgets, Forms & Tables </li>--}}
                    <!-- menu item Widgets-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendence"><i class="ti-blackboard"></i><span class="right-nav-text">{{trans('main_trans.attendance')}}</span>
{{--                            <span class="badge badge-pill badge-danger float-right mt-1">59</span> </a>--}}
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendence" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('attendance.index')}}"> {{trans('main_trans.students_list')}}  </a> </li>
                        </ul>

                    </li>
                    <!-- menu item Form-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
                            <div class="pull-left"><i class="ti-files"></i>
                                <span class="right-nav-text"> {{trans('main_trans.subjects')}} </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Form" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('subjects.index')}}">{{trans('main_trans.subjects_list')}}</a> </li>

                        </ul>
                    </li>
                    <!-- menu item table -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i>
                                <span class="right-nav-text"> {{trans('main_trans.quizzes')}} </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Quizzes.index')}}"> {{trans('main_trans.quizzes_list')}} </a> </li>

                            <li> <a href="{{route('questions.index')}}"> {{trans('main_trans.questions_list')}} </a> </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#online">
                            <div class="pull-left"><i class="fa fa-video-camera"></i>
                                <span class="right-nav-text"> {{trans('main_trans.online_courses')}} </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="online" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('online_classes.index')}}"> {{trans('main_trans.direct_connection_zoom')}} </a> </li>

                            <li> <a href=""> {{trans('main_trans.indirect_connection_zoom')}} </a> </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
                            <div class="pull-left"><i class="fa fa-book"></i>
                                <span class="right-nav-text"> {{trans('main_trans.library')}} </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('libraries.index')}}"> {{trans('main_trans.list_books')}} </a> </li>

                        </ul>
                    </li>

                    <li>
                        <a href="{{route('settings')}}">
                            <i class="fas fa-cogs"></i>
                                <span class="right-nav-text"> {{trans('main_trans.settings')}} </span>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

{{--        <!--================================= >--}}
    </div>

    </div>
