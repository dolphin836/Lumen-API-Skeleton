## 说明

开发环境创建了 `MySQL` 和 `Redis` 服务，亦可用于本地开发。`PHP` 镜像安装了 `pdo_mysql`、`opcache`、`sockets` 三个扩展组件。`opcache` 只在生产环境启用。

如果你不使用 `Docker` 来构建项目，也完全没有影响，`Laravel` 源码目录是 `backend`

## 服务

- MySQL Version 8.0.32
- Redis Version 7.0.9
- Nginx Version 1.23.3
- php-fpm Version 8.1.16
- Supervisor Version 4.2.4
- RabbitMQ Version 3.11.10

## 启动

1. 创建 `Laravel` 配置文件，并设置相应的项

```shell
cp src/.env.example src/.env
```

2. 设置日志目录权限

```shell
chmod -R 777 src/storage/logs
```

3. 创建 `Docker` 配置文件，并设置相应的项，注意端口的设置，避免与本地已有的冲突

```shell
cp .env.example .env
```

4. 初始化并启动服务

```shell
docker compose -f docker-compose.development.yml up -d                               # 创建并启动服务
docker compose -f docker-compose.development.yml start                               # 启动服务
docker compose -f docker-compose.development.yml stop                                # 停止服务
docker compose -f docker-compose.development.yml down                                # 停止并删除服务
docker compose -f docker-compose.development.yml restart                             # 重启所有服务
docker compose -f docker-compose.development.yml restart service_name                # 重启指定服务
```

实际使用中，请根据当前环境选择对应的配置文件，`docker-compose.development.yml` 开发环境，`docker-compose.test.yml` 测试环境，`docker-compose.production.yml` 生产环境

生产环境由于启用了 `Opcache`，代码更新后需要重启 `php-fpm` 服务重新加载代码

```shell
docker compose -f docker-compose.development.yml restart php-fpm
```

5. 安装或更新依赖

首次安装或者 `composer.lock` 文件有更新时需要更新依赖

```shell
docker compose -f docker-compose.development.yml exec php-fpm composer install # 全量安装
docker compose -f docker-compose.development.yml exec php-fpm composer update --lock # 增量安装
```

6. 更新代码

```shell
git fetch --all
git reset --hard origin/master
```

7. 迁移数据库

```shell
php artisan migrate:fresh
php artisan db:seed
```

## 其他

- Supervisor 的 Web 服务的账号和密码在 supervisor/supervisord.conf 中设置的
- Supervisor 常用命令
  - supervisorctl status|stop|start|restart server_name # 管理单个进程
  - supervisorctl update # 只重启配置文件变化了的进程
  - supervisorctl reload # 重启 supervisord（重新加载所有的配置文件）
  - supervisorctl shutdown # 停止 supervisord