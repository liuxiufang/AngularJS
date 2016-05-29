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
	* ng-copy 当文本框的值复制时发生改变 (例子见04/4.html)  
	* ng-bind-html 通过安全的方式把内容绑定到html元素上  
	* angular.isArray 判断是否为数组,如果引用的是数组返回 true (例子见04/6.html) 
	* angular.isNumber() 判断是否为数字  
	* angular.bootstrap() 手动启动angular js
	* angular.module()  创建，注册或检索 AngularJS 模块  
	` angular.module('myApp', []).controller('userCtrl', function($scope) { }`  
	* angular.noop() 空函数
	
 4. 表单控件  
 
	表单控件类的模板指令，最大的作用是它预定义了需要绑定的数据的格式，这样方便快捷的处理模板和数据
	* form
	
  		form标签必须要指定name 和 ng-controller,并且每一个控件都要绑定一个变量，form 和控件的名字，即是$scope中的相关市里的引用变量名称。

	  		<form id="myForm" name="myForm" ng-controller="testController"> 

			<input type="text" required name="username"  ng-model="username" onerror="alert('username')" />
   			<input type="text" name="age" ng-model="age" onerror="alert('age')"/>
    		 <img src="image.gif" onerror="alert('The image could not be loaded.')" />
			<button ng-click="show()">OK</button>
		</form>

	除去对象的方法与属性， form 这个标签本身有一些动态类可以使用： 
	
    1. ng-valid 当表单验证通过时的设置  
    2. ng-invalid 当表单验证失败时的设置  
    3. ng-pristine 表单的未被动之前拥有  
    4. ng-dirty 表单被动过之后拥有  
    
	form 对象的属性有：  

    1. $pristine 表单是否未被动过  
    2. $dirty 表单是否被动过  
    3. $valid 表单是否验证通过  
    4. $invalid 表单是否验证失败  
    5. $error 表单的验证错误  （对象包含所有字段的验证信息）  
    
	注意，这里的失败信息是按序列取的一个。比如，如果一个字段既要求 required ，也要求 minlength ，那么当它为空时， $error 中只有 required 的失败信息。只输入一个字符之后， required 条件满足了，才可能有 minlength 这个失败信息。  
	
		<form name="test_form">
	    <input type="text" name="username" required ng-model="username"  />
	    <span ng-style="{color:'red'}" ng-show="test_form.username.$dirty && test_form.username.$invalid">
	        <span ng-show="test_form.username.$error.required">用户名是必须的。</span>
	    </span>
	    <input type="email" required ng-model="email" name="email"/>
	    <span ng-style="{color:'red'}" ng-show="test_form.email.$dirty && test_form.email.$invalid ">
	        <span ng-show="test_form.email.$error.required">邮箱必填</span>
	        <span ng-show="test_form.email.$error.email">非法的邮箱</span>
	    </span>
	    <input type="submit" ng-disabled="test_form.username.$dirty && test_form.username.$invalid || test_form.email.$dirty && test_form.email.$invalid "/>  </form>  

	* input 是数据的最主要的入口。
	
		1. name 名字
		2. ng-model 绑定的数据 
		3. required 是否必填
		4. ng-required 是否必填
		5. ng-minlength 最小长度 
		6. ng-maxlength 最大长度
		7. ng-pattern 匹配模式 
		8. ng-change 值变化时的回调 
		9. ng-trim 是否有空格  ng-trim=true。    

 	```php 

		<form name="yourForm">
			<input type="text" name="pattern" required ng-trim="true" ng-model="pattern" ng-pattern="/^[0-9]*[1-9][0-9]*$/" ng-maxlength="6" maxlength="6"/>    
		 	<span ng-show="yourForm.pattern.$dirty && yourForm.pattern.$invalid">数量必填</span>    
		 	<input type="url" name="url" required ng-model="url" />    
			<span ng-show="yourForm.url.$dirty && yourForm.url.$invalid">地址错误</span>    
	 	</form>
	```    

input 控件，它还有一些扩展，这些扩展有些有自己的属性：   
		1. input type="number" 多了 number 错误类型，多了 max ， min 属性。     
		2. input type="url" 多了 url 错误类型。   
		3. input type="email" 多了 email 错误类型。   
		

六、 模板中的过滤器  
1. 排序 orderBy  
 orderBy 是模板当中排序用的过滤器标签，它可以像sort函数那样支持一个排序函数，也可以简单地指定一个属性名进行操作   
 
```php 
		<div ng-controller="TestCtrl">
		    {{ data | orderBy: 'age' }} <br />
		    {{ data | orderBy: '-age' }} <br />
		    {{ data | orderBy: '-age' | limitTo: 2 }} <br />
		    {{ data | orderBy: ['-age', 'name'] }} <br />
		</div>
		<script>
    		var TestCtrl = function($scope){
        	$scope.data = [
	            {name: 'B', age: 4},
	            {name: 'A', age: 1},
	            {name: 'D', age: 3},
	            {name: 'C', age: 3},
        	];
    	}

    	angular.bootstrap(document.documentElement);
		</script>  
```

2. filter 过滤标签，对模板内容进行标签过滤，不区分大小写  

```php  
		<div ng-controller="TestCtrl">
		    {{ data | filter: 'a' }} <br />  
		    {{ data | filter: '!A' }} <br />  
		    {{ data | filter: 'd'}} <br />  
		    {{ data | filter: 1}} <br />  
		</div>  
	    <script>
		    var TestCtrl = function($scope){
		        $scope.data = [
		            {name: 'B', age: 4},
		            {name: 'A', age: 1},
		            {name: 'D', age: 3},
		            {name: 'C', age: 3},
		        ];
		    }
		    angular.bootstrap(document.documentElement);</script>  

```

