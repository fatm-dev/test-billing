# Test billing

currency: для того чтобы пользоваться тенге нужны подписка так что прямо сейчас просто с euro(грязные данные)

## Deployment

Чтобы запустить приложение

```bash
  composer install
  ./vendor/bin/sail up -d
  ./vendor/bin/sail migrate
  ./vendor/bin/sail db:seed   #Для создания тестовых пользюков
```
