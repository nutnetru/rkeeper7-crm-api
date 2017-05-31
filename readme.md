## RKeeper 7 CRM API Wrapper

[![Pub](https://poser.pugx.org/nutnetru/rkeeper7-crm-api/v/stable.svg)]()
[![Travis](https://img.shields.io/travis/nutnetru/rkeeper7-crm-api.svg)]()

### Установка
```bash
composer require nutnet/rkeeper7-crm-api
```

### Использование
См. [примеры](examples/basic.php)

### Методы
Реализованы (см. [здесь](src/Requests)):
 * Get Cards Info (получить информацию по карте)
 * Transaction (выполнить транзакцию)
 * Get Transactions Info (список транзакций)
 
Для добавления нового метода реализуйте интерфейс `ApiRequest`.
При использовании метода `RequestAbstract::arrayAsXml` возможны след. форматы входных данных:

###### Ключ => значение
Преобразуется в `<ключ>значение</ключ>`

###### Одиночный элемент с параметрами
```php
'ключ' => [
   'value' => 'значение', // необязательно
   'attr' => ['name' => 'test'], // необязательно, аттрибуты элементы
   'children' => [...] // необязательно, дочерние элементы в таком же формате
]
```
преобразуется в `<ключ name="test"">...дочерние элементы...</ключ>`

###### Несколько элементов
```php
'ключ' => [
   [
       'value' => 1
   ],
   [
       'value' => 2,
       'attr' => [
           'test' => 'yes'
       ]
   ]
]
```
преобразуется в:
```xml
<ключ>1</ключ>
<ключ test="yes">2</ключ>
```