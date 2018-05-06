#Event-sourcing with Prooph

##Framework
Frameworks used:
- [Symfony4]
- [Bootstrap4]

##Event Sourcing  
Components used:
- [Prooph event-sourcing]
- [Prooph pdo-event-store]
- [Prooph event-store-symfony-bundle]

##Docker

```
cd resources/provision/docker
docker-compose up

```

## MySql
```
host: 127.0.0.1
credentials: user/password
port: 3307
schema: playlist
```

##Web

```
http://127.0.0.1:8081
```

[Symfony4]: http://www.symfony.com
[Bootstrap4]: https://getbootstrap.com/docs/4.0/
[Prooph event-sourcing]: https://github.com/prooph/event-sourcing/
[Prooph pdo-event-store]: https://github.com/prooph/pdo-event-store
[Prooph event-store-symfony-bundle]: https://github.com/prooph/event-store-symfony-bundle
