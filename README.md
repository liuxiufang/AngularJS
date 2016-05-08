一、 AngularJS 简介  
AngularJs 是Google开源的JS工具，简称ng, 它是数据双向绑定，MVVM。
#### 注意：  
 1. 对于IE方面，它兼容IE8以及以上的版本。  
 2. 与JQUERY 集成工作，一些对象与JQuery相关对象表现是一致的。  
 3. 使用ng是不要贸然去改变相关DOM的结构  
 
二、AngularJs 依赖注入  

> 
 var BoxCtrl = function($scope, $element){} 
 
这个函数中有两个参数： $scope和$element 参数名称不可更改，在处理是，通过函数对象的toString()方法可以知道这个函数定义代码的字符串表现形式，然后就知道它的参数$scope 和 $element,通过名字判断出这是两个外部依赖，然后就去获取资源，最后把资源作为参数，调用定义的函数。 

三、  angularJS的指令系统  
 1. ng-app:初始化一个AngularJS应用程序  
 `一个页面中默认只加载一个ng-app，并且是第一个，想要多加载需要手动设置`  
 2. ng-controller:指令定义了应用程序控制器  
 3. ng-model: 双向绑定数据  
 
四、 $scope下的常用方法  
 1. $scope.$watch:监听指定对象  

 > 
 //$.scope.$watch(监听对象，回调(新值，旧值)，是否实时监听)  
$scope.$watch($scope.sum,function(newVal,oldVal){  
    $scope.apple.fre = newVal >= 100 ? 0 : 10;  
},true);  

2. $scope.$apply:可以监听数据是否变化从而影响视图（可以支持原生js方法内使用)  

> 
setTimeout(function(){  
    $scope.$apply(function(){  
        $scope.name = 'hello word';  
    });  
},1000);  


 
 


