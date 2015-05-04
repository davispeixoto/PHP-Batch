# PHP-Batch

[![Latest Stable Version](https://img.shields.io/packagist/v/davispeixoto/php-batch.svg)](https://packagist.org/packages/davispeixoto/davispeixoto/php-batch)
[![Total Downloads](https://img.shields.io/packagist/dt/davispeixoto/php-batch.svg)](https://packagist.org/packages/davispeixoto/php-batch)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/davispeixoto/PHP-Batch/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/davispeixoto/PHP-Batch/?branch=master)
[![Codacy Badge](https://www.codacy.com/project/badge/647d1940502f4851bc2ab72e3245d0d0)](https://www.codacy.com/app/davis-peixoto/PHP-Batch)
[![Code Climate](https://codeclimate.com/github/davispeixoto/PHP-Batch/badges/gpa.svg)](https://codeclimate.com/github/davispeixoto/PHP-Batch)
[![Build Status](https://travis-ci.org/davispeixoto/PHP-Batch.svg?branch=master)](https://travis-ci.org/davispeixoto/PHP-Batch)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2418f5cc-d643-40fd-8d81-5f883845f5ef/small.png)](https://insight.sensiolabs.com/projects/2418f5cc-d643-40fd-8d81-5f883845f5ef)

A framework for PHP batch processing

## Motivation

- scalability for medium to large applications (let the servers to serve, and keep heavy processing in another offline place)
- PHP is popular and is getting better every day, in tools and community. And there is no such tool yet for PHP.
- Aside mainframe and big data worlds, apparently there is only [Spring Batch](http://projects.spring.io/spring-batch/), a Java framework for this sort of processing, and yes, this work is highly inspirated by it.

## Use cases

- images processing (resizing, watermarks, upload to CDN servers)
- processing credit cards payments
- weekly, end of month, quarters, etc, reports generation
- sending transactional notifications
- data sync between systems (ERP to CRM, for example)
- enterprise partners files transfer and processing

## Be Warned!

**More than other common software artifacts, heavy processes must be thought and architected way more thoroughly**

## Features

- Parallelization
- StopWatcher (for time-boxed batches)
- Manual Stop for Business Reasons
- Retry
- Skip
- Logging
- Events
- Chaining

## Installation

## Configuration

## Usage

## License

This software is licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Versioning

This project follows the [Semantic Versioning](http://semver.org/)

## Thanks

An amazing "Thank you, guys!" for [Jetbrains](https://www.jetbrains.com/) folks, 
who kindly empower this project with a free open-source license for [PhpStorm](https://www.jetbrains.com/phpstorm/) which can bring a whole new level of joy for coding.

[![Jetbrains][2]][1]

[![PhpStorm][4]][3]

  [1]: https://www.jetbrains.com/
  [2]: https://www.jetbrains.com/company/docs/logo_jetbrains.png
  [3]: https://www.jetbrains.com/phpstorm/
  [4]: https://www.jetbrains.com/phpstorm/documentation/docs/logo_phpstorm.png
