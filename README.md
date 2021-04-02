[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/garbuzivan/laravel-generator-package/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/garbuzivan/laravel-generator-package/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/garbuzivan/laravel-generator-package/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/garbuzivan/laravel-generator-package/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/garbuzivan/laravel-generator-package/badges/build.png?b=main)](https://scrutinizer-ci.com/g/garbuzivan/laravel-generator-package/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/garbuzivan/laravel-generator-package/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)

# Laravel generator package - Генератор пакетов для Laravel

<p><strong>Главная задача пакета, автоматизировать генерацию кода для решения бизнес задач при разработке на фреймворке Laravel:</strong></p>
<ul>
<li>Миграции</li>
<li>(Опционально) Фабрики (factories/seed)</li>
<li>Модель</li>
<li>CRUD интерфейс (без view для возможно переиспользовать в своих сценариях)</li>
<li>(Опционально) Интерфейс для Laravel Admin + route</li>
<li>(Опционально) Базовое API для работы с данными + route</li>
<li>(Опционально) API для передачи архитектуры формы и фильтров для автоматизации frontend + route</li>
<li>(Опционально) Базовые тесты</li>
</ul>

<p><strong>В отличии от других генераторов для Laravel, данный пакет:</strong></p> 
<ul>
<li>Упаковывает код в отдельный composer package.</li>
<li>Возможность реализовать кастомные поля.</li>
</ul>

### План работы
<ol>
<li>Устанавливаем пакет garbuzivan/laravel-generator-package</li>
<li>Настраиваем конфигурационный файл пакета, указав структуру и данные планируемых пакетов.</li>
<li>Запускаем генератор и на выходе получаем сгенерированные пакеты в отдельных категориях готовые для публикации и последующего использования.</li>
</ol>

## Install - Установка

<pre>composer require garbuzivan/laravel-generator-package</pre>

## Установка стандартного конфига

<pre>php artisan vendor:publish --force --provider="GarbuzIvan\LaravelGeneratorPackage\ServiceProvider" --tag="config"</pre>

