# sanction-list
Изучение symfony. Модуль сохранения и вывода списка санкций



## Получение данных по API

### Типы полей запроса **Params** 
| Название    | Тип   | Обяз | Описание                                      |
|-------------|-------|------|-----------------------------------------------|
| requisite   | int   | Н    | Реквизиты                                     |
| kartotekaId | int   | Н    | Идентификатор организации                     |
| orderBy     | array | Н    | Сортировка вывода. По какому полю сортировать |
| size        | int   | Н    | Лимит (размер) выборки                        |
| from        | int   | Н    | С какой страницы выводить                     |

### Пример запроса

```http request
POST URI_API/sanction-list/api
Content-Type: application/json

{
  "jsonrpc": "2.0",
  "id": 1,
  "method": "search",
  "params": {
    "requisite": 45235345,
    "kartotekaId": 9,
    "orderBy": {
      "dateUpdate": "DESC"
    },
    "size": 10,
    "from": 3
  }
}
```

### Типы полей ответа **Result**
| Название    | Тип          | Обяз | Описание                    |
|-------------|--------------|------|-----------------------------|
| name        | string       | О    | Наименование                |
| requisite   | string       | О    | Реквизит                    |
| status      | string       | О    | Статус организации          |
| kartotekaId | int          | О    | Идентификатор организации   |
| date        | DateSanction | О    | Даты включения/исключения   |
| country     | string       | О    | Страна, применившая санкции |
| directive   | string       | О    | Директивы                   |

### Типы полей ответа **DateSanction**
Формат вывода Y-m-d

### Типы полей ответа **DateSanction**
| Название  | Тип  | Обяз | Описание                          |
|-----------|------|------|-----------------------------------|
| inclusion | date | Н    | Дата включения                    |
| exclusion | date | Н    | Дата исключения                   |
| unknown   | bool | Н    | До распоряжения об отмене санкций |


### Пример ответа

```json
{
  "jsonrpc": "2.0",
  "id": 1,
  "result": {
    "data": [
      {
        "name": "ЗАО РыбТелеВодСнос",
        "requisite": "5363656282",
        "status": "eligendi",
        "kartotekaId": 9,
        "date": {
          "inclusion": "1989-10-03",
          "exclusion": null,
          "unknown": true
        },
        "country": "Гамбия",
        "directive": null
      },
      {
        "name": "ОАО ТяжФлотКрепЦентр",
        "requisite": "1535403995",
        "status": "possimus",
        "kartotekaId": 9,
        "date": {
          "inclusion": "2010-07-01",
          "exclusion": null,
          "unknown": true
        },
        "country": "Оман",
        "directive": "eligendi"
      },
      {
        "name": "ПАО ЦементФинансАсбоцемент",
        "requisite": "4637328904",
        "status": "inventore",
        "kartotekaId": 9,
        "date": {
          "inclusion": "2002-11-01",
          "exclusion": null,
          "unknown": true
        },
        "country": "Папуа-Новая Гвинея",
        "directive": "ad"
      },
      {
        "name": "ПАО КазМоторЛенБанк",
        "requisite": "8126023258",
        "status": "in",
        "kartotekaId": 9,
        "date": {
          "inclusion": "2011-06-12",
          "exclusion": "2012-08-26",
          "unknown": false
        },
        "country": "Самоа",
        "directive": "eligendi"
      },
      {
        "name": "ПАО СеверТверьЦемент",
        "requisite": "0318549515",
        "status": "magnam",
        "kartotekaId": 9,
        "date": {
          "inclusion": null,
          "exclusion": null,
          "unknown": false
        },
        "country": "Замбия",
        "directive": "omnis"
      },
      {
        "name": "ООО Цемент",
        "requisite": "3693639852",
        "status": "tenetur",
        "kartotekaId": 9,
        "date": {
          "inclusion": "2013-09-17",
          "exclusion": null,
          "unknown": true
        },
        "country": "Барбадос",
        "directive": null
      },
      {
        "name": "МФО СантехКазаньХмель",
        "requisite": "7311795240",
        "status": "eaque",
        "kartotekaId": 9,
        "date": {
          "inclusion": "2005-04-14",
          "exclusion": null,
          "unknown": true
        },
        "country": "Аргентина",
        "directive": "molestias"
      },
      {
        "name": "МФО Башкир",
        "requisite": "6135455035",
        "status": "velit",
        "kartotekaId": 9,
        "date": {
          "inclusion": null,
          "exclusion": null,
          "unknown": true
        },
        "country": "Мадагаскар",
        "directive": null
      },
      {
        "name": "ОАО ITЭлектро",
        "requisite": "4629012047",
        "status": "illo",
        "kartotekaId": 9,
        "date": {
          "inclusion": "2004-12-06",
          "exclusion": null,
          "unknown": true
        },
        "country": "Венгрия",
        "directive": null
      },
      {
        "name": "ОАО Урал",
        "requisite": "2113930681",
        "status": "eius",
        "kartotekaId": 9,
        "date": {
          "inclusion": null,
          "exclusion": "2033-11-09",
          "unknown": false
        },
        "country": "Болгария",
        "directive": null
      }
    ]
  }
}
```