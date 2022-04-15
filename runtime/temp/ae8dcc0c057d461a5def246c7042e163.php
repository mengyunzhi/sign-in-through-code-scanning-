<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\index\coursedetail.html";i:1650014901;s:69:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\index.html";i:1650014901;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>
课程管理
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/foundation/5.5.3/css/foundation.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/foundation/5.5.3/js/foundation.min.js"></script>
    <script src="https://cdn.staticfile.org/foundation/5.5.3/js/vendor/modernizr.js"></script>
    <script src="https://unpkg.com/vue@next"></script>
</head>

<body class="container">
    <!-- 菜单导航 -->
    <div class="row">
        <div class="col-md-12">
            
            <!-- 菜单导航 -->
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="http://www.mengyunzhi.com">梦云智</a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class=""><a href="<?php echo url('index'); ?>">课程管理</a></li>
                            </ul>
                            <ul class="nav navbar-nav">
                                <li class=""><a href="<?php echo url('courseSort'); ?>">排课管理</a></li>
                            </ul>
                            <ul class="nav navbar-nav">
                                <li class=""><a href="<?php echo url('courseScheduleWeek?week='.$week); ?>">课程表</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo url('index/Login/webLogout'); ?>">注销</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            <!-- /菜单导航 -->
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            

            
<div class="row">
    <div class="col col-md-8">
        <div class="col-sm-12">
            <a href="<?php echo url('courseSort'); ?>" class="btn btn-primary"><i class="glyphicon"></i>&nbsp;返回</a>&nbsp&nbsp
            <a href="<?php echo url('courseProgramAdd?schedule_id='.input('param.schedule_id')); ?>" class="btn btn-info"><i class="glyphicon"></i>&nbsp;添加项目</a>&nbsp&nbsp
            <a href="<?php echo url('courseTimeAdd?schedule_id='.input('param.schedule_id')); ?>" class="btn btn-success">&nbsp;添加上课时间</a>&nbsp;
            <a href="<?php echo url('courseKlassAdd?schedule_id='.input('param.schedule_id')); ?>" class="btn btn-success">&nbsp;添加上课班级</a>&nbsp;
        </div>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col-md-3">项</th>
                    <th scope="col-md-3">内容</th>
                    <th scope="col-md-3">其它</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>课程名称</td>
                    <td><?php echo $Schedule->getCourse()->getName(); ?></td>
                    <td>
                        <a class="btn btn-success" href="<?php echo url('courseEdit'); ?>"><i class="glyphicon"></i>&nbsp;编辑</a>
                    </td>
                </tr>
                <tr>
                    <td>学时</td>
                    <td><?php echo $Schedule->getCourse()->getLesson(); ?></td>
                    <td></td>
                </tr>
                <?php if(is_array($Schedule->getCourse()->getProgram()) || $Schedule->getCourse()->getProgram() instanceof \think\Collection): $key = 0; $__LIST__ = $Schedule->getCourse()->getProgram();if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_Program): $mod = ($key % 2 );++$key;?>
                <tr>
                    <td><?php echo '项目'.$key; ?></td>
                    <td><?php echo $_Program->getName() . '（学时：' . $_Program->lesson . '）'; ?></td>
                    <td>
                        <a href="<?php echo url('courseProgramDelete?program_id='.$_Program->id); ?>" class="btn btn-danger"><i class="glyphicon"></i>&nbsp;删除</a>
                        <a href="<?php echo url('courseProgramEdit?program_id='.$_Program->id.'&schedule_id='.$Schedule->id); ?>" class="btn btn-success"><i class="glyphicon"></i>&nbsp;编辑</a>
                        <a href="<?php echo url(''); ?>" class="btn btn-primary"><i class="glyphicon"></i>&nbsp;上移</a>
                        <a href="<?php echo url(''); ?>" class="btn btn-primary"><i class="glyphicon"></i>&nbsp;下移</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; foreach ($Schedule->klasses as $key => $_Klass): if($key === 0): ?>
                <tr>
                    <td rowspan="<?php echo count($Schedule->klasses); ?>">上课班级</td>
                    <td><?php echo $_Klass->name; ?></td>
                    <td><a href="<?php echo url('courseKlassDelete?schedule_id='.input('param.schedule_id').'&klass_id='.$_Klass->id); ?>" class="btn btn-danger"><i class="glyphicon"></i>&nbsp;删除</a></td>
                </tr>
                <?php else: ?>
                <tr>
                    <td><?php echo $_Klass->name; ?></td>
                    <td><a href="<?php echo url('courseKlassDelete?schedule_id='.input('param.schedule_id').'&klass_id='.$_Klass->id); ?>" class="btn btn-danger"><i class="glyphicon"></i>&nbsp;删除</a></td>
                </tr>
                <?php endif; endforeach; foreach ($DispatchArr as $key => $_Room): if($key === 0): ?>
                <tr>
                    <td rowspan="<?php echo count($DispatchArr); ?>">上课时间/地点</td>
                    <td>第<?php echo $DispatchArr[$key]->getWeek(); ?>周>>星期<?php echo $DispatchArr[$key]->getDay(); ?>>>第<?php echo $DispatchArr[$key]->getLesson(); ?>节,教室<?php echo $roomArr[$key] ?></td>
                    <td><a href="<?php echo url(''); ?>" class="btn btn-danger"><i class="glyphicon"></i>&nbsp;删除</a></td>
                </tr>
                <?php else: ?>
                <tr>
                    <td>第<?php echo $DispatchArr[$key]->getWeek(); ?>周>>星期<?php echo $DispatchArr[$key]->getDay(); ?>>>第<?php echo $DispatchArr[$key]->getLesson(); ?>节,教室<?php echo $roomArr[$key] ?></td>
                    <td><a href="<?php echo url(''); ?>" class="btn btn-danger"><i class="glyphicon"></i>&nbsp;删除</a></td>
                </tr>
                <?php endif; endforeach; ?>

                <tr>
                    <td>教师</td>
                    <td><?php echo $Schedule->getTeacher()->getName(); ?></td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

            

        </div>
    </div>
</body>

</html>