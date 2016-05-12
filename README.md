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

五、模板  

   1. 模板内容  
	   定义模板的内容现在有三种方式： 
	   * 在需要的地方直接写字符串  
	   * 外部文件  
	   * 使用script标签定义的内部文件
	   
	外部文件  
	` <div ng-include="'2.html'"></div>`  

	 使用script标签定义的内部文件  
	` 
	 <a ng-click="t='2.html'">Load</a>  
	 <div ng-include src="t"></div>  
	`  
  2. 内容渲染控制  
 	
	* 重复 ng-repeat  (例子见：03/4.html | 03/5.html)
	
		$index 当前索引  
		$first 是否为头元素  
		$middle 是否为非头非尾元素  
		$last 是否为尾元素  

	*  赋值 ng-init (例子见：03/6.html)
	  
		这个指令可以在模板中直接赋值，它作用于 angular.bootstrap 之前，并且，定义的变量与 $scope 作用域无关。 
	* 样式 ng-style  
	
		` <div ng-style="{width: 100 + 'px', height: 100 + 'px', backgroundColor: 'red'}"> </div>
	    `
	* 类 ng-class  
	
		` <div ng-controller="TestCtrl" ng-class="cls"></div> `  
	* ng-class-even 和 ng-class-odd 是和 ng-repeat 配合使用的  (例子见03/8.html)  
	* 显示和隐藏 ng-show ng-hide  
	
			<div ng-show="true">1</div>  
    
			 <div ng-show="false">2</div>  
    
		  	<div ng-hide="true">3</div>  
    
		  	<div ng-hide="false">4</div>  

	* ng-switch 是根据一个值来决定哪个节点显示，其它节点移除 
	 
	
	        <div ng-init="a=2">  
    	    <ul ng-switch on="a">  
   			<li ng-switch-when="1">1</li>      
    		<li ng-switch-when="2">2</li>    
    		<li ng-switch-default>other</li>    
   		 </ul>  
    	</div>
	
		
		

	    
	
 	
  
  


 
 


