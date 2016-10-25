<?php
    use yii\helpers\Url;
?>
<link rel="stylesheet" href="css/article.css" />
<div class="container">
    <div class="row">
        <div class="col-md-9" >
            <div class="content">
                <article class="thread thread-card  article-nav" style="padding: 5px 10px;">
                    <a href="<?=Url::base(true);?>">首页</a>
                </article>
                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">04</span>
                            <span style="display:block">23</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=29">yii2-imagine配置</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：&nbsp;&nbsp;&nbsp;&nbsp;yii2</li>
                                <li>浏览次数：163</li>
                            </ul>
                        </div>
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       yii2-imagine的拓展和imagine插件是分开的 ， yii2只提供了拓展 ， 刚好用到yii2 ， 搞了一天终于解决了 ， 分享一下心得给大家，希望大家少走点弯路。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=29" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
               <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">04</span>
                            <span style="display:block">15</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=28">haproxy+keepalived实现高可用负载均衡</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：88</li>
                            </ul>
                        </div>
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       haproxy提供了负载均衡 , 而当haproxy宕机时 ， 站点就无法提供服务了 ， 当加上keepalived还有一台备用haproxy , 当主的haproxy无法提供服务时 ， keepalived会启用备用的haproxy ，使站点能继续提供正常的服务。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=28" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">04</span>
                            <span style="display:block">14</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=27">haproxy安装与配置</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：88</li>
                            </ul>
                        </div>
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       HAProxy提供高可用性、负载均衡以及基于TCP和HTTP应用的代理。当访问量提高 ， 为了做负载均衡 ，Haproxy成了不错选择 。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=27" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">04</span>
                            <span style="display:block">09</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=26">利用vsftp做数据备份</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：83</li>
                            </ul>
                        </div>
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       数据备份的手段千万种 ， 根据自己的需求选择自己需要的数据，简单的vsftp数据备份也可以是你的首选。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=26" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">04</span>
                            <span style="display:block">07</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=25">Centos下DRBD+HeartBeat+NFS配置</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：77</li>
                            </ul>
                        </div>
                        <!--<a target="_blank" href="" rel="author" class="avatar avatar-50"><img alt="" src=""></a>-->
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       heartbeat的作用就可以增加drbd的可用性，它能在某节点故障后，自动切换drbd块到备份节点，并自动进行虚IP从新绑定，DRBD块提权，磁盘挂载以及启动NFS等脚本操作，这一系列操作因为只在他后端节点间完成，前端用户访问的是heartbeat的虚IP，所以对用户来说无任何感知。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=25" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">04</span>
                            <span style="display:block">02</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=24">Centos下DRBD安装配置</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：84</li>
                            </ul>
                        </div>
                        <!--<a target="_blank" href="" rel="author" class="avatar avatar-50"><img alt="" src=""></a>-->
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       Distributed Replicated Block Device(DRBD)是一个用软件实现的、无共享的、服务器之间镜像块设备内容的存储复制解决方案。数据镜像：实时、透明、同步（所有服务器都成功后返回）、异步（本地服务器成功后返回）                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=24" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">03</span>
                            <span style="display:block">31</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=23">Linux下mail通过smtp发送邮件</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：96</li>
                            </ul>
                        </div>
                        <!--<a target="_blank" href="" rel="author" class="avatar avatar-50"><img alt="" src=""></a>-->
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       当我们在管理服务器的时候 ， 不可能永远只管理一台 ， 我们管理可能是5台 ，甚至更多 ， 但是我们知道这些服务器的情况呢 ？ 一个个登录去看 ？ 不用 ， 用可以写个shell脚本 ，通过mail发送到自己的邮件就可以了。这样每天定时可以知道服务器的情况。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=23" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">03</span>
                            <span style="display:block">24</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=22">Nginx + php + mysql 服务器环境搭建</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：109</li>
                            </ul>
                        </div>
                        <!--<a target="_blank" href="" rel="author" class="avatar avatar-50"><img alt="" src=""></a>-->
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       Nginx + php + mysql 的组合绝对不亚于LAMP组合 , Nginx的轻量级替代了相对臃肿的Apache，大大提升的WEB的速度。而今如何配置LEMP，网上的资料也很乱，所以整理了一下，分享分享。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=22" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">03</span>
                            <span style="display:block">23</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=21">Linux配置MongoDB</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：91</li>
                            </ul>
                        </div>
                        <!--<a target="_blank" href="" rel="author" class="avatar avatar-50"><img alt="" src=""></a>-->
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       Mongo DB 是目前在IT行业非常流行的一种非关系型数据库(NoSql),其灵活的数据存储方式备受当前IT从业人员的青睐。想要学会Mongo DB 学会配置是第一步 , 所以现在来讲讲如何配置Mongo DB。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=21" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                                <article class="thread thread-card">
                    <header>
                        <div class="time-label">
                            <span class="year">2015</span>
                            <span style="display:block">03</span>
                            <span style="display:block">15</span>
                        </div>
                        <h3 class="thread-title">
                            <a href="/site/article.html?id=17">分析Nginx访问日志及写入数据库</a>
                        </h3>
                        <div class="thread-meta">
                            smister&nbsp;
                            <ul class="blog-category">
                                <li>分类：Linux</li>
                                <li>浏览次数：99</li>
                            </ul>
                        </div>
                        <!--<a target="_blank" href="" rel="author" class="avatar avatar-50"><img alt="" src=""></a>-->
                    </header>
                    <div class="clearfix"></div>
                    <div class="markdown-body">
                       nginx日志分析对每个站长来说都尤其重要，每天的访问量， 那个页面被访问的次数最多 ，那些浏览器是用户常用的 ， 都可以对其一一分析，以便于对网站更好的优化，让用户体验也不断提升。                    </div>
                    <div class="thread-footer">
                        <a href="/site/article.html?id=17" class="ds-thread-bevel">阅读原文</a>
                    </div>
                </article>
                                <!-- 分页数据  -->
                <div class="pagination">
                    <ul class="">
							<li class="prev disabled"><span>&laquo;</span></li>
							<li class="active"><a href="#" data-page="0">1</a></li>
							<li><a href="#" data-page="1">2</a></li>
							<li><a href="#" data-page="2">3</a></li>
							<li class="next"><a href="#" data-page="1">&raquo;</a></li>
					</ul>
				</div>
            </div>

        </div>
        <aside class="col-md-3 sidebar">
			<section class="visitor card">
				<div class="top">
					<div class="user-avatar">
						<a href="javascript:;" class="avatar avatar-50">
							<img alt="Smister" src="http://www.smister.com/mrs.jpg">
						</a>
					</div>
					<h4 class="name">Smister</h4>
					<a href="javascript:;">一步一脚印 ，贵在坚持..</a>
				</div>
			</section>
			<section class="card">
				<h4>分类</h4>
				<ul>
					<li>
						<a href="/site/index.html">全部</a>
					</li>
								<li>
						<a href="/site/index.html?cid=1">PHP</a>
					</li>
								<li>
						<a href="/site/index.html?cid=15">&nbsp;&nbsp;&nbsp;&nbsp;PHP安全</a>
					</li>
								<li>
						<a href="/site/index.html?cid=16">&nbsp;&nbsp;&nbsp;&nbsp;yii2</a>
					</li>
								<li>
						<a href="/site/index.html?cid=2">Linux</a>
					</li>
								<li>
						<a href="/site/index.html?cid=8">Python</a>
					</li>
							</ul>
			</section>

			 <section class="card">
				<h4>热门文章</h4>
				<ul>
					<li style="overflow:hidden;white-space: nowrap;text-overflow: ellipsis;">
						<a href="/site/article.html?id=9">Coreseek(中文分词的Sphinx)分词搜索配置及其设置增量索引</a>
					</li>
					<li style="overflow:hidden;white-space: nowrap;text-overflow: ellipsis;">
						<a href="/site/article.html?id=17">分析Nginx访问日志及写入数据库</a>
					</li>
				   <li style="overflow:hidden;white-space: nowrap;text-overflow: ellipsis;">
						<a href="/site/article.html?id=21">Linux配置MongoDB</a>
					</li>
				</ul>
			</section>
	</aside>
	</div>
</div>