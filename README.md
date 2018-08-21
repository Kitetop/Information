# 文章咨询聚合系统

> 开始

````
1. git clone https://git.duxze.com/xieshizhen/Infor.git
2. composer insatll
3. bin/console start // 开始抓取更新的文章
4. bin/console commend // 获得每日推荐文章
 
````

> 已有站点

````
1. app/config/urllist.php(中设置要定向爬取的站点即可)
   已有：映维网、ChinaAR、ARinChina
````
> 目录结构

``` bash
├── app
|    ├── Action
|    |     ├── Commend 用户获得推荐文章的API请求文件  
|    |     ├── Edit    后台管理员对文章进行管理的API请求文件
|    |     ├── User    记录用户行为的API请求文件
|    ├── Biz  数据库表的文件，返回表名(其他未列出来的都是定向站点的未经处理的文章粗胚)
|    |     ├── Commend.php 用来存储每日推荐文章
|    |     ├── News.php    存储定向站点上次爬取的URL，防止重复爬取
|    |     ├── Theme.php   存储处理过后的文章 
|    ├── Service (未列出来的都是定向爬取站点的处理服务)
|    |     ├── Collection
|    |     |       ├── Collection.php 收集文章的入口文件
|    |     |       ├── GrabSource.php 统一的爬取网页的内容服务
|    |     |       ├── SaveIndex.php  存储上次爬取存储的索引，方便及时阻断服务
|    |     |       ├── SaveNews.php   存储信息的工厂，根据爬取名字来决定将信息存储到哪一个文档中  
|    |     ├── Commend
|    |     |       ├── Compute.php     计算权重的服务(待完善)
|    |     |       ├── config.php      进行推荐的配置文件
|    |     |       ├── GetCommend.php  将文章存入推荐表
|    |     |       ├── GetTarget.php   给推荐文章进行排序的服务
|    |     |       ├── SaveCommend.php 将推荐的文章存入到推荐表中
|    |     |       ├── GetNews.php     让用户得到推荐的文章
|    |     |       ├── GetDetails.php  让用户得到推荐文章的文章详情
|    |     ├── Common
|    |     |       ├── Sort.php       排序的公共服务
|    |     |       ├── TimeDeal.php   对时间进行处理的服务，返回距现在多少小时
|    |     |       ├── TimeChange.php 对距离现在多少小时进行处理的服务，美化时间
|    |     ├── Formatdata
|    |     |       ├── Format.php     文本内容提取的入口文件
|    |     |       ├── PullWord.php   通用的分词服务
|    |     |       ├── Compare.php    文章与段落相关度的对比
|    |     |       ├── GetContent.php 对文章内容进行清理，提取段落信息
|    |     |       ├── WordResult.php 根据传递过来的文本信息计算词频
|    |     ├── Edit  给后台管理人员显示以及修改、删除文章的服务
|    |     ├── User  用户行为的服务
|    ├── config
|    |     ├── urllist.php  需要爬取网站的配置信息以及筛选信息规则
|    ├── Console   计划任务启动
|    |     ├── Index.php    文章的采集以及美化的总的入口文件
|    |     ├── Commend.php  获得每日推荐文章                    
├── bin
|    ├── console 设置脚本
├── public 统一入口文件

```

> 逻辑结构

````
1.数据库分层：
  
   各个网站爬取文章表 => Theme表 => commend表
             ├ => news 表用来记录每一个定向网站的上次爬取的url   
  
2.字段设计含义及作用：
   Theme：
         count           => 记录用户点击次数，记录用户行为，后续对文章推荐有用
         edit            => 记录后台管理人员是否对文章进行了修改，会改变文章优先级
         degree          => 记录文章抽取段落与文章整体的相关度
         from            => 记录文章来源，待定是以后根据文章来源总体点击率情况确定每个站点推荐文章数量
         collectionTime  => 记录文章收集时间，用于每日文章推荐 
         commendTime     => 记录文章的推荐时间，用于对文章排序
         editTime        => 记录后台管理人员对文章进行编辑的时间
3.各个服务之间的关系：
   Collection：
         Collection.php => 文章采集的统一入口文件，分发请求，调用各个站点的采集服务
             |——————————————————————       
             | 各个站点的文章采集服务 | 
             |——————————————————————
                       |
                       | => GrabSource.php (采集网页信息的服务)
                       |————————————————————————————
                       |SaveNews.php SaveIndex.php  | => 存储信息
                       |————————————————————————————
                       
   Format：
         Format.php => 文章内容提取的统一入口文件                    
            |——————————————————————————       
            | 各个站点的文章内容提取服务  | 
            |——————————————————————————           
                      
````
> 已有API

````
1. 得到每日推荐资讯
   HOST/news => eg: 10.0.27.200/news method => GET
2. 去除主题相关度不高的资讯
   HOST/edit/delete => eg: 10.0.27.200/edit/delete method => GET (使用axios测试的时候使用delete不成功，但是使用postman可以测通，为了让前端使用，将方法改成了 GET)
3. 得到主题相关度情况的咨询
   HOST/edit => eg: 10.0.27.200/edit method => GET  
4. 修改抽取的资讯段落，进行编辑
   HOST/edit => eg: 10.0.27.200/edit method => POST  
5. 获得文章详情
   HOST/news/details => eg: 10.0.27.200/news/details method => GET  
6. 记录用户的点击数量
   HOST/news/count => eg: 10.0.27.200/news/count method => GET
   
````

       



       



       

