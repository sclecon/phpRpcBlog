# 微服务开发流程
本次开发微服务系统所走过的坑和流程

### 服务端

#### 安装服务端框架
```shell script
composer create-project hyperf/hyperf-skeleton tcp-service-system
```

#### 进入项目目录 假设`work`为本次开发目录
```shell script
cd work/tcp-service-system
```

#### 安装JsonRpc服务
```shell script
composer require hyperf/json-rpc
```

#### 安装JsonRpc服务端
```shell script
composer require hyperf/rpc-server
```

#### 创建服务提供接口
创建目录
```shell script
mkdir app/JsonRpc/Annotation && cd app/JsonRpc/Annotation
```
创建文件 通过`vim AdServiceInterface.php`进入文件写入
```php script
<?php

namespace App\JsonRpc\Annotation;

interface AdServiceInterface {
    public function get(int $id) : array;
}
```

#### 创建服务提供接口对象
进入目录
```shell script
cd ../
```
创建文件 通过`vim AdService.php`进入文件写入
```php script
<?php

namespace App\JsonRpc\Annotation;

/**
 * @RpcService(name="AdService", protocol="jsonrpc", server="jsonrpc", publishTo="consul")
 */
class AdService implements AdServiceInterface {
    public function get(int $id) {
        return ['id'=>$id];
    }
}
```
#### 创建jsonRpc服务
必须要创建jsonrpc服务，否则暴露的协议无效

修改配置文件`config/autoload/server.php`
```php script
<?php

use Hyperf\Server\Server;
use Hyperf\Server\Event;

return [
    // servers里面可只定义jsonrpc服务，而无需定义http服务，因当前项目仅为某服务项
    'servers' => [
        [
            'name' => 'jsonrpc',
            'type' => Server::SERVER_BASE,
            'host' => '0.0.0.0',
            'port' => 9503,
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_RECEIVE => [\Hyperf\JsonRpc\TcpServer::class, 'onReceive'],
            ],
            'settings' => [
                'open_eof_split' => true,
                'package_eof' => "\r\n",
                'package_max_length' => 1024 * 1024 * 2,
            ],
        ],
    ],
];
```
#### 安装consul组件
由于我们是推送到`consul`，所以我们还需要安装`consul`组件
```shell script
# 进入服务提供者根目录
cd work/tcp-service-system
# 安装consul组件
composer require hyperf/service-governance-consul
```
#### 填写`consul`配置信息
`services.php`一般情况下会不存在，这时候我们自己通过`vim`创建即可
```shell script
vim config/autoload/services.php
```
写入配置信息
```php script
<?php
return [
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    'consumers' => [],
    'providers' => [],
    'drivers' => [
        'consul' => [
            'uri' => 'http://127.0.0.1:8500',
            'token' => '',
        ]
    ]
];

```

#### 启动服务
```shell script
php $work/bin/hyperf.php start
```

### 客户端

#### 安装Hyperf框架
```shell script
composer create-project hyperf/hyperf-skeleton http-server
```

#### 进入项目目录 假设`work`为本次开发本目录
```shell script
cd work/http-server
```

#### 安装JsonRpc服务
```shell script
composer require hyperf/json-rpc
```

#### 安装JsonRpc客户端
```shell script
composer require hyperf/rpc-client
```

#### 复制服务接口文件到`app/JsonRpc/Annotation`目录
```shell script
# 创建目录
mkdir app/JsonRpc/Annotation

# 复制文件
copy work/tcp-service-system/app/JsonRpc/Annotation/* work/http-server/app/JsonRpc/Annotation
```

#### 安装`consul`服务中心组件
```shell script
composer require hyperf/service-governance-consul
```

#### 创建并配置服务中心配置文件
`config/autoload/services.php`配置文件一般情况下默认是不存在的

可以通过`vim config/autoload/services.php`进行文件的创建并写入以下配置
```php script
<?php

declare(strict_types=1);

return [
    'consumers' => [
        [
            'name'  =>  'AdService',
            'service'   =>  \App\JsonRpc\Annotation\AdServiceInterface::class,
            'protocol'  =>  'jsonrpc',
            'registry' => [
                'protocol' => 'consul',
                'address' => 'http://127.0.0.1:8500',
            ]
        ]
    ]
];
```
#### 调用服务
我们可以通过在控制器`IndexController`中进行依赖注入
```php script
/**
* @Inject
* @var AdServiceInterface
*/
protected $adService;
```
然后`action`方法中进行调用
```php script
public function index(){
    return [
        'msg'   =>  '演示JsonRpc调用',
        'data'  =>  $this->adService->get(1)
    ];
}
```

#### 启动服务
```shell script
php work/http-server/bin/hyperf.php start
```

### 请求测试
```shell script
curl http:127.0.0.1:9501
```