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
  

	 * ng-src 控制src属性:
	
	` <img ng-src="{{'../src/image/logo.gif'}}">`  
	* ng-href 控制 href 属性：  
	
	` <a ng-href="{{ 'http://www.baidu.com'}}">here</a>`  
	* ng-checked 选中状态:  
	
 			<p>My cars ng-checked:</p>
			<input type="checkbox" ng-model="all">全选
			<input type="checkbox" ng-checked="all">奥迪
			<input type="checkbox" ng-checked="all">奔驰 
	例子见03/10.html  
	* ng-selected 被选择状态 
	* ng-disabled 禁用状态
	* ng-multiple 多选状态
	* ng-readonly 只读状态
	* ng-options  选择的值是一个对象 
	  
	注意： 上面的这些只是单向绑定，即只是从数据到展示，不能反作用于数据。要双向绑定，还是要使用 ng-model 。

  3. 事件  
  
	* ng-change  (例子见04/1.html)
	ng-change 指令用于告诉 AngularJS 在 HTML 元素值改变时需要执行的操作,注意一点ng-change搭配ng-model来进行操作。  
	AngularJS ng-change 指令指令不会覆盖原生的 onchange 事件, 如果触发该事件，ng-change 表达式与原生的 onchange 事件都会执行  
	ng-change 事件在值的每次改变时触发，它不需要等待一个完成的修改过程，或等待失去焦点的动作。  
	ng-change 事件只针对输入框值的真实修改，而不是通过 JavaScript 来修改。  

	* ng-click 点击  (例子见04/2.html)
	ng-click 指令告诉了 AngularJS HTML 元素被点击后需要执行的操作。  

 	* ng-dblclick 双击 (例子见04/2.html)
 	ng-dblclick 指令用于告诉 AngularJS 在鼠标鼠标 HTML 元素时需要执行的操作并且不会覆盖原始的ondblclick事件，ng-dblclick 表达式与原始的 ondblclick 事件将都会执行。  
	
	* ng-mousedown 鼠标在指定的 HTML 元素上按下时要执行的操作。 (例子见04/3.html)  
	
		鼠标点击依次执行的顺序:

    	Mousedown  
    	Mouseup  
    	Click  
	* ng-mouseenter 鼠标在指定的 HTML 元素上穿过时要执行的操作。 (例子见04/3.html)  
	* ng-mouseleave 鼠标在指定的 HTML 元素上离开时要执行的操作。 (例子见04/3.html)  
	* ng-mousemove 鼠标在指定的 HTML 元素上移动时要执行的操作。 (例子见04/3.html)  
	* ng-mouseover  鼠标在指定的 HTML 移动到元素上时要执行的操作。 (例子见04/3.html)  
	* ng-mouseup  鼠标在指定的 HTML 松开鼠标时要执行的操作。 (例子见04/3.html)
	* ng-submit 指令用于在表单提交后执行指定函数。   (例子见04/3.html)
	
	
	

	
		
		

	    
	
 	
  
  


 
 


