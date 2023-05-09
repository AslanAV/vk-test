# vk-test

Demo: https://php-project-lvl-3.herokuapp.com/

## Requirements

* PHP 8.1
* Extensions: sqlite3, Carbon
* Composer 2.4.4
* SQLite

## Setup

```bash
make setup
```

## Run

```bash
make start
```
___

## Setup with Docker

```bash
make compose-setup
```

## Run with Docker

```bash
make compose-start
```

### API  for localhost

1) Для создания события используйте `POST`- запрос на адрес

```json lines
localhost/event
```

с телом запроса
```json
{
    "event": {
        "name": "event2"
    },
    "auth": false
}
```

Где данные по ключу `name` - string,
а данные `auth`- boolean

2) Для фильтрации и получения счетчиков используйте `POST` - запрос на адрес

```json lines
localhost/get-events
```

с телом запроса

```json
{
    "filter": {
        "name_event": "event2",
        "period": {
            "start": "2023-05-07",
            "end": "2023-05-08 14:09:28"
        }
    },
    "count": "ip"
}
```

Где данные по ключу `name_event` - string,
данные `start` `end` - данные о времени в любом читаемом формате,
данные `count` - string.

Для получения различных счетчиков используйте поле `count` тела запроса.

Счетчики
`event_name`- счетчик конкретных событий
`ip` - счетчик событий по пользователю (по IP-адресу)
`status` - счетчик событий по статусу пользователя

