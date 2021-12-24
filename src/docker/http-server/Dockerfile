FROM hyperf/hyperf:8.0-alpine-v3.15-swoole
MAINTAINER sclecon<27941662@qq.com>
WORKDIR /data/project
EXPOSE 9501
CMD ["php", "/data/project/bin/hyperf.php", "start"]

# 创建网络
# docker network create -d bridge php-rpc-blog

# 创建镜像
# docker build -t php-rpc-blog/php-server:latest src\docker\http-server

# 创建容器并启动服务
# docker run -itd -p 9501:9501 --restart always --name http-server --network php-rpc-blog --volume /C/Users/27941/Documents/github/phpRpcBlog/src/workspace/http-server:/data/project php-rpc-blog/php-server php /data/project/bin/hyperf.php start
