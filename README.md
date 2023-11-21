# Развертывание приложения

## Шаг 1: Установка зависимостей
- Откройте терминал и перейдите в папку с загруженным приложением Yii2.
- Выполните команду composer install, чтобы установить все зависимости, перечисленные в файле composer.json.

## Шаг 2: Настройка базы данных
- Создайте новую базу данных на сервере.
- Откройте файл common/config/main-local.php и настройте подключение к базе данных.
- Создайте новую базу данных для тестов на сервере.
- Откройте файл common/config/test-local.php и настройте подключение к базе данных.
- Выполните команду `php ./yii_test migrate`
- Выполните команду `php ./vendor/bin/codecept build`


## Шаг 3: Применение миграций
- В корневом каталоге выполните команду `php yii migrate` в терминале.

## Шаг 4: Запуск тестов
- Для запуска теста связанного с тестовым заданием запустить команду:
`php vendor/bin/codecept run common/tests/unit/component/CadastreReaderTest.php`

# Использование компонента
Компонент, **CadastreReader** находится в директории common/components/CadasterReader.php.
В коде вызывается при помощи: 
```
Yii::$app->CadastreReader->getData($number)
```
где $number - кадастровый номер, типа данных string. Также есть возможность принимать несколько номеров за раз в формате строки с запятой в качестве разделителя. 
Пример: '69:27:0000022:1306, 69:27:0000022:1307'.

Для консоли используется команда:
```
yii cadastre/get 69:27:0000022:1306,69:27:0000022:1307 
```
Для rest:
```
curl -i -H "Accept:application/json" "http://yourDomain/cadastre/get?number=69:27:0000022:1306,69:27:0000022:1307"
```

#Скриншоты работы приложения
Web
<img src="https://imgur.com/3AjszkI" height="100px">

Rest
<img src="https://imgur.com/Ki2Tbso" height="100px">

Console
<img src="https://imgur.com/NLFgZqn" height="100px">