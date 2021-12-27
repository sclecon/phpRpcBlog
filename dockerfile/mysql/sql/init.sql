-- 进入数据库
use `blog`;

-- 系统配置表
CREATE TABLE IF NOT EXISTS `system` (
    `id` mediumint(8) unsigned auto_increment,
    `field` char(64) NOT NULL COMMENT '配置标识',
    `info` varchar(32) NOT NULL COMMENT '配置名称',
    `ctype` char(16) NOT NULL DEFAULT 'input' COMMENT '配置类型',
    `value` varchar(255) DEFAULT NULL COMMENT '配置值',
    PRIMARY KEY (`id`),
    UNIQUE (`field`)
) ENGINE = InnoDB;

-- 广告数据表
CREATE TABLE IF NOT EXISTS `advertisement` (
    `id` mediumint(8) unsigned auto_increment,
    `name` varchar(64) NOT NULL COMMENT '广告名称',
    `image` char(255) NOT NULL COMMENT '广告图片',
    `url` char(255) NOT NULL COMMENT '广告链接',
    `ctype` char(16) NOT NULL DEFAULT 'banner' COMMENT '广告类型',
    `status` int(1) NOT NULL DEFAULT 1 COMMENT '用户状态',
    `dateline` int(10) NOT NULL COMMENT '创建时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 用户信息表
CREATE TABLE IF NOT EXISTS `user` (
    `id` mediumint(8) unsigned auto_increment,
    `name` varchar(64) NOT NULL COMMENT '用户名',
    `avatar` char(255) NOT NULL COMMENT '用户头像',
    `super_admin` int(1) NOT NULL DEFAULT 0 COMMENT '是否超级管理员',
    `status` int(1) NOT NULL DEFAULT 1 COMMENT '用户状态',
    `dateline` int(10) NOT NULL COMMENT '创建时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 分类表
CREATE TABLE IF NOT EXISTS `cate` (
    `id` mediumint(8) unsigned auto_increment,
    `name` varchar(64) NOT NULL COMMENT '分类名称',
    `image` char(255) NOT NULL COMMENT '分类图标',
    `status` int(1) NOT NULL DEFAULT 1 COMMENT '分类状态',
    `dateline` int(10) NOT NULL COMMENT '创建时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 文章表
CREATE TABLE IF NOT EXISTS `article` (
    `id` mediumint(8) unsigned auto_increment,
    `cid` mediumint(8) unsigned NOT NULL COMMENT '文章分类ID',
    `uid` mediumint(8) unsigned NOT NULL COMMENT '发布用户UID',
    `subject` varchar(128) NOT NULL COMMENT '文章标题',
    `introduce` varchar(255) NOT NULL COMMENT '分类简介',
    `views` int(5) NOT NULL DEFAULT 0 COMMENT '文章查看人数',
    `reply` int(5) NOT NULL DEFAULT 0 COMMENT '文章评论人数',
    `status` int(1) NOT NULL DEFAULT 1 COMMENT '文章状态',
    `dateline` int(10) NOT NULL COMMENT '创建时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 文章详情表
CREATE TABLE IF NOT EXISTS `article_message` (
    `id` mediumint(8) unsigned auto_increment,
    `aid` mediumint(8) unsigned NOT NULL COMMENT '文章ID',
    `message` text COMMENT '文章内容',
    `dateline` int(10) NOT NULL COMMENT '创建时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 文章评论表
CREATE TABLE IF NOT EXISTS `article_reply` (
    `id` mediumint(8) unsigned auto_increment,
    `aid` mediumint(8) unsigned NOT NULL COMMENT '文章ID',
    `uid` mediumint(8) unsigned NOT NULL COMMENT '发布用户UID',
    `message` varchar(255) NOT NULL COMMENT '评论内容',
    `status` int(1) NOT NULL DEFAULT 1 COMMENT '评论状态',
    `dateline` int(10) NOT NULL COMMENT '创建时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 插入系统配置
insert into `system` (`field`, `info`, `ctype`, `value`) values ('system_name', '系统名称', 'input', 'sclecon博客');
insert into `system` (`field`, `info`, `ctype`, `value`) values ('web_title', '首页标题', 'input', '基于phpJsonRpc开发的博客系统');

-- 插入广告数据
insert into `advertisement` (`name`, `image`, `url`, `ctype`, `dateline`) values ('一张轮播图', 'image-url', 'url', 'banner', UNIX_TIMESTAMP(NOW()));

-- 插入超级管理员
insert into `user` (`name`, `avatar`, `super_admin`, `dateline`) values ('admin', 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJsr2z03cDf9Ksp8uiajvDicjRZhz2icQib6QGzPVBzYsNgJgVhNJUria8unUzEmTq40bQsR2jRBWWoNHg/132', 1, UNIX_TIMESTAMP(NOW()));
-- 插入默认分类
insert into `cate` (`name`, `image`, `dateline`) values ('php', 'https://profile.csdnimg.cn/1/A/5/3_qq_43318174', UNIX_TIMESTAMP(NOW()));
-- 插入一篇文章
insert into `article` (`uid`, `cid`, `subject`, `introduce`, `dateline`) values (1, 1, 'Hello Hyperf&Vue', '这个项目后端采用Hyperf，前端采用Vue', UNIX_TIMESTAMP(NOW()));
-- 插入文章内容
insert into `article_message` (`aid`, `message`, `dateline`) values (1, '这个项目后端采用`Hyperf`，前端采用`Vue`！此项目会慢慢进行完善', UNIX_TIMESTAMP(NOW()));


