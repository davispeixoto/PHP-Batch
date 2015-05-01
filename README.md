# PHP-Batch

A framework for PHP batch processing

## Motivation

- scalability for medium to large applications (leverage the server to serve, and keep heavy processing in another place)
- PHP is popular and is getting better every day, in tools and community
- Aside mainframe and big data worlds, apparently there is only [Spring Batch](), a Java framework for this sort of processing, and yes, this work is highly inspirated by it.

## Use cases

- images resizing
- processing credit cards payments
- weekly, end of month, quarters, etc, reports generation
- sending notifications
- data sync between systems (ERP to CRM, for example)

## Be Warned!

**More than other common software artifacts, heavy processes must be thought and architected way more thoroughly**

## Features

- StopWatch (time-boxed batches)
- Manual Stop for Business Reasons
- Retry
- Skip
- Logging 
- Multi-thread
- Events
- Chaining

## Flow

Job -> Step(s) -> Worker(s) -> Task/Transaction(s) -> Item(s)