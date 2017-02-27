<?php
$topModules = \App\Models\SysModule::tops()->get();
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/assets/plugins/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            @forelse($topModules as $module)
                <li class="treeview">
                    <a href="#">
                        <i class="{{$module->icon}}"></i>
                        <span>{{$module->name}}</span>
                        <span class="pull-right-container">
                      <span class="label label-primary pull-right">{{count($module->children)}}</span>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        @forelse($module->children as $child)
                            <li class="{{app('request')->is(trim($child->url, '/')) ? 'active':''}}"><a href="{{url($child->url)}}"><i class="{{$child->icon}}"></i>{{$child->name}}</a></li>
                            @empty
                        @endforelse
                    </ul>
                </li>
                @empty
            @endforelse
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script type="text/javascript">
    $(function () {
        $('.treeview .active').parent().parent().addClass('active ');
    })
</script>