目录说明
1.controller为控制器，命名规则RainController.class.php  类名与文件名一致
2.include,这个是框架的文件目录
3.model为逻辑层，链接数据库或者处理复杂的业务逻辑写到这里，命名规则RainModel.class.php  类名和文件名一致
4.Library为功能库，直接使用的，优先考虑(类名::方法名即可访问的)，放到这里(CURL,Array等处理函数)，命名规则RainLibrary.class.php,类名和文件名一致


pathInfo说明：
index.php   =>  RunController -> run();
index.php/rain  => RainController -> run();
index.php/rain/run  =>RainController -> run();

