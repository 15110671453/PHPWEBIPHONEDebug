/**
 * Created by admindyn on 2018/7/5.
 */


var someThing = {};

console.dir(someThing);

var  son = null;

var arr = ["java","c++","python"];

/*
* 判断对象类型  当对象null 是 返回undefined
*
* 其他 返回string number boolen function object
* */

console.log(typeof some);

console.log(typeof son);
console.log(typeof "123");
console.log(typeof 123);
console.log(typeof true);

/*
* 普通函数 随时可以变为构造函数
* */
function F(){}

console.log(typeof F);
/*
* 对于 从没有声明过的变量 可以使用 typeof 操作符 获得 undefined 但是
* 其他操作就不行了 运行报错
* */

// if (!(some instanceof Object))
// {
//     console.log("null");
// }
//console.log(some);



if (!(son instanceof Object))
{
    /*
    * 判断对象为空Null
    *
    * 声明 并定义过 但是 后来置为了null
    * */
    console.log("son");
    console.log("null");
    console.log(son);
}


var mdef;

console.log(typeof mdef);
if (!(mdef instanceof Object))
 {
     /*
     * 声明了 未定义
     * */
     console.log("mdef");
     console.log("null");
     console.log(mdef);
 }



var t = 123;

if ((typeof t) == 'number')
{
    console.log("数值类型");
    if (t instanceof Number)
    {
        console.log("数值对象");
    }
}
var w = '123';
if ((typeof w) == 'string')
{
    console.log("字符串类型");

    if (w instanceof String)
    {
        console.log("字符串对象");
    }
}

if ((typeof true) == 'boolean')
{
    console.log("布尔类型");

    if (true instanceof Boolean)
    {
        console.log("布尔对象");
    }

}
if ((typeof F) == 'function')
{
    console.log("函数类型");

    if (F instanceof Function)
    {
        console.log("函数对象");
    }
}
if ((typeof arr) == 'object')
{
    console.log("object类型");

    if (arr instanceof Array)
    {
        console.log("数组对象");
    }
}

if ((typeof {}) == 'object')
{
    console.log("object类型");

    if ({} instanceof Object)
    {
        console.log("Object对象");
    }
}



console.dir(F);

console.log(Object.prototype.toString.call(F));
/*
* 对象
* */
var f = new F();

console.dir(f);

console.log(Object.prototype.toString.call(f));


(function () {

    function inherit(Sub, Super){
        /*
         * 思考 这里通过空函数作为继承原型的中转 说到空对象 为什么没有用Object 或字面量对象{} 而用一个空函数 对象
         *
         * 原因在于这里 需要用到prototype 关联原型 函数向上查找的特点
         *
         * 这个属性只有函数有
         * */
        function F(){}

        /*
        *
        * 这里选择一个空 构造函数 实例的对象 作为 中转 原型对象
        *
        * F()的一个实例，那这个实例会有一个_proto指针，这个指针指向父类的prototype原型对象,
        *
        * 原型链建立

        * */

        F.prototype = Super.prototype;
        Sub.prototype = new F();
        Sub.prototype.constructor = Sub;
    }

    function Person(name, age, gender){
        if(!(this instanceof Person)){
            return new Person(name, age, gender);
        }
        this.name = name;
        this.age = age;
        this.gender = gender;
        /*
         * 函数中的this 到底是谁 原则：
         *  1、函数作为 构造函数调用  new 运算符 修改this 为当前的对象
         *  2、函数被赋值给一个类的属性 通过哪个类的对象调用这个函数 这个函数执行时this 的取值就是
         *  该方法所在的对象
         *  3、普通函数 没有赋值给任何一个类的属性 也没有作为构造函数 那么这种函数当前this 应该取值window
         *  4、通过call 函数 apply 函数 bind 函数 临时修改this 的取值
         * */

        this.test = function(){ console.log("Test, my name is " + this.name); };
    }
    Person.prototype.sayHello = function(){ console.log("Hello, my name is " + this.name); };
    var somebody = new Person("youxia person", 30, "male");
    var another = new Person("another person", 20, "female");

    somebody.sayHello();

    another.sayHello();

    another.test();

    console.dir(Person);

    console.dir(somebody);



    function Worker(name, age, gender, speciality){
        /*
        * obj instanceof Object
        * 检测Object.prototype是否存在于参数obj的原型链上。
        *
        * 这里检测Person的原型链 是否在当前对象的原型链上 从而决定是否继承了Person
        * */
        if(!(this instanceof Person)){

            return new Worker(name, age, gender, speciality);
        }
        Person.call(this, name, age, gender);
        this.speciality = speciality;
    }
    inherit(Worker, Person);
    Worker.prototype.doWork = function(){console.log(this.name + " is working with " + this.speciality);}

    var worker = new Worker("youxia woker", 30, "male", ["JavaScript","HTML","CSS"]);
    worker.sayHello(); //从Person类继承的
    worker.doWork();   //Worker类中自己定义的
    worker.test();

    console.dir(worker);

    console.dir(Worker);

    window.mymodule = {
        inherit : inherit,
        Person : Person,
        Worker : Worker
    }

})();

var worker = new window.mymodule.Worker("moduler test",40,"hahaha",["OC","Python","C"]);

worker.doWork();



console.log(Object.prototype.toString.call(worker));


function Y2Y(age){

    this.age = age;
}


function T2T(speciality){

    this.speciality = speciality;
}

function update(Sub,Super){
    /*
     * 思考 这里通过空函数作为继承原型的中转 说到空对象 为什么没有用Object 或字面量对象{} 而用一个空函数 对象
     *
     * 原因在于这里 需要用到prototype 关联原型 函数向上查找的特点
     *
     * 这个属性只有函数有
     * */
    function F(){}

    /*
     *
     * 这里选择一个空 构造函数 实例的对象 作为 中转 原型对象
     *
     * F()的一个实例，那这个实例会有一个_proto指针，这个指针指向父类的prototype原型对象,
     *
     * 原型链建立

     * */

/*
* 这里是对比 原型链建立
* */
    F.prototype = Super.prototype;
    Sub.prototype = new F();
    /*
    *
    *
    * */
    /*
    * 这里是给空构造函数F 实例的对象 添加了一个constructor属性 原本对象是没有这个属性
    *
    * 一个原型链 一个节点需要一个constructor
    * 也就是说 一个任意对象经过这样被构造函数原型指引 并且自己添加constructor指引该构造函数 可改造为原型对象
    * 这里使用空对象是为了 资源利用
    *
    *
    * */
    Sub.prototype.constructor = Sub;
    /*
    *
    * */

}

update(T2T,Y2Y);

var g = new T2T("special");

console.dir(g);