3. 时间转换 对模板中的内容进行时间转换  

```php  
		<div ng-controller="TestCtrl">
		    {{ a | date: 'yyyy-MM-dd HH:mm:ss' }}
		</div>
		
		<script type="text/javascript">
		    var TestCtrl = function($scope){
		        $scope.a = ((new Date().valueOf()));
		    }
		
		    angular.bootstrap(document.documentElement);
		</script> 
``` 

4. limitTo 截取标签，截取模板内容  

		{{ [1,2,3,4,5] | limitTo: 2 }}
		{{ [1,2,3,4,5] | limitTo: -3 }}  

5. lowercase uppercase 大小格式转换  

		{{ 'abc' | uppercase }}
		{{ 'ABCd你好' | lowercase }}  

七、 锚点路由  

1. 使用锚点前，必须要先定义,$routeProvider用这个服务来定义

```php  

	<body  ng-app="routingDemoApp">  
	<ul>
	    <li><a href="#/">首页</a></li>
	    <li><a href="#/new">新闻</a></li>
	    <li><a href="#/comment">评论</a></li>
	</ul>
	<div ng-view></div>
	<script type="text/javascript" src="../src/js/route.js"></script>
	<script>
	    angular.module('routingDemoApp',['ngRoute'])
            .config(['$routeProvider', function ($routeProvider) {
                $routeProvider
                    .when('/',{template:'这是首页页面'})
                      .when('/new',{template:'这是新闻分类页面'})
                    .when('/new',{templateUrl:'2.html'})
                    .when('/comment',{template:'这是评论页面'})
                    .otherwise({redirectTo:'/'});
            }]);
	</script>
	</body>    
```

首先看 ng-view 这个 directive ，它是一个标记“锚点作用区”的指令。  
锚点作用区的功能，就是让锚点路由定义时的那些模板， controller 等，它们产生的 HTML 代码放在作用区内。  

2. 定义模板变量的表示符  

一般变量模板的标识符都已经默认定义好，但是如果开发人员想自己定义模板变量标识标签.  
	
```php  
	 angular.bootstrap(document.documentElement,
	  [function($interpolateProvider){
	    $interpolateProvider.startSymbol('[[');
	    $interpolateProvider.endSymbol(']]');
	  }]);   
```

八、  HTTP请求  
	1. 请求处理，请求并且返回一个扩充success方法和error方法的promise对象，还可以增加回调函数   
	
$http 接受的配置项有：  
	* method 方法  
	* url 路径  
	* params GET请求的参数  
	* data post请求的参数     
 
```php  
	<body ng-app="MyApp" ng-controller="TestController">
	<ul>
	    <li ng-repeat="x in list">
	        {{ x.username + ', ' + x.age }}
	    </li>
	</ul>
	<script>
	    var app = angular.module('MyApp', []);
	    app.controller('TestController', function($scope, $http) {
	        $http.get("indexController.php")
	                .success(function(response) {$scope.list = response.data;});
	    });
	</script> 
``` 
九、 其他  
 1. 模板单独使用  
	
单独运行模板也必须和DOM紧密相关，定义时必须是html标签包裹，这样才能创建DOM,并且渲染页面时，必须传入$scope,之后便可以$compile就可以得到一个渲染好的节点对象  

```php  
	<body ng-app="MyApp" ng-controller="TestController">
	<div>
    <p>{{ a }}</p>
	</div>
	<script>
    var app = angular.module('MyApp', []);
    app.controller('TestController', function($scope,$element,$compile) {
        $scope.a = '123';
        $scope.set = function(){
            var tpl = $compile('<p>hello {{ a }}</p>');
            var e = tpl($scope);
            $element.append(e);
        }
        $scope.set();
    });
	</script>
	</body>  
```
  
 2. 自定义模块  
 
```php  
	var my_module = angular.module('MyModule', [], function(){
    console.log('here');
	}); 
``` 

这段代码定义了一个叫做 MyModule 的模块， my_module 这个引用可以在接下来做其它的一些事，比如定义服务。  

3. 自定义服务  

 ng在提供服务的过程涉及它的依赖注入机制，也就是通过provider这个注入控制器，来使操作的，注入机制通过调用一个provider的$get()方法，把得到的内容作为控制器的参数进行相关调用，  
	
```php  
	//这是一个provider
	var pp = function(){
	  this.$get = function(){
	    return {'haha': '123'};
	  }
	}

	//我在模块的初始化过程当中, 定义了一个叫 PP 的服务
	var app = angular.module('Demo', [], function($provide){
	  $provide.provider('PP', pp);
	});

	//PP服务实际上就是 pp 这个 provider 的 $get() 方法返回的东西
	app.controller('TestCtrl',
	  function($scope, PP){
	    console.log(PP);
	  }
	);  

```
这里分为factory方法，和service方法，两者的区别在于，service要求提供一个“构造方法”，并且得到一个object，而factory要求提供的是$get()方法，得到一个数字或者字符串，他们之间的关系  

	

第一个是factory方法，module的factory是一个引用，这个方法直接把一个函数当成一个对象的$get()方法，这样就可以不用显示地定义一个provider：  

```php  
	var app = angular.module('Demo', [], function($provide){
	  $provide.factory('PP', function(){
	    return {'hello': '123'};
	  });
	});
```
    app.controller('TestCtrl', function($scope, PP){ console.log(PP) });  
第二个是service方法，  
```php  
	 var app = angular.module('Demo', [], function(){ });
		app.service = function(name, constructor){
		  app.factory(name, function(){
		    return (new constructor());
		  });
	}
  ```
  
	





			





	



 
	
	
	
	

	
		
		

	    
	
 	
  
  


 
 


